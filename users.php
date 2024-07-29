<?php session_start();
if(!isset($_SESSION['email'])||$_SESSION['login'] !== true) {
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
    <title>Users</title>
    <link rel="stylesheet" href="css/users.css">
</head>
<body>
<?php require 'admin_nav.php';?>
    </nav>
    <div>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require 'connection.php';
            $sql="SELECT No,firstName,lastName,email,phone,privilege,Created FROM users";
            $result=$conn->query($sql);
            while ($row=$result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['firstName']."</td>";
                echo "<td>".$row['lastName']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>0".$row['phone']."</td>";
                echo "<td>".$row['privilege']."</td>";
                echo "<td>".$row['Created']."</td>";
                echo "<td>";
                echo "<form action='del_user.php' method='POST' onsubmit='return confirm(\"Are you sure you want remove ".$row['lastName']."?\");'>";
                echo "<input type='hidden' name='user' value='" . $row['No'] . "'>";
                echo "<button type='submit'>Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>

</html>