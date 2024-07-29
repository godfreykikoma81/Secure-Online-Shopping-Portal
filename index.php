<?php
session_start();
require 'connection.php';
require 'vendor/autoload.php';
try {

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            echo "Invalid email format.";
            exit();
        }
        $pass = $_POST['password'];
        $loginError = false;

        $stmt = $conn->prepare("SELECT No,email,password,privilege,secret FROM users where email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $dbemail, $dbpassword, $privilege, $secret);
        $stmt->fetch();
        $stmt->close();

        if ($email == $dbemail && password_verify($pass, $dbpassword)) {
            $_SESSION['login']=true;
            $_SESSION['email'] = $email;
            $_SESSION['privilege'] = $privilege;
            $_SESSION['user_id'] = $id;
            $_SESSION['2fa_secret'] = $secret;
            header("Location: verify_2fa.php");
            exit();
        } else {
            $loginError = true;
            ?>
            <meta http-equiv="refresh" content="3;url=index.php" />
            <?php
}
    }
} catch (Exception $e) {
    echo "There is a problem in a server" . $e->getMessage();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="image.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <form action="index.php" method="post" class="container" id="form">
        <h3 style="text-align: center;">Secure Online Shopping Portal</h3>
        <div class="form-group">
            <label for="email">Username</label>
            <input type="email" name="email" id="email" >
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <small style="color:red; text-align:center;" id="error"></small>
        </div>

        <div class="form-group">
            <input type="submit" name="" id="btn" value="login">
        </div>
        <small>click <a href="register.php">here</a> to click account</small>
        <script>
        <?php if ($loginError) {?>
            document.getElementById('error').innerHTML = 'Invalid email or password. Please try again.';
        <?php }?>
    </script>
    </form>
</body>
</html>
