<?php
    include 'include/dbh.inc.php';
    include 'include/function.inc.php';
    session_start();

    if(isset($_POST['addToCart'])){
        $product_image = $_POST['productImage'];
        $product_name = $_POST['productName'];
        $product_price = $_POST['productPrice'];
        $product_quantity = $_POST['productQuantity'];
        $userEmail = $_SESSION['user_email'];
        
        //if checking clicked item are already added to the cart
        $select_cart_sql = "SELECT * FROM cart WHERE itemName = ? AND userEmail = ?";;
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$select_cart_sql)){
            header("Location: home.php?error=stmt?error?in?selectcart");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $product_name, $userEmail);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        //if checking clicked item are already added to the cart and show the message box
        if ($row = mysqli_fetch_assoc($resultData)){
            echo '<script>alert("This Product already added to cart")</script>';
        }
        else{
            $itemAddCartSql = "INSERT INTO cart (itemImage,itemName,itemPrice,itemQuantity,userEmail) VALUES (?,?,?,?,?);";
            $stmtInsertProduct = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmtInsertProduct,$itemAddCartSql)){
                header("Location: home.php?error=stmt?error?in?insert?cart?item");
                exit();
            }
            mysqli_stmt_bind_param($stmtInsertProduct,"sssis",$product_image,$product_name,$product_price,$product_quantity,$userEmail);
            mysqli_stmt_execute($stmtInsertProduct);
            mysqli_stmt_close($stmtInsertProduct);
            echo '<script>alert("This product add to cart!")</script>';
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page  |  LK PC SOLUTION|Dambulla</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./image/LK PC Solution.png" type="image/x-icon">
</head>
<body>
    <div class="container_home">
        <div class="navbar">
            <img src="./image/LK PC Solution.png" alt="">
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
        <div class="homecontent">
            <h1>Welcome LK PC Solution</h1>
            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                Vel enim perspiciatis, cum asperiores quis minima sit, natus ipsam iste libero ex. 
                Recusandae ab id inventore ipsum rem porro eaque, architecto, aperiam hic itaque eos?
                Nihil voluptatum sed rem beatae. Doloremque reiciendis qui molestias repudiandae 
                ducimus neque, placeat nesciunt ut hic.
            </p>
        </div>
        <div class="productitem">
            <?php
            //select the product items in productall table
            $selectProduct = mysqli_query($conn , "SELECT * FROM productall");
            if(mysqli_num_rows($selectProduct) > 0) {
                while($row = mysqli_fetch_assoc($selectProduct)) {
                    $productName = $row['productTitle'];
                    $productImage = $row['productImage'];
                    $productPrice = $row['productPrice'];
            ?>
                <form action="" method="post">
                <img src="productItem/<?php echo $productImage ?>" alt="product">
                <p class="name"><?php echo $productName?></p>
                <p class="price">Rs <?php echo $productPrice?>/-</p>
                <input type="number" name="productQuantity" id="" min="1" value="1">
                <input type="hidden" name="productImage" value="<?php echo $productImage ?>">
                <input type="hidden" name="productName" value="<?php echo $productName?>">
                <input type="hidden" name="productPrice" value="<?php echo $productPrice ?>">
                <button type="submit" name="addToCart">Add to Cart</button>
            </form>
            <?php
                  };
             };
            ?>
        </div>
        <div class="footer_home">
            <p>Copyright &copy; 2024 LK PC Solution. All rights reserved.</p>
        </div>
    </div>
</body>
</html>