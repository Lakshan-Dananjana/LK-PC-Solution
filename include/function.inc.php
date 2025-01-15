<?php
//check empty input function in login
function emptyInputLogin($email,$password){

    if(empty($email)){
        echo '<script>alert("Email is empty")</script>';
    }
    if(empty($password)){
        echo '<script>alert("Password is empty")</script>';
    }
}
//check empty input function in signup
function emptyInputSignup($name,$email,$password,$cpassword){
    if(empty($name)){
        echo '<script>alert("Name is empty")</script>';
    }
    if(empty($email)){
        echo '<script>alert("Email is empty")</script>';
    }
    if(empty($password)){
        echo '<script>alert("Password is empty")</script>';
    }
    if(empty($cpassword)){
        echo '<script>alert("Confirm Password is empty")</script>';
    }
}
function invalidEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<script>alert("invalid email")</script>';
    }
}
function passwordMatch($password,$cpassword){
    if ($password !== $cpassword){
        echo '<script>alert("Password and Confirm password don,t match")</script>';
    }
}
function userExists($conn,$email){
    $sql = "SELECT * FROM user WHERE userEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('Location: register.php?error=stmterror');
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result) > 0){
        echo '<script>alert("Email already exists")</script>';
        exit();
    }
    mysqli_stmt_close($stmt);    
}
function userExistsForget($conn,$email){
    $sql = "SELECT * FROM user WHERE userEmail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;  // Returns true if the email exists
}
function emptyInputForget($femail,$fpassword,$fcpassword){
    if(empty($femail)){
        echo '<script>alert("Email is empty")</script>';
    }
    if(empty($fpassword)){
        echo '<script>alert("Password is empty")</script>';
    }
    if(empty($fcpassword)){
        echo '<script>alert("Confirm Password is empty")</script>';
    }
}
function loginUser($conn,$email,$password){
    $sql = "SELECT * FROM user WHERE userEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "SQL error";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $hashedPwdCheck = password_verify($password, $row['userPwd']);
        
        if($hashedPwdCheck == false){
            echo '<script>alert("Your Password Is Wrong")</script>';
            echo '<script>window.location.href = "index.php";</script>';
            exit();
        } elseif($hashedPwdCheck == true){
            session_start();
            $_SESSION['user_id'] = $row['userId'];
            $_SESSION['user_name'] = $row['userName'];
            $_SESSION['user_email'] = $row['userEmail'];
            echo '<script>window.location.href = "home.php";</script>';
            exit();
        }
    }
    else{
        echo '<script>alert("Your email is not found")</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    }
}
function generateOTP(){
    return rand(100000,999999);
}