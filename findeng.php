
<?php
include('settings.php');

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

if($action == 0)
{

if(isset($_SESSION['seng']))
{

    
    if(isset($_SESSION['filideng']))
    {
        $where = " WHERE catid=".$_SESSION['filideng'];
        
        if($_SESSION['filideng']==0)
        {
            $where = '';
        }
    }
    else{
         $where = '';
    }
    
    if(!isset($_SESSION['engpg']))
    {
    $_SESSION['engpg'] = 1;
    }
    
    $query3 = "SELECT * FROM eng".$where.' ORDER BY `word`';
    $result3 = mysql_query($query3);
    
    

    

    while($row = mysql_fetch_array($result3))
    {
        
        
        if(stristr($row['word'],$_SESSION['seng']))
        {

    echo '<table class="results"><tr>';

    echo '<td class="source">'.$row['word'].'</td>';
    
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
        
echo '</table>';

}



if($action == 2)
{
    $id = $_GET['id'];
    
    echo '<a class="back" href="eng.php?action=0"></a>';
    
    $query = "SELECT * FROM words WHERE id=".$id;
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    
    echo '<table class="results"><tr>';
    echo '<td class="alright">'.$row['eng'].'<img src="img/arrow.png" alt"img"/>'.$row['ro'].' </td>';
    echo '</tr><tr>';
    if(file_exists('images/'.$row['id'].'.jpg'))
                        {
                            echo '<td class="alleft"><center><img src="images/'.$row['id'].'.jpg" alt="pic" /></center></td>';
                        }
    
    echo '</tr></table>';
}


mysql_close();

?>

   