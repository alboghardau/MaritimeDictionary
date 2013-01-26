<?php
session_start();
ob_start();
include("../../settings.php");

$catname = $_POST['catname'];
$id = $_POST['id'];

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

$query = "UPDATE categories SET name='".$catname."' WHERE id=".$id;
$query2 = "UPDATE words SET catname='".$catname."' WHERE category=".$id;

mysql_query($query);
mysql_query($query2);

ob_flush();
header("Location: ../categories.php?action=1&id=0");
?>
