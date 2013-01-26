<?php
session_start();
ob_start();


define ("MAX_SIZE","100"); 

$id = $_POST['id'];

 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
 $errors=0;

 if(file_exists('../../images/'.$id.'.jpg'))
{
    unlink('../../images/'.$id.'.jpg');
}

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

$image_name=$id.'.'.$extension;

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



header('Location: ../allwords.php?action=3&id='.$id);
ob_flush();
?>
