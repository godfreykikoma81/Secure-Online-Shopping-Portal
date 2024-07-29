<?php
session_start();
if (!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
require 'connection.php';
$email=$_SESSION['email'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $pass=$_POST['password'];
    $new_password=$_POST['new_password'];

    $stmt=$conn->prepare("SELECT password FROM users where email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($db_Password);
    $stmt->fetch();
    $stmt->close();

    if(password_verify($pass,$db_Password)){
        $hash_new_password=password_hash($new_password,PASSWORD_DEFAULT);

        $update=$conn->prepare("UPDATE users SET password=? where email=?");
        $update->bind_param("ss",$hash_new_password,$email);
        if($update->execute()){
            header("location:admin_password.php");
            echo "Password Successfull Changed..";
            exit();
        }else{
            echo "error changing password ";
        }
        $update->close();
    }else{
        echo "incorrect current password. Please try again";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="image.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admins-Password</title>
    <link rel="stylesheet" href="css/admin_password.css">
</head>

<body>
<?php require 'admin_nav.php';?>
<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location:login.php");
    exit();
}
$conn=new mysqli('localhost','root','','shopping');
$email=$_SESSION['email'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $pass=$_POST['password'];
    $new_password=$_POST['new_password'];

    $stmt=$conn->prepare("SELECT password FROM users where email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($db_Password);
    $stmt->fetch();
    $stmt->close();

    if(password_verify($pass,$db_Password)){
        $hash_new_password=password_hash($new_password,PASSWORD_DEFAULT);

        $update=$conn->prepare("UPDATE users SET password=? where email=?");
        $update->bind_param("ss",$hash_new_password,$email);
        if($update->execute()){
            header("location:user_change.php");
            echo "Password Successfull Changed..";
            exit();
        }else{
            echo "error changing password ";
        }
        $update->close();
    }else{
        echo "incorrect current password. Please try again";
    }
}
$conn->close();
?>
    <h2 style="text-align: center;">Change your Password</h2>
    <form action="admin_password.php" class="container" id="form" method="post">
        <div class="form-group">
            <input type="password" name="password" id="" required placeholder="Enter Old Password">
        </div>
        <div class="form-group">
            <input type="password" name="new_password" id="password" placeholder="Enter New Password">
            <small id="err_password" style="font-family: 'Courier New', Courier, monospace;color: red;"></small>
        </div>
        <div class="form-group">
            <input type="password" name="" id="confirmPassword"placeholder="Re-Enter New Password">
            <small id="err_confirm" style="font-family: 'Courier New', Courier, monospace; color: red;"></small>
        </div>
        <div class="form-group">
            <input type="submit" name="" id="" value="Change">
        </div>
    </form>
    <script>
        const password=document.getElementById('password');
        const confirmPassword=document.getElementById('confirmPassword');
    
        err_password=document.getElementById('err_password');
        err_confirm=document.getElementById('err_confirm');

        //error handling
        form.addEventListener('submit',(e)=>{
            const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+}{"':;?/>.<,]).{8,}$/;
           
            if(!password.value.match(passwordPattern)){
                e.preventDefault();
                err_password.innerHTML="Enter Strong Password";
            }else{
                err_password.innerHTML='';
            }
            if(confirmPassword.value===password.value){
                err_confirm.innerHTML='';
            }else{
                e.preventDefault();
                err_confirm.innerHTML='Password does not match';
            }
        })
    </script>
</body>

</html>