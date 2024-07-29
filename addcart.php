<?php
session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['id'];
  
    $userId = $_SESSION['user_id'];

    // Add the product to the cart table
    $sql = "INSERT INTO cart(user_id, Product_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    if ($stmt->execute()) {
        header("Location: user_profile.php");
    } else {
        // Handle error if needed
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
