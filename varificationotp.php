<?php
require_once 'include/function.inc.php';
require_once 'include/dbh.inc.php';

session_start();

if (isset($_POST['submit'])){
    $inputOtp = $_POST['otpNumber'];
    $femail = $_SESSION['femail'];
    $fpassword = $_SESSION['fpassword'];
    $otp = $_SESSION['otp'];
    //checking if OTP is correct
    if ($inputOtp == $otp){
        // Update password in the database
        $sql = "UPDATE user SET userPwd=? WHERE userEmail=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../varificationotp.php?error=sqlerror");
            exit();
        }
        $hashedPwd = password_hash($fpassword, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $femail);
        mysqli_stmt_execute($stmt);
        echo '<script>alert("Your Password is successfuly changed.")</script>';
        // Redirect after displaying the alert
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    }else if($inputOtp !== $otp){
        echo '<script>alert("OTP did not matched.")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varification Page  |  LK PC SOLUTION|Dambulla</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="./image/LK PC Solution.png" type="image/x-icon">
</head>
<body>
<div class="container_varify">
        <form action="" method="post" class="varify">
            <h1>Varification</h1>
            <div><input type="text" name="otpNumber" id="" placeholder="Varify Your OTP"></div>
            <button type="submit" name="submit">Varify</button>
        </form>
    </div>
</body>
</html>