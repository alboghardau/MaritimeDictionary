<?php
session_start();
ob_start();

if(isset($_SESSION['logged'])&&($_SESSION['logged'] == "on"))
{
    header('Location: main.php');
}

if(isset($_SESSION['logerror']))
{
    echo '<center><p>'.$_SESSION['logerror'].'</p></center>';
}

ob_flush();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr">
    <head>
         <title>Maritime Dictionary</title>
         <link rel="stylesheet" href="style/admin.css" type="text/css" />
    </head>
    <body>


<center>
<form action="scripts/usertest.php" method="post">
    <table>
    <tr>
            <td>Username:</td><td><input type="text" name="username"/></td>
    </tr>
    <tr>
        <td>Passwords:</td><td><input type="password" name="password"/></td>
    </tr>
   </table>
    
    <input type="submit"/>
</form>
</center>
        
    </body>
</html>
