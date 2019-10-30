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
$flag = true;
if ( isset( $_POST[ 'user_email' ],$_POST["user_pass1"],$_POST["user_pass2"] ) ) {
// Grab User submitted information
$email = $_POST["user_email"];
$pass1 = $_POST["user_pass1"];
$pass2 = $_POST["user_pass2"];
$email = trim($email);
$pass1 = trim($pass1);
$pass2 = trim($pass2);
//data base connection
		$DBServer = 'localhost';
		$DBUser   = 'haitham';
		$DBPass   = 'SrHr5mjR9Cy9baqf';
		$DBName   = 'e-mail';	// Connect to the database
		$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

//validating values
	$sql = "SELECT userName, password FROM userlogin WHERE userName = '$email'"; 
	$Find_result=$conn->query($sql);
		if($Find_result == false) {
		  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		  exit;
	}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$Message = "* Invalid email address"; 
	$flag= false;
	}
	else if ($Find_result->num_rows !== 0){
			$Message = "* Username Already Registered"; 
			$flag= false;
			}

	
if ($flag) {
		if (strcmp ($pass1 ,$pass2 ) == 0){
			if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $pass1)) { 
			$Message = "* Password Rules NOT Applied"; 
			$flag= false; }
		}
		else 		
		{
			$Message = "* Password Miss Match"; 
			$flag= false;
		}
	}
/*
    Explaining $\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$
    $ = beginning of string
    \S* = any set of characters
    (?=\S{8,}) = of at least length 8
    (?=\S*[a-z]) = containing at least one lowercase letter
    (?=\S*[A-Z]) = and at least one uppercase letter
    (?=\S*[\d]) = and at least one number
    (?=\S*[\W]) = and at least a special character (non-word characters)
    $ = end of the string

 */
 
if ($flag){
		$sql = "INSERT INTO userlogin (UserID,userName, password,state) VALUES (default,'$email','$pass1',default)";
		$inseert_result=$conn->query($sql);
		if($inseert_result == false) {
		  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		  exit; } 
		else { $Message1 = "Account Created, please go to LOGIN PAGE"."</br>";
		/*header("Location: ./index.php");*/} 
	}

}
?>

<div>
<fieldset style="width:40%"><legend>SIGN UP</legend> 
<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 
	<table border="0" align=center valign=middle >
		<tr>
			<td><label for="user_email">Type Email</label></td>
			<td><input type="text" name="user_email"  size="40"></td>
		</tr>
		<tr>
			<td><label for="user_pass1">type Password</label></td>
			<td><input name="user_pass1" type="password"  size="40"></input></td>
		</tr>
        <tr>
			<td><label for="user_pass2">re-type Password</label></td>
			<td><input name="user_pass2" type="password"  size="40"></input></td>
		</tr>
		<tr>
           	<td colspan="2" align="center"><input type="submit"  value=" sign up"/> </td>
		</tr>
        <tr>
           	<td colspan="2" ><font color="#CF292C"><?php echo $Message?><br></font> <font color="#1A9615"><?php echo $Message1?><font></td>
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
