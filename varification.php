<?php
require_once 'include/function.inc.php';
require_once 'include/dbh.inc.php';

session_start();
if(isset($_POST['submit'])){
   $otp = $_POST['otpNumber'];
   $name = $_SESSION['name'];
   $email = $_SESSION['email'];
   $password = $_SESSION['password'];
   $userJobRoll = "user";

   if ($otp == $_SESSION['otp']){
        // Create a new user in the database
        $sql = "INSERT INTO user (userName, userEmail, 	userPwd, userJobRoll) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: register.php?error=sqlerror");
            exit();
        } else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashedPwd, $userJobRoll);
            mysqli_stmt_execute($stmt);
            echo '<script>alert("Registration Successful.")</script>';
            // Redirect after displaying the alert
            echo '<script>window.location.href = "index.php";</script>';
            exit();
        }
   }else if($otp !== $_SESSION['otp']){
        echo '<script>alert("OTP did not matched.")</script>';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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