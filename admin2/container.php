<?php
include('../settings.php');

if(isset($_SESSION['container']))
{

//container for english new word
if($_SESSION['container']=='1')
{
    
//var_dump($_SESSION['cont_eng_word']);
//var_dump($_SESSION['cont_eng_id']);
//var_dump($_SESSION['cont_rom_id']);
//var_dump($_SESSION['cont_rom_word']);    

echo '<div class="maintop">Last added word
<div style="position: relative; right: 15px; float:right;"><a href="scripts/cont_close_addw.php"><img src="img/close.png" alt="pic"/></a>  </div></div>

<div class="mainmain">';


$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

//display edit english word if needed
if(isset($_SESSION['editeng'])&&($_SESSION['editeng']==1))
{
       
    $query = "SELECT * FROM eng ORDER BY id DESC LIMIT 1";
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
                        <input type="hidden" name="action" value="1"/>
                        <td><input style="width:220px"  type="text" name="engw" value="'.$word.'"/></td>
                        <td><input type="submit" value="Edit"/></td>
                        </tr>
                        </table>
                        </form></center>';
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
                        <input type="hidden" name="action" value="2"/>
                        <td><input style="width:220px"  type="text" name="engw" value="'.$word.'"/></td>
                        <td><input type="submit" value="Edit"/></td>
                        </tr>
                        </table>
                        </form></center>';
}


$query = "SELECT * FROM eng ORDER BY id DESC LIMIT 1";
$result = mysql_query($query);

echo '<center><table><tr><td ><img src="img/uk.png" alt="pic"/></td><td><img src="img/rom.png" alt="pic"/></td></tr></table>';

while($row = mysql_fetch_array($result))
{
    echo '<table><tr>';
    echo '<td><a href="scripts/cont_editw_set.php?action=1&id='.$row['id'].'" ><img src="img/arrow.png" alt="pic"/></a></td>';

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
        echo '<td><a href="scripts/cont_editw_set.php?action=2&id='.$row3['id'].'" ><img src="img/arrow.png" alt="pic"/></a></td>';
        echo '<td><a href="scripts/del_add_ro.php?engid='.$row['id'].'&romid='.$row3['id'].'"><img src="img/close.png" alt="pic"/></a></td>';
        echo '</tr>';
    }
    echo "</table></td>";
    
 
    unset($findquery);
    }
    
    
    echo '</tr></table>';
    
    //display category selector

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
                
        echo '<tr><td class="'.$display.'"><a href="scripts/cont_change_cat.php?catid='.$row4['id'].'&wordid='.$row['id'].'"><div>'.$row4['name'].'</div></a></td></tr>';
        
    }
   echo "</table>";
}




mysql_close($conn);





echo '                    <form action="scripts/addw.php" method="post">
                        <table>
                            <tr>
                        <td><img src="img/rom.png" alt="pic"/></td>
                        <input type="hidden" name="action" value="2"/>
                        <td><input style="width:220px"  type="text" name="romw"/></td>
                        <td><input type="submit" value="Add"/></td>
                            </tr>
                        </table>
                        
                    </form></center>';

echo '</div><div class="mainlow"></div>';
echo '<div class="mainspace"></div>';
}


}


?>
