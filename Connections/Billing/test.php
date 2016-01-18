<?php require_once('../Connections/ctest.php'); ?>
<?php //require_once('../Connections/itest.php'); ?>
 <?php
 if (isset($_POST['flushdb'])) { 
$y="TRUNCATE TABLE master_herelist;";
$resulty=mysql_query($y) or die(mysql_error());
$dbflush = "Database has been flushed";}


try {
    $dbh = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
} catch (PDOException $e) {
    error(false, "PDO ERROR: " . $e->getMessage());
}

$COUNTRY_LIST= "select * from country ORDER BY ID DESC";
$q   = $dbh->query($COUNTRY_LIST) or die("failed!");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<meta name="Author" content="Kali Kiran Thammanna" />
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
<meta name="Publisher" content="Kali Kiran Thammanna" />
<meta name="Publisher-Email" content="kalkiran@in.ibm.com" />
<meta name="Placename" content="India" />
<meta name="Contributors" content="Kali Kiran Thammanna" />

<title>IIS</title>

<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<th height="35" align="left" valign="middle" style="font-size:20px"><strong>H1B Extension Dump Upload</strong></th>
</tr>
<tr>
<td><hr style="border-bottom: #333 1px solid"/></td>
</tr>
<tr>
<td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td style="color:#FF0000; font-weight:bold"><?php if(isset($errStr)) echo $errStr; else echo "&nbsp;" ?></td>
</tr>
<tr>
<tr>

<td valign="middle"><form id="form2" name="form2" method="post" action="">
<input type="submit" name="flushdb" id="flushdb" value="Flush Database" />
<span style="color:#FF0000; font-weight:bold"><?php if (isset($dbflush)) echo ($dbflush); ?></span>
</form></td>

</tr>


<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><fieldset><legend>File Upload</legend>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table border="0" cellspacing="0" cellpadding="1">
<tr>
<td><strong>Please choose a file :</strong></td>
<td nowrap="nowrap"><label for="uploaded"></label>
  <input type="file" name="uploaded" id="uploaded" />
  <input name="MM_insert" type="hidden" id="MM_insert" value="upload" />
<input type="submit" name="upload" id="upload" value="Upload" /></td>
<td nowrap="nowrap"><a href="herelist.csv">Sample format</a></td>
<td nowrap="nowrap">&nbsp;</td>
</tr>
<tr>
<td>
</td>
</tr>
</table>

<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td>
<fieldset><legend>GAT List</legend>
<form enctype="multipart/form-data" action="fileupd.php" method="POST">
   <input type="text" name="serch" id="serch" size="30">
   <input type="submit" name="search" id="search" value="Search">
 </form>
		
<?php  
if(isset($_POST['serch']))
{
	    $FOUND_RECS= "select * from master_herelist where empid LIKE '%".$_POST['serch']."%' || firstname LIKE '%".$_POST['serch']."%' || lastname LIKE '%".$_POST['serch']."%'";
        $q   = $conn->query($FOUND_RECS) or die("failed!");
		   if(!$c = $q->rowCount())
			    {echo "<strong>Notice : </strong> There are no records found as per the search criterion.";}
			  else
			   {
			    echo"<br>";echo"<br>";				  				  
				echo "<table border='1' cellpadding='2' class='basictable' cellspacing='0'>";
				echo"<caption>GAT List - Search Results for ".$_POST['serch']." | ".$c." records found</caption>";
			    echo "<th>First Name</th>";
				echo "<th>Last Name</th>";
				echo "<th>Empid</th>";
				echo "<th>I94 Expiry Date</th>";
				echo "<th>Petition Expiry Date</th>";
				echo "<th>Reminder-1</th>";
			    echo "<th>Reminder-2</th>";
				echo "<th>Reminder-3</th>";
                echo "<th>Email</th>";
                echo"<th>Update</th>";				 
				echo"<th>Delete</th>";	
		while($r = $q->fetch(PDO::FETCH_ASSOC)){                   
				echo "<tr>";
				 echo "<td>".$r['firstname']."</td>";
			     echo "<td>".$r['lastname']."</td>";	
				 echo "<td>".$r['empid']."</td>";
				 echo"<td align='center'>";  
				 echo $r['i94expirydate'];	  
				 echo"</td>";
				 echo"<td align='center'>";  
				 echo $r['petexpdt'];
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $r['rem1senton'] == 0){ echo "Null";} else {echo $r['rem1senton'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $r['rem2senton'] == 0){ echo "Null";} else {echo $r['rem2senton'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $r['rem3senton'] == 0){ echo "Null";} else {echo $r['rem3senton'];}
				 echo"</td>";
				 echo"<td>";
				 echo "<input type=\"submit\" value=\"email\" id=\"email\" name=\"email\" method=\"POST\">";
				 echo"</td>";				 
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"update\" id=\"update\" value=\"Update\">";
				 echo"</td>";
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"delete\" id=\"delete\" value=\"Delete\">";
				 echo "<input type=\"hidden\" value=\"".$r['empid']."\" name=\"eid\" id=\"eid\"><input type=\"hidden\" value=\"".$r['firstname']."\" name=\"empname2\" id=\"empname2\"><input type=\"hidden\" value=\"".$r['id']."\" name=\"id2\" id=\"id2\">";
				 echo"</form>";
				 echo"</td>";				 
				 echo"</tr>";                
	    }
			    echo"</tr>";
		        echo"</table>";	
	}
	}
					 
else
{
		$GAT_TOTAL_LIST= "select * from master_herelist ORDER BY ID DESC";
        $q   = $conn->query($GAT_TOTAL_LIST) or die("failed!");
           if(!$c = $q->rowCount())
		    {
		    echo "<strong>Notice : </strong> There are no records available";	
			} 
			else
		    {				  
			echo "<table border='1' cellpadding='2' class='basictable' cellspacing='0'>";
			echo"<caption>GAT List - All Records</caption>";
		    echo "<tr>";
		    echo "<th>First Name</th>";
		    echo "<th>Last Name</th>";
		    echo "<th>Empid</th>";
		    echo "<th>I94 Expiry Date</th>";
		    echo "<th>Petition Expiry Date</th>";
		    echo "<th>Reminder-1</th>";
		    echo "<th>Reminder-2</th>";
		    echo "<th>Reminder-3</th>";
		    echo "<th>Email</th>";
		    echo"<th>Update</th>";				 
		    echo"<th>Delete</th>";	
		    while($r = $q->fetch(PDO::FETCH_ASSOC))
	        {	
	        echo"<tr>";
			     echo"<td>".$r['firstname']."</td>";
			     echo "<td>".$r['lastname']."</td>";				
                 echo"<td>";echo "<form enctype=\"multipart/form-data\" name=\"speciallist\" id=\"speciallist\" action=\"fileupd.php\" method=\"POST\">";	   
				 echo $empids= $r['empid'];echo "</td>";
				 echo"<td align='center'>";echo $r['i94expirydate'];echo"</td>";
				 echo"<td align='center'>";echo $r['petexpdt'];echo"</td>";
				 echo"<td align='center'>";
				 if( $r['rem1senton'] == 0){ echo "Null";} else {echo $r['rem1senton'];}
				 echo"</td>";echo"<td align='center'>";
				        if( $r['rem2senton'] == 0)
				            { 
							 echo "Null";} 
							 else 
							{
							 echo $r['rem2senton'];}
				 echo"</td>";echo"<td align='center'>";
				 if( $r['rem3senton'] == 0){ echo "Null";} else {echo $r['rem3senton'];}
				 echo"</td>";
				 echo"<td>";echo "<input type=\"submit\" value=\"email\" id=\"email\" name=\"email\" method=\"POST\">";echo"</td>";
				 echo"<td align='center'>";echo "<input type=\"submit\" name=\"update\" id=\"update\" value=\"Update\">";echo"</td>";
				 echo"<td align='center'>";echo "<input type=\"submit\" name=\"delete\" id=\"delete\" value=\"Delete\">";
				 echo "<input type=\"hidden\" value=\"$empids\" name=\"eid\" id=\"eid\"><input type=\"hidden\" value=\"".$r['firstname']."\" name=\"empname2\" id=\"empname2\"><input type=\"hidden\" value=\"".$r['id']."\" name=\"id2\" id=\"id2\">";
				 echo"</form>";
				 echo"</td>";				 
				 echo"</tr>";
    	}
		echo"</td>";
	    echo"</tr>";
		echo"</table>";
		
	}
	
					  }
           
  if(isset($_POST['email']))
	          {
			  $empids=$_POST['eid'];         
	          $auth = new ldap_object();
			  $auth->LDAP_connect();
			  $eid = mysql_real_escape_string($empids);
		      $empdet = $auth->getUser($empids);
			  $manempid = $empdet["managerserialnumber"].$empdet["managercountrycode"];
			  $mandet = $auth->getManInfo($manempid);
			  $auth->LDAP_close();
			  $manemail = $mandet["preferredidentity"];
               $counter=1;        
			  $to = $empdet["preferredidentity"];
		      $subject  = 'Test Email';
		      $message  = 'Hi ' .$empdet["hrfirstname"]. ',</br>This is a Test Email<p style="font-size:12px; font-family:\'Courier New\';"><strong>Link : </strong>Please <a target="_blank" href="https://lab.bluehost.ibm.com/iis/ext/iform.php"><strong>Click Here</strong></a> to action H1B Visa Extension.</p>';
		      $headers  = 'From: Visa Extension System <iis@bluehost.ibm.com>' . "\r\n" .
						  'Reply-To: ' . $_SESSION['w3_username'] . "\r\n" .
						  'MIME-Version: 1.0' . "\r\n" .
						  'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
						  'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers))
  {
    echo"<br>";
    echo"SUCCESSFUL DELIVERY MESSAGE: Emails have been Sent to ".$empdet["hrfirstname"]." Successfully";
    $counter = $counter + 1;
    }
else
   {
    echo "<br>";
    echo "<b>Failure Delivery Notice: </b>Email sending failed <br>";
    echo "<b>Possible Failures: </b>Internet Connection or the mail server is down.Please try again.<br>";
					  
			    }
}
?>
</form>
</fieldset></td>
</tr>
<tr>
<td>
<?php      
$file_history = "SELECT * FROM finalresult";
$q   = $conn->query($file_history) or die("failed!");
                 echo"<br>";echo"<br>";				  				  
				 echo "<table border='1' cellpadding='2' class='basictable' cellspacing='0'>";
				 echo"<th align='center' colspan='6'>File Upload History</th>";
				 echo "<tr>";
				 echo "<td><b>Uploaded Date</b></td>";
				 echo "<td><b>File Name</b></td>";
				 echo "<td><b> Size(Bytes)</b> </th>";
				 echo "<td><b>Status</b></td>";
				 echo "<td><b>Imported Data</b></td>";	
                 echo "<td><b>ID</b></td>";				 
   while($r = $q->fetch(PDO::FETCH_ASSOC)){                   
				 echo "<tr>";echo "<td>".$r['datetime']."</td>";
			     echo "<td>".$r['filelocation']."</td>";
			     echo "<td>".$r['fsize']."</td>";
				 echo "<td>".$r['fname']."</td>";	
				 echo "<td>".$r['status']."</td>";
			     echo "<td>".$r['id']."</td>";
                 echo"</tr>";                 
	  }
?>
</td>
</tr>
</table>
</table>


</body>
</html>