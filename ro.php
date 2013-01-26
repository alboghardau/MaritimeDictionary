<?php
session_start();
ob_start();

$_SESSION['page']=3;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr">
    <head>
         <title>Maritime Dictionary</title>
         <link rel="stylesheet" href="style/style.css" type="text/css" />
         
         <script type="text/javascript">
<!--

  var viewportwidth;
  var viewportheight;

 // the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight

  if (typeof window.innerWidth != 'undefined')
  {
      viewportwidth = window.innerWidth,
      viewportheight = window.innerHeight
  }

 else if (typeof document.documentElement != 'undefined'
 && typeof document.documentElement.clientWidth !=
 'undefined' && document.documentElement.clientWidth != 0)
 {
   viewportwidth = document.documentElement.clientWidth,
   viewportheight = document.documentElement.clientHeight
 }
   

 else
 {
   viewportwidth = document.getElementsByTagName('body')[0].clientWidth,
   viewportheight = document.getElementsByTagName('body')[0].clientHeight
 }
   viewportheight = viewportheight-110;
 
   document.write('<style type="text/css"> div.rightcol {height: '+viewportheight+'px}</style>');
//-->
</script>
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
                echo '
                    <center>
                <form action="scripts/setrosearch.php" method="post">
                <table><tr>
                <td ><img src="img/rom.png" alt="uk"/></td>
                <td ><input type="text" name="searchro"/></td>
                <td><input type="submit" value="Search" /></td>
                </tr></table>

                </form>
            </center>
                    ';
                
                ?>
                
                                        <center><div class="leftcol">
                            <?php include('rocatfilter.php');?>
                        </div></center>
                        <div class="rightcol">
                            <?php include('findro.php');?>
                        </div>
       
                
                
            </div>
    
            
            
        </div>   
        
    </body>
    
</html>

<?php 
ob_flush();
?>