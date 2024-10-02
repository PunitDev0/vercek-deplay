<?php
session_start();
include './config.php'; // Assuming this contains the $conn database connection

// Check if user ID is present in session
if (!isset($_SESSION['user_id'])) {
    die("Error: User ID not found in session.");
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    // Get user input and sanitize it
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $address1 = htmlspecialchars($_POST['addressLine1']);
    $address2 = htmlspecialchars($_POST['addressLine2']);
    $city = htmlspecialchars($_POST['city']);
    $state = htmlspecialchars($_POST['state']);
    $zipCode = htmlspecialchars($_POST['zipCode']);
    $country = htmlspecialchars($_POST['country']);
    $phone = htmlspecialchars($_POST['phoneNumber']);

    // Create an array for the new address data
    $newAddress = [
        'fname' => $firstName,
        'lname' => $lastName,
        'address' => $address1,
        'address2' => $address2,
        'city' => $city,
        'state' => $state,
        'zip_code' => $zipCode,
        'country' => $country,
        'phone' => $phone
    ];

    // Prepare a SELECT statement to retrieve existing addresses
    $stmt = $conn->prepare("SELECT User_Address FROM user_info WHERE id = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the user ID parameter
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Decode the existing addresses from JSON
    $existingAddresses = [];
    if ($row && !empty($row['User_Address'])) {
        $existingAddresses = json_decode($row['User_Address'], true);
        // Handle JSON decoding errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            die("Error decoding JSON: " . json_last_error_msg());
        }
    }

    // Add the new address to the existing array
    $existingAddresses[] = $newAddress; // Adding as a new entry

    // Convert the updated address array back to JSON
    $updatedAddressesJson = json_encode($existingAddresses, JSON_PRETTY_PRINT);

    // Prepare to update the database
    $stmt = $conn->prepare("UPDATE user_info SET User_Address = ? WHERE id = ?");
    if (!$stmt) {
        die("Error preparing update statement: " . $conn->error);
    }

    // Bind the parameters (JSON string and user ID)
    $stmt->bind_param("si", $updatedAddressesJson, $user_id);

    // Execute the UPDATE query
    if ($stmt->execute()) {
        echo "User address updated successfully.";
    } else {
        die("Error updating record: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();
}

// Retrieve user addresses for displaying on the form
$query = $conn->prepare("SELECT User_Address FROM user_info WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

if ($row && !empty($row['User_Address'])) {
    $user_address = json_decode($row['User_Address'], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Error decoding JSON: " . json_last_error_msg());
    }
    
    // Print user address for debugging
  
} else {
    echo "No address found for this user.";
}


// Handle address deletion
if (isset($_POST['delete'])) {
    $indexToDelete = $_POST['address_index'];

    // Remove the selected address from the array
    unset($user_address[$indexToDelete]);

    // Reindex the array to maintain consistency
    $addresses = array_values($user_address);

    // Convert the updated array back to JSON and update the database
    $updatedAddressesJson = json_encode($user_address, JSON_PRETTY_PRINT);
    $stmt = $conn->prepare("UPDATE user_info SET User_Address = ? WHERE id = ?");
    $stmt->bind_param("si", $updatedAddressesJson, $user_id);
    
    if ($stmt->execute()) {
        echo "Address deleted successfully.";
    } else {
        die("Error updating record: " . $stmt->error);
    }

    // Reload the page to reflect changes
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


// Close the database connection
$conn->close();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Addresses</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        #addressForm {
    max-height: 0;
    opacity: 0;
    overflow: hidden;
    transition: max-height 0.5s ease-out, opacity 0.5s ease-out;
}

#addressForm.show {
    max-height: 1000px; /* Adjust according to your form's expected height */
    opacity: 1;
}

    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <?php include 'Navbar.php'; ?>
    <div class="min-h-screen flex flex-col md:flex-row">
        
        <!-- Sidebar -->
        <div class="bg-white shadow-md w-full mt-6 md:w-64 p-6">
            <div class="flex items-center shadow-xl space-x-4 mb-8">
                <div class="w-14 h-14 bg-gray-300 rounded-full overflow-hidden flex items-center justify-center">
                    <?php
                    if (isset($_SESSION['admin_image']) && !empty($_SESSION['admin_image'])) {
                        echo '<img src="../images/user_images/' . $_SESSION['admin_image'] . '" alt="User Image" class="w-full h-full object-cover"/>';
                    } else if (isset($_SESSION['user_image']) && !empty($_SESSION['user_image'])) {
                        echo '<img src="' . $_SESSION['user_image'] . '" alt="User Image" class="w-full h-full object-cover"/>';
                    } else {
                        echo '<img src="../images/default-user.png" alt="Default User Image" class="w-full h-full object-cover"/>';
                    }
                    ?>
                </div>
                <div>
                    <h2 class="text-xl font-semibold">Puneet Kumar</h2>
                </div>
            </div>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="./MyOrders.php" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                            <i class='bx bx-home'></i>
                            <span>My Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="./User_info.php" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                            <i class='bx bx-user'></i>
                            <span>Profile Information</span>
                        </a>
                    </li>
                    <li class="text-blue-600">
                        <a href="#" class="flex items-center space-x-2">
                            <i class='bx bx-map'></i>
                            <span>Manage Addresses</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                            <i class='bx bx-id-card'></i>
                            <span>PAN Card Information</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <form class="flex-1 lg:p-6 md:p-4 p-2" method="POST">
            <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md lg:p-6 md:p-4 p-2">
                <h2 class="text-2xl font-semibold mb-4">Manage Addresses</h2>
                <?php if (isset($successMessage)) : ?>
                    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                        <?php echo $successMessage; ?>
                    </div>
                <?php elseif (isset($errorMessage)) : ?>
                    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <button id="addAddressBtn" class="mb-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    + Add a New Address
                </button>

                <div id="addressForm" class="bg-blue-50 p-6 rounded-lg shadow-inner hidden">
                <h3 class="text-xl font-semibold mb-4">Edit Address</h3>
                <button class="px-4 py-2 mb-6 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Use my current location
                </button>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-gray-700">First Name</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="firstName" >
                        </div>
                        <div>
                            <label class="block text-gray-700">First Name</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="lastName" placeholder="">
                        </div>
                        <div>
                            <label class="block text-gray-700">10-digit mobile number</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="phoneNumber" placeholder="">
                        </div>
                        <div>
                            <label class="block text-gray-700">Pincode</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="zipCode" placeholder="">
                        </div>
                        <div>
                            <label class="block text-gray-700">Locality</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="country" placeholder="">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700">Address1 (Area and Street)</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="addressLine1" placeholder="">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700">Address2 (Area and Street)</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="addressLine2" placeholder="">
                        </div>
                        <div>
                            <label class="block text-gray-700">City/District/Town</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="city" placeholder="">
                        </div>
                        <div>
                            <label class="block text-gray-700">State</label>
                            <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="state" placeholder=""></input>
                        </div>
                    </div>
                    <!-- Save Button -->
                    <div class="mt-6 flex justify-end">
                        <button name="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                            Save
                        </button>
                    </div>
                </div>
            </div>
            <div class="container mx-auto p-4">
            <?php if (!empty($user_address)) : ?>
             <?php foreach ($user_address as $index => $address) : ?>
                <div class="bg-white shadow-lg rounded-lg p-4 mb-4 flex justify-between items-center space-x-4">
                    <div>
                        <h2 class="font-bold"><?= htmlspecialchars($address['fname'] . ' ' . $address['lname']) ?></h2>
                        <p><?= htmlspecialchars($address['phone']) ?></p>
                        <p><?= htmlspecialchars($address['address'] . ', ' . $address['address2'] . ', ' . $address['city'] . ', ' . $address['state'] . ' - ') ?>
                        <strong><?= htmlspecialchars($address['zip_code']) ?></strong></p>
                    </div>
                    <div class="relative">
                        <button id="menu-btn-<?= $index ?> " class="menu-btn text-gray-600 focus:outline-none">
                            <!-- Three dots icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="menu-<?= $index ?>" class="deletebutton hidden absolute right-0 bg-white shadow-lg rounded-lg py-2 w-32">
                        <form method="POST" action="">
                            <input type="hidden" name="address_index" value="<?= $index ?>">
                            <button type="submit" name="delete" class="block w-full text-left px-4 py-2 hover:bg-gray-200">Delete</button>
                        </form>
                    </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else : ?>
                    <p>No addresses found.</p>
                <?php endif; ?>
            </div>
        </form>
    </form>

    </div>
</body>
<script>
   document.querySelectorAll(".menu-btn").forEach((btn, index) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault()
            const menu = document.querySelector('.deletebutton');
            menu.classList.toggle('hidden');
        });
    });

    document.getElementById('addAddressBtn').addEventListener('click', function(e) {
        e.preventDefault();

    const addressForm = document.getElementById('addressForm');

    if (addressForm.classList.contains('hidden')) {
        addressForm.classList.remove('hidden');
        setTimeout(() => {
            addressForm.classList.add('show');
        }, 10); // A slight delay to trigger the animation
    } else {
        addressForm.classList.remove('show');
        setTimeout(() => {
            addressForm.classList.add('hidden');
        }, 500); // Wait for animation to complete before hiding
    }
});
</script>

</html>