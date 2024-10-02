<?php
session_start();
include './config.php'; // Include your database connection file

// Fetch user ID from session or other logic
$user_id = $_SESSION['user_id'];

// Query to get user orders and associated product details

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div>
        <?php include'./Navbar.php'?>
    </div>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="bg-white shadow-md w-full mt-6 md:w-64 p-6">
            <div class="flex items-center space-x-4 shadow-xl mb-8">
            <div class="w-14 h-14 bg-gray-300 rounded-full overflow-hidden flex items-center justify-center">
                            <?php
                                if(isset($_SESSION['admin_image']) && !empty($_SESSION['admin_image'])) {
                                    echo '<img src="../images/user_images/' . $_SESSION['admin_image'] . '" alt="User Image" class="w-full h-full object-cover"/>';
                                } else if(isset($_SESSION['user_image']) && !empty($_SESSION['user_image'])){
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
                        <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
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
            <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md lg:p-6 md:p-4 p-2">
                <h2 class="text-2xl font-semibold mb-4">My Orders</h2>
                <div class="space-y-4">
                    <!-- Order 1 -->
                     <?php 
                     $user_id = $_SESSION['user_id'];
                        $query = "SELECT * FROM product_info.user_order AS w 
                        LEFT JOIN product_info.product_item AS pr 
                        ON w.product_id = pr.product_id where user_id = '$user_id'";

                        $result = mysqli_query($product_info,$query);
                        while($row = mysqli_fetch_assoc($result)){
                     ?>
                    <a href="./OrderDetails.php?product_id=<?php echo urlencode($row['product_id']); ?>" class="block border border-gray-300 rounded-lg p-2 flex items-center space-x-4">
                        <img class="w-16 h-16 object-cover rounded" src="../Images/Product_images/<?php echo htmlspecialchars($row['product_image']); ?>" alt="Product Image">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold"><?php echo $row['product_name']; ?></h3>
                            <p class="text-sm text-gray-600"><?php $row['product_price']; ?></p>
                        </div>
                        <span class="text-green-600 font-semibold">Delivered</span>
                    </a>
                        <?php
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
