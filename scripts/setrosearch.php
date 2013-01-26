<?php
ob_start();
session_start();

if(isset($_POST['searchro']))
{
    $_SESSION['sro'] = $_POST['searchro'];
    $_SESSION['filidro']=0;
}

if($_SESSION['sro']=="")
{
    unset($_SESSION['sro']);
}

$_SESSION['ropg'] = 1;

header("Location: ../ro.php?action=0");
ob_flush();
?>
