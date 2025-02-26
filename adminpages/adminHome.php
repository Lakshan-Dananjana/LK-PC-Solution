<?php
    include '../include/dbh.inc.php';
    include '../include/function.inc.php';
    session_start();
    if(!isset($_SESSION['user_name'])){
        echo '<script>window.location.href = "../index.php";</script>';
    }
    // get number of users
    $sqlUser = "SELECT COUNT(*) as totalUsers FROM user";
    $resultUser = mysqli_query($conn,$sqlUser);

    if($resultUser){
        $rowUser = mysqli_fetch_assoc($resultUser);
        $totalUser = $rowUser['totalUsers'];
    }
    else{
        echo "Error: ".mysqli_error($conn);
    }

    // get number of products
    $sqlProduct = "SELECT COUNT(*) as totalProduct FROM Product";
    $resultProduct = mysqli_query($conn,$sqlProduct);

    if($resultProduct){
        $rowProduct = mysqli_fetch_assoc($resultProduct);
        $totalProduct = $rowProduct['totalProduct'];
    }
    else{
        echo "Error: ".mysqli_error($conn);
    }

    // get number of orders
    $sqlCart = "SELECT COUNT(*) AS totalOrders FROM cart";
    $resultCart = mysqli_query($conn,$sqlCart);

    if($resultCart){
        $rowCart = mysqli_fetch_assoc($resultCart);
        $totalCart = $rowCart['totalOrders'];
    }
    else{
        echo "Error: ".mysqli_error($conn);
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
                <a href="adminCart.php">Cart</a>
                <a href="adminUser.php">Users</a>
                <a href="../include/logout.inc.php">Logout</a>
            </div>
            <div class="content">
                <h1>Dashboard</h1>
                <div class="details">
                    <div>
                        <p class="titel">Users</p>
                        <p class="count"><?php echo $totalUser; ?></p>
                        <a href="adminUser.php" class="linkBtn">See More>></a>
                    </div>
                    <div>
                        <p class="titel">Product</p>
                        <p class="count"><?php echo $totalProduct; ?></p>
                        <a href="adminproduct.php" class="linkBtn">See More>></a>
                    </div>
                    <div>
                        <p class="titel">Cart</p>
                        <p class="count"><?php echo $totalCart; ?></p>
                        <a href="adminCart.php" class="linkBtn">See More>></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>