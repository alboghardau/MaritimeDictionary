<?php
session_start();
ob_start();
include("../../settings.php");

$catname = $_POST['catname'];

    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $query = "SELECT * FROM categories";
    
    $result = mysql_query($query);
    
    $test = 0;
    
    while($row = mysql_fetch_array($result))
    {        
        if($catname == $row['name'])
        {
            $test = 1;
        }
      
    }
    
    if($test == 0)
    {
        $quer = "INSERT INTO categories (name) VALUES ('".$catname."')";
        mysql_query($quer);
    }
    
    mysql_close($conn);


header("Location: ../categories.php?action=1&id=0");
ob_flush();
?>
