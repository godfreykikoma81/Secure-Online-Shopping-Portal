<?php
require 'connection.php';
//TwoFactorAuth library
require 'vendor/autoload.php';

function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

try {
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $fname = sanitize_input($_POST['fname']);
        $lname = sanitize_input($_POST['lname']);
        $email = filter_var(sanitize_input($_POST['email']), FILTER_VALIDATE_EMAIL);
        $pass = $_POST['password'];
        $phone = sanitize_input($_POST['phone']);

        if (!$email) {
            echo "Invalid email format.";
            exit();
        }
        
        if (strlen($phone) != 10 || !ctype_digit($phone)) {
            echo "Invalid phone number.";
            exit();
        }
        if (empty($fname) || empty($lname) || strlen($fname) > 20 || strlen($lname) > 20) {
            echo "First and last names must not be empty and should not exceed 20 characters.";
            exit();
        }
        
        if (strlen($fname) == 0 || strlen($lname) == 0){
            echo "First and last names cannot be empty.";
            exit();$sql = "SELECT Product_id, Product_Name, Product_Picture, Product_Price 
            FROM item 
            ORDER BY Product_id DESC";
        }

        $message=false;
        $privilege = 'normal';
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("SELECT email FROM users where email=?");
        $stmt->bind_param("s", $email);

        $stmt->execute();
        $stmt->bind_result($emailCount);
        $stmt->fetch();
        $stmt->close();
        if ($emailCount > 0) {
            $message=true;
        } else {
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
    <title>register</title>
    <link rel="stylesheet" href="css/register.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <form action="register.php" method="post" class="container" id="form">
        <h3 style="text-align: center;">Register</h3>
        <div class="form-group">
            <label for="fname">First Name </label>
            <input type="text" name="fname" id="fname">
            <small id="err_fname" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="lname">Last Name </label>
            <input type="text" name="lname" id="lname">
            <small id="err_lname" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <small id="err_email" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="password">Password </label>
            <input type="password" name="password" id="password">
            <small id="err_password" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="Confirm">Confirm Password </label>
            <input type="password" name="confirmPassword" id="confirmPassword">
            <small id="err_confirm" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone">
            <small id="err_phone" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <input type="submit" name="register" id="btn" value="SignUp">
        </div>
        <small>click <a href="index.php">here </a>to login</small>
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
    <?php if($message): ?>
        <script>
        swal({
            text:"Email already exists. Please create a new account.",
            icon:"error",
        });
    </script>
    <?php endif; ?>
</body>
</html>
