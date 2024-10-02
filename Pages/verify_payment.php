<?php
session_start();
include('config.php'); // Database connection
require_once '../razorpay/Razorpay.php';

use Razorpay\Api\Api;

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die(json_encode(['status' => 'failure', 'error' => 'User not logged in.']));
}

$user_id = $_SESSION['user_id'];

// Razorpay API credentials
$keyId = 'rzp_test_kBREEooxYkKLPo'; 
$keySecret = 'P5NsdNUNPas0c0C74oCjkk1Y';

$api = new Api($keyId, $keySecret);

// Fetch payment details from POST request
$payment_id = $_POST['payment_id'];
$order_id = $_POST['order_id'];
$signature = $_POST['signature'];
$product_id = $_SESSION['product_id'];

// Fetch other order details (like amount, address) if not stored earlier
$amount = $_SESSION['total'];  // Example amount, should be stored or fetched dynamically
$currency = 'INR';
$address = $_SESSION['address']; // Should be fetched dynamically from session or DB

try {
    // Verify payment signature
    $attributes = [
        'razorpay_order_id' => $order_id,
        'razorpay_payment_id' => $payment_id,
        'razorpay_signature' => $signature
    ];

    $api->utility->verifyPaymentSignature($attributes);

    // Payment verified, update the database
    $status = 'completed';

    // Correct connection variable (change $conn based on your actual variable in config.php)
    $sql = "INSERT INTO user_order (user_id, razorpay_payment_id, razorpay_order_id, amount, currency, status, address, product_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $product_info->prepare($sql); // Use the correct connection variable, not $product_info
    if ($stmt === false) {
        die(json_encode(['status' => 'failure', 'error' => 'MySQL prepare error: ' . $product_info->error]));
    }

    // Bind parameters and execute query
    if (!$stmt->bind_param('ssssssss', $user_id, $payment_id, $order_id, $amount, $currency, $status, $address, $product_id)) {
        die(json_encode(['status' => 'failure', 'error' => 'MySQL bind_param error: ' . $stmt->error]));
    }

    if (!$stmt->execute()) {
        die(json_encode(['status' => 'failure', 'erro   r' => 'MySQL execute error: ' . $stmt->error]));
    }

    $stmt->close();

    // Success response
    echo json_encode(['status' => 'success']);

} catch (Exception $e) {
    // Payment verification failed
    echo json_encode(['status' => 'failure', 'error' => $e->getMessage()]);
}
?>
