<?php session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="image.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DashBoard</title>
    <link rel="stylesheet" href="css/admin_profile.css">
</head>

<body>
<?php require 'admin_nav.php';?>
    <div style="text-align: center;">
        <button><a href="upload.php">Add Product</a></button>
        <button><a href="New_Admin.php">New Admin</a></button>
    </div>
    <div class="product-container">
    <?php
require 'connection.php';

$sql = "SELECT Product_id, Product_Name, Product_Picture, Product_Price 
        FROM item 
        ORDER BY Product_id DESC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<div class='product-box'>";
    echo "<img src='./upload/" . $row['Product_Picture'] . "' alt='Product Image'>";
    echo "<h3>" . $row['Product_Name'] . "</h3>";
    echo "<p>Price: " . $row['Product_Price'] . " Tsh</p>";
    echo "<form action='del.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this product?\");'>";
    echo "<input type='hidden' name='id' value='" . $row['Product_id'] . "'>";
    echo "<button type='submit'>Delete</button>";
    echo "</form>";
    echo "</div>";
}
?>
    </div>
</body>

</html>