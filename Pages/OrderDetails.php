<?php
session_start();
include './config.php';
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Sanitize input
    $product_id = mysqli_real_escape_string($product_info, $product_id);

    // Fetch product details from the database
    $product_query = mysqli_query($product_info, "SELECT * FROM product_item WHERE product_id = $product_id");
    $product = mysqli_fetch_assoc($product_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/Order.css">
    <title>Order Details</title>
</head>
<body>
    <?php include 'Navbar.php'; ?>
    <div class="container mx-auto px-4 py-6 bg-gray-100 flex flex-col gap-5">
        <!-- Order Tracking Section -->
        <div class="bg-white p-4 mt-2 rounded shadow-2xl">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/4 mb-4 md:mb-0 flex-shrink-0">
                    <img src="../Images/Product_images/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product" class="w-full h-auto object-cover rounded">
                </div>
                <div class="md:w-1/2 md:pl-4">
                    <p class="text-lg font-semibold mb-2"><?php echo htmlspecialchars($product['product_name']); ?></p>
                    <p class="text-xl font-bold">₹<?php echo htmlspecialchars($product['product_price']); ?> <span class="text-green-500">2 Offers Applied</span></p>
                    <div class="mt-4">
                        <div class="tracker" role="list">
                            <div class="step completed" role="listitem" aria-label="Step 1: Order Confirmed" tabindex="0">
                                <div class="circle" aria-label="Completed Step 1">1
                                    <div class="tooltip">Order Confirmed</div>
                                </div>
                                <div class="step-text">Tue, 9th Jul</div>
                            </div>
                            <div class="step completed" role="listitem" aria-label="Step 2: Shipped" tabindex="0">
                                <div class="circle" aria-label="Completed Step 2">2
                                    <div class="tooltip">Shipped</div>
                                </div>
                                <div class="step-text">Tue, 9th Jul</div>
                            </div>
                            <div class="step active" role="listitem" aria-label="Step 3: Out for Delivery" tabindex="0">
                                <div class="circle" aria-label="Active Step 3">3
                                    <div class="tooltip">Out for Delivery</div>
                                </div>
                                <div class="step-text">Wed, 10th Jul</div>
                            </div>
                            <div class="step" role="listitem" aria-label="Step 4: Delivered" tabindex="0">
                                <div class="circle" aria-label="Upcoming Step 4">4
                                    <div class="tooltip">Delivered</div>
                                </div>
                                <div class="step-text">Wed, 10th Jul</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center mt-4">
                <button class="text-blue-500 mb-2 md:mb-0">Rate & Review Product</button>
                <button class="text-blue-500">Chat with us</button>
            </div>
        </div>

        <!-- Header Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white p-4 rounded shadow-2xl">
            <div class="text-left">
                <h2 class="text-xl font-semibold">Delivery Address</h2>
                <p>Kunal</p>
                <p>Gali no.8, house no.18, first floor...</p>
                <p>New Delhi - 110044</p>
                <p>Phone number: 8376905677</p>
            </div>
            <div class="text-center md:col-span-2">
                <h2 class="text-xl font-semibold">Your Rewards</h2>
                <p>12 SuperCoins Cashback</p>
                <p>Early Access to this Sale</p>
            </div>
            <div class="text-right md:col-span-2">
                <h2 class="text-xl font-semibold">More actions</h2>
                <button class="bg-blue-500 text-white px-4 py-2 rounded">Download Invoice</button>
            </div>
        </div>
    </div>
    <?php include 'Footer.php'; ?>
</body>
</html>
