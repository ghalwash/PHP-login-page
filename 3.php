<html>
<?php
echo "Hello abol";
$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'haitham';
$DBPass   = 'SrHr5mjR9Cy9baqf';
$DBName   = 'e-mail';

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

$sql = "SELECT * FROM login"; 
$rs=$conn->query($sql);
if($rs == false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
  echo '<br>'.$rows_returned.'<br>';
}

$rs->data_seek(0);
while($row = $rs->fetch_assoc()){
    echo $row['username'] . '<br>';
}


?>
</html>
