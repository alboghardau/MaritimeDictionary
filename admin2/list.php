<?php
      
session_start();
ob_start();

$_SESSION['adminpage'] = 3;

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
                <div class="maintop">All Words</div>
                <div class="mainmain">
                <center>              
<?php

include("../settings.php");

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);


//count and display page list
$query = "SELECT * FROM eng";
$result = mysql_query($query);
$words = mysql_num_rows($result);


for($i = 1; $i <= $words/15; $i++)
{
echo '<a class="page" href="scripts/all_set_page.php?page='.$i.'">'.$i."</a>";
if($i%20 == 0)
{
    echo "<br/>";
}
}


//display edit english word if needed
if(isset($_SESSION['editeng'])&&($_SESSION['editeng']==1))
{
       
    $query = "SELECT * FROM eng WHERE id=".$_SESSION['editeng_id'];
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    
    $word = $row['word'];
    $wordid = $row['id'];
    
    //display form to edit word
    echo '              <center><form action="scripts/cont_editw_edit.php" method="post">
                        <table>
                        <tr>
                        <td><img src="img/uk.png" alt="pic"/></td>
                        <input type="hidden" name="id" value="'.$wordid.'"/>
                        <input type="hidden" name="action" value="3"/>
                        <td><input style="width:220px"  type="text" name="engw" value="'.$word.'"/></td>
                        <td><input type="submit" value="Edit"/></td>
                        </tr>
                        </table>
                        </form></center>';
    
        $query2 = "SELECT * FROM categories";
    $result2 = mysql_query($query2);
    
    echo "<table>";
    
    while($row4 = mysql_fetch_array($result2))
    {        
        if($row4['id'] == $row['catid'])
        {
            $display =  'selected';
        }
        else
        {
            $display = 'notselected';
        }
                
        echo '<tr><td class="'.$display.'"><a href="scripts/all_change_cat.php?catid='.$row4['id'].'&wordid='.$row['id'].'"><div>'.$row4['name'].'</div></a></td></tr>';
        
    }
   echo "</table>";
}

//display edit romanian word if needed
if(isset($_SESSION['editro'])&&($_SESSION['editro']==1))
{
       
    $query = "SELECT * FROM ro WHERE id=".$_SESSION['editro_id'];
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    
    $word = $row['word'];
    $wordid = $row['id'];
    
    //display form to edit word
    echo '              <center><form action="scripts/cont_editw_edit.php" method="post">
                        <table>
                        <tr>
                        <td><img src="img/rom.png" alt="pic"/></td>
                        <input type="hidden" name="id" value="'.$wordid.'"/>
                        <input type="hidden" name="action" value="4"/>
                        <td><input style="width:220px"  type="text" name="engw" value="'.$word.'"/></td>
                        <td><input type="submit" value="Edit"/></td>
                        </tr>
                        </table>
                        </form></center>';
}

//set page result filter
if(isset($_SESSION['all_page']))
{
  $start = $_SESSION['all_page']*15-15;
  $pgfil = " LIMIT ".$start." , 15";
}
else
{
    $pgfil = " LIMIT 0, 10";
}

$query = "SELECT * FROM eng".$pgfil;
$result = mysql_query($query);

echo '<table><tr><td ><img src="img/uk.png" alt="pic"/></td><td><img src="img/rom.png" alt="pic"/></td></tr></table>';

while($row = mysql_fetch_array($result))
{
    echo '<table><tr>';
        echo '<td><a href="scripts/lightbulb.php?red=2&id='.$row['id'].'">';
        if($row['visible']==0)
        {
            echo '<img src="img/lightoff.png" alt="pic"/>';
        }
        if($row['visible']==1)
        {
            echo '<img src="img/lighton.png" alt="pic"/>';
        }
    echo '</a></td>';
    echo '<td><a href="scripts/cont_editw_set.php?action=3&id='.$row['id'].'" ><img src="img/arrow.png" alt="pic"/></a></td>';

    echo '<td class="eng">'.$row['word'].'</td>';
    
    $query2 = "SELECT idro FROM connections WHERE ideng=".$row['id'];
    $result2 = mysql_query($query2);
    
    while($row2 = mysql_fetch_array($result2))
    {
        if(isset($findquery))
        {
           $findquery = $findquery.$row2['idro'].","; 
        }
        else
        {
            $findquery = $row2['idro'].",";
        }
        
    }
    if(isset($findquery))
    {
    $findquery = rtrim($findquery,',');
    
        
    $newquery = "SELECT * FROM ro WHERE id IN (".$findquery.")";
    $newresult = mysql_query($newquery);
    
    echo "<td><table>";
    while($row3 = mysql_fetch_array($newresult))    
    {
        echo '<tr><td class="rom">'.$row3['word'].'</td>';
        echo '<td><a href="scripts/cont_editw_set.php?action=4&id='.$row3['id'].'" ><img src="img/arrow.png" alt="pic"/></a></td>';
        echo '<td><a href="scripts/del_list_ro.php?engid='.$row['id'].'&romid='.$row3['id'].'"><img src="img/close.png" alt="pic"/></a></td>';
        echo '</tr>';
    }
    echo "</table></td>";
    
 
    unset($findquery);
    }
    
    
    echo '</tr></table>';
}




?>

                </center>            
                    
                </div>
                <div class="mainlow"></div>
                
            </div>
            

            
        </div>
            </body>
</html>

<?php

ob_flush();

mysql_close($conn);

?>