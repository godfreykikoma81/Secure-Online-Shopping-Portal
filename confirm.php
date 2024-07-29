<?php
session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
require 'connection.php';

$userId = $_SESSION['user_id']; // Assuming user_id is stored in session upon login

// Query to get the contact information of the super user
$sql = "SELECT phone FROM users WHERE privilege = 'super' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $superUser = $result->fetch_assoc();
    $contactNumber = $superUser['phone'];
} else {
    $contactNumber = "not available"; // Default message if no super user found
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="image.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .confirmation-container {
            text-align: center;
            background-color: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .confirmation-container h2 {
            margin-bottom: 20px;
        }
        .confirmation-container p {
            margin-bottom: 20px;
        }
        .confirmation-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h2>Purchase Confirmed</h2>
        <p>Your purchase has been successfully confirmed.</p>
        <p>For further assistance, please contact this number: 0<?php echo htmlspecialchars($contactNumber); ?></p>
        <a href="user_profile.php">Go to Home</a>
    </div>
</body>
</html>
