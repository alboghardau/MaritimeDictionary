<?php
session_start();
ob_start();

include("../../settings.php");

$username = $_POST['username'];
$password = $_POST['password'];



$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

$query = "SELECT * FROM users WHERE username='".$username."'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

if($row['password'] == md5($password))
{
    $_SESSION['logged'] = "on";
    $_SESSION['usertype'] = "admin";
}
else
{
    $_SESSION['logged'] = "off";
    $_SESSION['logerror'] = "Invalid user name or password.";
}
mysql_close($conn);
ob_flush();

header("Location: ../main.php");
?>
