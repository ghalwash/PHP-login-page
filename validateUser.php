<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php
// Grab User submitted information
$email = $_POST["user_email"];
$email = trim($email);
$pass = $_POST["user_pass"];
$pass = trim($pass);
$DBServer = 'localhost';
$DBUser   = 'haitham';
$DBPass   = 'SrHr5mjR9Cy9baqf';
$DBName   = 'e-mail';
echo $email."<br>";
// Connect to the database
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
$sql = "SELECT userName, password FROM userlogin WHERE userName = '$email'"; 
$Find_result=$conn->query($sql);

if($Find_result == false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  exit;
} else { echo "its ok"."</br>";}

//echo $Find_result->num_rows . "<br>";
if($Find_result->num_rows == 0) {
    // User not found. So, redirect to login_form again.
   // header('Location: login.html');
   echo "user not found";
  }	
// put the whole record in an array
	$row = $Find_result->fetch_assoc();
		if($row["userName"]==$email && $row["password"]==$pass){
			echo $row["userName"]."&nbsp;".$row["password"];
			echo"You are a validated user.";
	}
	else
		echo"Sorry, your credentials are not valid, Please try again.";

/*$rs->data_seek(0);
while($row = $rs->){
echo $row['username'] . '<br>';
}
if($result->num_rows == 0) {
    // User not found. So, redirect to login_form again.
    header('Location: login.html');
}

$userData = mysqli_fetch_array($result, MYSQL_ASSOC);
$hash     = hash('sha256', $userData['salt'] . hash('sha256', $password) );

if($hash != $userData['password']) {
    // Incorrect password. So, redirect to login_form again.
    header('Location: login.html');
} else {
    // Redirect to home page after successful login.
    header('Location: home.html');
}
?>

*/



// Select the database to use


?>
<body>
</body>
</html>