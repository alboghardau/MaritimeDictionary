<?php
session_start();
ob_start();

include('../settings.php');
$_SESSION['page']=4;

$action = $_GET['action'];
$id = $_GET['id'];

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
                
                <?php 
                //add category
                
                if($action == 1)
                {
                    echo '<center><form action="scripts/addcat.php" method="post">
                    Category name<br/>
                    <input type="text" name="catname"/>
                    <input type="image" src="img/transparent.png" class="add" value=""/>
                    </form></center><br/>';
                    
                    
                        $query = "SELECT * FROM categories";
    
    $result = mysql_query($query);
    
    echo '<center><table>';
    echo '<tr><td>Name</td><td>Delete</td><td>Edit</td></tr>';

    while($row = mysql_fetch_array($result))
    {
        if($row['id']!=1)
        {
        echo '<tr>';
        echo '<td>'.$row['name'].'</td>';
        echo '<td><a href="categories.php?action=2&id='.$row['id'].'"><img src="img/del.png" alt="del" /><a/>'.'</td>';
        echo '<td><a href="categories.php?action=3&id='.$row['id'].'"><img src="img/settings.png" alt="del" /><a/>'.'</td>';
        echo '</tr>';
        }
    }
    echo '</table></center>';
    
    
                }
                
                //category confirm delete
                
                if($action == 2)
                {
                    $rescat = mysql_query('SELECT * FROM categories WHERE id='.$id);
                    
                    $rowcat = mysql_fetch_array($rescat);
                    
                    echo '<a class="back" href="categories.php?action=1&id=0"></a>';
                    echo '<center>Are you sure you want to delete category named -'.$rowcat['name'].'-?</center>';
                    echo '
                    <center><form action="scripts/delcat.php" method="post">
                    <input type="hidden" name="id" value="'.$id.'"/>
                    <input type="image" src="img/transparent.png" class="delete"   value=""/>
                    <br/>
                    Delete words in this category?
                    <br/>
                    <img src="img/yes.png" alt="yes"/><input type="radio" name="delwords" value="yes"/>
                    <img src="img/no.png" alt="no"/><input type="radio" name="delwords" value="no" checked="checked"/>
                    <br/>
                    
                    </form></center>   
                    ';                   
                }
                
                if($action == 3)
                {
                    $query2 = "SELECT * FROM categories WHERE id=".$id;
                    
                    $result2 = mysql_query($query2);
                    
                    $row2 = mysql_fetch_array($result2);
                    
                    echo '<a class="back" href="categories.php?action=1&id=0"></a>';
                    echo '<center><form action="scripts/editcat.php" method="post">
                    Category name<br/>
                    <input type="text" name="catname" value="'.$row2['name'].'"/>
                    <input type="hidden" name="id" value="'.$id.'"/>    
                    <input type="image" src="img/transparent.png" class="edit" value=""/>
                    </form></center><br/>';
                
                }
                
                
                
                
                ?>
                

                <br/>
                
                
                <?php 
                

    

    mysql_close($conn);
                
    ob_flush();
                ?>
                
            </div>
            

            <div id="low"></div>
            
            
        </div>   
        
    </body>
    
</html>