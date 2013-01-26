<?php
      
session_start();
ob_start();

$_SESSION['adminpage'] = 1;

if($_SESSION['logged']!="on")
{
    header('Location: index.php');
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr">
    <head>
         <title>Maritime Dictionary</title>
         <link rel="stylesheet" href="style/admin.css" type="text/css" />
    </head>
    <body>

        <div id ="topspace"></div>
        <div id="wrap">
            <div id ="left">
                
                <?php include("menu.php");?>
                
            </div>
            
            <div id ="right">
                <div class="maintop">Home</div>
                <div class="mainmain">
                    


                    
                    
                </div>
                <div class="mainlow"></div>
                
            </div>
            

            
        </div>
            </body>
</html>

<?php

ob_flush();

?>