<?php
    include 'include/dbh.inc.php';
    include 'include/function.inc.php';
    session_start();

    $userEmail = $_SESSION['user_email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders  |  LK PC SOLUTION|Dambulla</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./image/LK PC Solution.png" type="image/x-icon">
</head>
<body>
    <div class="order_container">
        <div class="navbar">
            <img src="./image/LK PC Solution.png" alt="">
            <div class="navLink">
                <div class="nav">
                    <a href="home.php">Home</a>
                    <a href="product.php">Product</a>
                    <a href="cart.php">Cart</a>
                    <a href="order.php">Orders</a>
                </div>
                <div class="u_details">
                    <a href="#">
                        <?php if(isset($_SESSION['user_name'])){
                        echo $_SESSION['user_name'];
                        }
                        else{
                            echo '<script>window.location.href = "index.php";</script>';
                        }
                        ?>
                    </a>
                    <a href="include/logout.inc.php">Logout</a>
                </div>
            </div>
            <div class="iconNavbar">
                <input type="checkbox" name="" id="show">
                <label for="show">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16" id="showIcon">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                    </svg>
                </label>
                <input type="checkbox" name="" id="close">
                <label for="close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16" id="closeIcon">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </label>
            </div>
        </div>
        <div class="conatiner_cart">
            <h1>Orders</h1>
            <table>
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Delivery Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM orders WHERE userEmail = '$userEmail'";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $productImage = $row['orderImage'];
                            $productName = $row['orderName'];
                            $productQuantity = $row['orderQuantity'];
                            $productPrice = $row['orderPrice'];
                            $productTotalPrice = $row['totalPrice'];
                            $orderStatus = $row['orderStatus'];
                            $deliveryStatus = $row['deliveryStatus'];
                            ?>
                    <tr>
                        <td><img src="./productItem/<?php echo $productImage;?>" alt="" class="cartImage" ></td>
                        <td><?php echo $productName;?></td>
                        <td>Rs <?php echo $productPrice;?>/-</td>
                        <td><?php echo $productQuantity;?></td>
                        <td>Rs <?php echo $productTotalPrice;?>/-</td>
                        <td><?php echo $orderStatus;?></td>
                        <td><?php echo $deliveryStatus;?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>