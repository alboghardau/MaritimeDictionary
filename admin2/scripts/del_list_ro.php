<?php
include('settings.php');

session_start();
ob_start();

$engid = $_GET['engid'];
$romid = $_GET['romid'];

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

$query = "DELETE FROM connections WHERE ideng=".$engid." AND idro=".$romid;
mysql_query($query);
mysql_close($conn);


ob_flush();
header('Location: ../list.php');
?>
