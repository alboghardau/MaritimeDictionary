<?php
session_start();
ob_start();

include('../../settings.php');

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

$id = $_POST['id'];
$eng = $_POST['eng'];
$ro = $_POST['ro'];
$catid = $_POST['catid'];

$q1 = "UPDATE words SET eng='".$eng."' WHERE id=".$id;
mysql_query($q1);
$q1 = "UPDATE words SET ro='".$ro."' WHERE id=".$id;
mysql_query($q1);
$q1 = "UPDATE words SET category='".$catid."' WHERE id=".$id;
mysql_query($q1);

$query = "SELECT * FROM categories WHERE id=".$catid;
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$q1 = "UPDATE words SET catname='".$row['name']."' WHERE id=".$id;
mysql_query($q1);


mysql_close($conn);
header('Location: ../editw.php?action=3&id='.$id);
ob_flush();


?>
