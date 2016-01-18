<?php require_once('../Connections/session.php'); ?>
<?php require_once('../Connections/itest.php'); ?>
<?php require_once('../Connections/iisqc.php'); ?>


<?php
class ldap_object{

	private $url 			= "ldap://bluepages.ibm.com/";
	private $dn 			= "ou=bluepages,o=ibm.com";
	private $connect		= "";
	private $connect_status	= false;

	function LDAP_connect()
	{
		$this->connent = ldap_connect($this->url);
		if (ldap_set_option($this->connent, LDAP_OPT_PROTOCOL_VERSION, 3)) {
   			//echo "Using LDAPv3";
		} else {
    		echo "Failed to set protocol version to 3";
		}

		if($this->connent)	$this->connect_status = true;
	}
	function LDAP_close()
	{
		ldap_close($this->connent);
		$this->connect_status = false;
	}	

	function authenricate($id){
		if($this->connect_status) {
			$userDM  = $this->getUserInfo($id);
			return $userDM;
		}
	}
	
	function getManInfo($empid)
	{
		if($this->connect_status) {
			$filter 	= "(&(uid=".$empid."))";
			$targets	= array("co", "uid", "cn", "preferredidentity");
			$sr 		= @ldap_search($this->connent, $this->dn, $filter, $targets);
			$info 		= @ldap_get_entries($this->connent, $sr);
			if ($info["count"]<1){
				return "Manager Info not found!! ";
			}
			$userInfo = array();
			for ($i=0; $i<$info["count"]; $i++) {
				$userInfo["co"] = $info[$i]["co"][0];
				$userInfo["cn"] = $info[$i]["cn"][0];
				$userInfo["uid"] = $info[$i]["uid"][0];
				$userInfo["preferredidentity"] = $info[$i]["preferredidentity"][0];
			}
			return $userInfo;
		}
	}

	function getUser($eid)
	{
		if($this->connect_status) {
			$filter 	= "(&(uid=".$eid."))";
			$targets	= array("preferredidentity","managerserialnumber","managercountrycode","hrfirstname");
			$sr 		= @ldap_search($this->connent, $this->dn, $filter, $targets);
			$info 		= @ldap_get_entries($this->connent, $sr);
			$userInfoGrp = array();
			for ($i=0; $i<$info["count"]; $i++) {
				$userInfoGrp["preferredidentity"] = $info[$i]["preferredidentity"][0];
				$userInfoGrp["hrfirstname"] = $info[$i]["hrfirstname"][0];
				$userInfoGrp["managerserialnumber"] = $info[$i]["managerserialnumber"][0];
				$userInfoGrp["managercountrycode"] = $info[$i]["managercountrycode"][0];
			}
			return $userInfoGrp;
		}
	}
};
 ?>
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="schema.DC" href="http://purl.org/DC/elements/1.0/"/>
<link rel="SHORTCUT ICON" href="../images/iis.ico"/>
<meta name="Keywords" content="kms, IBM HR, Global Immigration, Knowledge Management, Knowledge"/>
<meta name="Description" content="IBM CHQ - Global Immigration - HR : Knowledge Management Suite."/>
<meta name="Abstract" content="IBM CHQ - Global Immigration - HR : Knowledge Management Suite."/>
<meta name="IBM.Effective" scheme="W3CDTF" content="2012-05-15"/>
<meta name="IBM.Industry" scheme="IBM_IndustryTaxonomy" content="ZZ" />
<meta name="IBM.Country" content="US"/>
<meta name="DC.Rights" content="© Copyright IBM Corp. 2011"/>
<meta name="DC.Date" scheme="iso8601" content="2012-05-10"/>
<meta name="DC.Subject" scheme="IBM_SubjectTaxonomy" content=""/>
<meta name="DC.Language" scheme="rfc1766" content="en-US"/>
<meta name="DC.Type" scheme="IBM_ContentClassTaxonomy" content="ZZ999"/>
<meta name="DC.publisher" content="IBM Corporation" />
<meta name="Security" content="Public"/>
<meta name="Robots" content="index,follow"/>
<meta name="Source" content="v17 Template Generator, Template 17.02"/>
<meta name="Owner" content="Piyush Jain1/India/IBM"/>
<meta name="Feedback" content="jainpiyush@in.ibm.com" />

<meta name="Language" content="en" />
<meta name="Author" content="Piyush Jain" />
<meta name="Copyright" content="© Copyright IBM Corp. 2011 - Global Immigration" />
<meta name="Reply-to" content="jainpiyush@in.ibm.com" />
<meta name="document-class" content="Completed" />
<meta name="document-classification" content="Software" />
<meta name="document-rights" content="Copyrighted Work" />
<meta name="document-type" content="Web Page" />
<meta name="document-rating" content="General" />
<meta name="document-distribution" content="IU" />
<meta name="document-state" content="Dynamic" />
<meta name="cache-control" content="Public" />
<meta name="Publisher" content="Piyush Jain" />
<meta name="Publisher-Email" content="jainpiyush@in.ibm.com" />
<meta name="Placename" content="India" />
<meta name="Contributors" content="Piyush Jain" />

<title>IIS</title>

<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th height="35" align="left" valign="middle" style="font-size:20px"><strong>Reminders-III : <?php if ((isset($_GET['count'])) && ($_GET['count']!="")) { if ($_GET['count']==1) echo "This Week"; else if ($_GET['count']==2) echo "Next Week"; else if ($_GET['count']==3) echo "This Month"; else if ($_GET['count']==4) echo "Reminders Missed"; } ?></strong></th>
      </tr>
      <tr>
        <td><hr style="border-bottom: #333 1px solid"/></td>
      </tr>
     
       
          <tr>
            <td><div align="left">
			 <fieldset>
			 <legend>DASH BOARD</legend>
			<table border="1" cellpadding="0" class='basictable' style="border-collapse:collapse" align="left" bordercolorlight="#CCCCCC">
							 <tr><td><a href="reminder3.php?count=1">This Week</a></td>
								 <td><a href="reminder3.php?count=2">Next Week</a></td>
								 <td><a href="reminder3.php?count=3"> This Month</a></td>
								 <td><a href="reminder3.php?count=4">Reminders Missed</a></td>
							 </tr>
			</table>
<?php
	if (isset($_GET['count']) && ($_GET['count']!=""))
{
if ($_GET['count']==1)
   {  
	mysql_select_db($database_itest, $itest);
$B= "select * from master_herelist where (i94expirydate BETWEEN (DATE_ADD(NOW(), INTERVAL 143 DAY)) AND (DATE_ADD(rem1senton, INTERVAL 150 DAY)) || petexpdt BETWEEN (DATE_ADD(NOW(), INTERVAL 143 DAY)) AND (DATE_ADD(rem1senton, INTERVAL 150 DAY))) AND (reminder1=1) AND (reminder2=1) AND (reminder3=0) AND  (responsereceived=0) AND (visatype='H1')";
$result1 = mysql_query($B) or die(mysql_error());
$num=mysql_numrows($result1);

		  if($num==0 || isset($_POST['reminder3']))
			   {
			    echo"<br>";echo"<br>";echo"<br>";
				
				echo "<strong>Notice</strong>:There are no Reminder IIIs to be sent This Week";
				         					
				 }
				 else
				  {
		       
				 echo"<br>";echo"<br>";			  
				 echo "<table border='1' cellpadding='0' class='basictable' style='border-collapse:collapse' align='left' bordercolorlight='#CCCCCC'>";
				 echo"<th align='center' colspan='8'>Reminders-III This Week </th>";
				 echo "<tr>";
				 echo "<th> <b>First Name </b></th>";
				 echo "<th> <b>Last Name</b> </th>";
				 echo "<th><b> Empid </b> </th>";
				 echo "<th align='center'><b> Rem1 SentOn </b> </th>";
				 echo "<th align='center'><b> Rem2 SentOn </b> </th>";
				 echo "<th align='center'> <b> I94 Expiry Date </b></th>";
				 echo "<th align='center'> <b> Petition Expiry Date </b></th>";
				 echo "<th align='center'> <b> Host Manager ID</b></th>";
				 echo"</tr>";
		    while($row = mysql_fetch_array($result1) )
	        {	
	            
				   echo"<tr>";
				   echo"<td>";
				   echo $row['firstname'];
				   echo "</td>";				   
				   echo"<td>";
				   echo $row['lastname'];	
				   echo"</td>";			 
				   echo"<td>"; 
				   echo $empids= $row['empid'];	
				   echo "</td>";					
				   echo"<td align='center'>";
				   echo $row['rem1senton'];	
				   echo"</td>";		
                   echo"<td align='center'>";
				   echo $row['rem2senton'];	
				   echo"</td>";					
				   				   
				   echo"<td>";  
				   echo $row['i94expirydate'];	  
				   echo"</td>";
				   echo"<td>";  
				   echo $row['petexpdt'];	  
				   echo"</td>";
				   echo"<td>";  
				   echo "<input type='/text/' id='/cc/' name='/cc/' size='/50/'>";	  
				   echo"</td>";
				   
				   
				   echo"</tr>";
						}
				  
				   echo"<tr><td>";
				 
				   echo "<form enctype=\"multipart/form-data\" action=\"reminder3.php\" method=\"POST\">";	   
				   echo "<input type=\"submit\" value=\"Send Reminders\" name=\"rem3\">";
				   echo "<input type=\"hidden\" value=\"y\" name=\"sr\" id=\"sr\">";
				   echo "</form>";
				   echo"</td></tr>";
				   echo"</table>";
					
	}
		
		

	 }
	if ($_GET['count']==2)
        {
         mysql_select_db($database_itest, $itest);
        $B= "select * from master_herelist where (i94expirydate BETWEEN (DATE_ADD(NOW(), INTERVAL 150 DAY)) AND (DATE_ADD(NOW(), INTERVAL 157 DAY)) || petexpdt BETWEEN (DATE_ADD(NOW(), INTERVAL 150 DAY)) AND (DATE_ADD(NOW(), INTERVAL 157 DAY))) AND (reminder1=1) AND (reminder2=1) AND (reminder3=0) AND (responsereceived=0) AND (visatype='H1')";
        $result1 = mysql_query($B) or die(mysql_error());
        $num=mysql_numrows($result1);
	     		 
		  if($num==0 || isset($_POST['reminder3']))
			   {
			    echo"<br>";echo"<br>";echo"<br>";
				
				echo "<strong>Notice</strong>:There are no Reminder IIIs to be sent for Next Week";
				
                           					
				 }
				 else
				  {		       
                echo"<br>";echo"<br>";			  
				echo "<table border='1' cellpadding='0' class='bascitable' style='border-collapse:collapse' align='left' bordercolorlight='#CCCCCC'>";
			    echo"<th align='center' colspan='5'>Reminders-III Next Week </th>";
			    echo "<tr>";
			    echo "<td> <b>First Name </b></td>";
			    echo "<td> <b>Last Name</b> </td>";
			    echo "<td align='center'><b> Empid </b> </th>";
			    echo "<td align='center'><b> Rem1 SentOn </b> </th>";
				echo "<td align='center'><b> Rem2 SentOn </b> </th>";
			    echo "<td align='center'> <b> I94 Expiry Date </b></td>";
				 echo "<td align='center'> <b>Petition Expiry Date </b></td>";
		    while($row = mysql_fetch_array($result1) )
	        {	
	            
		           echo"<tr>";
				   echo"<td>";
				   echo $row['firstname'];
				   echo "</td>";				   
				   echo"<td>";
				   echo $row['lastname'];	
				   echo"</td>";			 
				   echo"<td>"; 
				   echo $empids= $row['empid'];	
				   echo "</td>";					
				   echo"<td align='center'>";
				   echo $row['rem1senton'];	
				   echo"</td>";	
                   echo"<td align='center'>";
				   echo $row['rem2senton'];	
				   echo"</td>";					
				   				   
				   echo"<td align='center'>";  
				   echo $row['i94expirydate'];	  
				   echo"</td>";
				   echo"<td>";  
				   echo $row['petexpdt'];	  
				   echo"</td>";
				   
				   echo"</tr>";					
			}		
	}
		
	   echo"</td>";
	   echo"</tr>";
       echo"</table>";
}
if ($_GET['count']==3)
   {
   
    mysql_select_db($database_itest, $itest);
	$B= "select * from master_herelist where (i94expirydate BETWEEN (DATE_ADD(NOW(), INTERVAL 143 DAY)) AND (DATE_ADD(NOW(), INTERVAL 172 DAY)) || petexpdt BETWEEN (DATE_ADD(NOW(), INTERVAL 143 DAY)) AND (DATE_ADD(NOW(), INTERVAL 172 DAY))) AND (reminder1=1) AND (reminder2=1) AND (reminder3=0) AND  (responsereceived=0) AND (visatype='H1')";
         $result1 = mysql_query($B) or die(mysql_error());
         $num=mysql_numrows($result1);
	    		            	 
		  if($num==0 || isset($_POST['reminder3']))
			   {
			    echo"<br>";echo"<br>";echo"<br>";
				echo "<strong>Notice</strong>:There are no Reminder IIIs to be sent This Month";
				 }
				 else
				  {
		       
                echo"<br>";echo"<br>";			  
				echo "<table border='1' cellpadding='0' class='basictable' style='border-collapse:collapse' align='left' bordercolorlight='#CCCCCC'>";
			    echo"<th align='center' colspan='7'>Reminders-III This Month</th>";
			    echo "<tr>";
			    echo "<th> <b>First Name </b></th>";
			    echo "<th> <b>Last Name</b> </th>";
			    echo "<th align='center'><b> Empid </b> </th>";
			    echo "<th><b> Rem1 SentOn </b> </th>";
				echo "<th><b> Rem2 SentOn </b> </th>";
			    echo "<th> <b> I94 Expiry Date </b></th>";
				echo "<th align='center'> <b> Petition Expiry Date </b></th>";
				     
		    while($row = mysql_fetch_array($result1) )
	        {	
	            
	               echo"<tr>";
				   echo"<td>";
				   echo $row['firstname'];
				   echo "</td>";				   
				   echo"<td>";
				   echo $row['lastname'];	
				   echo"</td>";			 
				   echo"<td>"; 
				   echo $empids= $row['empid'];	
				   echo "</td>";					
				   echo"<td align='center'>";
				   echo $row['rem1senton'];	
				   echo"</td>";
				   echo"<td align='center'>";
				   echo $row['rem2senton'];	
				   echo"</td>";					
				   
				   echo"<td align='center'>";  
				   echo $row['i94expirydate'];	  
				   echo"</td>";
				   echo"<td align='center'>";  
				   echo $row['petexpdt'];	  
				   echo"</td>";
				   
				   echo"</tr>";
						}
		
	}
		
		echo"</td>";
	   echo"</tr>";
echo"</table>";

    
	 
	 }
	 
	 if ($_GET['count']==4)
   { 
    		
        mysql_select_db($database_itest, $itest); 
    	$B= "select * from master_herelist where ((NOW() > (DATE_SUB(rem1senton, INTERVAL 30 DAY))) || (NOW() > (DATE_SUB(rem1senton, INTERVAL 30 DAY)))) AND (reminder1='1') AND (reminder2='1') AND (reminder3='0') AND(responsereceived='0') AND (visatype='H1')";
        $result1 = mysql_query($B) or die(mysql_error());
        $num=mysql_numrows($result1);
		 
		 if($num==0 || isset($_POST['reminder1']))
			          {
					    echo "<br>";echo "<br>";echo "<br>";
						
						echo "<b>Notice</b>: There are no Reminder-III misses This Month";
						
						
				       }
			         else

                      {	            		 
					 echo "<table border='1' cellpadding='0' class='basictable' style='border-collapse:collapse' align='left' bordercolorlight='#CCCCCC'>";
					 echo"<th align='center' colspan='7'>Reminders-III Missed</th>";
					 echo "<tr>";
					 echo "<th> <b>First Name </b></th>";
					 echo "<th> <b>Last Name</b> </th>";
					 echo "<th align='center'><b> Empid </b> </th>";
					 echo "<th><b> Rem1 SentOn </b> </th>";
					 echo "<th><b> Rem2 SentOn </b> </th>";
					 echo "<th> <b> I94 Expiry Date </b></th>";
					 echo "<th> <b> Petition Expiry Date </b></th>";
						  
				while($row = mysql_fetch_array($result1) )
	                 {	            
				   echo"<tr>";
				   echo"<td>";
				   echo $row['firstname'];
				   echo "</td>";   
				   echo"<td>";
				   echo $row['lastname'];	
				   echo"</td>";
				   echo"<td>"; 
				   echo $empids= $row['empid'];	
				   echo "</td>";
				   echo "</td>";					
				   echo"<td align='center'>";
				   echo $row['rem1senton'];	
				   echo"</td>";					
				   echo"<td align='center'>";
				   echo $row['rem2senton'];	
				   echo"</td>";					
				   
				   echo"<td align='center'>";  
				   echo $row['i94expirydate'];	  
				   echo"</td>";
				   echo"<td align='center'>";  
				   echo $row['petexpdt'];	  
				   echo"</td>";
				   
				   echo"</tr>";
				   
			    		
				   }
            echo"<br>";echo"<br>";
			echo"</table>";
			echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";
			echo "<form enctype=\"multipart/form-data\" action=\"reminder1.php\" method=\"POST\">";	   
			echo "<input type=\"submit\" value=\"Send Missed Reminders\" name=\"rem1\">";
			echo "<input type=\"hidden\" value=\"y\" name=\"sr\" id=\"sr\">";
			echo "</form>";
			   
		    }	  
	 }
	 
	 
	 
	}
	 ?>
	 
	 <?php
			 $x=1;			  
			 if ((isset($_POST['rem3'])) && ($_GET['count']=1) || (isset($_POST['sr'])) && ($_POST['sr']=="y"))  
			   {
			    
			   mysql_select_db($database_itest, $itest);			
			   $counter=1;       		
            
		
			
            $B= "select * from master_herelist where (i94expirydate BETWEEN (DATE_ADD(NOW(), INTERVAL 143 DAY)) AND (DATE_ADD(rem1senton, INTERVAL 150 DAY)) || petexpdt BETWEEN (DATE_ADD(NOW(), INTERVAL 143 DAY)) AND (DATE_ADD(rem1senton, INTERVAL 150 DAY))) AND (reminder1=1) AND (reminder2=1) AND (reminder3=0) AND  (responsereceived=0) AND (visatype='H1')";
            $result1 = mysql_query($B) or die(mysql_error());
            echo $num=mysql_numrows($result1);
	         
		    while(!$num==0 && $row1 = mysql_fetch_array($result1) )
	        {	
			  $_SESSION['MM_Empid'];					
			  $empids=$row1['empid'];         
	          $auth = new ldap_object();
			  $auth->LDAP_connect();
			  $eid = mysql_real_escape_string($empids);
		      $empdet = $auth->getUser($eid);
			  $manempid = $empdet["managerserialnumber"].$empdet["managercountrycode"];
			  $mandet = $auth->getManInfo($manempid);
			  $auth->LDAP_close();
			  $manemail = $mandet["preferredidentity"];
                       
			  $to = $empdet["preferredidentity"];
		      $subject  = 'H1B Extension Request - Reminder 3';
		      $message  = 'Hi ' .$empdet["hrfirstname"]. ',</br>This is to to inform you that your I94 Petition will expire in less than 5 months from now.<p style="font-size:12px; font-family:\'Courier New\';"><strong>Link : </strong>Please <a target="_blank" href="https://lab.bluehost.ibm.com/iis/ext/iform.php"><strong>Click Here</strong></a> to action H1B Visa Extension.</p>';
			  
			  
			  
		      $headers  = 'From: Visa Extension System <iis@bluehost.ibm.com>' . "\r\n" .
						  'Reply-To: ' . $_SESSION['w3_username'] . "\r\n" .
						  "CC:" .$_POST['cc']. "\r\n" .						  
						  'MIME-Version: 1.0' . "\r\n" .
						  'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
						  'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers))
  {
  if($counter == $num)
	  {
	   echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";
  echo"<br>SUCCESSFUL DELIVERY MESSAGE: ".$counter." Emails have been Sent Successfully";
   }
         $counter = $counter + 1;
         $reminder= 1;
		 $A="update master_herelist SET rem3senton= now() where empid= '$empids' ";
             $result = mysql_query($A) or die(mysql_error());

   $A="update master_herelist SET reminder3='1' where empid= '$empids' ";	
   $result = mysql_query($A) or die(mysql_error());

    }
	  
else
   {
    echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
    echo "<br><b>Failure Delivery Notice</b>Email sending failed <br>";
    echo "<b>Possible Failures:</b>Internet Connection or the mail server is down.Please try again.<br>";
	mysql_select_db($database_itest, $itest);
	$A="update master_herelist SET reminder3='0' where empid= '$empdet' ";
	 $result = mysql_query($A) or die(mysql_error()); 
		 
	}
				}
			  
			 } 
?> 

<?php
			 $x=1;			  
			 if ((isset($_POST['rem3'])) && ($_GET['count']=4) || (isset($_POST['sr'])) && ($_POST['sr']=="y"))  
			   {
			    
			   
			   $counter=1;       		
            mysql_select_db($database_itest, $itest);
		
			
            $B= "select * from master_herelist where ((NOW() > (DATE_SUB(rem1senton, INTERVAL 30 DAY))) || (NOW() > (DATE_SUB(rem1senton, INTERVAL 30 DAY)))) AND (reminder1='1') AND (reminder2='1') AND (reminder3='0') AND(responsereceived='0') AND (visatype='H1')";
            $result1 = mysql_query($B) or die(mysql_error());
            $num=mysql_numrows($result1);
	         
		    while(!$num==0 && $row1 = mysql_fetch_array($result1) )
	        {	
			  $_SESSION['MM_Empid'];					
			  $empids=$row1['empid'];         
	          $auth = new ldap_object();
			  $auth->LDAP_connect();
			  $eid = mysql_real_escape_string($empids);
		      $empdet = $auth->getUser($eid);
			  $manempid = $empdet["managerserialnumber"].$empdet["managercountrycode"];
			  $mandet = $auth->getManInfo($manempid);
			  $auth->LDAP_close();
			  $manemail = $mandet["preferredidentity"];
                       
			  $to = $empdet["preferredidentity"];
		      $subject  = 'H1B Extension Request - Reminder 3';
		      $message  = 'Hi ' .$empdet["hrfirstname"]. ',</br>This is to to inform you that your I94 Petition will expire in less than 5 months from now.<p style="font-size:12px; font-family:\'Courier New\';"><strong>Link : </strong>Please <a target="_blank" href="https://lab.bluehost.ibm.com/iis/ext/iform.php"><strong>Click Here</strong></a> to action H1B Visa Extension.</p>';
		      $headers  = 'From: Visa Extension System <iis@bluehost.ibm.com>' . "\r\n" .
						  'Reply-To: ' . $_SESSION['w3_username'] . "\r\n" .
						  'MIME-Version: 1.0' . "\r\n" .
						  'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
						  'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers))
  {
  if($counter == $num)
	  {
	   echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";
  echo"<br>SUCCESSFUL DELIVERY MESSAGE: ".$counter." Emails have been Sent Successfully";
   }
         $counter = $counter + 1;
         $reminder= 1;
   $A="update master_herelist SET reminder3='1' where empid= '$empids' ";	
   $result = mysql_query($A) or die(mysql_error());

    }
	  
else
   {
    echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
    echo "<br><b>Failure Delivery Notice</b>Email sending failed <br>";
    echo "<b>Possible Failures:</b>Internet Connection or the mail server is down.Please try again.<br>";
	mysql_select_db($database_itest, $itest);
	 $A="update master_herelist SET reminder3='0' where empid= '$empdet' ";
	 $result = mysql_query($A) or die(mysql_error()); 
		 
	}
				}
			  
			 } 
?> 
</div>
</td>
 	
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>