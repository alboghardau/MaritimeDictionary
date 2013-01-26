<?php
session_start();
ob_start();

$page = $_GET['page'];

$_SESSION['all_page'] = $page;

ob_flush();
header("Location: ../list.php");
?>
