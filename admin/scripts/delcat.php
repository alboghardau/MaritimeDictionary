<?php
session_start();
ob_start();
include('../../settings.php');

$id = $_POST['id'];
$delwords = $_POST['delwords'];


//prevention to del uncategorized
if($id == 1)
    {
    goto end;
}


$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

$query = 'DELETE FROM categories WHERE id='.$id;

mysql_query($query);

if($delwords == "yes")
{
    $qer = "DELETE FROM words WHERE category=".$id;
    mysql_query($qer);
}
if($delwords == "no")
{
    $catname = 'Uncategorized';
    $query2 = "UPDATE words SET catname='".$catname."' WHERE category=".$id;
    mysql_query($query2);
    $qer = "UPDATE words SET category=1 WHERE category=".$id;
    mysql_query($qer);

    echo mysql_error();
}



mysql_close($conn);


end:
    


header('Location: ../categories.php?action=1&id=0');
ob_flush();    
?>
