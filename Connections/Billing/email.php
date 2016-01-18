<?php
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers.= "Cc: kali.kiran@gmail.com"."\r\n";	
	$headers .= 'From: IBM <kali.kiran@gmail.com>' . "\r\n";	
    $to1= "kali.kiran@gmail.com";
    $message = "Hi";
	
     if(mail($to1,$message,$headers))
          {
           echo "Success";
           }
            else
            {
            echo "No Success";
            }			  
           
	
?>