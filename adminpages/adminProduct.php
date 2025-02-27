<?php
    include '../include/dbh.inc.php';
    include '../include/function.inc.php';
    require_once __DIR__ . '/vendor/autoload.php'; // Ensure TCPDF is autoloaded


    session_start();
    if(!isset($_SESSION['user_name'])){
        echo '<script>window.location.href = "../index.php";</script>';
    }
    if (isset($_POST['pdfDownload'])) {
        $table_data = $_POST['table_data']; // Get table HTML from form
    
        // Check if TCPDF class exists
        if (!class_exists('TCPDF')) {
            die("TCPDF is not installed properly. Run 'composer require tecnickcom/tcpdf'");
        }
    
        // Create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    
        // Set document properties
        $pdf->SetCreator('LK PC Solution');
        $pdf->SetAuthor($_SESSION['user_name']);
        $pdf->SetTitle('Product PDF Export');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
    
        // Convert HTML table to PDF
        $pdf->writeHTML('<h2>Product List</h2>' . $table_data, true, false, true, false, '');
    
        // Output the PDF (Download)
        $pdf->Output('ProductDetails.pdf', 'D');
    }

    if(isset($_POST['addProduct'])){
        $productname = $_POST['productName'];
        $productimage = $_FILES['productImage']['name'];
        $tempname = $_FILES['productImage']['tmp_name'];
        $folder = '../productItem/'.$productimage;
        $productprice = $_POST['productPrice'];
        $productquantity = $_POST['productQuantity'];

        if (move_uploaded_file($tempname, $folder)) {
            $uploadSql = "INSERT INTO product (productImage, productName, productPrice, productQuantity) VALUES ('$productimage', '$productname', '$productprice', '$productquantity')";
            $result = mysqli_query($conn, $uploadSql);
    
            if ($result) {
                echo '<script>alert("File uploaded successfully!")</script>';
            } else {
                echo '<script>alert("Database insert failed: ' . mysqli_error($conn) . '")</script>';
            }
        } else {
            echo '<script>alert("File not uploaded!")</script>';
        }
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
                <a href="adminRegistration.php">Admin Sign Up</a>
                <a href="../include/logout.inc.php">Logout</a>
            </div>
            <div class="content">
                <h1>Product</h1>
                <div class="btnSection">
                    <button class="jBtn" id="jBtn">Add Product</button>
                    <button class="jBtn2" id="jBtn2">View Table</button>
                </div>
                <div class="productTable">
                    <table border="1" id="tableToExport">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $selectSql = "SELECT * FROM product";
                                $result = mysqli_query($conn,$selectSql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $productId = $row['productId'];
                                    $productName = $row['productName'];
                                    $productImage = $row['productImage'];
                                    $productPrice = $row['productPrice'];
                                    $prodcutQuantity = $row['productQuantity'];
                                
                            ?>
                            <tr>
                                <td><?php echo $productId; ?></td>
                                <td><img src="../productItem/<?php echo $productImage; ?>" alt="" class="tableImage"></td>
                                <td><?php echo $productName; ?></td>
                                <td>Rs <?php echo $productPrice; ?>/-</td>
                                <td><?php echo $prodcutQuantity; ?></td>
                                <td>
                                    <form action="" method="post" class="tableForm">
                                        <input type="hidden" name="productId" value="<?php echo $productId;?>">
                                        <input type="hidden" name="productImage" value="<?php echo $productImage;?>">
                                        <input type="hidden" name="productName" value="<?php echo $productName;?>">
                                        <input type="hidden" name="productPrice" value="<?php echo $productPrice;?>">
                                        <input type="hidden" name="productQuantity" value="<?php echo $prodcutQuantity;?>">
                                        <button type="submit" name="update" >Update</button>
                                        <button type="submit" name="delete" >Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="productAdd">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="text" name="productName" placeholder="Product Name">
                        <input type="Number" name="productQuantity" min="1" placeholder="Product Quantity">
                        <input type="text" name="productPrice" placeholder="Product Price">
                        <input type="file" name="productImage" id="productImage">
                        <button type="submit" name="addProduct">Add Product</button>
                    </form>
                </div>
                <form method="post" action="">
                    <input type="hidden" name="table_data" id="table_data">
                    <button type="submit" onclick="saveTableData()" name="pdfDownload" class="downloadbtn">Download PDF</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/adminProduct.js"></script>
</body>
</html>