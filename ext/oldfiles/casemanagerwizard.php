<?php require_once('../Connections/session.php'); ?>

<html>	
<head>


 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
<title>Validate i-94 Form Details</title>
</head>
<body>
<?php 

     if(isset($_POST['upload']))
	    {
		  echo $file_name = ( $_FILES['documenta']['name']);
	      $file_name1 = explode('.',$file_name);
	      $file_name2 = "File Name:".$file_name;
	      $type = $_FILES['documenta']['type'];
	      $type1= "File Type:".$type;
	      $size=  $_FILES['documenta']['size'];
	      $size1="File size:".$size;
	      $target = "../../ext"; 
	      
                         //if(!is_dir($folder)) mkdir($folder);
                          //$target =$folder."/";
                          $tempname= basename( $_FILES['documenta']['name']); 
						  $target = $target.$tempname; 
					     (move_uploaded_file($_FILES['documenta']['tmp_name'], $target)); 
						  echo $msg = "File uploaded successfully";		  
		 
		 }

?>



<form enctype="multipart/form-data" action="casemanagerwizard.php" method="post">
<div align="left">

 
  <fieldset>
    <legend>I94 Details</legend>
    <table cellspacing="10">
	     <tr>
            <td>
			<?php
			$con = mysql_connect('localhost', 'root', '');
     if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
      Mysql_select_db("ushere", $con);
     
	        $now = date('Y/m/d', time());
			$futuredate=date('Y-m-d', strtotime($now . " + 180 days"));
			   
		    $P = "select firstname, lastname, empid, i94expirydate from master_herelist where i94expirydate > '$futuredate'";
			$result=  mysql_query($P) or die(mysql_error());
			$num=mysql_numrows($result);
			$q=array();
			 while($row = mysql_fetch_array($result) )
			   {	
			     $fname= $row['firstname'];
				 $lname= $row['lastname'];
                 $i94expdate=$row['i94expirydate'];	
      		     $empids=$row['empid'];
				 $w="INSERT IGNORE INTO reminders(firstname, lastname, empid, i94expirydate) VALUES ('".$fname."','".$lname."','".$empids."', '".$i94expdate."')";
	              mysql_query($w) or die(mysql_error());
	  }
			
			?>
			
			
			</td>
          </tr>
           
                  
		    <tr>
			 <td>
			 <?php	
		
		  $con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
				die('Could not connect: ' . mysql_error());
               }
			   
 Mysql_select_db("ushere", $con);
 
 $future = mktime(0,0,0,date("m"),date("d")+179,date("Y"));
 $final=date("Y-m-d", $future);
 //echo $final;

             
		$B= "select firstname, lastname, empid, i94expirydate from reminders where reminder1= '0' && i94expirydate='$final' LIMIT 5";
        $result = mysql_query($B) or die(mysql_error());
          $num=mysql_numrows($result);
		  
		  
		  if(isset($_POST['reminder1']) || $num==0)
			   {
			    echo "<table border='1' width='10' height='10' cellpadding='3'>";
                echo"<th colspan='4'>Reminders-1 </th>";
		        echo "<tr>";
	            echo "<td> <b>FIRST NAME </b></td>";
		        echo "<td> <b>LAST NAME</b> </td>";
		        echo "<td><b> EMPID </b> </th>";
		        echo "<td> <b> I94 Expiry Date </b></td>";
				echo "</tr>";
				echo "</table>";
                    echo"<span> There are no Reminder 1s left to be sent  </span>"; echo "</br>";
                           					
				 }
				 else
				  {
		  
		     
         echo "<table border='1' width='10' height='10' cellpadding='3'>";
		 echo"<th colspan='4'>Reminders-1 </th>";
		    echo "<tr>";
	    echo "<td> <b>FIRST NAME </b></td>";
		echo "<td> <b>LAST NAME</b> </td>";
		  echo "<td><b> EMPID </b> </th>";
		  echo "<td> <b> I94 Expiry Date </b></td>";
		      
		    while($row = mysql_fetch_array($result) )
	        {	
	            
	 echo"<tr>";
	   echo"<td>";
	   echo $row['firstname'];
       echo "</td>";
	   
	   echo"<td>";
	   echo $row['lastname'];	
       echo"</td>";
 
       echo"<td>"; 
	   echo $row['empid'];	
        echo "</td>";
  
       echo"<td>";  
	   echo $row['i94expirydate'];	  
	    echo"</td>";
	           echo"</tr>";
    	}
		 echo "</table>";
	}
	
	
		?>
		   <input type= "submit" value="Send Reminder1" name="reminder1">
		   <?php

  if(isset($_POST['reminder1']))
		     {
			 
$con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
				die('Could not connect: ' . mysql_error());
               }
			   
            Mysql_select_db("ushere", $con);
            $future = mktime(0,0,0,date("m"),date("d")+179,date("Y"));
            $final=date("Y-m-d", $future);
 
			 $B= "select email, empid from reminders where reminder1='0' && i94expirydate='$final'";
                     $result1 = mysql_query($B) or die(mysql_error());
			while($row1 = mysql_fetch_array($result1) )
	        {	
			 
	               $empid=$row1['empid'];
			       $email=$row1['email'];
              
	              
        
$to = 'kali.kiran@gmail.com';
$subject  = 'Test Reminder-1';
$message  = '"http://localhost/iis/ext/iform.php "This is to to inform you that your I94 Petition expiry Date will be Expired in 6months from now. Please click on the following link if you would like to get an extension';
$headers  = 'From: kali.kiran@gmail.com' . "\r\n" .
            'CC: kalirayback@yahoo.com' . "\r\n" .
            'Reply-To: kali.kiran@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
if(mail($to, $subject, $message, $headers))
  {
      
       
$con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			   
 Mysql_select_db("ushere", $con);
 $A="update reminders SET reminder1='1' where empid= '$empid' ";
 $result = mysql_query($A) or die(mysql_error()); 
 //echo "mail sent";
   $reminder= 1;
 $B="insert into emaillog(empid, emailto,reminderno)  values('$empid','$to','$reminder')";
        mysql_query($B) or die(mysql_error()); 
		//echo "emailog inserted";
		}
	  
else
    echo "Email sending failed";
            }
			  
			 } 
			  
	?>
            </td>
			 <td>
			<?php	
		
		  $con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			   
 Mysql_select_db("ushere", $con);
 
          //$now = date('Y/m/d', time());
	      //$futuredate=date('Y-m-d', strtotime($now . " + 165 days"));
		  
		    $future = mktime(0,0,0,date("m"),date("d")+165,date("Y"));
            $final=date("Y-m-d", $future);
 
			
		$B= "select firstname, lastname, empid, i94expirydate from reminders where responsereceived='0' && reminder2='0' && reminder1='1' && i94expirydate='$final' LIMIT 5";
        $result = mysql_query($B) or die(mysql_error());
         $num=mysql_numrows($result);
		 if($num== 0)
			   {
			    echo "<table border='1' width='10' height='10' cellpadding='3'>";
                echo"<th colspan='4'>Reminders-2 </th>";
		        echo "<tr>";
	            echo "<td> <b>FIRST NAME </b></td>";
		        echo "<td> <b>LAST NAME</b> </td>";
		        echo "<td><b> EMPID </b> </th>";
		        echo "<td> <b> I94 Expiry Date </b></td>";
				echo "</tr>";
				echo "</table>";
                    echo"<span> There are no Reminder 2s left to be sent  </span>"; echo "</br>";
                           					
				 }
			
		 		
	else{
       echo "<table border='1' width='10' height='10' cellpadding='3'>";
		 echo"<th colspan='4'>Reminders-2 </th>";
		    echo "<tr>";
	  echo "<td> <b>FIRST NAME </b></td>";
	  echo "<td> <b>LAST NAME</b> </td>";
	  echo "<td><b> EMPID </b> </th>";
	  echo "<td> <b> I94 Expiry Date</b></td>";
		  
		    while($row = mysql_fetch_array($result) )
	  {	
	   
	 echo"<tr>";
	   echo"<td>";
	   echo $row['firstname'];
       echo "</td>";
	   
	   echo"<td>";
	   echo $row['lastname'];	
       echo"</td>";
 
       echo"<td>"; 
	   echo $row['empid'];	
        echo "</td>";
  
       echo"<td>";  
	   echo $row['i94expirydate'];	  
	    echo"</td>";
	           echo"</tr>";
    	}
		 echo "</table>";	
}		 
		?>
		 	<input type= "submit" value="Send Reminder2" name="sendrem2">	  
			
			<?php
			 if(isset($_POST['sendrem2']))
			   {
			   $con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
				die('Could not connect: ' . mysql_error());
               }
			   
            Mysql_select_db("ushere", $con);
 
			 $B= "select email, empid from reminders where responsereceived='0' && reminder2='0'";
                     $result1 = mysql_query($B) or die(mysql_error());
			while($row1 = mysql_fetch_array($result1) )
	        {	
			 
	               $empid=$row1['empid'];
			       $email=$row1['email'];
              
	              
        
$to = 'kali.kiran@gmail.com';
$subject  = 'Test - Reminder 2';
$message  = '"http://localhost/iis/iform.php" "This is to to inform you that your I94 Petition expiry Date will Expired in less than 6months from now. Please click on the following link if you would like to get an extension"';
$headers  = 'From: kali.kiran@gmail.com' . "\r\n" .
            'CC: kalirayback@yahoo.com' . "\r\n" .
            'Reply-To: kali.kiran@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
if(mail($to, $subject, $message, $headers))
  {
      
       
$con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			   
 Mysql_select_db("ushere", $con);
 $A="update reminders SET reminder2='1' where empid= '$empid' ";
 $result = mysql_query($A) or die(mysql_error()); 
 //echo "mail sent";
   $reminder= 2;
 $B="insert into emaillog(empid, emailto,reminderno)  values('$empid','$to','$reminder')";
        mysql_query($B) or die(mysql_error()); 
		//echo "emailog inserted";
		}
	  
else
    echo "Email sending failed";
            }
			  
			 } 
			  
	?> 
		
			 </td>
			 <td>
			 <?php	
		
		  $con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			   
 Mysql_select_db("ushere", $con);
 
		$B= "select firstname, lastname, empid, i94expirydate from reminders where responsereceived='0' && reminder1='1' && reminder2='1' && reminder3='0'  LIMIT 10";
        $result = mysql_query($B) or die(mysql_error());
            $num=mysql_numrows($result);
		 
		 if($num== 0)
			   {
			    echo "<table border='1' width='10' height='10' cellpadding='3'>";
                echo"<th colspan='4'>Reminders-2 </th>";
		        echo "<tr>";
	            echo "<td> <b>FIRST NAME </b></td>";
		        echo "<td> <b>LAST NAME</b> </td>";
		        echo "<td><b> EMPID </b> </th>";
		        echo "<td> <b> I94 Expiry Date </b></td>";
				echo "</tr>";
				echo "</table>";
                    echo"<span> There are no Reminder 3s left to be sent  </span>"; echo "</br>";
                           					
				 }
				else
				{
	
       echo "<table border='1' width='10' height='10' cellpadding='3'>";
		 echo"<th colspan='4'>Reminders-3 </th>";
		    echo "<tr>";
	  echo "<td> <b>FIRST NAME </b></td>";
		echo "<td> <b>LAST NAME</b> </td>";
		  echo "<td><b> EMPID </b> </th>";
		  echo "<td> <b> I94 Expiry Date </b></td>";
		  
		    while($row = mysql_fetch_array($result) )
	  {	
	   
	 echo"<tr>";
	   echo"<td>";
	   echo $row['firstname'];
       echo "</td>";
	   
	   echo"<td>";
	   echo $row['lastname'];	
       echo"</td>";
 
       echo"<td>"; 
	   echo $row['empid'];	
        echo "</td>";
  
       echo"<td>";  
	   echo $row['i94expirydate'];	  
	    echo"</td>";
	           echo"</tr>";
    	}
		 echo "</table>";
		}
		?>
			<input type= "submit" value="Send Reminder3" name="sendrem3">

			
			<?php
			 if(isset($_POST['sendrem3']))
			   {
			   $con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
				die('Could not connect: ' . mysql_error());
               }
			   
            Mysql_select_db("ushere", $con);
 
			       $B= "select email, empid from reminders where responsereceived='0' && reminder1='1' && reminder2='1' && reminder3='0'";
                     $result1 = mysql_query($B) or die(mysql_error());
			while($row1 = mysql_fetch_array($result1) )
	        {	
			 
	               $empid=$row1['empid'];
			       $email=$row1['email'];
              
	              
        
$to = 'kali.kiran@gmail.com';
$subject  = 'Test - Reminder 3';
$message  = '"http://localhost/iis/iform.php?empid='.$empid.' "This is to to inform you that your I94 Petition expiry Date will Expired in less than 6months from now. Please click on the following link if you would like to get an extension';
$headers  = 'From: kali.kiran@gmail.com' . "\r\n" .
            'CC: kalirayback@yahoo.com' . "\r\n" .
            'Reply-To: kali.kiran@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
if(mail($to, $subject, $message, $headers))
  {
      
       
$con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			   
 Mysql_select_db("ushere", $con);
 $A="update reminders SET reminder3='1' where empid= '$empid' ";
 $result = mysql_query($A) or die(mysql_error()); 
 //echo "mail sent";
   $reminder= 3;
 $B="insert into emaillog(empid, emailto,reminderno)  values('$empid','$to','$reminder')";
        mysql_query($B) or die(mysql_error()); 
		//echo "emailog inserted";
		}
	  
else
    echo "Email sending failed";
            }
			  
			 } 
			  
	?> 
		
						
			 </td>
			 <td>
			 <?php	
		
		  $con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			   
 Mysql_select_db("ushere", $con);
 
		$B= "select firstname, lastname, empid, i94expirydate from reminders  LIMIT 10 ";
        $result = mysql_query($B) or die(mysql_error());
          $num=mysql_numrows($result);
		 
		 		
	
       echo "<table border='1' width='10' height='10' cellpadding='3'>";
		 echo"<th colspan='6'>Approve/Reject Ticket Status</th>";
		
		    echo "<tr>";
	    echo "<td> <b>FIRST NAME </b></td>";
		echo "<td> <b>LAST NAME</b> </td>";
		echo "<td><b> EMPID </b> </th>";
		echo "<td> <b> I94 Expiry Date </b></td>";
		echo"<td><b>FINAL STATUS<b></td>";
		echo"</tr>";
		    while($row = mysql_fetch_array($result) )
	  {	
	   
	 echo"<tr>";
	   echo"<td>";
	   echo $row['firstname'];
       echo "</td>";
	   
	   echo"<td>";
	   echo $row['lastname'];	
       echo"</td>";
 
       echo"<td>"; 
	   echo $row['empid'];	
        echo "</td>";
  
       echo"<td>";  
	   echo $row['i94expirydate'];	  
	    echo"</td>";
	           echo"</tr>";
    	}
		
		
		
		
		
		
		 echo "</table>";
		 		
		?>
			 
			 <input type= "submit" value="Approved Tickets" name="approved">
			 </td>
			 
			 </tr>
			</table>
		
        </fieldset>
		  
	</form>
		 
		 <form enctype="multipart/form-data" action="1111.php" method="post">
<div align="left">
<tr>	
            <td>&nbsp;</td>
          </tr>
         <tr>
            <td>&nbsp;</td>
          </tr>
         
 
  <fieldset>
    <legend>CASE MANAGER WIZARD</legend>
    <table cellspacing="10">
	   <tr>
	     <?php	
		
		  $con = mysql_connect('localhost', 'root', '');
                   if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			   
 Mysql_select_db("ushere", $con);
 
		$B= "select firstname, lastname, empid, i94expirydate, email, responsereceived, filelocation1, filelocation2 from reminders LIMIT 10";
        $result = mysql_query($B) or die(mysql_error());
        $num=mysql_numrows($result);
		 
		 
		 		
	
       echo "<table border='1' width='100' height='10' cellpadding='5' cellspacing='5'>";
		 echo"<th colspan='12'>Approve/Reject Ticket Status</th>";
		 echo "<tr>";
	    echo "<td> <b>FIRST NAME </b></td>";
		echo "<td> <b>LAST NAME</b> </td>";
		  echo "<td><b> EMPID </b> </td>";
		  echo"<td><b>I94 Expiry Date<b></td>";
		  echo "<td><b>Email Sent To</b></td>";	
          echo "<td> <b>Response Received from Employee</b></td>";		  
		  echo "<td> <b>Filelocation for Copy of I94 Doc<h> </td>";
		  echo "<td> <b>Filelocation for copy of Passport Doc<h> </td>";
		  echo"<td><b>Approve/Reject</b></td>";
		   
		  
		    while($row = mysql_fetch_array($result) )
	  {	
	   
	 echo"<tr>";
	   echo"<td>";
	   echo $row['firstname'];
       echo "</td>";
	   
	   echo"<td>";
	   echo $row['lastname'];	
       echo"</td>";
 
       echo"<td>"; 
	   echo $row['empid'];	
        echo "</td>";
   
       echo"<td>";  
	   echo $row['i94expirydate'];	  
	    echo"</td>";
	   
            echo"<td>"; 
	   echo $row['email'];	
        echo "</td>";
        
		 echo"<td>"; 
	   echo $row['responsereceived'];	
        echo "</td>";
		
		echo"<td>"; 
	   echo $row['filelocation1'];	
        echo "</td>";
		
		echo"<td>"; 
	   echo $row['filelocation2'];	
        echo "</td>";
       echo"</tr>";
    	}
		 echo "</table>";		
		?>
	     </tr>
   </table>
   </fieldset>
</body>
</html>