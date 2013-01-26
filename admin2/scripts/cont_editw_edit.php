<?php
include("../../settings.php");
session_start();
ob_start();

$id = $_POST['id'];
$word = $_POST['engw'];
$action = $_POST['action'];

$word = mysql_escape_string($word);

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);


if($action == 1)
{
    $query = "UPDATE eng SET word='$word' WHERE id=".$id;
    unset ($_SESSION['editeng']);
    unset ($_SESSION['editeng_id']);
    
}

if($action == 2)
{
    $query = "UPDATE ro SET word='$word' WHERE id=".$id;
    unset ($_SESSION['editro']);
    unset ($_SESSION['editro_id']);
}
if($action == 3)
{
    $query = "UPDATE eng SET word='$word' WHERE id=".$id;
    unset ($_SESSION['editeng']);
    unset ($_SESSION['editeng_id']);
    
}

if($action == 4)
{
    $query = "UPDATE ro SET word='$word' WHERE id=".$id;
    unset ($_SESSION['editro']);
    unset ($_SESSION['editro_id']);
}


mysql_query($query);



ob_flush();

mysql_close($conn);

if($action == 1)
{
header("Location: ../add.php");
}
if($action == 2)
{
header("Location: ../add.php");
}
if($action == 3)
{
header("Location: ../list.php");
}
if($action == 4)
{
header("Location: ../list.php");
}
?>
