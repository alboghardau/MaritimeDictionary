<?php

session_start();
ob_start();

$action = $_GET['action'];
$id = $_GET['id'];

if($action == 1)
{
$_SESSION['editeng'] = 1;
$_SESSION['editeng_id'] = $id;
ob_flush();
header("Location: ../add.php");
}

if($action == 2)
{
$_SESSION['editro'] = 1;
$_SESSION['editro_id'] = $id;
ob_flush();
header("Location: ../add.php");
}

if($action == 3)
{
$_SESSION['editeng'] = 1;
$_SESSION['editeng_id'] = $id;
ob_flush();
header("Location: ../list.php");
}

if($action == 4)
{
$_SESSION['editro'] = 1;
$_SESSION['editro_id'] = $id;
ob_flush();
header("Location: ../list.php");
}

?>
