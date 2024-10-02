<?php
session_start();
include './config.php';
if (isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'] ? $_POST['quantity'] : 0;
    $user_id = $_SESSION['user_id'];
    // echo $product_id;
    // echo $quantity;
    
    $querry = "INSERT INTO cart_$user_id (product_id, quantity) VALUES ($product_id, $quantity)";
    $result = mysqli_query($cart, $querry);

}
?>


    <div class="Navbar fixed w-full z-50">
            <?php include './Navbar.php'; ?>
        </div>
   <div class="MainCart py-14">
        <main class="container mx-auto p-4">
            <div class="flex flex-wrap">
                <hr>
                <div class="w-full p-2 flex flex-col md:flex-row gap-10">
                    <div class="border-2 border-gray-200 shadow-lg p-4 flex-1">
                        <h1 class="text-2xl font-bold mb-4 opacity-60">Shopping Cart</h1>
                        <div class="cart-items">
                        <?php
                                  $query = "SELECT * FROM user_cart.cart_$user_id AS w 
                                  LEFT JOIN product_info.product_item AS pr 
                                  ON w.product_id = pr.product_id";

                                $result = mysqli_query($cart, $query);
                                
                                $cartItems = [];
                                $totalPrice = 0;
                                $totalPriceWithTax = 0;
                                $Tax = 0;
                                  if ($result && $result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          $cartItems[] = $row;
                                          $totalPrice += $row['product_price'];
                                      }
                                      $Tax = $totalPrice * 0.10;
                                      $totalPriceWithTax = $totalPrice + $Tax;
                                  }
                                foreach ($cartItems as $item) {
                                    
                            ?>
                                <div class="cart-item flex flex-col md:flex-row items-center mb-2 border-2 p-2">
                                    <div class="w-full md:w-2/12 bg-gray-200">
                                        <img src="../images/Product_images/<?php echo $item['product_image']; ?>" alt="Product Image" class="w-full object-contain rounded h-full">
                                    </div>
                                    <div class="w-full md:w-2/4 pl-4 mt-2 md:mt-0">
                                        <h2 class="text-md font-bold"><?php echo $item['product_name']; ?></h2>
                                        <p class="text-lg text-red-600">$<?php echo $item['product_price']; ?></p>
                                    </div>
                                    <div class="w-full md:w-1/4 flex items-center mt-2 md:mt-0">
                                        <input type="number" value="<?php echo $item['quantity']; ?>" min="1" max="10" class="border p-2 rounded w-20 mr-4">
                                        <?php
                                        if(isset($_POST['remove_from_cart'])){
                                             $query = "DELETE FROM cart_$user_id WHERE product_id = '".$_POST['product_id']."'";
                                             $result = mysqli_query($cart, $query);
                                        }
                                        ?>
                                        <form method="POST" action="">
                                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                            <button type="submit" name="remove_from_cart" class="remove-item bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition-all duration-300">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            <?php  }?>
                            <a href="./Home.php">
                            <div class="flex items-center mt-4">
                                <i class='bx bx-chevron-left'></i>
                                <h1>Continue Shopping</h1>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="max-w-sm w-full md:w-3/6 h-fit mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow">
                        <div class="border-2 border-gray-200 rounded-lg shadow p-4">
                            <div class="flex justify-between mb-4">
                                <span>6 items</span>
                                <span>$<?php echo $totalPrice ?></span>
                            </div>
                            <div class="flex justify-between mb-4">
                                <span>Shipping</span>
                                <span>$7.00</span>
                            </div>
                            <div class="flex justify-between mb-4 font-bold">
                                <span>Total (tax excl.)</span>
                                <span>$<?php echo $totalPriceWithTax; ?></span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Taxes</span>
                                <span><?php echo $Tax?></span>
                            </div>
                            <a href="./PaymentOrder.php">
                            <button class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                                PROCEED TO CHECKOUT
                            </button>
                            </a>
                        </div>
                        
                        <div class="policies my-4 border-2 shadow-xl">
                            <div class="p-5 flex gap-3 items-center"><i class='bx bx-lock-alt text-red-500 text-3xl'></i><p>Security policy (edit with the Customer Reassurance module)</p></div>
                            <hr>
                            <div class="p-5 flex items-center gap-3"><i class='bx bxs-truck text-red-500 text-3xl'></i><p>Delivery policy (edit with the Customer Reassurance module)</p></div>
                            <hr>
                            <div class="p-5 flex items-center gap-3"><i class='bx bx-wallet-alt text-red-500 text-3xl'></i><p>Return policy (edit with the Customer Reassurance module)</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="Footer">
            <?php include './Footer.php'; ?>
        </div>

   </div>
<script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.js" ></script>
