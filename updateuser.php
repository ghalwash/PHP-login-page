<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ghalwash-Sys Sign up Form</title>
</head>
<?php
// Grab User submitted information
$email = $_POST["user_email"];
$email = trim($email);
$passOld = $_POST["user_passOld"];
$passOld = trim($passOld);
$pass1 = $_POST["user_pass1"];
$pass1 = trim($pass1);
$pass2 = $_POST["user_pass2"];
$pass2 = trim($pass2);
$DBServer = 'localhost';
$DBUser   = 'haitham';
$DBPass   = 'SrHr5mjR9Cy9baqf';
$DBName   = 'e-mail';

// Connect to the database
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
$sql = "UPDATE userlogin SET password='$pass1' WHERE userName='$email'";

$inseert_result=$conn->query($sql);

if($inseert_result == false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  exit; } 
else { echo "updated succsessfully ok"."</br>";}
?>
<body>
</body>
</html>