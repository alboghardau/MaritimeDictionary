<?php
session_start();
ob_start();
include('../../settings.php');


if(isset($_POST['search']))
{
if(strlen($_POST['search'])>= 4)
{

$_SESSION['search'] = $_POST['search'];
}
else
    {
    unset($_SESSION['search']);
}
}



  

header('Location: ../editw.php?action=1&id=0');
ob_flush();  
?>
