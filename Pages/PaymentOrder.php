<?php
session_start();
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Checkout</title>
	<link rel="icon" type="image/png" href="images/icons/favicon.png" />
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
	<div class="fixed w-full z-50">
		<?php include './Navbar.php' ?>
	</div>
	<div class="grid sm:px-10 lg:grid-cols-2 gap-5 lg:px-20 xl:px-32 py-16">
		<div>
			<?php
			$user_id = $_SESSION['user_id'];
			$query = mysqli_query($conn, "SELECT User_Address FROM user_info WHERE id = $user_id");
			$row = mysqli_fetch_array($query);
			$_SESSION['address'] = $row['User_Address'];
			$user_address = json_decode($row['User_Address'], true);
			?>

			<div class="p-4 pt-8 mt-5 rounded-lg border bg-white">
				<p class="text-xl font-medium">Address</p>
				<div class="mt-8 space-y-4 rounded-lg border bg-white px-4 py-6 sm:px-6">
					<div class="flex flex-col sm:flex-row">
						<div class="flex w-full flex-col px-4 py-2">
							<span class="font-semibold text-lg"><?php echo $user_address['fname'] . " " . $user_address['lname']; ?></span>
							<p class="text-gray-600"><?php echo $user_address['address'] . ", " . $user_address['address2']; ?></p>
							<p class="text-gray-600"><?php echo $user_address['city'] . ", " . $user_address['state'] . " " . $user_address['zip_code']; ?></p>
							<p class="text-gray-600"><?php echo $user_address['country']; ?></p>
						</div>
					</div>
				</div>
			</div>

			<div class="px-4 pt-8 border rounded-lg shadow-xl mt-5">
				<p class="text-xl font-medium">Order Summary</p>
				<p class="text-gray-400">Check your items. And select a suitable shipping method.</p>
				<div class="mt-8 space-y-3  bg-white px-2 py-4 sm:px-6 max-h-[300px] overflow-y-auto">
					<?php
					$product_id = $_GET['product_id'];
					$_SESSION['product_id'] = $product_id;

					$related_items = mysqli_query($product_info, "SELECT * FROM product_item WHERE product_id = $product_id");

					$item = mysqli_fetch_assoc($related_items);
					echo $item['product_name'];
					?>
						<div class="flex flex-col rounded-lg bg-white sm:flex-row border ">
							<img class="m-2 h-24 w-28 rounded-md border object-cover object-center" src="../Images/Product_images/<?php echo $item['product_image'] ?>" alt="" />
							<div class="flex w-full flex-col px-4 py-4">
								<span class="font-semibold"><?php echo $item['product_name'] ?></span>
								<p class="text-lg font-bold">$<?php echo $item['product_price'] ?></p>
							</div>
						</div>
				</div>
			</div>
		</div>
		<div class=" bg-gray-50 px-4 pt-8 lg:mt-5 rounded-lg border h-fit ">
			<p class="mt-8 text-lg font-medium">Shipping Methods</p>
			<form class="mt-5 grid gap-4">
				<span class="block font-semibold mb-2 text-lg">Payment</span>

				<!-- Payment Options Container -->
				<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-10">
					<!-- Card Payment Option -->
					<label class="peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4 items-center justify-center hover:shadow-md transition-shadow duration-150 ease-in-out">
						<input type="radio" name="payment" value="card" class=" peer" id="Card" />
						<div class="flex flex-col items-center">
							<!-- Card Icon (You can use icons from Boxicons or similar libraries) -->
							<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 8H3V6a2 2 0 012-2h14a2 2 0 012 2v2zM3 10h18v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6z" />
							</svg>
							<span class="text-sm font-medium text-gray-700">Card</span>
						</div>
					</label>

					<!-- Wallet Payment Option -->
					<label class="peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4 items-center justify-center hover:shadow-md transition-shadow duration-150 ease-in-out">
						<input type="radio" name="payment" value="wallet" class=" peer" />
						<div class="flex flex-col items-center">
							<!-- Wallet Icon -->
							<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z" />
							</svg>
							<span class="text-sm font-medium text-gray-700">Wallet</span>
						</div>
					</label>

					<!-- Cash Payment Option -->
					<label class="peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4 items-center justify-center hover:shadow-md transition-shadow duration-150 ease-in-out">
						<input type="radio" name="payment" value="cash" class=" peer" />
						<div class="flex flex-col items-center">
							<!-- Cash Icon -->
							<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-3.866 0-7 1.79-7 4s3.134 4 7 4 7-1.79 7-4-3.134-4-7-4zM12 8V4m0 4v4" />
							</svg>
							<span class="text-sm font-medium text-gray-700">Cash</span>
						</div>
					</label>
				</div>
			</form>


			<div class="mt-10 ">
				<p class="text-xl font-medium">Payment Details</p>
				<p class="text-gray-400">Complete your order by providing your payment details.</p>
				<!-- <div id="cardPayment">
					<label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
					<div class="relative">
						<input type="text" id="email" name="email" class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="your.email@gmail.com" />
						<div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
							</svg>
						</div>
					</div>
					<label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Card Holder</label>
					<div class="relative">
						<input type="text" id="card-holder" name="card-holder" class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Your full name here" />
						<div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
							</svg>
						</div>
					</div>
					<label for="card-no" class="mt-4 mb-2 block text-sm font-medium">Card Details</label>
					<div class="flex">
						<div class="relative w-7/12 flex-shrink-0">
							<input type="text" id="card-no" name="card-no" class="w-full rounded-md border border-gray-200 px-2 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="xxxx-xxxx-xxxx-xxxx" />
							<div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
								<svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z" />
									<path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z" />
								</svg>
							</div>
						</div>
						<input type="text" name="credit-expiry" class="w-full rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="MM/YY" />
						<input type="text" name="credit-cvc" class="w-1/6 flex-shrink-0 rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="CVC" />
					</div>
					<label for="billing-address" class="mt-4 mb-2 block text-sm font-medium">Billing Address</label>
					<div class="flex flex-col sm:flex-row">
						<div class="relative flex-shrink-0 sm:w-7/12">
							<input type="text" id="billing-address" name="billing-address" class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Street Address" />
							<div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
								<img class="h-4 w-4 object-contain" src="https://flagpack.xyz/_nuxt/4c829b6c0131de7162790d2f897a90fd.svg" alt="" />
							</div>
						</div>
						<select type="text" name="billing-state" class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500">
							<option value="State">State</option>
						</select>
						<input type="text" name="billing-zip" class="flex-shrink-0 rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none sm:w-1/6 focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="ZIP" />
					</div>

				</div> -->
				<div class="mt-6 border-t border-b py-2">
					<div class="flex items-center justify-between">
						<p class="text-sm font-medium text-gray-900">Subtotal</p>
						<p class="font-semibold text-gray-900">$<?php echo $item['product_price'] ?></p>
					</div>
					<div class="flex items-center justify-between">
						<p class="text-sm font-medium text-gray-900">Shipping</p>
						<p class="font-semibold text-gray-900">$<?php echo $Total = $item['product_price'] + 40?></p>
					</div>
				</div>
				<div class="mt-6 flex items-center justify-between">
					<p class="text-sm font-medium text-gray-900">Total</p>
					<p class="text-2xl font-semibold text-gray-900">$<?php echo $Total ?></p>
				</div>
				<form action="#" method="POST">
					<input type="hidden" name="product_id" value="<?php echo $_SESSION['product_id']?>">
					<button id="button" class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Place Order</button>
				</form>
			</div>
		</div>
	</div>
	</div>
	<?php
include('config.php'); // Ensure this contains database connection setup
require_once '../razorpay/Razorpay.php';

use Razorpay\Api\Api;

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die(json_encode(['status' => 'failure', 'error' => 'User not logged in.']));
}

$user_id = $_SESSION['user_id'];
$_SESSION['total'] = $Total; 
// Razorpay API credentials
$keyId = 'rzp_test_kBREEooxYkKLPo'; 
$keySecret = 'P5NsdNUNPas0c0C74oCjkk1Y';  

$api = new Api($keyId, $keySecret);
// Create a new Razorpay order
try {
    $order = $api->order->create([
        'amount' => $Total * 100,  // Amount in paise (1 INR = 100 paise)
        'currency' => 'INR',
        'receipt' => 'order_rcptid_' . $user_id,
        'payment_capture' => 1 // Auto-capture
    ]);

    $orderId = $order['id'];
    // echo json_encode(['status' => 'success', 'order_id' => $orderId]);

} catch (Exception $e) {
    die(json_encode(['status' => 'failure', 'error' => $e->getMessage()]));
}

?>
	<script src="../JS/Main.js"></script>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script>
document.getElementById('button').onclick = function(e) {
    e.preventDefault();

    var options = {
        "key": "<?php echo $keyId; ?>", // Razorpay Key ID
        "amount": "<?php echo $Total * 100; ?>", // Amount in paise
        "currency": "INR",
        "name": "Your Website Name",
        "description": "Purchase Description",
        "image": "../Assests/image/logo.png", // Company logo
        "order_id": "<?php echo $orderId; ?>", // Razorpay Order ID
        "handler": function(response) {
            // Simulate successful payment in test mode
            console.log("Simulating successful payment in test mode");

            // $.ajax({
            //     url: "verify_payment.php",
            //     type: "POST",
            //     data: {
            //         payment_id: response.razorpay_payment_id,
            //         order_id: response.razorpay_order_id,
            //         signature: response.razorpay_signature
            //     },
            //     success: function(data) {
            //         alert('Payment verified successfully!');
            //     },
            //     error: function(err) {
            //         alert('Payment verification failed!');
            //     }
            // });
        },
        "theme": {
            "color": "#3399cc"
        }
    };

    var rzp = new Razorpay(options);
    rzp.open();
}

</script>

</body>

</html>