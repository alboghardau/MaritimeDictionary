<?php
session_start();
ob_start();

$page = $_GET['page'];

$_SESSION['engpg'] = $page;

header('Location: ../eng.php?action=0');
ob_flush();  
?>
