<?php
ob_start();
session_start();

include("../../settings.php");

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

$catid = $_GET['catid'];
$wordid = $_GET['wordid'];

$query = "SELECT * FROM categories WHERE id=".$catid;
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$catname = $row['name'];

$query2 = "UPDATE eng SET catid='$catid' WHERE id='$wordid'";
mysql_query($query2);
$query2 = "UPDATE eng SET catnameeng='$catname' WHERE id='$wordid'";
mysql_query($query2);

$query = "SELECT * FROM connections WHERE ideng=".$wordid;
$result = mysql_query($query);

$catroname = $row['roname'];

while($row = mysql_fetch_array($result))
{
  
    
$query2 = "UPDATE ro SET catid='$catid' WHERE id=".$row['idro'];
mysql_query($query2);
$query2 = "UPDATE ro SET catnamero='$catroname' WHERE id=".$row['idro'];
mysql_query($query2);
    
}

mysql_close($conn);
ob_flush();

header("Location: ../add.php")
?>
