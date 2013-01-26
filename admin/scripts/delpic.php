<?php
session_start();
ob_start();

include('../../settings.php');

$id = $_GET['id'];

if(file_exists('../../images/'.$id.'.jpg'))
{
    unlink('../../images/'.$id.'.jpg');
}
header('Location: ../editw.php?action=3&id='.$id);
ob_flush();
?>
