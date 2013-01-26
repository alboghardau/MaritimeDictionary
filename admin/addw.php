<?php
session_start();
ob_start();

$_SESSION['page']=2;

include("../settings.php");

    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);

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
            <div id="topspace"></div>
            
            <div id="topbar">
                
                
<?php

include('menu.php');

?>
                
                
                
            </div>
            <div id="contentmain">
            
                <center><form name="newad" action="scripts/addword.php" method="post" enctype="multipart/form-data">
                    <table> 
                    <tr><td>Eng:</td><td><input type="text" name="eng" size="100"/></td></tr>
                    <tr><td>Ro:</td><td><input type="text" name="ro" size="100"/></td></tr>
                    </table>    
                    
                    <br/>Category:<br/>
                    
                    <?php
                    
                    $query = "SELECT * FROM categories";
                    $result = mysql_query($query);
                    
                    while($row = mysql_fetch_array($result))
                    {
                        echo $row['name'].'<input type="radio" name="category" value="'.$row['id'].'"';
                        if($row['id']==1)
                        {
                            echo 'checked="checked"';
                        }
                        echo '/>';
                    }
                    
                    ?>
                    <br/><br/>
                    Image:<input type="file" name="image"/>
                    <br/><br/><input name="Submit" type="image" src="img/transparent.png" class="add"/>
                </form></center>
                <br/>
                <?php
                             if(isset($_SESSION['newword']))
                {
                    echo $_SESSION['newword'];
                }
                echo '<br/>';

                if(isset($_SESSION['newwordid']))
                {
                    if((file_exists("../images/".$_SESSION['newwordid'].".jpg") == 1)||(file_exists("../images/".$_SESSION['newwordid'].".jpeg") == 1))
                    {
                        if(isset($_SESSION['log']))
                        {
                            echo $_SESSION['log'];
                        } 
                    echo '<br/><img src="../images/'.$_SESSION['newwordid'].'.jpg" alt="'.$_SESSION['newwordid'].'" />';
                    }                    
                }
                
                
                ?>
            </div>
            <div id="low">
                <?php
  
                ?>
                
            </div>
            
            
        </div>   
        
    </body>
    
</html>

<?php

mysql_close($conn);
ob_flush();

?>