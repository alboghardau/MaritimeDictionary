<?php      
session_start();
ob_start();

$_SESSION['adminpage'] = 2;

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
                <?php include('container.php');?>
                <div class="maintop">Add New Word</div>
                <div class="mainmain">
                    <center>
                    <form action="scripts/addw.php" method="post">
                        <table>
                            <tr>
                        <td><img src="img/uk.png" alt="pic"/></td>
                        <input type="hidden" name="action" value="0"/>
                        <td><input style="width:220px"  type="text" name="engw"/></td>
                        <td><input type="submit" value="Add"/></td>
                            </tr>
                        </table>
                        
                    </form>
                    </center>
                    
                    
                </div>
                <div class="mainlow"></div>
                
            </div>
            

            
        </div>
            </body>
</html>

<?php

ob_flush();

?>