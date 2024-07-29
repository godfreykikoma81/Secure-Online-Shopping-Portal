<?php
session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];

    $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $stmt->close();
    }
    $conn->close();
}
header("Location: cart.php");
exit();
?>
