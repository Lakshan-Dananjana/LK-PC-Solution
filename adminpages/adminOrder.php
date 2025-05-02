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
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    
        // Set document properties
        $pdf->SetCreator('LK PC Solution');
        $pdf->SetAuthor($_SESSION['user_name']);
        $pdf->SetTitle('Orders PDF Export');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
    
        // Convert HTML table to PDF
        $pdf->writeHTML('<h2>Orders List</h2>' . $table_data, true, false, true, false, '');
    
        // Output the PDF (Download)
        $pdf->Output('OrderDetails.pdf', 'D');
    }

    if (isset($_POST['updateBtn'])) {
        $orderId = $_POST['orderId'];
        $deliveryStatus = $_POST['deliveryStatus'];
        $UserEmail = $_POST['userEmail'];

        $sql = "UPDATE orders SET deliveryStatus='$deliveryStatus' WHERE id='$orderId' AND userEmail ='$UserEmail'";
        mysqli_query($conn, $sql);
        header("Location: adminOrder.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Cart Page Dashboard|LK PC Solution|Dambulla</title>
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
                <a href="adminOrder.php">Orders</a>
                <a href="adminRegistration.php">Admin Sign Up</a>
                <a href="../include/logout.inc.php">Logout</a>
            </div>
            <div class="content">
                <h1>Orders</h1>
                <div class="productTable">
                    <table border="1" id="tableToExport">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Phone Number</th>
                                <th>Order Type</th>
                                <th>Delivery Status</th>
                                <th>Order Image</th>
                                <th>Order Name</th>
                                <th>Order Price</th>
                                <th>Order Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM orders";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $orderId = $row['id'];
                                    $orderImage = $row['orderImage'];
                                    $orderName = $row['orderName'];
                                    $orderPrice = $row['orderPrice'];
                                    $orderQuantity = $row['orderQuantity'];
                                    $orderType = $row['orderStatus'];
                                    $deliveryStatus = $row['deliveryStatus'];
                                    $totalPrice = $row['totalPrice'];
                                    $userEmail = $row['userEmail'];
                                    $userName =$row['UserName'];
                                    $phoneNumber = $row['userPhoneNumber'];
                               
                            ?>
                            <tr>
                                <td><?php echo $orderId;?></td>
                                <td><?php echo $userName;?></td>
                                <td><?php echo $userEmail;?></td>
                                <td><?php echo $phoneNumber;?></td>
                                <td><?php echo $orderType;?></td>
                                <td>
                                    <form action="" method="post">
                                        <select name="deliveryStatus" id="deliveryStatus">
                                            <option value="">Select A Option</option>
                                            <option value="Pending..." <?php echo ($deliveryStatus == "Pending...") ? "selected" : ""; ?>>Pending...</option>
                                            <option value="Delivered" <?php echo ($deliveryStatus == "Delivered") ? "selected" : ""; ?>>Delivered</option>
                                            <option value="Complete" <?php echo ($deliveryStatus == "Complete") ? "selected" : ""; ?>>Complete</option>
                                        </select>
                                        <input type="hidden" name="orderId" value="<?php echo $orderId;?>">
                                        <input type="hidden" name="userEmail" value="<?php echo $userEmail;?>">
                                        <button type="submit" name="updateBtn">Update</button>
                                    </form>
                                </td>
                                <td><img src="../productItem/<?php echo $orderImage;?>" alt="" class="tableImage"></td>
                                <td><?php echo $orderName;?></td>
                                <td><?php echo $orderPrice;?></td>
                                <td><?php echo $orderQuantity;?></td>
                                <td><?php echo $totalPrice;?></td>
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