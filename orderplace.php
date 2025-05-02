<?php
include 'include/dbh.inc.php';
include 'include/function.inc.php';
session_start();
if(isset($_SESSION['user_name'])){
    $userEmail = $_SESSION['user_email'];
    $itemName = $_SESSION['itemName'];
    $itemPrice = $_SESSION['itemPrice'];
    $itemQuantity = $_SESSION['itemQuantity'];
    $itemImage = $_SESSION['itemImage'];
    $totalPrice = $itemPrice * $itemQuantity;
    $deliveryType ="Cash On Delevery";
}
else{
        echo '<script>window.location.href = "index.php";</script>';
}

if (isset($_POST['orderbtn'])){
    $orderName = $_POST['itemName'];
    $orderPrice = $_POST['itemPrice'];
    $orderQuantity = $_POST['itemQuantity'];
    $orderdeleveryType = $_POST['deliveryType'];
    $orderTotalPrice = $_POST['totalPrice'];
    $orderImage = $_POST['itemImage'];
    $phoneNumber = $_POST['phoneNumber'];
    $username = $_SESSION['user_name'];
    $deliveryStatus = "Pending...";

    $sql = "INSERT INTO orders ( UserName, userEmail, userPhoneNumber, orderStatus, deliveryStatus, orderImage, orderName, orderPrice, orderQuantity, totalPrice) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: orderplace.php?error=stmt_error_in_order_palce_item");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ssissssiii',$username,$userEmail,$phoneNumber,$orderdeleveryType,$deliveryStatus,$orderImage,$orderName,$orderPrice,$orderQuantity,$orderTotalPrice);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    

    $slqCartDelete = "DELETE FROM cart WHERE itemName = ? AND userEmail = ?";
    $stmtCartDelete = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmtCartDelete, $slqCartDelete)) {
        header("Location: orderplace.php?error=stmt_error_in_cart_item_delete");
        exit();
    }
    mysqli_stmt_bind_param($stmtCartDelete , 'ss', $orderName,$userEmail);
    mysqli_stmt_execute($stmtCartDelete);
    mysqli_stmt_close($stmtCartDelete);

    $selectProduct = mysqli_query($conn , "SELECT * FROM product WHERE productName = '$orderName'");
    $row = mysqli_fetch_assoc($selectProduct);
    $quantity = $row['productQuantity'];

    $newQuantity = $quantity - $orderQuantity;

    $updateQuery = "UPDATE product SET productQuantity = $newQuantity WHERE productName = '$orderName'";
    mysqli_query($conn,$updateQuery);
    echo '<script>alert("This product Ordered Successful")</script>';
    echo '<script>window.location.href = "order.php";</script>';

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order  |  LK PC SOLUTION|Dambulla</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./image/LK PC Solution.png" type="image/x-icon">
</head>
<body>
    <div class="orderPalce_conatiner">
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
        <div class="order">
            <h1>Order Details</h1>
            <div class="orderDetails">
                <form action="" method="post">
                    <div class="details">
                        <p>UserName :</p> <p><?php echo $_SESSION['user_name']; ?></p> 
                    </div>
                    <div class="details">
                        <img src="./productItem/<?php echo $itemImage; ?>" alt=""> 
                    </div>
                    <div class="details">
                        <p>Order Name :</p> <p><?php echo $itemName; ?></p> 
                    </div>
                    <div class="details">
                        <p>Order Price :</p><p>Rs <?php echo $itemPrice; ?>/-</p> 
                    </div>
                    <div class="details">
                        <p>Order Quantity :</p> <p><?php echo $itemQuantity; ?></p> 
                    </div>
                    <div class="details">
                        <p>Phone Number :</p> <input type="text" name="phoneNumber" id="" placeholder="Enter Your Phone Number">
                    </div>
                    <div class="details">
                        <p>Delevery Type :</p> <p><?php echo $deliveryType; ?> </p> 
                    </div>
                    <div class="details">
                        <p>Total Price :</p> <p>Rs <?php echo $totalPrice; ?>/-</p> 
                    </div>
                    <div class="placebtn">
                        <input type="hidden" name="itemImage" value="<?php echo $itemImage; ?>">
                        <input type="hidden" name="itemName" value="<?php echo $itemName; ?>">
                        <input type="hidden" name="itemQuantity" value="<?php echo$itemQuantity; ?>">
                        <input type="hidden" name="itemPrice" value="<?php echo $itemPrice; ?>">
                        <input type="hidden" name="deliveryType" value="<?php echo$deliveryType; ?>">
                        <input type="hidden" name="totalPrice" value="<?php echo$totalPrice; ?>">
                        <button type="submit" class="orderbtn" name="orderbtn">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>