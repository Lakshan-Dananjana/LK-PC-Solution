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
        $pdf->SetTitle('User PDF Export');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
    
        // Convert HTML table to PDF
        $pdf->writeHTML('<h2>User List</h2>' . $table_data, true, false, true, false, '');
    
        // Output the PDF (Download)
        $pdf->Output('UserDetails.pdf', 'D');
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
                <h1>Users</h1>
                <div class="productTable">
                    <table border="1" id="tableToExport">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>User Job Roll</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT* FROM user";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $userId = $row['userId'];
                                    $userName = $row['userName'];
                                    $userEmail = $row['userEmail'];
                                    $userJobRoll = $row['userJobRoll'];
                                
                            ?>
                            <tr>
                                <td><?php echo $userId;?></td>
                                <td><?php echo $userName;?></td>
                                <td><?php echo $userEmail;?></td>
                                <td><?php echo $userJobRoll;?></td>
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