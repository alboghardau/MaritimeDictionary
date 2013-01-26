<?php
session_start();
ob_start();
include("../../settings.php");

 
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);

$eng = $_POST['eng'];
$ro = $_POST['ro'];
$catid = $_POST['category'];
if($eng == "")
{
    $_SESSION['newword']="Error: No word inserted!";
    unset ($_SESSION['newwordid']);
    goto quit;
}
if($ro == "")
{
    $_SESSION['newword']="Error: No word inserted!";
    unset ($_SESSION['newwordid']);
    goto quit;
}

 define ("MAX_SIZE","100"); 


 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 
 //test if words exist   
 $query1 = "SELECT * FROM words"; 
 $result1 = mysql_query($query1);
 while($row1 = mysql_fetch_array($result1))
 {
     if(($eng == $row1['eng'])&&($ro == $row1['ro']))
         {
         $_SESSION['newword'] = 'Error: Word Inserted Already';
         goto quit;           
     }
 }
 
 //find category name
 $query4 = "SELECT * FROM categories WHERE id=".$catid;
 $result4 = mysql_query($query4);
 $row4 = mysql_fetch_array($result4);
 
 
 //insert new word
 $query2 = "INSERT INTO words (eng,ro,category,catname) VALUES ('".$eng."','".$ro."',".$catid.",'".$row4['name']."')";
 echo $query2;
 mysql_query($query2);
 
 $_SESSION['newword']='Last inserted word:'.$eng." - ".$ro;
 
 
 $query3 = "SELECT * FROM words WHERE eng='".$eng."' AND ro='".$ro."'";
 
 $result3 = mysql_query($query3);
 $row3 = mysql_fetch_array($result3);
 
 $rowid = $row3['id'];
 
 $_SESSION['newwordid'] = $rowid;
 

 $errors=0;



 	$image=$_FILES['image']['name'];

 	if ($image) 
 	{

 		$filename = stripslashes($_FILES['image']['name']);

  		$extension = getExtension($filename);
 		$extension = strtolower($extension);

 if (($extension != "jpg") && ($extension != "jpeg")) 
 		{
	
 			$_SESSION['log']='Unknown extension!';
 			$errors=1;
 		}
 		else
 		{

 $size=filesize($_FILES['image']['tmp_name']);
 $extension = "jpg";


if ($size > MAX_SIZE*1024)
{
	echo '<h1>You have exceeded the size limit!</h1>';
	$errors=1;
}

$image_name=$rowid.'.'.$extension;

$newname="../../images/".$image_name;
echo $image_name;

$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied) 
{
	$_SESSION['log']='Copy unsuccessfull!';
	$errors=1;
}}}


 if(isset($_POST['Submit']) && !$errors) 
 {
 	$_SESSION['log']="File Uploaded Successfully!";
 }

quit:
    
mysql_close($conn);

header('Location: ../addw.php');
ob_flush();
?>
