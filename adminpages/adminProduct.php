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
                <h1>Product</h1>
                <div class="btnSection">
                    <button class="jBtn" id="jBtn">Add Product</button>
                    <button class="jBtn2" id="jBtn2">View Table</button>
                </div>
                <div class="productTable">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="productAdd">
                    <form action="" method="post">
                        <input type="text" name="productName" placeholder="Product Name">
                        <input type="Number" name="productQuantity" placeholder="Product Quantity">
                        <input type="text" name="" placeholder="Product Price">
                        <input type="file" name="productImage" id="productImage">
                        <button type="submit">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/adminProduct.js"></script>
</body>
</html>