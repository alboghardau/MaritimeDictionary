<?php
$action= $_GET['action'];

ob_start();

include('settings.php');

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

if(!isset($_SESSION['filideng']))
{
$_SESSION['filideng']=0;
}

$a = 0;
$cats = array("");
if(isset($_SESSION['seng']))
{
    $query = "SELECT * FROM eng";
    $result = mysql_query($query);
    
    while($row = mysql_fetch_array($result))
    {
        if(stristr($row['word'],$_SESSION['seng']))
        {
            if(in_array($row['catid'], $cats))
            {                
            }
            else
            {
                $cats[$a]=$row['catid'];
                $a++;
            }
        }
    }   
}

sort($cats);


    

if(($a<1)&&(isset($_SESSION['seng'])))
{
    echo "No results found!";
}
else
{
   

 if(isset($_SESSION['seng']))
{

     echo '<table>';   
    
echo '<tr><td class="cate">All</td><td>';
if ($_SESSION['filideng']==0)
{
    echo '<img src="img/checked.png" alt="c" />';
}
else
{
    echo '<a href="scripts/setengfil.php?id=0" class="check"></a>';
    
}
    echo '</td></tr>';
    

for($i = 0;$i < sizeof($cats);$i++)
{
    $query = "SELECT * FROM categories WHERE id=".$cats[$i];

    $result = mysql_query($query);
    $row2 = mysql_fetch_array($result);
    echo '<tr>';
    echo '<td  class="cate">'.$row2['name'].'</td>';
    echo '<td>'; 
    
    if($row2['id']==$_SESSION['filideng'])
    {
        echo '<img src="img/checked.png" alt="c" />';
    }
    else
    {
        echo '<a href="scripts/setengfil.php?id='.$row2['id'].'" class="check"></a>';
    }
        
    echo '<td>';
    echo '</tr>';
    
    
}

echo '</table>';
}
}

mysql_close($conn);
ob_flush();

?>

 