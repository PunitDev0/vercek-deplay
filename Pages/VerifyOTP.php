<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_otp = $_POST['otp'];

    if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiration'])) {
        if ($entered_otp == $_SESSION['otp'] && time() <= $_SESSION['otp_expiration']) {
            // OTP is valid
            unset($_SESSION['otp']); // Clear OTP from session
            unset($_SESSION['otp_expiration']);
            header("Location: Login.php"); // Redirect to login page
            exit;
        } else {
            echo "Invalid OTP or OTP has expired.";
        }
    } else {
        echo "No OTP session found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen">
<div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row w-full max-w-4xl">
            <!-- Left Image Section -->
            <div class="hidden md:flex w-full md:w-1/2 bg-gray-100 justify-center items-center p-10">
                <img src="../Assests/image/postponed-concept.png" alt="OTP Illustration" class="object-contain">
            </div>
            <!-- Right Form Section -->
            <div class="w-full md:w-1/2 p-8">
                <div class="text-right">
                    <a href="#" class="text-sm text-gray-500 hover:text-indigo-600">Need help? <span class="font-semibold">Contact Us</span></a>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Verify OTP</h2>
                <p class="text-sm text-gray-600 mb-8">Enter the One-Time Password sent to your email/phone</p>
                <form action="#">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="otp">OTP</label>
                        <input id="otp" name="otp" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter your OTP" required>
                    </div>
                    <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Verify OTP</button>
                </form>
                <div class="mt-8">
                    <p class="text-sm text-gray-500 text-center">Didn't receive the OTP?</p>
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 block text-center mt-2">Resend OTP</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
