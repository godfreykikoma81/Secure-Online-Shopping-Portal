<?php
session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
require 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user'];
    $sql = "SELECT privilege FROM users WHERE No = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($status);
    $stmt->fetch();
    $stmt->close();
    if ($status != "super") {
        $sql_delete = "DELETE FROM users WHERE No = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $user_id);
        if ($stmt_delete->execute()) {
            echo "User deleted successfully";
        } else {
            echo "Error deleting user: " . $conn->error;
        }
        $stmt_delete->close();
    } else {
        echo "You do not have permission to delete this user";
    }
}
header("Location: users.php");
exit();
?>