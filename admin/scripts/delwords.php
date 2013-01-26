<?php
session_start();
ob_start();

include('../../settings.php');

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

$id = $_POST['id'];

$query = "DELETE FROM words WHERE id=".$id;
mysql_query($query);

$filename = "../../images/".$id.'.jpg';

if(file_exists($filename))
{
    unlink($filename);
}


mysql_close($conn);
header('Location: ../editw.php?action=1&id=0');
ob_flush();
?>
