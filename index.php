<?php

$_SESSION['page']=1;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr">
    <head>
         <title>Maritime Dictionary</title>
         <link rel="stylesheet" href="style/style.css" type="text/css" />
    </head>
    <body>
        <div id="main">

            
            <div id="topbar">
                
                
<?php

include('menu.php');

?>            
                
            </div>
            <div id="contentmain">
                
                <?php 
                include("version.php");
                ?>
                
            </div>
           
            
            
        </div>   
        
    </body>
    
</html>