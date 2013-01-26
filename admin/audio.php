<?php
set_time_limit(500);
ob_start();
session_start();

$file = fopen('audio.txt',"r");
$text = fgets($file);
fclose($file);

echo $text;
include('../settings.php');

require "tts.php";

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);

        $query = 'SELECT * FROM words';
        $result = mysql_query($query);
        

        while($row = mysql_fetch_array($result))
        {
           if($row['id']>=$text)
           {
            if(!file_exists('../audio/'.$row['id'].'.mp3'))
            {
                echo $text;
                $tts = new TextToSpeech($row['eng']);
                $tts->saveToFile("../audio/".$row['id'].".mp3");
                
                $file = fopen("audio.txt","w+");
                fwrite($file,$row['id']);
                fclose($file);
            }
          } 
                    
        }

//header("Location: index.php");
mysql_close($conn);
ob_flush();
?>
