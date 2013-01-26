
<?php
include('settings.php');

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

if($action == 0)
{



if(isset($_SESSION['sro']))
{

    
    if(isset($_SESSION['filidro']))
    {
        $where = " WHERE category=".$_SESSION['filidro'];
        
        if($_SESSION['filidro']==0)
        {
            $where = '';
        }
    }
    else{
         $where = '';
    }
    

    
    $query3 = "SELECT * FROM ro".$where.' ORDER BY `word`';
    $result3 = mysql_query($query3);
    
   

    while($row = mysql_fetch_array($result3))
    {
        
        
        if(stristr($row['word'],$_SESSION['sro']))
        {

    echo '<center><table class="results"><tr>';

    echo '<td class="source">'.$row['word'].'</td>';
    
    $query2 = "SELECT ideng FROM connections WHERE idro=".$row['id'];
    $result2 = mysql_query($query2);
    
    while($row2 = mysql_fetch_array($result2))
    {
        if(isset($findquery))
        {
           $findquery = $findquery.$row2['ideng'].","; 
        }
        else
        {
            $findquery = $row2['ideng'].",";
        }
        
    }
    if(isset($findquery))
    {
    $findquery = rtrim($findquery,',');
    
        
    $newquery = "SELECT * FROM eng WHERE id IN (".$findquery.")";
    $newresult = mysql_query($newquery);
    
    echo '<td><img src="img/arrow.png" alt="pic"/></td><td><table >';
    while($row3 = mysql_fetch_array($newresult))    
    {
        echo '<tr><td class="translated">'.$row3['word'].'</td>';

        echo '</tr>';
    }
    echo "</table></td>";
    
 
    unset($findquery);
    }
    
    
    echo '</tr></table>';
}
        
        
        }    
    }
        
echo '</table></center>';

}

if($action == 2)
{
    $id = $_GET['id'];
    
    echo '<a class="back" href="ro.php?action=0"></a>';
    
    $query = "SELECT * FROM words WHERE id=".$id;
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    
    echo '<table class="results"><tr>';
    echo '<td class="alright">'.$row['ro'].'<img src="img/arrow.png" alt"img"/>'.$row['eng'].' </td>';
    echo '</tr><tr>';
    if(file_exists('images/'.$row['id'].'.jpg'))
                        {
                            echo '<td class="alleft"><center><img src="images/'.$row['id'].'.jpg" alt="pic" /></center></td>';
                        }
    
    echo '</tr></table>';
}


mysql_close();

?>

   