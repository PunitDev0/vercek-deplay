<?php
include './config.php';

if (!$product_info) {
  die("Connection failed: " . mysqli_connect_error());
}
echo $_SESSION['catgid'];
$catgid = $_SESSION['catgid'];

$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'relevance';

switch ($sort_by) {
  case 'price-asc':
    $order_by = 'product_price ASC';
    break;
  case 'price-desc':
    $order_by = 'product_price DESC';
    break;
  default:
    $order_by = 'product_id ASC';
    break;
}
echo $sort_by;


$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 1000;

$query = "SELECT * FROM product_item WHERE product_catg=$catgid AND product_price BETWEEN $min_price AND $max_price order by $order_by";
$item = mysqli_query($product_info, $query);
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
  .buttons {
    visibility: hidden;
    transition: all ease-in-out;
  }

  .mySwiper:hover .buttons {
    visibility: visible;
  }
</style>

<div class="container mx-auto p-4">
  <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php
    while ($items = mysqli_fetch_array($item)) {
    ?>
      <div class="bg-white rounded-lg h-auto overflow-hidden flex flex-col relative p-2">
        <?php
        if (isset($_SESSION['user_logged_in'])) {
          $user_id = $_SESSION['user_id'];
        }
        $product_id = $items['product_id'];
        ?>
        <div class="swiper mySwiper w-full">
          <div class="item-card p-4 z-50 rounded-lg absolute right-0">
            <form id="hidden-form" method="POST" style="display: none;">
              <input type="hidden" name="action" id="form-action">
              <input type="hidden" name="product_id" id="form-product_id">
              <input type="hidden" name="user_id" id="form-user_id" value="<?php echo $user_id; ?>">
            </form>
            <i class="fas fa-heart heart-icon text-gray-400 cursor-pointer text-xl transition-colors duration-300" data-product-id="<?php echo $product_id; ?>"></i>
          </div>

          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="h-full w-full p-2 border flex items-center justify-center overflow-hidden">
                <img class="object-contain h-64 w-auto" src="../Images/Product_images/<?php echo $items['product_image']; ?>" alt="<?php echo $items['product_name']; ?>">
              </div>
            </div>
            <?php
            $related_items = mysqli_query($product_info, "SELECT * FROM product_images WHERE pr_id = $product_id");

            $image_filenames = [];
            while ($row = mysqli_fetch_assoc($related_items)) {
              $images_json = $row['pr_img'];
              $images_array = json_decode($images_json, true);
              if (is_array($images_array)) {
                $image_filenames = array_merge($image_filenames, $images_array);
              }
            }

            foreach ($image_filenames as $image_filename) {
            ?>
              <div class="swiper-slide">
                <div class="p-2 border flex items-center justify-center overflow-hidden ">
                  <img class="object-contain z-[-10] h-64" src="../images/Product_images/RF_images/<?php echo htmlspecialchars($image_filename); ?>" alt="Product Image">
                </div>
              </div>
            <?php
            }
            ?>
          </div>

          <div class="z-50 absolute -translate-y-10 m-auto">
            <button class="buttons absolute translate-x-52 text-2xl" id="custom-prev-button">
              <i class='bx bxs-chevron-right'></i>
            </button>
            <button class="buttons absolute custom-next-button text-2xl">
              <i class='bx bxs-chevron-left translate-x-5'></i>
            </button>
          </div>
        </div>

        <div class="p-4 text-center">
          <p class="truncate text-sm sm:text-base md:text-base lg:text-base">
            <?php echo $items['product_name']; ?>
          </p>
          <p class="text-red-500 text-sm sm:text-lg md:text-xl lg:text-2xl mt-2">
            $<?php echo $items['product_price']; ?>
          </p>
          <div class="flex justify-between space-x-2 mt-2">
               <?php
              $query = "SELECT * FROM cart_$user_id WHERE product_id = $product_id";
              // Run the query and check if it succeeded
              $result = mysqli_query($cart, $query);
               ?>
            <form action="<?php echo  (mysqli_num_rows($result) > 0) ? "Cart.php" : "details.php" ?>" method="GET">
              <input type="hidden" name="id" value="<?php echo $items['product_id']; ?>">
              <button type="submit" class="add-to-cart bg-black text-white py-1 px-2 sm:px-3 sm:py-2 text-xs sm:text-sm md:text-xs rounded transition duration-300 hover:bg-gray-700 w-full">
                <?php
                  if(mysqli_num_rows($result) > 0){
                    // Product is already in the cart
                    echo "Go to Cart";
                        } else {
                            // Product is not in the cart
                            echo "Add to Cart";
                        }
                    
                ?>
              </button>
            </form>
            <form action="details.php" method="GET">
              <input type="hidden" name="id" value="<?php echo $items['product_id']; ?>">
              <button type="submit" class="buy-now bg-green-500 text-white py-1 px-2 sm:px-3 sm:py-2 text-xs sm:text-sm md:text-xs rounded transition duration-300 hover:bg-green-700 w-full">
                Buy Now
              </button>
            </form>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="../JS/Card.js"></script>
