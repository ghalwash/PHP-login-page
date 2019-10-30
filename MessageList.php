<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php
$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'haitham';
$DBPass   = 'SrHr5mjR9Cy9baqf';
$DBName   = 'e-mail';
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}
?>
	<table border="1" align=center width="100%" >
    <tr><td colspan="2" align="center"> user name </td></tr>
    <tr><td bgcolor="#F9DFE0" align="center" > sent</td>
       <td bgcolor="#F9DFE0" align="center"> Recieved </td>
   </tr>
	<tr>
   	<td>
    
    <table border="0" align=center width="100%" >
    <form action="" method="post">
    <tr>
    <th bgcolor="silver">Action</th>
    <th bgcolor="silver">Sent to</th>
    <th bgcolor="silver">Message Body</th>
    <th bgcolor="silver">time</th>
  </tr>
  
	<?php
            $sql = "SELECT * FROM messages"; 
            $rs=$conn->query($sql);
            $rs->data_seek(0);
            while($row = $rs->fetch_assoc()){
			echo '<tr><td>'.'<input type="submit"  value= "delete" name="'. $row['MessageID'].'">'.'</td><td>'.$row['MessageOwner'].'</td><td>' . $row['MessageBody'].'</td><td>'.$row['Time'].'</td></tr>' ;} 
			?>
     </form>
        </table>
           </td>
			<td>
           
	<table border="0" align=center width="100%" >
        <tr>
    <th bgcolor="silver">Action</th>
    <th bgcolor="silver">Recieved From</th>
    <th bgcolor="silver">Message Body</th>
    <th bgcolor="silver">time</th>
  </tr>
  
	<?php
            $sql = "SELECT * FROM messages"; 
            $rs=$conn->query($sql);
            $rs->data_seek(0);
            while($row = $rs->fetch_assoc()){
        echo '<tr><td>'.'<input type="submit"  value= "delete" name="'. $row['MessageID'].'">'.'</td><td>'.$row['MessageOwner'].'</td><td>' . $row['MessageBody'].'</td><td>'.$row['Time'].'</td></tr>' ;} 
			        
    ?>    
     </table>

           </td>
		   </tr>


		</table>
</form> 
</fieldset> 
<body>
</body>
</html>