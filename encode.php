<?php

$iv = mcrypt_create_iv (mcrypt_get_block_size (MCRYPT_TripleDES, MCRYPT_MODE_CBC), MCRYPT_DEV_RANDOM);

function enc($int,$nr)
{
    $text = $int;
    global $iv;
    $text = mcrypt_cbc(MCRYPT_TRIPLEDES, "XiTo74dOO09N48YeUmuvbL0E", $text, MCRYPT_ENCRYPT,$iv);
    
    
    $text = base64_encode($text);
    $text = strrev($text);
    
    
    
    $cifsalt = rand(10, 99);
    
    $tsalt = substr($text, 0, 3).$nr;
    $tsalt = crypt($tsalt);
  
    $tsalt = substr($tsalt, 0, 6);
    
    $nr = base64_encode(base64_encode($nr));
    $nr = strrev($nr);
     
    
    $text = $tsalt.$cifsalt.$text.$nr;

    
    
    
    return $text;
}

function dec($int,$nr)
{
    $text = $int;
    

    
    $text = substr($text, 8);
    
    $nr = base64_encode(base64_encode($nr));
    $nr = strrev($nr);
    
    $text = str_replace($nr, "", $text);
    $text = strrev($text); 
    
    
    $text = base64_decode($text);  
        
    global $iv;
    $text = mcrypt_cbc(MCRYPT_TRIPLEDES, "XiTo74dOO09N48YeUmuvbL0E", $text, MCRYPT_DECRYPT,$iv);
        
    return $text;
}

$enc = enc("PHP encryption is a method of obfuscating scripts in such a way that it offers additional protection and prevents unauthorized editing of thes","2");
echo $enc."<br/>";
echo dec($enc,"2");

?>
