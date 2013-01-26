<?php

session_start();
ob_start();

include("../../settings.php");


$action = $_POST['action'];


$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

//add new english word
if($action == 0)
{
$engword = $_POST['engw'];   
    
$engword = mysql_real_escape_string($engword);

$query = "INSERT INTO eng (word,catid,catnameeng) VALUES ('$engword',1,'Uncategorized')";
mysql_query($query);

//read the word added
$query = "SELECT * FROM eng ORDER BY id DESC LIMIT 1";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

//store word id in seesion
$_SESSION['container'] = 1;
$_SESSION['cont_eng_id'][0] = $row['id'];
$_SESSION['cont_eng_word'][0] = $row['word'];

//sters variablile rom
unset($_SESSION['cont_rom_id']);
unset($_SESSION['cont_rom_word']) ;
}

//action to add rom word and connections
if($action == 2)
{
$romword = $_POST['romw'];   
   
$romword = mysql_escape_string($romword);

$query = "INSERT INTO ro (word,catid,catnamero) VALUES ('$romword',1,'Fara Categorie')";
mysql_query($query);

$query = "SELECT * FROM ro ORDER BY id DESC LIMIT 1";
$result = mysql_query($query);
$row = mysql_fetch_array($result);


$romnr = sizeof($_SESSION['cont_rom_id']);
$_SESSION['cont_rom_id'][$romnr] = $row['id'];
$_SESSION['cont_rom_word'][$romnr] = $row['word'];



foreach ($_SESSION['cont_eng_id'] as $engid) {
    
    $query = "INSERT INTO connections (ideng,idro) VALUES ('$engid','$row[0]')";
    mysql_query($query);
}

}




echo mysql_error();
mysql_close($conn);

ob_flush();

header("Location: ../add.php");

?>
