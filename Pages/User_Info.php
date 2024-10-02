<?php
session_start();
include './config.php'; // Replace with your database connection

// Ensure the user is logged in and session contains user_id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch the current profile information
    $sql = "SELECT Personal_info FROM user_info WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind the user ID to the query
        $stmt->bind_param("i", $user_id);

        // Execute the query
        $stmt->execute();

        // Bind the result to a variable
        $stmt->bind_result($profile_info_json);

        // Fetch the result
        if ($stmt->fetch()) {
            // Decode the JSON object
            $profile_info = json_decode($profile_info_json, true);
            // print_r($profile_info); // Use this for debugging purposes
        }

        // Close the statement
        $stmt->close();
    }

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Create a JSON object with the profile data
        $profile_data = json_encode([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'email' => $email,
            'phone' => $phone
        ]);

        // SQL query to update the user's profile info
        $sql = "UPDATE user_info SET Profile_info = ? WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters and execute
            $stmt->bind_param("si", $profile_data, $user_id);

            if ($stmt->execute()) {
                // Success message
                echo "Profile updated successfully.";
            } else {
                // Error message
                echo "Error updating profile: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        // Close the connection
        $conn->close();
    }
} else {
    echo "User not logged in.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Information</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div>
        <?php include './Navbar.php' ?>
    </div>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="bg-white shadow-md w-full mt-6 md:w-64 p-6">
            <div class="flex items-center space-x-4 shadow-xl mb-8">
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
                        <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                            <i class='bx bx-user'></i>
                            <span class="text-blue-600">Profile Information</span>
                        </a>
                    </li>
                    <li>
                        <a href="./User_Address.php" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
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
        <div class="flex-1 lg:p-6 md:p-4 p-2">
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md lg:p-6 md:p-4 p-2">
                <h2 class="text-2xl font-semibold mb-4">Personal Information</h2>
                <form method="POST">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-gray-700">First Name</label>
                            <input type="text" name="first_name" value="<?php echo $profile_info['first_name']?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Last Name</label>
                            <input type="text"  value="<?php echo $profile_info['last_name']?>" name="last_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Your Gender</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="male" <?= ($profile_info['gender'] == "Male") ? "checked" : ""; ?>>
                                    <span class="ml-2">Male</span>
                                </label>
                                <label class="inline-flex items-center">
                                  <input type="radio" name="gender" value="Female" <?= ($profile_info['gender'] == "Female") ? "checked" : ""; ?>>
                                    <span class="ml-2">Female</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700">Email Address</label>
                            <input type="email"  value="<?php echo $profile_info['email' ]?>" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
                        </div>
                        <div>
                            <label class="block text-gray-700">Mobile Number</label>
                            <input type="text" name="phone"  value="<?php echo $profile_info['phone']?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
                        </div>
                    </div>
                    <button class="mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Save Changes
                    </button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>