<?php
ob_start();
session_start();

$id = $_GET['id'];

$_SESSION['filideng'] = $id;
$_SESSION['engpg'] = 1;

header('Location: ../eng.php?action=0');

ob_flush();


?>
