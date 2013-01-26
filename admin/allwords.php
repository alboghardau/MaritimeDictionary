<?php
session_start();
ob_start();

$_SESSION['page']=5;
$action = $_GET['action'];
$id = $_GET['id'];

include('../settings.php');

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
                //action 1 search words
                if($action == 1)
                {
                    
      
 
                    echo '
                        
                
                <center><table>
                        <tr>
                            <td>Eng</td>
                            <td>Ro</td>
                            <td>Category</td>
                            <td>Delete</td>
                            <td>Edit</td>
                            <td>Image</td>
                        </tr>   
                ';
                
                    
                    if(!isset($_SESSION['allpg']))
                    {
                        $_SESSION['allpg'] = 1;
                    }

                    $query2 = 'SELECT * FROM words';
                    $result2 = mysql_query($query2);
                    
                    $nrwords = mysql_num_rows($result2);

                    $startrow = $_SESSION['allpg'] * 30 - 30;
                    
                    $query = 'SELECT * FROM words LIMIT '.$startrow.",30";
                    $result = mysql_query($query);
                    

                    
                    echo '<center class="show">Page:'.$_SESSION['allpg'].' Number of words: '.$nrwords."</center>";

                    for($i=1;$i<=ceil($nrwords/30);$i++)
                    {
                        echo '<a class="page" href="allwscripts/setpage.php?page='.$i.'">'.$i.'</a>';
                    
                       if($i%25 == 0)
                       {
                           echo "<br/>";
                       }
                        
                    }
                    
                    
                    while($row = mysql_fetch_array($result))
                    {

                        echo "<tr>";
                        echo '<td class="show">'.$row['eng'].'</td>';
                        echo '<td class="show">'.$row['ro'].'</td>';
                        echo '<td class="show">'.$row['catname'].'</td>';
                        echo '<td><a href="allwords.php?action=2&id='.$row['id'].'"><img src="img/del2.png" alt="del" /><a/>'.'</td>';
                        echo '<td><a href="allwords.php?action=3&id='.$row['id'].'"><img src="img/settings2.png" alt="set" /><a/>'.'</td>';
                        echo '<td>';
                        
                        if(file_exists('../images/'.$row['id'].'.jpg'))
                        {
                            echo '<img src="img/jpg2.png" alt="pic" />';
                        }
                        
                        echo '</td>';
                        
                                 
                    }                    
                
                echo '</table></center>';
                }
                
                if($action == 2)
                {
                     echo '<a class="back" href="allwords.php?action=1&id=0"></a>';
                     
                     $query = 'SELECT * FROM words WHERE id='.$id;
                     $result = mysql_query($query);
                     $row = mysql_fetch_array($result);
                     
                     echo '<center>Are you sure you want to delete? <br/> '.$row['ro'].'-'.$row['eng'].'</center>';
                     
                     if(file_exists("../images/".$id.".jpg"))
                    {
                        echo '<center><img src="../images/'.$id.'.jpg" alt="img" /></center>';
                    }                     
                        echo '
                                             <form action="allwscripts/delwords.php" method="post">
                    <center>
                    <input type="hidden" name="id" value="'.$id.'"/>
                    
                    <input type="image" class="delete" src="img/transparent.png" />
                    <br/>
                    </form></center>   
                    ';                    
                    
                                         
                }
                
                if($action == 3)
                {
                    
                    echo '<a class="back" href="allwords.php?action=1&id=0"></a>';
                    
                    $query = 'SELECT * FROM words WHERE id='.$id;
                    $result = mysql_query($query);
                    $row = mysql_fetch_array($result);
                    
                    
                    echo '
                        
                        <center><form action="allwscripts/editwords.php" method="post"><table>
                        <tr><td>Eng:</td><td><input type="text" name="eng" size="100" value="'.$row['eng'].'"/></td></tr>
                        <tr><td>Ro:</td><td><input type="text" name="ro" size="100" value="'.$row['ro'].'"/></td></tr>
                            </table><br/>
                            <input type="hidden" name="id" value="'.$id.'"/>
                            Category:<br/>';
                    
                    $query2 = "SELECT * FROM categories";
                    $result2 = mysql_query($query2);
                    while ($row2 = mysql_fetch_array($result2))
                    {
                        echo $row2['name'];
                        echo '<input type="radio" name="catid" value="'.$row2['id'].'" ';
                        if($row2['id'] == $row['category'])
                        {
                            echo 'checked="checked"';
                        }
                        echo '/>';
                    }
                    
                    echo'   <br/><br/> <input type="image" class="edit" src="img/transparent.png" />
                        </form></center>
                    '; 
                    
                     if(file_exists("../images/".$id.".jpg"))
                    {
                        echo '<br/><center><img src="../images/'.$id.'.jpg" alt="img" /></center>';
                        echo '<center>';
                        echo '<a class="delete" href="allwscripts/delpic.php?id='.$id.'"></a>';
                        echo '</center>';
                        

                    } 
                        echo '<br/><center><form name="newad" action="allwscripts/addpic.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="'.$id.'"/>
                        Image:<input type="file" name="image"/>
                        <input name="Submit" type="image" src="img/transparent.png" class="add"/>
                        </form></center>
';
       
                }
                ?>
                
                
                
            </div>
            <div id="low"></div>
            
            
        </div>   
        
    </body>
    
</html>
<?php

mysql_close($conn);
ob_flush();

?>