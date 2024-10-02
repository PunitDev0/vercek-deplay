<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/gsap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Enhanced Navbar</title>
</head>

<style>
    .cart {
        scrollbar-width: none;
    }

    /* Hover underline effect */
    .hover-underline::after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        background: #000;
        transition: width 0.3s;
    }

    .hover-underline:hover::after {
        width: 100%;
    }

    /* Animated dropdown */
    .sub-menu {
        max-height: 0;
        opacity: 0;
        transform: translateY(-20px);
        transition: all 0.4s ease-in-out;
    }

    .user-icon:hover .sub-menu {
        max-height: 300px;
        opacity: 1;
        transform: translateY(0);
    }
</style>

<body class="min-h-screen min-w-full font-poppins text-black">
    <div class="">
        <nav id="navbar" class="flex justify-between items-center h-[65px] px-4 md:px-12 border-gray-200">
            <!-- Left section: Logo and Hamburger Menu -->
            <div class="flex items-center" id="menu">
                <div class="md:hidden">
                    <i class="bx bx-menu text-3xl cursor-pointer"></i>
                </div>
                <div class="ml-4">
                    <a href="./Home.php"><img src="../Assests/image/logo.png" alt="Logo" class="h-12 opacity-80 transition-opacity hover:opacity-100" /></a>
                </div>
            </div>

            <!-- Center section: Nav links -->
            <form id="nav-form" action="Product.php" method="GET" class="hidden md:flex gap-8 items-center text-sm font-semibold">
                <input type="hidden" name="page" id="page-input">
                <a href="./Home.php" class="hover-underline hover:text-gray-900 text-gray-600">Home</a>
                <a href="#" onclick="submitForm('1')" class="hover-underline hover:text-gray-900 text-gray-600">Polos</a>
                <a href="#" onclick="submitForm('2')" class="hover-underline hover:text-gray-900 text-gray-600">Watch</a>
                <a href="#" onclick="submitForm('3')" class="hover-underline hover:text-gray-900 text-gray-600">Shoes</a>
                <a href="#" onclick="submitForm('4')" class="hover-underline hover:text-gray-900 text-gray-600">Accessories</a>
                <a href="#" onclick="submitForm('')" class="hover-underline hover:text-gray-900 text-gray-600">Contact</a>
            </form>

            <?php $_SESSION['catgid'] = isset($_GET['page']) ? $_GET['page'] : " ";?>

            <!-- Right section: Icons and User Dropdown -->
            <div class="flex items-center gap-5 text-xl">
                <a href="#" class="relative group">
                    <i class="bx bx-heart hover:text-red-500 transition-all duration-200"></i>
                </a>
                <a href="#" class="relative group">
                    <i class="bx bx-cart hover:text-blue-500 transition-all duration-200"></i>
                </a>

                <!-- User icon and dropdown -->
                <div class="relative user-icon cursor-pointer">
                    <a href="./User_info.php" class="hover:text-blue-500 transition-all duration-200">
                        <i class="bx bxs-user"></i>
                    </a>

                    <!-- Sub-menu dropdown -->
                    <div class="sub-menu absolute z-30 right-10 w-52 bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
                        <div class="p-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden flex items-center justify-center">
                                    <?php
                                    if (isset($_SESSION['admin_image']) && !empty($_SESSION['admin_image'])) {
                                        echo '<img src="../images/user_images/' . $_SESSION['admin_image'] . '" alt="User Image" class="w-full h-full object-cover" />';
                                    } else if (isset($_SESSION['user_image']) && !empty($_SESSION['user_image'])) {
                                        echo '<img src="' . $_SESSION['user_image'] . '" alt="User Image" class="w-full h-full object-cover" />';
                                    } else {
                                        echo '<img src="../images/default-user.png" alt="Default User Image" class="w-full h-full object-cover" />';
                                    }
                                    ?>
                                </div>
                                <h1 class="text-gray-900 font-medium text-base">
                                    <?php
                                    if (isset($_SESSION['user_id'])) {
                                        echo $_SESSION['user_name'];
                                    } elseif (isset($_SESSION['admin_id'])) {
                                        echo $_SESSION['admin_name'];
                                    } else {
                                        echo 'Guest';
                                    }
                                    ?>
                                </h1>
                            </div>

                            <!-- Divider -->
                            <div class="w-full bg-gray-300 h-0.5 mt-4"></div>

                            <!-- Menu Links -->
                            <div class="mt-4 space-y-3">
                                <a href="./User_info.php" class="flex items-center gap-2 justify-between text-gray-700 hover:text-blue-500 transition-all">
                                    <i class="bx bxs-user-circle text-xl"></i>
                                    <p class="text-base">Edit Profile</p>
                                    <i class="bx bx-chevron-right text-xl"></i>
                                </a>
                                <a href="./User_Address.php" class="flex items-center gap-2 justify-between text-gray-700 hover:text-blue-500 transition-all">
                                    <i class="bx bx-map text-xl"></i>
                                    <p class="text-base">Address</p>
                                    <i class="bx bx-chevron-right text-xl"></i>
                                </a>
                                <a href="./MyOrders.php" class="flex items-center gap-2 justify-between text-gray-700 hover:text-blue-500 transition-all">
                                    <i class="bx bx-shopping-bag text-xl"></i>
                                    <p class="text-base">My Orders</p>
                                    <i class="bx bx-chevron-right text-xl"></i>
                                </a>

                                <!-- Divider -->
                                <div class="w-full bg-gray-300 h-0.5 mt-4"></div>

                                <!-- Sign Out -->
                                <a href="logout.php" class="flex gap-4 items-center text-red-500 hover:text-red-600 transition-colors duration-300">
                                    <i class="bx bx-power-off text-xl"></i>
                                    <p class="text-base">Sign Out</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>



        <div class="sidebar fixed top-0 left-0 h-screen w-52 backdrop-blur-lg p-5 transform -translate-x-52 transition-transform duration-300 ease-in-out z-10 flex flex-col gap-4 md:hidden" id="sidebar">
            <div class="absolute right-3 top-3 cursor-pointer bx-close">
                <i class="bx bx-x"></i>
            </div>
            <a class="sideEle" href="#">Home</a>
            <a class="sideEle" href="#" onclick="submitForm('polo_item')">Polos</a>
            <a class="sideEle" href="#" onclick="submitForm('shirt_item')">Shirts</a>
            <a class="sideEle" href="#" onclick="submitForm('Accessories_item')">Accessories</a>
            <a class="sideEle" href="#" onclick="submitForm('shoes_item')">Shoes</a>
            <a class="sideEle" href="#" onclick="submitForm('contact')">Contact</a>
            <i class="bx bx-home-heart sideEle"></i>
            <i class="bx bx-cart sideEle"></i>
            <i class="bx bxs-user sideEle"></i>
        </div>
        <div class="cart overflow-auto h-[100vh] fixed backdrop-blur-2xl w-[300px] translate-x-[300px] bg-gray-100 z-50 top-0 right-0 transition-transform duration-300 ease-in-out" id="cart">
            <div class="p-4 flex justify-between items-center">
                <h1 class="text-black text-xl font-bold">Cart</h1>
                <i class='bx bx-x text-2xl text-black cursor-pointer' id="bx-x"></i>
            </div>

            <!-- Cart Items -->
            <div class="p-4">
                <div class="flex items-center gap-4 mb-4">
                    <img src="../images/product_1.jpg" alt="Product Image" class="w-12 h-12 object-cover rounded-full" />
                    <div class="flex-1">
                        <h2 class="text-black text-sm">Product Name</h2>
                        <p class="text-black text-xs">$99.99</p>
                    </div>
                    <input type="number" value="1" min="1" max="10" class="w-12 text-sm text-black rounded-md" />
                </div>
                <!-- Repeat this block for each item in the cart -->
            </div>

            <!-- Cart Summary -->
            <div class="bg-white rounded-lg shadow-lg p-4 mx-4 mb-4">
                <div class="flex justify-between mb-4">
                    <span class="text-gray-700">6 items</span>
                    <!-- <span class="text-gray-700">$<?php echo $total; ?></span> -->
                </div>
                <div class="flex justify-between mb-4">
                    <span class="text-gray-700">Shipping</span>
                    <span class="text-gray-700">$7.00</span>
                </div>
                <div class="flex justify-between mb-4 font-bold">
                    <span class="text-gray-900">Total (tax excl.)</span>
                    <span class="text-gray-900">$1,091.00</span>
                </div>
                <div class="flex justify-between mb-6">
                    <span class="text-gray-700">Taxes</span>
                    <span class="text-gray-700">$0.00</span>
                </div>
                <a href="./Cart.php">
                    <button class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800">
                        Go to Cart
                    </button>
                </a>
            </div>
        </div>
        <div class="wishlist overflow-x-hidden h-[100vh] fixed backdrop-blur-2xl w-[300px] translate-x-[300px] bg-gray-100 z-50 top-0 right-0 transition-transform duration-300 ease-in-out" id="wishlist">
            <div class="p-4 flex justify-between items-center">
                <h1 class="text-black text-xl font-bold">Wishlist</h1>
                <i class='bx bx-x text-2xl text-black cursor-pointer' id="bx-wish"></i>
            </div>
            <?php
            include './config.php';
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            } else {
                $user_id = $_GET['userID'];
            }
            // $user_id = $_SESSION['user_id'] ?  $_SESSION['user_id'] : $_GET['user_id'];

            $query = "SELECT * FROM user_wishlist.wishlist_$user_id AS w 
                                    LEFT JOIN product_info.product_item AS pr 
                                    ON w.product_id = pr.product_id";

            $result = mysqli_query($wishlist, $query);

            $wishlistItems = [];
            $totalPrice = 0;
            $numrows = $result->num_rows;

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $wishlistItems[] = $row;
                    $totalPrice += $row['product_price'];
                }
            }

            foreach ($wishlistItems as $item) {
            ?>
                <!-- Cart Items -->
                <div class="p-4">
                    <div class="flex gap-4 mb-4">
                        <img src="../images/Product_images/<?php echo htmlspecialchars($item['product_image']); ?>" alt="Product Image" class="w-12 h-12 object-cover rounded-full" />
                        <div class="flex-1">
                            <h2 class="truncate text-black text-sm"><?php echo htmlspecialchars($item['product_name']); ?></h2>
                            <p class="text-black text-xs">$99.99</p>
                        </div>
                        <input type="number" value="1" min="1" max="10" class="w-12 text-sm text-black rounded-md" />
                    </div>
                </div>
            <?php
            }
            ?>


            <!-- Cart Summary -->
            <div class="bg-white rounded-lg shadow-lg p-4 mx-4 mb-4">
                <div class="flex justify-between mb-4">
                    <span class="text-gray-700">
                        <php echo $numrows> items
                    </span>
                    <span class="text-gray-700">$<?php echo $totalPrice; ?></span>
                </div>
                <div class="flex justify-between mb-4">
                    <span class="text-gray-700">Shipping</span>
                    <span class="text-gray-700">$7.00</span>
                </div>
                <div class="flex justify-between mb-4 font-bold">
                    <span class="text-gray-900">Total (tax excl.)</span>
                    <span class="text-gray-900">$1,091.00</span>
                </div>
                <div class="flex justify-between mb-6">
                    <span class="text-gray-700">Taxes</span>
                    <span class="text-gray-700">$0.00</span>
                </div>
                <form action="./Wishlist.php" method="GET">
                    <input type="hidden" name="userID" value="<?php echo $_SESSION['user_id'] ?>">
                    <button class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800">
                        Go to Wishlist
                    </button>

                </form>
            </div>

        </div>
        <script>
            // Optional: Close wishlist
            document.getElementById('bx-wish').addEventListener('click', function() {
                document.getElementById('wishlist').classList.add('translate-x-[300px]');
            });
        </script>
        <script src="../JS/Navbar.js"></script>
    </body>

    </html>