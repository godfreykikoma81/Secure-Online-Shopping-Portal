<?php
session_start();
include 'connection.php';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $action = "logout";
    $log= "INSERT INTO logs(User_Id, action) VALUES ('$user_id', '$action')";
    $conn->query($log);
}
$_SESSION = array();
session_destroy();
header("Location: index.php");
exit("you logout");
?>