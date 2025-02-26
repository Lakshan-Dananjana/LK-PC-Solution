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
        $pdf->SetTitle('Cart PDF Export');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
    
        // Convert HTML table to PDF
        $pdf->writeHTML('<h2>Order Cart List</h2>' . $table_data, true, false, true, false, '');
    
        // Output the PDF (Download)
        $pdf->Output('CartDetails.pdf', 'D');
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
                <h1>Cart</h1>
                <div class="productTable">
                    <table border="1" id="tableToExport">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Image</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                                <th>Item Quantity</th>
                                <th>User Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM cart";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $itemId = $row['itemId'];
                                    $itemImage = $row['itemImage'];
                                    $itemName = $row['itemName'];
                                    $itemPrice = $row['itemPrice'];
                                    $itemQuantity = $row['itemQuantity'];
                                    $userEmail = $row['userEmail'];
                               
                            ?>
                            <tr>
                                <td><?php echo $itemId;?></td>
                                <td><img src="../productItem/<?php echo $itemImage;?>" alt="" class="tableImage"></td>
                                <td><?php echo $itemName;?></td>
                                <td><?php echo $itemPrice;?></td>
                                <td><?php echo $itemQuantity;?></td>
                                <td><?php echo $userEmail;?></td>
                            </tr>
                            <?php
                                 }
                            ?>
                        </tbody>
                    </table>
                </div>
                <form method="post" action="">
                    <input type="hidden" name="table_data" id="table_data">
                    <button type="submit" onclick="saveTableData()" name="pdfDownload" class="downloadbtn">Download PDF</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/admincart.js"></script>
</body>
</html>