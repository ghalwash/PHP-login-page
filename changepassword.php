<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>

<?php
$Message="";
$Message1="";
$flag= false;
if ( isset( $_POST[ 'user_email' ],$_POST["user_pass1"],$_POST["user_pass2"] ) ) {
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

// check the existance of User
$sql = "SELECT userName, password FROM userlogin WHERE userName = '$email'"; 
$Find_result=$conn->query($sql);
if($Find_result == false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  exit;
}
//if($Find_result->num_rows == 0) {
    // User not found. So, redirect to login_form again.
   //header('Location: changepassword.php');
  // $Message= "Invalid Credentials";
  //}	
// put the whole record in an array
	$row = $Find_result->fetch_assoc();
		if($row["userName"]==$email && $row["password"]==$passOld){
			$flag= true;
	}
	else
		$Message = "Invalid Credentials, Please try again.";
}

if ($flag){
	// check password Rules and matching
	if (strcmp ($pass1 ,$pass2 ) == 0){
			if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $pass1)) { 
			$Message = "* Password Rules NOT Applied"; }
			else {
				$sql = "UPDATE userlogin SET password='$pass1' WHERE userName='$email'";
				$inseert_result=$conn->query($sql);
				if($inseert_result == false) {
					  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
					  exit; } 
				else { $Message1= " Valide User, updated succsessfully";}
				}
		}
		else
		{
			$Message = "* Password Miss Match"; 
			$flag= false;
		}
}

?>

<div>
<fieldset style="width:40%"><legend>Change Password </legend> 
<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 
	<table border="0" align=center valign=middle >
		<tr>
			<td><label for="user_email">Email</label></td>
			<td><input type="text" name="user_email"  size="40"></td>
		</tr>
		<tr>
			<td><label for="user_passOld">old Password</label></td>
			<td><input name="user_passOld" type="password"  size="40"></input></td>
		</tr>

		<tr>
			<td><label for="user_pass1">new Password</label></td>
			<td><input name="user_pass1" type="password"  size="40"></input></td>
		</tr>
        <tr>
			<td><label for="user_pass2">re-type new Password</label></td>
			<td><input name="user_pass2" type="password"  size="40"></input></td>
		</tr>
		<tr>
           	<td align="center"> </td>
            <td align="center"><input type="submit"  value=" Change Password"/> </td>
		</tr>
        <tr>
       <td colspan="2"><font color="#CF292C"><?php echo $Message?></font><font color="#1A9615"><?php echo $Message1?></font></td>       
		</tr>
        <tr>
           	<td colspan="2" align="right"><a href="index.php" >sign in </a></td>
		</tr>
        
		</table>
</form> 
</fieldset>
<Br> 
<b><U>Password Rules</B></U>
<UL>
    <Li>At least length 8</li>
    <Li>Containing at least one lowercase letter</li>
    <Li>At least one uppercase letter</li>
    <Li>At least one number</li>
    <Li>At least a special character </li>
    </Ul>

</div>
</body>
</html>
