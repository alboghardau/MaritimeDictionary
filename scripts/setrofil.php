<?php
ob_start();
session_start();

$id = $_GET['id'];

$_SESSION['filidro'] = $id;
$_SESSION['ropg'] = 1;

header('Location: ../ro.php?action=0');

ob_flush();


?>
