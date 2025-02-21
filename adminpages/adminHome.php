<?php
    include '../include/dbh.inc.php';
    include '../include/function.inc.php';
    session_start();
    if(!isset($_SESSION['user_name'])){
        echo '<script>window.location.href = "../index.php";</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page Dashboard|LK PC Solution|Dambulla</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="../image/LK PC Solution.png" type="image/x-icon">
</head>
<body>
    <div class="container_admin">
        <div class="header">
            <h1>LK PC Solution Admin Panel</h1>
            <div class="userInfo">
                <p>Login in as: <?php  echo $_SESSION['user_name'];?></p>
                <a href="../include/logout.inc.php">Logout</a>
            </div>
        </div>
        <div class="body">
            <div class="sidebar">
                <a href="adminHome.php">Dashboard</a>
                <a href="adminProduct.php">Product</a>
                <a href="#">Cart</a>
                <a href="#">Users</a>
                <a href="#">Logout</a>
            </div>
            <div class="content">
                <h1>Dashboard</h1>
                <div class="details">
                    <div>
                        <p class="titel">Users</p>
                        <p class="count">85</p>
                    </div>
                    <div>
                        <p class="titel">product</p>
                        <p class="count">85</p>
                    </div>
                    <div>
                        <p class="titel">Cart</p>
                        <p class="count">85</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>