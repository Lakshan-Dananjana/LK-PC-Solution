<?php

include 'include/dbh.inc.php';
include 'include/function.inc.php';
session_start();
if(isset($_SESSION['user_name'])){
    $userEmail = $_SESSION['user_email'];
}
else{
        echo '<script>window.location.href = "index.php";</script>';
}
if(isset($_POST['deletebtn'])){
    // Delete item from cart
    $productName = $_POST['itemName'];
    $sql = "DELETE FROM cart WHERE itemName = ? AND userEmail = ?"; 
    $stmt = mysqli_stmt_init($conn); 
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: cart.php?error=stmt_error_in_delete_cart_item");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $productName, $userEmail); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo '<script>alert("This product has been deleted from your cart.")</script>';

}
if(isset($_POST['deleteall'])){
    // Delete all item from cart
    $sql = "DELETE FROM cart WHERE userEmail = ?"; 
    $stmt = mysqli_stmt_init($conn); 
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: cart.php?error=stmt_error_in_delete_cart_item");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $userEmail); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo '<script>alert("All product has been deleted from your cart.")</script>';
}
if(isset($_POST['updatebtn'])){
    //  Update item from cart
    $productName = $_POST['itemName'];
    $productSize = $_POST['itemSize'];
    $sql = "UPDATE cart SET itemQuantity = ? WHERE itemName = ? AND userEmail = ?"; 
    $stmt = mysqli_stmt_init($conn); 
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: cart.php?error=stmt_error_in_update_cart_item");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "iss", $productSize,$productName,$userEmail); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo '<script>alert("This product has been updated from your cart.")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart  |  LK PC SOLUTION|Dambulla</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./image/LK PC Solution.png" type="image/x-icon">
</head>
<body>
<div class="navbar">
            <img src="./image/LK PC Solution.png" alt="">
            <div class="navLink">
                <div class="nav">
                    <a href="home.php">Home</a>
                    <a href="product.php">Product</a>
                    <a href="#">About Us</a>
                    <a href="cart.php">Cart</a>
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
        <h1>Shooping Cart</h1>
        <table>
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM cart WHERE userEmail='$userEmail'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $itemName = $row['itemName'];
                $itemPrice = $row['itemPrice'];
                $itemQuantity = $row['itemQuantity'];
                $totalPrice = $itemPrice * $itemQuantity;
                $itemImage = $row['itemImage'];
            ?>
                <tr>
                    <td><img src='productItem/<?php echo $itemImage;?>' alt='Product Image' class="cartImage"></td>
                    <td><?php echo $itemName;?></td>
                    <td>Rs<?php echo $itemPrice;?>/-</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="itemName" value="<?php echo $itemName;?>">
                            <input type="number" class="itemSize" min="1" name="itemSize" id="" value="<?php echo $itemQuantity;?>">
                            <button type="submit" name="updatebtn" class="updatebtn">Update</button>
                        </form>
                    </td>
                    <td>Rs<?php echo $totalPrice;?>/-</td>
                    <td><form action="" method="post">
                            <input type="hidden" name="itemName" value="<?php echo $itemName;?>">
                            <button type="submit" name="deletebtn" class="deletebtn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
                };
            ?>
            <tr>
                <td colspan="4">
                </td>
                <td>Total Price: Rs.
                    <?php
                        $sql = "SELECT SUM(itemPrice * itemQuantity) AS totalPrice FROM cart WHERE userEmail='$userEmail'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['totalPrice'];
                   ?>/-
                </td>
                <td><form action="" method="post">
                            <button type="submit" name="deleteall" class="deletebtn">Delete All</button>
                        </form>
                </td>
            </tr>
            
            </tbody>
        </table>
    </div>
    <script src="js/homeScript.js"></script>
</body>
</html>