<?php
session_start();
// TwoFactorAuth library
require 'vendor/autoload.php';

if (!isset($_SESSION['email']) || $_SESSION['login']!==true) {
    header("Location: index.php");
    exit();
}
$invalidtoken=false;
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $authenticator = new PHPGangsta_GoogleAuthenticator();;
    $code = $_POST['code'];
    $secret = $_SESSION['2fa_secret'];

    if ($authenticator->verifyCode($secret,$code)) {
        if ($_SESSION['privilege'] == 'normal') {
            $user_id = $_SESSION['user_id'];
            $action = "login";
            $log = "INSERT INTO logs(User_Id, action) VALUES ('$user_id', '$action')";
            $conn->query($log);
            header("Location: user_profile.php");
        } elseif ($_SESSION['privilege'] == 'super') {
            $user_id = $_SESSION['user_id'];
            $action = "login";
            $log = "INSERT INTO logs(User_Id, action) VALUES ('$user_id', '$action')";
            $conn->query($log);
            header("Location: admin_profile.php");
        }
        exit();
    } else {
        $invalidtoken=true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="image.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link rel="stylesheet" href="css/verify_2f.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <form action="verify_2fa.php" method="post">
        <h3>Enter your 2FA code</h3>
        <div>
            <label for="code">2FA Code:</label>
            <input type="text" name="code" id="code" required>
        </div>
        <div>
            <input type="submit" value="Verify">
        </div>
    </form>
    <?php if($invalidtoken):?>
    <script>
        swal({
            text:"The token you entered is incorrect. Please try again.",
            icon:"error",
        });
    </script>
    <?php endif; ?>
</body>
</html>
