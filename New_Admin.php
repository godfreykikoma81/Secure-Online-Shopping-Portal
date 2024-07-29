<?php
session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
require 'connection.php';
require 'vendor/autoload.php';
try {
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $phone = $_POST['phone'];
        $privilege = 'super';
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $authenticator = new PHPGangsta_GoogleAuthenticator();
        $secret = $authenticator->createSecret();
        $stmt = $conn->prepare("INSERT INTO users(firstName,lastName,email,password,phone,privilege,secret)values(?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssiss", $fname, $lname, $email, $hashed_pass, $phone, $privilege, $secret);
        if ($stmt->execute()) {
            $qrCodeUrl = $authenticator->getQRCodeGoogleUrl($email, $secret);
            echo "<div style='text-align: center;'>";
            echo "<span class='message'>Scan this QR code with your Google Authenticator app.</span><br>";
            echo "<img src='$qrCodeUrl'>";
            echo "</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} catch (Exception $e) {
    echo "There is a problem in a server" . $e->getMessage();
}     
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="image.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="css/New_Admin.css">
</head>

<body>
    <?php require 'admin_nav.php';?>
    <h2 style="text-align: center;">Register New Admin</h2>
    <form action="New_Admin.php" method="post" class="container" id="form">
        <div class="form-group">
            <label for="fname">First Name </label>
            <input type="text" name="fname" id="fname" autocomplete="off">
            <small id="err_fname" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="lname">Last Name </label>
            <input type="text" name="lname" id="lname" autocomplete="off">
            <small id="err_lname" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" autocomplete="off">
            <small id="err_email" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="password">Password </label>
            <input type="password" name="password" id="password" autocomplete="">
            <small id="err_password" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="Confirm">Confirm Password </label>
            <input type="password" name="ConfirmPassword" id="confirmPassword" autocomplete="off">
            <small id="err_confirm" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" autocomplete="off">
            <small id="err_phone" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <input type="submit" name="register" id="btn" value="register">
        </div>
    </form>
    <script>
        const fname=document.getElementById('fname');
        const lname=document.getElementById('lname');
        const email=document.getElementById('email');
        const password=document.getElementById('password');
        const confirmPassword=document.getElementById('confirmPassword');
        const phone=document.getElementById('phone');
        const form=document.getElementById('form');

        err_fname=document.getElementById('err_fname');
        err_lname=document.getElementById('err_lname');
        err_password=document.getElementById('err_password');
        err_confirm=document.getElementById('err_confirm');
        err_email=document.getElementById('err_email');
        err_phone=document.getElementById('err_phone');

        //error handling
        form.addEventListener('submit',(e)=>{
            const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+}{"':;?/>.<,]).{8,}$/;
            if(fname.value===''||fname==null){
                e.preventDefault();
                err_fname.innerHTML='Please Enter valid Name';
            }else{
                err_fname.innerHTML='';
            }
            if(lname.value===''|| lname.value==null){
                e.preventDefault();
                err_lname.innerHTML='Please Enter valid Name';
            }else{
                err_lname.innerHTML='';
            }
            if(!email.value.match(emailPattern)){
                e.preventDefault();
                err_email.innerHTML='Please Enter valid Email';
            }else{
                err_email.innerHTML='';
            }
            if(!password.value.match(passwordPattern)){
                e.preventDefault();
                err_password.innerHTML="Enter Strong Password";
            }else{
                err_password.innerHTML='';
            }
            if(confirmPassword.value!==password.value){
                e.preventDefault();
                err_confirm.innerHTML='Password does not match';
            }else{
                err_confirm.innerHTML='';
            }
            if(!phone.value.length()===10){
                e.preventDefault();
                err_phone.innerHTML='Enter valid phone number';
            }else{
                err_phone.innerHTML='';
            }
        })
    </script>
</body>

</html>
