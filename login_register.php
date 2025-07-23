<?php

include './connect.php';
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


if(isset($_POST['signup'])) {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    
     $checkEmail="SELECT * FROM user WHERE email='$email'";
     $result=$conn->query($checkEmail);

     if($result->num_rows>0){
        $_SESSION['register_error'] = 'Email already used!';
        $_SESSION['active_form'] = 'register';
     }
     else {
        $insertQuery = "INSERT INTO user(username, email, password)
                        VALUES('$username','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("Location: ./loginpage.php");
            }
            else{
                header("Location: ./registration.php");
                $_SESSION['register_error'] = 'ERROR. Try again.'.$conn->error;
            }
     }
}

if(isset($_POST['signin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0) {
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['userinfo'][] = $row;
        header("Location: ./homepage.php");
        exit();
    }
    else{
        header("Location: ./loginpage.php");
        $_SESSION['login_error'] = "Account not found. Incorrect email or password.";
    }
}
?>