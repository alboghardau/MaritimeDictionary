<?php
session_start();
ob_start();

$page = $_GET['page'];

$_SESSION['ropg'] = $page;

header('Location: ../ro.php?action=0');
ob_flush();  
?>
