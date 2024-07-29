<?php session_start();
if(!isset($_SESSION['email']) || $_SESSION['login'] !== true) {
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
    <title>User Logs</title>
    <link rel="stylesheet" href="css/users.css">
</head>
<body>
<?php require 'admin_nav.php';?>
    <div class="container">
        <?php
        require 'connection.php';
        $sql = "SELECT users.No, users.firstName, users.lastName, logs.action, logs.timestamp 
                FROM users 
                LEFT JOIN logs ON users.No = logs.user_id 
                ORDER BY users.lastName, users.firstName, logs.timestamp DESC";
        $result = $conn->query($sql);

        $currentUserId = null;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($currentUserId !== $row['No']) {
                    if ($currentUserId !== null) {
                        echo "</tbody></table>";
                    }
                    $currentUserId = $row['No'];
                    echo "<br><br>";
                    echo "<h4>".$row['firstName']." ".$row['lastName']."</h4>";
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr><th>Action</th><th>Timestamp</th></tr>";
                    echo "</thead>";
                    echo "<tbody>";
                }
                echo "<tr>";
                echo "<td>".$row['action']."</td>";
                echo "<td>".$row['timestamp']."</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No logs found.</p>";
        }
        ?>
    </div>
</body>
</html>
