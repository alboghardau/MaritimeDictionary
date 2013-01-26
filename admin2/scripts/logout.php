<?php
session_start();
ob_start();

session_destroy();

//part to delete not linked words

include("../../settings.php");

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);


$query = "SELECT * FROM connections";
$result = mysql_query($query);

$arraynr = 0;
//write connections id arrays ro/eng
while($row = mysql_fetch_array($result))
{
    $engarr[$arraynr] = $row['ideng'];
    $roarr[$arraynr] = $row['idro'];
    $arraynr ++;
}

$query = "SELECT * FROM eng";
$result = mysql_query($query);

while($row = mysql_fetch_array($result))
{
    if (!in_array($row['id'], $engarr))
    {
        mysql_query("DELETE FROM eng WHERE id=".$row['id']);
    }
}


$query = "SELECT * FROM ro";
$result = mysql_query($query);

while($row = mysql_fetch_array($result))
{
    if (!in_array($row['id'], $roarr))
    {
        mysql_query("DELETE FROM ro WHERE id=".$row['id']);
    }
}


mysql_close($conn);

ob_flush();
header('Location: ../index.php');
?>
