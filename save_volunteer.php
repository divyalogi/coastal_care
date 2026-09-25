<?php

$conn = mysqli_connect("localhost","root","","coastalcare");

$name = $_POST['name'];

$service = $_FILES['service']['name'];
$aadhaar = $_FILES['aadhaar']['name'];

move_uploaded_file($_FILES['service']['tmp_name'],"uploads/".$service);
move_uploaded_file($_FILES['aadhaar']['tmp_name'],"uploads/".$aadhaar);

mysqli_query($conn,"
INSERT INTO volunteers(name,service_file,aadhaar_file)
VALUES('$name','$service','$aadhaar')
");

echo "Saved";

?>