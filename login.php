<!DOCTYPE html>
<html>
<head>
<title>Login - Coastal Care</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="login-bg">


<div class="login-card">
    <?php

if(isset($_GET['loginsuccess'])){
    echo "<div class='msg success'>Login Successful!</div>";
}

if(isset($_GET['loginfail'])){
    echo "<div class='msg error'>Wrong Username or Password</div>";
}

if(isset($_GET['created'])){
    echo "<div class='msg success'>Account Created Successfully!</div>";
}

if(isset($_GET['resetok'])){
    echo "<div class='msg success'>Password Reset Successfully!</div>";
}

if(isset($_GET['notfound'])){
    echo "<div class='msg error'>Username Not Found!</div>";
}

?>


<img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1400&q=80">

<h2>Coastal Care</h2>

<!-- LOGIN FORM -->
<form action="process.php" method="post">

<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>

<select name="role">
<option>User</option>
<option>Volunteer</option>
<option>Admin</option>
</select>

<button name="login">Login</button>
<?php
session_start();

if(isset($_SESSION['msg'])){
    echo "<div class='msg success'>".$_SESSION['msg']."</div>";
    unset($_SESSION['msg']);
}
?>



</form>

<p style="text-align:center; margin-top:10px;">
<a href="?reset=1">Forgot Password?</a>
</p>

<hr>

<!-- RESET PASSWORD FORM -->
<?php if(isset($_GET['reset'])){ ?>


<h3>Reset Password</h3>

<form action="process.php" method="post">

<input type="text" name="reset_user" placeholder="Username" required>
<input type="password" name="new_password" placeholder="New Password" required>

<button name="reset">Reset Password</button>

</form>

<?php } ?>

<hr>

<!-- SIGNUP FORM -->
<h3>Create Account</h3>

<form action="process.php" method="post">

<input type="text" name="newuser" placeholder="New Username" required>
<input type="password" name="newpass" placeholder="New Password" required>

<button name="signup">Sign Up</button>


</form>

</div>

</body>
</html>
