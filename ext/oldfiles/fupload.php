<?php

$con = mysql_connect('localhost', 'aztoolz', 'bluehost');
if (!$con) { die('Could not connect: ' . mysql_error()); }
Mysql_select_db("aztoolz", $con);

$y="Select * from finalresult";
$resulty=mysql_query($y) or die(mysql_error());
			$num=mysql_numrows($resulty);
	
if(isset($_POST['upload']))
{
$file_name = ( $_FILES['uploaded']['name']); 
echo $type = $_FILES['uploaded']['type'];
$size=  $_FILES['uploaded']['size'];
$_FILES['uploaded']['tmp_name'];
if($type == "text/csv")
{
$target = "upload/";
$tempname= basename($_FILES['uploaded']['name']); 						   
$target = $target.$tempname;
(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target));

$status= "File Successfully uploaded to the server";
$w="INSERT INTO finalresult(filelocation, status) VALUES ('".$target."','".$status."')";
mysql_query($w) or die(mysql_error());
$maxid = mysql_insert_id();

$handle = fopen($target, "r");
while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
$emp = str_pad(trim($data[0]), 6, '0', STR_PAD_LEFT)."744";
$udat = date("Y-m-d", strtotime($data[7]));
if (($data[3]=="H1B") || ($data[3]=="H1") || ($data[3]=="H1 B")) $visaty = "H1"; else $visaty = $data[3];
//echo "</br>";
$import="INSERT INTO master_herelist(empid, firstname, lastname, visatype, workcity, workstate, actstartdate, i94expirydate, termdate, clientname, ibmbuisnessunit, counter) values('$emp','$data[1]','$data[2]','$visaty','$data[4]','$data[5]','$data[6]',".$udat.",'$data[8]','$data[9]','$data[10]',$maxid)";
mysql_query($import) or die(mysql_error());
}
fclose($handle);			  
$msg2= "Records have been successfully added to the Database";		 
} else { echo $msg1= "Can not upload the file as its not a CSV file"; }} 				
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
<meta name="Author" content="Kali Kiran" />
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
<meta name="Publisher" content="Kali Kiran" />
<meta name="Publisher-Email" content="jainpiyush@in.ibm.com" />
<meta name="Placename" content="India" />
<meta name="Contributors" content="Piyush Jain" />

<title>Extension Dump Upload</title>

<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th height="35" align="left" valign="middle" style="font-size:20px"><strong>H1B Extension Dump Upload</strong></th>
      </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><hr style="border-bottom: #333 1px solid"/></td>
      </tr>
      <tr>
        <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
			
			<form enctype="multipart/form-data" action="fupload.php" method="POST">
 
 <fieldset>
 <legend>File Upload Wizard</legend>
 Please upload the File as in the sample Format

 <table border="0" cellpadding="2" >
 
 <tr>
 <td>
 <a href="herelist.csv">Please click on for the sample Format
	</a>
 </td>
 </tr>
  <tr>
 <td>
 Please choose a file: <input name="uploaded" type="file" />
 <input type="submit" id="upload" value="upload" name="upload"/>
  
 </td>
 </tr>
 	 </table>
	 </fieldset>
	 </form>
 </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
			
<?php			
			echo"<fieldset>";
			echo"<legend>File Upload History and Location Information</legend>";
             if($num== 0)
			  {
			   echo"<table border=1 cellpadding=2>";
                 echo"<tr>";
				  echo"<td>";
				 echo "<b>Notice</b>: There are no Files Stored in the repository";
				  echo "</td>";
				  echo"</tr>";
			   }
			  
			 else
			 {
			  echo"<table border=1 cellpadding=2>";
			  echo"<tr>";
			     echo "<th>Date&time</th>";
				  echo "<th>File location</th>";
				   echo"<th>upload status</th>";
				   echo"</tr>";
			  while($row = mysql_fetch_array($resulty) )
	              {
                 echo"<tr>";
				  echo"<td>";
				 echo $row['datetime'];
				  echo "</td>";
				  echo"<td>";
		         $final_file_location= $row['filelocation'];
				 echo "<a href=\"".$final_file_location."\" target=\"_blank\">".$final_file_location."</a>";
				 echo"</td>";
				 echo"<td>".$row['status']."</td>";
				  echo"</td>";
				  echo"</tr>";
				      }
	echo"</table>";
	echo"</fieldset>";
	}
	
	?>
	
	
	</td>
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