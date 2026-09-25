<?php
session_start();

$conn = mysqli_connect("localhost","root","","coastalcare");

if(!$conn){
    die("Database connection failed");
}

# LOGIN
if(isset($_POST['login'])){
    $u = mysqli_real_escape_string($conn, $_POST['username']);
    $p = mysqli_real_escape_string($conn, $_POST['password']);

    $check = mysqli_query($conn,
        "SELECT * FROM users WHERE username='$u' AND password='$p'"
    );

    if(mysqli_num_rows($check) > 0){

        $_SESSION['username'] = $u;   // 🔥 VERY IMPORTANT
        $_SESSION['loggedin'] = true; // extra safety

        header("Location: dashboard.php");
        exit();

    } else {

        $_SESSION['msg'] = "Wrong Username or Password!";
        header("Location: login.php");
        exit();
    }
}


# SIGNUP
if(isset($_POST['signup'])){
    $nu = $_POST['newuser'];
    $np = $_POST['newpass'];

    mysqli_query($conn,"INSERT INTO users(username,password) VALUES('$nu','$np')");

    $_SESSION['msg'] = "Account Created Successfully!";
    header("Location: login.php");
    exit();
}

# RESET PASSWORD
if(isset($_POST['reset'])){
    $ru = $_POST['reset_user'];
    $np = $_POST['new_password'];

    $find = mysqli_query($conn,"SELECT * FROM users WHERE username='$ru'");

    if(mysqli_num_rows($find)>0){
        mysqli_query($conn,"UPDATE users SET password='$np' WHERE username='$ru'");
        $_SESSION['msg'] = "Password Reset Successfully!";
    }else{
        $_SESSION['msg'] = "Username Not Found!";
    }

    header("Location: login.php");
    exit();
}
?>
