<?php require_once('../Connections/session.php');?>

<?php require_once('../Connections/itest.php'); ?>

		   <?php
			   
			  if (isset($_POST['approved']))
                    {					 
						echo "<form enctype=\"multipart/form-data\" action=\"approve.php\" method=\"POST\">";	   
					    echo "<table border='1' cellpadding='2' style='border-collapse: collapse' class='basictable'>";
					    echo "<tr><td><textarea rows='1' cols='50' name=\"approvenotes\" wrap=\"physical\">Please Type in the comments for Approval</textarea></td></tr>"; 
						echo "<tr><td align='right'><input type=\"submit\" name=\"cancelnoteapp\" value=\"Cancel\"><input type=\"submit\" name=\"approvalnote\" value=\"Send the approval Note\"></td></tr><input type=\"hidden\" name=\"idee1\" value=\"".$_POST['id']."\"><input type=\"hidden\" name=\"empidapp\" value=\"".$_POST['empid']."\">";
						echo "</table>";			   
						echo "</form>";	
							   }

									
	   if (isset($_POST['approvalnote']))
		   {mysql_select_db($database_itest, $itest);
		   $content= $_POST['approvenotes'];
			$empid= $_POST['empidapp'];
 		    $A="update master_herelist SET actionstatus= 'Approved', comments='".$content."' where id= '".$_POST['idee1']."' ";
			$result = mysql_query($A) or die(mysql_error());
			$num=1;
								
			  $empids=$empid;         
	          $auth = new ldap_object();
			  $auth->LDAP_connect();
			  $eid = mysql_real_escape_string($empids);
		      $empdet = $auth->getUser($eid);
			  $manempid = $empdet["managerserialnumber"].$empdet["managercountrycode"];
			  $mandet = $auth->getManInfo($manempid);
			  $auth->LDAP_close();
			  $manemail = $mandet["preferredidentity"];
              
			$to = $empdet["preferredidentity"];
								$subject  = 'H1B Extension Request - Status: Approved';
								$message  = 'Hi ' .$empdet["hrfirstname"]. ',</br>This is to to inform you that your request for Work Permit Extension has been Approved. Please consult your manager for further clarifications. Thank You. Please click on <a href=""> Sample format</a> to get the Documents Checklist<p style="font-size:12px; font-family:\'Courier New\';"><strong>Link : </strong>Please <a target="_blank" href="https://lab.bluehost.ibm.com/iis/ext/iform.php"><strong>Click Here</strong></a> to action H1B Visa Extension.</p>';
								$headers  = 'From: Visa Extension System <iis@bluehost.ibm.com>' . "\r\n" .
								'cc: ' . $manemail . "\r\n" .
								'Reply-To: ' . $_SESSION['w3_username'] . "\r\n" .
								'MIME-Version: 1.0' . "\r\n" .
								'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
								'X-Mailer: PHP/' . phpversion();

					if(mail($to, $subject, $message, $headers))
					  {
					  echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";
					  echo"<br>SUCCESSFUL DELIVERY MESSAGE: ".$num."  Approval Email/s have been Sent Successfully";
					   }				  
					else
					   {
						echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
						echo "<br><b>Failure Delivery Notice</b>Email sending failed <br>";
						echo "<b>Possible Failures:</b>Internet Connection or the mail server is down.Please try again.<br>";
					    }
						    }
								
		?>
    <?php
		   if (isset($_POST['reverted']))		   
		    {
		    echo "<form enctype=\"multipart/form-data\" action=\"approve.php\" method=\"POST\">";	   
		    echo "<table border='1' cellpadding='2' style='border-collapse: collapse' class='basictable'>";
		    echo "<tr><td><textarea rows='1' cols='50' name=\"revertnotes\" wrap=\"physical\">Please Type in the comments for Reverting</textarea></td></tr>"; 
			echo "<tr><td align='right'><input type=\"submit\" name=\"cancelnoterev\" value=\"Cancel\"><input type=\"submit\" name=\"revertnote\" value=\"Send the Revert Note\"></td></tr><input type=\"hidden\" name=\"idee3\" value=\"".$_POST['id']."\"><input type=\"hidden\" name=\"empidrev\" value=\"".$_POST['empid']."\">";
			echo "</table>";			   
			echo "</form>";	
			   }

		   if (isset($_POST['revertnote']))
		   {mysql_select_db($database_itest, $itest);
		   $content= $_POST['revertnotes'];
			$empid= $_POST['empidrev'];
 		    $A="update master_herelist SET actionstatus= 'Reverted', comments='".$content."' where id= '".$_POST['idee3']."' ";
			$result = mysql_query($A) or die(mysql_error());
			$num=1;
								
			  $empids=$empid;         
	          $auth = new ldap_object();
			  $auth->LDAP_connect();
			  $eid = mysql_real_escape_string($empids);
		      $empdet = $auth->getUser($eid);
			  $manempid = $empdet["managerserialnumber"].$empdet["managercountrycode"];
			  $mandet = $auth->getManInfo($manempid);
			  $auth->LDAP_close();
			  $manemail = $mandet["preferredidentity"];
              
			$to = $empdet["preferredidentity"];
			$subject  = 'H1B Extension Request - Status: Reverted';
			$message  = 'Hi ' .$empdet["hrfirstname"]. ',</br>This is to to inform you that Documents you have submitted for I-94 Extension are incomplete. Please upload the appropriate documents again. Thank you. <p style="font-size:12px; font-family:\'Courier New\';"><strong>Link : </strong>Please <a target="_blank" href="https://lab.bluehost.ibm.com/iis/ext/iform.php"><strong>Click Here</strong></a> to action H1B Visa Extension.</p>';
			$headers  = 'From: Visa Extension System <iis@bluehost.ibm.com>' . "\r\n" .
            'cc: ' . $manemail . "\r\n" .
            'Reply-To: ' . $_SESSION['w3_username'] . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
	         
	              'This is to Inform You that status of your Work Permit Extension request is in "Pending-waiting for the documents", as the documents uploaded are incorrect.Please upload the mentioned documents again';
		if(mail($to, $subject, $message, $headers))
		  {
			   echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";
			   echo"<br>SUCCESSFUL DELIVERY MESSAGE: ".$num."  Revert Email/s have been Sent Successfully";
		   }	  
		else
	   {
		echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
		echo "<br><b>Failure Delivery Notice</b>Email sending failed <br>";
		echo "<b>Possible Failures:</b>Internet Connection or the mail server is down.Please try again.<br>";
		  
	    }}
		?>
		
		<?php
		   if (isset($_POST['rejected']))
		   {echo "<form enctype=\"multipart/form-data\" action=\"approve.php\" method=\"POST\">";
			echo "<table border='1' cellpadding='2' style='border-collapse: collapse' class='basictable'>";
			echo "<tr><td><textarea rows='1' cols='50' name=\"rejectnotes\" wrap=\"physical\">Please Type in the comments for Rejection</textarea></td></tr>"; 
			echo "<tr><td align='right'><input type=\"submit\" name=\"cancelnoterej\" value=\"Cancel\"><input type=\"submit\" name=\"rejectnote\" value=\"Send the Reject Note\"></td></tr><input type=\"hidden\" name=\"idee2\" value=\"".$_POST['id']."\"><input type=\"hidden\" name=\"empidrej\" value=\"".$_POST['empid']."\">";
			echo "</table>";			   
			echo "</form>";			   
			}
			$num=1;

		   if (isset($_POST['rejectnote']))
		   {mysql_select_db($database_itest, $itest);
		    $content= $_POST['rejectnotes'];
			$empids= $_POST['empidrej'];
 		    $A="update master_herelist SET actionstatus= 'Rejected', comments='".$content."' where id= '".$_POST['idee2']."' ";
			$result = mysql_query($A) or die(mysql_error());
			
			  $auth = new ldap_object();
			  $auth->LDAP_connect();
			  $eid = mysql_real_escape_string($empids);
		      $empdet = $auth->getUser($eid);
			  $manempid = $empdet["managerserialnumber"].$empdet["managercountrycode"];
			  $mandet = $auth->getManInfo($manempid);
			  $auth->LDAP_close();
			  $manemail = $mandet["preferredidentity"];
              
			$to = $empdet["preferredidentity"];
			$subject  = 'H1B Extension Request - Status: Rejected';
			$message  = 'Hi ' .$empdet["hrfirstname"]. ',</br>This is to to inform you that your request for Work Permit Extension has been rejected. Please consult your manager for further clarifications. Thank You. <p style="font-size:12px; font-family:\'Courier New\';"><strong>Link : </strong>Please <a target="_blank" href="https://lab.bluehost.ibm.com/iis/ext/iform.php"><strong>Click Here</strong></a> to action H1B Visa Extension.</p>';
			$headers  = 'From: Visa Extension System <iis@bluehost.ibm.com>' . "\r\n" .
            'cc: ' . $manemail . "\r\n" .
            'Reply-To: ' . $_SESSION['w3_username'] . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
	         
		if(mail($to, $subject, $message, $headers))
		  {	
		echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";echo"<br>";
		echo"<br>SUCCESSFUL DELIVERY MESSAGE: ".$num."  Reject Email/s have been Sent Successfully";
		   }	  
		else
	   {
		echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
		echo "<br><b>Failure Delivery Notice</b>Email sending failed <br>";
		echo "<b>Possible Failures:</b>Internet Connection or the mail server is down.Please try again.<br>";
	    }}
			
		?>		

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
        <th height="35" align="left" valign="middle" style="font-size:18px"><strong>Pending Ticket Status</strong></th>
      </tr>
      <tr>
        <td><hr style="border-bottom: #333 1px solid"/></td>
      </tr>
      <tr>
        <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
			<fieldset>
    <legend>Dashboard</legend>
    <table cellpadding="2" cellspacing="0" border="0">
	                 
	   <tr>
	     <?php	
		
		  mysql_select_db($database_itest, $itest);
		$B= "select * from master_herelist where responsereceived='1' && fileuploadstatus='1' && actionstatus='0' || actionstatus='Reverted'";
        $result = mysql_query($B) or die(mysql_error());
        $num=mysql_numrows($result);
         echo "<table border='1' cellpadding='2' style='border-collapse: collapse' align='left' bordercolorlight='#C0C0C0' class='basictable'>";
		 echo"<caption>Accuracy and Completeness Check Wizard</caption>";
		 echo "<tr>";
	     echo "<th> <b>First Name </b></th>";
		 echo "<th> <b>Last Name</b> </th>";
		 echo "<th align='center'><b> Empid </b> </th>";
		 echo"<th><b>I94 Expiry Date<b></th>";
		 echo "<th align='center'> <b>Copy of I94 Doc</b> </th>";
		 echo "<th align='center'> <b>Copy of Passport Doc<h> </th>";
		 echo"<th> Casemanager Action </th>";
while($row = mysql_fetch_array($result) )
	  {   
	   echo"<tr>";	   
	   echo"<td>".$row['firstname']."</td>";	   
	   echo"<td>".$row['lastname']."</td>"; 
       echo"<td align='center'>".$row['empid']."</td>";   
       echo"<td align='center'>".$row['i94expirydate']."</td>";
	   echo"<td align='center'>"; 
if($row['responsereceived']) echo "<a href=".$row['filelocation1']." target=\"_blank\">I94 Copy</a>"; else echo "-";
       echo "</td>";
	   echo"<td align='center'>";
if($row['responsereceived']) { echo "<a href=".$row['filelocation2']." target=\"_blank\" >PassportCopy</a>"; }
         echo "</td>";
		 echo"<td>";
		 echo "<form action=\"approve.php\" method=\"POST\">";
	     echo "<input name='approved' value='Approve' type='submit'>";
	     echo "<input name='rejected' value='Reject' type='submit'>";
	     echo "<input name='reverted' value='Revert' type='submit'>";
         echo"<input name='id' type='hidden' value='".$row['id']."'>";
         echo"<input name='empid' type='hidden' value='".$row['empid']."'>";
		 echo "</form>";
         echo "</td>";	
		 }
			   
			   
			   
		 echo "</table>";
		 
		 ?>
		 

		 </table>
		 </fieldset>

			</td>
          </tr>
          <tr>
            <td> &nbsp;		   
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
		  <tr>
            <td>&nbsp;</td>
          </tr>
		  <tr>
            <td>&nbsp;</td>
          </tr><tr>
            <td>&nbsp;</td>
          </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>