<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","coastalcare");

if(!$conn){
    die("Database connection failed");
}

$username = $_SESSION['username'];
$success = "";

/* Save Feedback */
if(isset($_POST['send_feedback'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);

    mysqli_query($conn,
        "INSERT INTO feedback(username,name,email,message)
         VALUES('$username','$name','$email','$message')"
    );

    $success = "Feedback sent successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Help & Feedback - Coastal Care</title>
<meta name="viewport" content="width=device-width">

<style>

body{
margin:0;
font-family:Segoe UI,sans-serif;
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
display:flex;
justify-content:center;
align-items:center;
min-height:100vh;
}

.card{
background:white;
width:90%;
max-width:500px;
padding:25px;
border-radius:14px;
box-shadow:0 6px 18px rgba(0,0,0,.2);
}

h2{
margin-top:0;
text-align:center;
}

input, textarea{
width:100%;
padding:10px;
margin:10px 0;
border-radius:8px;
border:1px solid #ccc;
font-size:14px;
}

textarea{
height:120px;
resize:none;
}

button{
width:100%;
padding:12px;
background:#1f4e5f;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
font-size:16px;
}

.success{
color:green;
text-align:center;
margin-bottom:10px;
}

.back{
margin-top:15px;
display:block;
text-align:center;
text-decoration:none;
color:#1f4e5f;
font-weight:bold;
}

</style>
</head>

<body>

<div class="card">

<h2>💬 Help & Feedback</h2>

<?php if($success!=""){ ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>

<form method="post">

<input type="text" name="name" placeholder="Your Name" required>

<input type="email" name="email" placeholder="Your Email" required>

<textarea name="message" placeholder="Enter your feedback or issue..." required></textarea>

<button name="send_feedback">Send Feedback</button>

</form>

<a class="back" href="dashboard.php">← Back to Dashboard</a>

</div>

</body>
</html>
