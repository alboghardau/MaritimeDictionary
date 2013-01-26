<?php
session_start();
ob_start();

if(isset($_SESSION['container']))
{
    unset($_SESSION['container']);
}

if(isset($_SESSION['cont_eng_id']))
{
    unset($_SESSION['cont_eng_id']);
}

if(isset($_SESSION['cont_eng_word']))
{
    unset($_SESSION['cont_eng_word']);
}

if(isset($_SESSION['cont_rom_word']))
{
    unset($_SESSION['cont_rom_word']);
}

if(isset($_SESSION['cont_rom_id']))
{
    unset($_SESSION['cont_rom_id']);
}

ob_flush();
header("Location: ../add.php");
?>
