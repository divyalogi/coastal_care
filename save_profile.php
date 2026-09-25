<?php

$conn=mysqli_connect("localhost","root","","coastalcare");

$name=$_POST['name'];
$age=$_POST['age'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$role=$_POST['role'];

$sql="INSERT INTO users_profile(name,age,dob,gender,mobile,email,role)
VALUES('$name','$age','$dob','$gender','$mobile','$email','$role')";

mysqli_query($conn,$sql);

echo "<script>alert('Profile Saved Successfully');window.location='dashboard.php';</script>";

?>
