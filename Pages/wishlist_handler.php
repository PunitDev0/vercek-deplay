<?php
include './config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];

    // Connect to the database
    if ($wishlist->connect_error) {
        die("Connection failed: " . $wishlist->connect_error);
    }

    if ($action == 'add') {
        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO wishlist_$user_id (product_id) VALUES (?)";
        $stmt = $wishlist->prepare($sql);
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        echo "Success";
    } elseif ($action == 'remove') {
        $sql = "DELETE FROM wishlist_$user_id WHERE product_id = ?";
        $stmt = $wishlist->prepare($sql);
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        echo "Removed";
    }
    $stmt->close();
}
?>
