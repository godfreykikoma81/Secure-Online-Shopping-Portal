<?php
session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $idToDelete = $_POST['id'];
        
        require 'connection.php';
        $stmt = $conn->prepare("DELETE FROM item WHERE Product_id = ?");
        $stmt->bind_param("i", $idToDelete);
        if ($stmt->execute()) {
            header("Location: admin_profile.php");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    } else {
        echo "No ID provided";
    }
} else {
    echo "Invalid request method";
}
?>
