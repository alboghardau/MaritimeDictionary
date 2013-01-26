<?php
session_start();
ob_start();
include("../../settings.php");

$red = $_GET['red'];
$id = $_GET['id'];

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);


$query = 'SELECT * FROM eng WHERE id='.$id;
$result = mysql_query($query);
$row = mysql_fetch_array($result);

if($row['visible'] == 1)
{
    $query = 'UPDATE eng SET visible=0 WHERE id='.$id;
    mysql_query($query);
}
if($row['visible'] == 0)
{
    $query = 'UPDATE eng SET visible=1 WHERE id='.$id;
    mysql_query($query);
}





mysql_close($conn);




if($red ==1)
{
   header("Location: ../add.php"); 
}
if($red ==2)
{
   header("Location: ../list.php"); 
}
ob_flush();
?>
