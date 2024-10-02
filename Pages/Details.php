<?php
session_start();
include './config.php';

if (!$product_info) {
    die("Connection failed: " . mysqli_connect_error());
}

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product_query = mysqli_query($product_info, "SELECT * FROM product_item WHERE product_id = $product_id");
$product = mysqli_fetch_assoc($product_query);
?>
<div class="Details font-sans antialiased">

    <div class="Navbar fixed w-full z-50">
        <?php include './Navbar.php'; ?>
    </div>
    <main class="container mx-auto p-4 py-28">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 p-2">
                <div class="product-images h-fit">
                    <div class="main-image mb-4">
                        <img src="../Images/Product_images/<?php echo $product['product_image']; ?>" alt="Product Image" class="mainImage w-full h-full object-contain rounded transition-all ease-in-out" style="max-height: 500px;">
                    </div>
                    <div class="swiper mySwiper4">
                        <div class="swiper-wrapper flex gap-10">
                            <?php
                            $related_items = mysqli_query($product_info, "SELECT * FROM product_images WHERE pr_id = $product_id");

                            // Initialize an array to store image filenames
                            $image_filenames = [];

                            while ($row = mysqli_fetch_assoc($related_items)) {
                                // Decode JSON data
                                $images_json = $row['pr_img']; // Assuming 'pr_img' contains JSON data
                                $images_array = json_decode($images_json, true); // Decode JSON to PHP array

                                if (is_array($images_array)) {
                                    // Add the image filenames to the array
                                    $image_filenames = array_merge($image_filenames, $images_array);
                                }
                            }

                            // Loop through image filenames and generate swiper slides
                            foreach ($image_filenames as $image_filename) {
                            ?>
                                <div class="swiper-slide flex-auto flex justify-center items-center">
                                    <div class="image w-24 h-24 md:w-32 md:h-32">
                                        <img src="../images/Product_images/RF_images/<?php echo htmlspecialchars($image_filename); ?>" class="w-full h-full object-contain rounded" alt="Related Image" id="relatedImage" />
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 p-2">
                <div class="product-details">
                    <h1 class="md:text-3xl text-lg font-bold mb-2"><?php echo $product['product_name']; ?></h1>
                    <p class="text-2xl text-red-600 mb-2">$<?php echo $product['product_price']; ?></p>
                    <p class="text-red-600 font-bold mb-4">HURRY! ONLY 3 ITEMS LEFT IN STOCK</p>
                    <div class="delivery-info mb-4 border-2 p-3 flex items-center gap-3">
                        <i class='bx bxs-truck text-5xl'></i>
                        <div class="div">
                            <p class="font-bold">Delivery: 3 Working Days</p>
                            <hr>
                            <p class="font-bold">Expected Delivery Date is 31st July, 2024</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <form action="Cart.php" method="POST" class="flex items-center gap-4">
                            <div class="quantity mb-4">
                                <label for="quantity" class="block mb-2">Quantity</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="10" value="1" class="border p-2 rounded w-20">
                            </div>
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <button type="submit" name="add_to_cart" class="add-to-cart bg-black text-white py-2 px-4 rounded transition duration-300 md:text-lg text-xs hover:bg-gray-700">ADD TO CART</button>
                        </form>
                        <form action="PaymentOrder.php" method="GET" class="flex items-center gap-4">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" name="buy_now" class="buy-now bg-green-500 text-white py-2 px-4 rounded transition duration-300 md:text-lg text-xs hover:bg-green-700">BUY NOW</button>
                        </form>
                    </div>
                    <div class="policies my-4 border-2 shadow-xl">
                        <div class="p-5 flex gap-3 items-center"><i class='bx bx-lock-alt text-red-500 text-3xl'></i>
                            <p>Security policy (edit with the Customer Reassurance module)</p>
                        </div>
                        <hr>
                        <div class="p-5 flex items-center gap-3"><i class='bx bxs-truck text-red-500 text-3xl'></i>
                            <p>Delivery policy (edit with the Customer Reassurance module)</p>
                        </div>
                        <hr>
                        <div class="p-5 flex items-center gap-3"><i class='bx bx-wallet-alt text-red-500 text-3xl'></i>
                            <p>Return policy (edit with the Customer Reassurance module)</p>
                        </div>
                    </div>
                    <div class="share mt-4">
                        <p class="mb-2">Share:</p>
                        <button class="bg-blue-600 text-white py-2 px-4 rounded mr-2">Facebook</button>
                        <button class="bg-blue-400 text-white py-2 px-4 rounded mr-2">Twitter</button>
                        <button class="bg-red-600 text-white py-2 px-4 rounded">Pinterest</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-tabs mt-8">
            <div class="tab mb-4">
                <button class="tablinks bg-gray-200 py-2 px-4 rounded-l" onclick="openTab(event, 'Description')">Description</button>
                <button class="tablinks bg-gray-200 py-2 px-4" onclick="openTab(event, 'ProductDetails')">Product Details</button>
            </div>
            <div id="Description" class="tabcontent">
                <h3 class="text-xl font-bold mb-6">About this item</h3>
                <ul class="px-10">
                    <?php
                    $bullet_points = explode('<br />', $product['product_details']);
                    foreach ($bullet_points as $point) {
                        echo '<li class="mb-4 list-disc">' . htmlspecialchars($point) . '</li>';
                    }
                    ?>
                </ul>
            </div>
            <div id="ProductDetails" class="tabcontent">
                <p>Product details content goes here...</p>
            </div>
        </div>

        <div id="AdditionalSection" class="container mx-auto my-12 p-4">
            <div class="flex flex-wrap items-center justify-center md:justify-between gap-4">
                <?php
                $related_items = mysqli_query($product_info, "SELECT * FROM product_item WHERE product_id = $product_id");

                // Initialize an array to store image filenames
                $image_filenames = [];

                while ($row = mysqli_fetch_assoc($related_items)) {
                    // Decode JSON data
                    $images_json = $row['Description_images']; // Assuming 'Description_images' contains JSON data
                    $images_array = json_decode($images_json, true); // Decode JSON to array

                    if (is_array($images_array)) {
                        // Add the image filenames to the array
                        $image_filenames = array_merge($image_filenames, $images_array);
                    }
                }

                // Loop through image filenamesf and generate swiper slides
                foreach ($image_filenames as $image_filename) {
                ?>
                    <div class="w-full p-2">
                        <img src="../images/Description_images/<?php echo htmlspecialchars($image_filename); ?>" alt="Additional Image" class="w-full h-auto object-contain rounded transition-all duration-500 transform hover:scale-105">
                    </div>
            </div>
        </div>
    <?php
                }
    ?>
    </main>
    <div class="Footer">
         <?php include './Footer.php'; ?>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.js"></script>
<script src="../JS/Details.js"></script>
<script>
  // Initialize Swiper for product images
  const swiper4 = new Swiper('.mySwiper4', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    freeMode: true,
    loop: true,
  });
</script>
</body>
</html>
