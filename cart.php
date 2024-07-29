<?php
session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
require 'connection.php';

$userId = $_SESSION['user_id']; // Assuming user_id is stored in session upon login

$sql = "SELECT item.Product_id, item.Product_Name, item.Product_Price, COUNT(cart.product_id) as quantity
        FROM cart
        INNER JOIN item ON cart.product_id = item.Product_id
        WHERE cart.user_id = ?
        GROUP BY cart.product_id";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
$totalItems = 0;
$totalPrice = 0;

while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
    $totalItems += $row['quantity'];
    $totalPrice += $row['Product_Price'] * $row['quantity'];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="image.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <?php include 'user_header.php'?>
        body {
            font-family: Arial, sans-serif;
        }
        .cart-container {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .cart-item p {
            margin: 0;
        }
        .cart-summary {
            text-align: center;
            margin-top: 20px;
        }
        .cart-summary p {
            margin: 5px 0;
        }
        .confirm-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            width:20%;
        }
        .remove-button {
            padding: 5px 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'?>
    <div class="cart-container">
        <?php if (empty($cartItems)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item">
                    <p><?php echo htmlspecialchars($item['Product_Name']); ?></p>
                    <p><?php echo htmlspecialchars($item['quantity']); ?> x <?php echo htmlspecialchars($item['Product_Price']); ?> Tsh</p>
                    <p><?php echo htmlspecialchars($item['quantity'] * $item['Product_Price']); ?> Tsh</p>
                    <form action="remove_from_cart.php" method="POST" style="margin: 0;">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['Product_id']); ?>">
                        <button type="submit" class="remove-button">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
            <div class="cart-summary">
                <p>Total Items: <?php echo $totalItems; ?></p>
                <p>Total Price: <?php echo $totalPrice; ?> Tsh</p>
            </div>
            <form action="confirm.php" method="POST">
                <button type="submit" class="confirm-button">Confirm Purchase</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
