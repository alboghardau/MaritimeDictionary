<?php
session_start();
ob_start();

$page = $_GET['page'];

$_SESSION['allpg'] = $page;

header('Location: ../allwords.php?action=1&id=0');
ob_flush();
?>
