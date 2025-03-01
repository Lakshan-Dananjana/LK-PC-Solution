<?php
    include '../include/dbh.inc.php';
    include '../include/function.inc.php';
    session_start();
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $productImage = $_SESSION['image'];
        $productName = $_SESSION['name'];
        $productPrice = $_SESSION['price'];
        $productQuantity = $_SESSION['quantity'];

        if(isset($_POST['update'])){
            $name = $_POST['productName'];
            $price = $_POST['productPrice'];
            $quantity = $_POST['productQuantity'];

            $sql = "UPDATE product SET productName ='$name', productPrice =$price, productQuantity =$quantity WHERE productId =$id";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<script>alert("Product updated successfully!");</script>';
                echo '<script>window.location.href = "adminProduct.php";</script>';
                
            }else{
                echo '<script>alert("Failed to update product!");</script>';
            }
            

        }
        
    }
    else{
        echo '<script>window.location.href = "adminProduct.php";</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update Product Page Dashboard|LK PC Solution|Dambulla</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="../image/LK PC Solution.png" type="image/x-icon">
</head>
<body>
    <div class="container_admin_update">
        <form action="" class="UpdateProduct" method="post">
            <h1>Update Product</h1>
            <img src="../productItem/<?php echo $productImage?>" alt="Image" >
            <div>
                <label for="">Product Name</label>
                <input type="text" name="productName" id="" value="<?php echo $productName?>">
            </div>
            <div>
                <label for="">Product Price</label>
                <input type="number" name="productPrice" id="" min="1" value="<?php echo $productPrice?>">
            </div>
            <div>
                <label for="">Product Quantity</label>
                <input type="number" name="productQuantity" id="" min="1" value="<?php echo $productQuantity?>">
            </div>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>