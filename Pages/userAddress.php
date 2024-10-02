<?php
include './config.php';
session_start();

// Make sure $user_id is defined properly
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die("Error: User ID not found in session.");
}

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address1 = $_POST['addressLine1'];
    $address2 = $_POST['addressLine2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode'];
    $country = $_POST['country'];
    $phone = $_POST['phoneNumber'];

    $fullAddress = $address1 . ' ' . $address2;
    $customerData = [
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

    // Convert array to JSON string
    $customerJson = json_encode($customerData);

    // Use a prepared statement to avoid SQL injection
    $stmt = $conn->prepare("UPDATE user_info SET User_address = ? WHERE id = ?");
    $stmt->bind_param("si", $customerJson, $user_id);

    // Execute the query
    if ($stmt->execute()) {
        echo "User address updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="Navbar sticky   ">
      <?php include './Navbar.php' ?>
    </div>
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Shipping Address</h2>
        <form id="addressForm" class="grid grid-cols-1 md:grid-cols-2 gap-6" method = "POST">
            <div>
                <label class="block text-sm font-medium text-gray-700" for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700" for="addressLine1">Address Line 1</label>
                <input type="text" id="addressLine1" name="addressLine1" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700" for="addressLine2">Address Line 2</label>
                <input type="text" id="addressLine2" name="addressLine2" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="city">City</label>
                <input type="text" id="city" name="city" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="state">State/Province</label>
                <input type="text" id="state" name="state" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="zipCode">Zip/Postal Code</label>
                <input type="text" id="zipCode" name="zipCode" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="country">Country</label>
                <input type="text" id="country" name="country" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700" for="phoneNumber">Phone Number</label>
                <input type="text" id="phoneNumber" name="phoneNumber" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="col-span-2 flex justify-end">
                <button type="submit" name ="submit" class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md">Save Address</button>
            </div>
        </form>
    </div>
    <div class="">
        <?php include './Footer.php'; ?>
    </div>
</body>
</html>