<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ghalwash-Sys Login Form</title>
</head>

<body align = center>

<?php
$flag = false;
$Message="";
// Grab User submitted information
if ( isset( $_POST[ 'user_email' ],$_POST["user_pass"]) && !is_null( $_POST[ 'user_email' ])&& !is_null($_POST["user_pass"] ) ) {

$email = $_POST["user_email"];
$email = trim($email);
$pass = $_POST["user_pass"];
$pass = trim($pass);
$DBServer = 'localhost';
$DBUser   = 'haitham';
$DBPass   = 'SrHr5mjR9Cy9baqf';
$DBName   = 'e-mail';

// Connect to the database
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
$sql = "SELECT userName, password FROM userlogin WHERE userName = '$email'"; 
$Find_result=$conn->query($sql);
if($Find_result == false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  exit;
}
if($Find_result->num_rows == 0) {
    // User not found. So, redirect to login_form again.
   // header('Location: login.html');
  $Message= "Invalid Credentials";
  }	
// put the whole record in an array
	$row = $Find_result->fetch_assoc();
		if($row["userName"]==$email && $row["password"]==$pass){
			echo $row["userName"].'<br>'."&nbsp;".$row["password"].'<br>';
			echo"You are a  user.";
			$flag = true; 
	}
	else
		echo "Sorry, your credentials are not valid, Please try again.";
}

?>
<fieldset style="width:30%"><legend>LOG-IN </legend> 
		<form method="POST" action="<?php if(!$flag) echo htmlentities($_SERVER['PHP_SELF']); else echo "MessageList.php" ?>"> 
			<table border="0" align=center valign=middle >
				<tr>
				<td><label for="user_email">Email</label></td>
				<td><input type="text" name="user_email" size="40"></td>
				</tr>
				<tr>
				<td><label for="user_pass">Password</label></td>
				<td><input name="user_pass" type="password" size="40"></input></td>
				</tr>
				<tr>
            <td colspan="2" align="center"><input type="submit" value="login"></tr>
      		      <tr>
                <td align="left"><a href="signup.php"> sign up</a>
                <td align="right"><a href="changepassword.php"> Change Password</a>
				</tr>
                  <tr>
           	<td colspan="2" ><font color="#CF292C"><?php echo $Message?><br></font> </td>
		</tr>
			</table>
		</form> 
	</fieldset> 
	</body>    
</html>