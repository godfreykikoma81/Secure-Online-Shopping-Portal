<?php
session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'connection.php';    
    
    $pname = $_POST['pname'];
    $price = $_POST['price']; 
    
    // Check if image file is uploaded
    if($_FILES['pict']['error'] === 4){
        echo "<script>alert('Image does not exist');</script>";
    } else {
        $filename = $_FILES['pict']['name'];
        $tmpname = $_FILES['pict']['tmp_name'];

        $validImage = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if(!in_array($imageExtension, $validImage)){
            echo "<script>alert('Please upload image');</script>";
        } else {
            // Generate a unique name for the image
            $newImageName = uniqid() . '.' . $imageExtension;
            // Move the uploaded file to a folder
            move_uploaded_file($tmpname, 'upload/' . $newImageName);
            
            $stmt = $conn->prepare("INSERT INTO item (Product_Name, Product_Picture, Product_Price) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $pname, $newImageName, $price);
            if ($stmt->execute()) {
                echo "<script>alert('Successfully added');</script>";
                header("Location: admin_profile.php"); 
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="image.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admins-Password</title>
    <link rel="stylesheet" href="css/upload.css">
</head>

<body>
<?php require 'admin_nav.php';?>
    <form action="upload.php" class="container" method="post"  enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="pname" id="" required placeholder="Prduct Name">
        </div>
        <div class="form-group">
            <input type="file" name="pict" id="" required placeholder="Enter Product picture">
        </div>
        <div class="form-group">
            <input type="number" name="price" id="" required placeholder="Enter Price">
        </div>
        <div class="form-group">
            <input type="submit" name="form" id="" value="upload">
        </div>
    </form>
</body>

</html>