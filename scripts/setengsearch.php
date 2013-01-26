<?php
ob_start();
session_start();

if(isset($_POST['searcheng']))
{
    $_SESSION['seng'] = $_POST['searcheng'];
    $_SESSION['filideng']=0;
}

if($_SESSION['seng']=="")
{
    unset($_SESSION['seng']);
}

$_SESSION['engpg'] = 1;

header("Location: ../eng.php?action=0");
ob_flush();
?>
