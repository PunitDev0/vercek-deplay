<?php
session_start();
include './config.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email =  $_POST['email'];
    $password =  $_POST['password'];
    

    $user = mysqli_query($conn,"SELECT * FROM user_info WHERE email = '$email'");
    $admin = mysqli_query($conn,"SELECT * FROM admin_info WHERE email = '$email'");
    
    if($user || $admin){
        if($user_data = mysqli_fetch_assoc($user)){
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['user_name'] = $user_data['name'];
                $_SESSION['user_email'] = $user_data['email'];
                $_SESSION['user_image'] = $user_data['user_img'];
                header('Location: Home.php');
            }else if($admin_data = mysqli_fetch_assoc($admin)){
                $_SESSION['logged_in'] = true;
                $_SESSION['admin_id'] = $admin_data['id'];
                $_SESSION['admin_name'] = $admin_data['name'];
                $_SESSION['admin_email'] = $admin_data['email'];
                $_SESSION['admin_image'] = $admin_data['user_img'];
                header('Location: Home.php');
            }else{
                
            }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- <img src="../Assests/image/download.jpg" class=" h-full w-full absolute z-[-10]"> -->
    <div class="min-h-screen flex items-center shadow-2xl justify-center">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row w-full max-w-4xl">
            <!-- Left Image Section -->
            <div class="hidden md:flex w-full md:w-1/2 bg-indigo-50 justify-center items-center">
                <img src="../Assests/image/pexels-mikhail-nilov-6893329.jpg" alt="Login " class="object-cover h-full w-full ">
            </div>
            <!-- Right Form Section -->
            <div class="w-full md:w-1/2 p-8">
                <div class="text-right">
                    <a href="./Signup.php" class="text-sm text-gray-500 hover:text-indigo-600">Don't you have an account? <span class="font-semibold">Sign up</span></a>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Welcome Back</h2>
                <p class="text-sm text-gray-600 mb-8">Login to your account</p>
                <form action="#" method="POST">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="Email">Email</label>
                        <input id="username" name="email" type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Your email" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="password">Password</label>
                        <input id="password" name="password" type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Your password" required>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 mt-2 block">Forgot password?</a>
                    </div>
                    <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Login</button>
                </form>
                <div class="mt-8">
                    <p class="text-sm text-gray-500 text-center">Login with</p>
                    <div class="flex justify-center space-x-4 mt-2">
                        <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-blue-400 hover:text-blue-600"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-red-500 hover:text-red-700"><i class="fab fa-google"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
