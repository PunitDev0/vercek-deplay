<?php
// api/index.php

// Set the correct content type
header('Content-Type: text/html; charset=utf-8');

// Include your routing logic here
$requestUri = $_SERVER['REQUEST_URI'];

// Simple routing logic to include the appropriate PHP file
if (preg_match('/^\/admin/', $requestUri)) {
    include(__DIR__ . '/../admin/pages' . substr($requestUri, 6));
} elseif (preg_match('/^\/pages/', $requestUri)) {
    include(__DIR__ . '/../pages' . substr($requestUri, 6));
} elseif (preg_match('/^\/images/', $requestUri)) {
    // Serve images directly from the images folder
    $imagePath = __DIR__ . '/../images' . substr($requestUri, 6);
    if (file_exists($imagePath)) {
        header('Content-Type: image/jpeg');
        readfile($imagePath);
        exit();
    }
} else {
    // Default to your main page or a 404 page
    include(__DIR__ . '/../Pages/Home.php'); // Change this to your main page
}
