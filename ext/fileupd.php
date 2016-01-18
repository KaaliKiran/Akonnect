<?php require_once('../Connections/itest.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{ if (PHP_VERSION < 6) {$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue; }
$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
switch ($theType) { case "text": $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL"; break;
case "int": $theValue = ($theValue != "") ? intval($theValue) : "NULL"; break;
case "date": $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL"; break;
} return $theValue; }}
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_finallist = 10;
$pageNum_finallist = 0;
if (isset($_GET['pageNum_finallist'])) {
$pageNum_finallist = $_GET['pageNum_finallist']; }
$startRow_finallist = $pageNum_finallist * $maxRows_finallist;

mysql_select_db($database_itest, $itest);
$query_finallist = "SELECT * FROM uploadhistory ORDER BY id DESC";
$query_limit_finallist = sprintf("%s LIMIT %d, %d", $query_finallist, $startRow_finallist, $maxRows_finallist);
$finallist = mysql_query($query_limit_finallist, $itest) or die(mysql_error());
$row_finallist = mysql_fetch_assoc($finallist);

if (isset($_GET['totalRows_finallist'])) {
$totalRows_finallist = $_GET['totalRows_finallist'];
} else { $all_finallist = mysql_query($query_finallist);
$totalRows_finallist = mysql_num_rows($all_finallist); }
$totalPages_finallist = ceil($totalRows_finallist/$maxRows_finallist)-1;
$queryString_finallist = "";
if (!empty($_SERVER['QUERY_STRING'])) {
$params = explode("&", $_SERVER['QUERY_STRING']);
$newParams = array();
foreach ($params as $param) {
if (stristr($param, "pageNum_finallist") == false && 
stristr($param, "totalRows_finallist") == false) {
array_push($newParams, $param);}}
if (count($newParams) != 0) { $queryString_finallist = "&" . htmlentities(implode("&", $newParams)); }}
$queryString_finallist = sprintf("&totalRows_finallist=%d%s", $totalRows_finallist, $queryString_finallist);


if (isset($_POST['flushdb'])) { $y="TRUNCATE TABLE insurance_list;";
$resulty=mysql_query($y) or die(mysql_error());
$dbflush = "Database has been flushed";}


if ((isset($_GET['s'])) && ($_GET['s']==1)) $errStr = "File Uploaded & added to the Database successfully."; else $errStr = "";
if ((isset($_POST['MM_insert'])) && ($_POST['MM_insert']=="upload"))
{ if (phpversion() > "4.0.6") { $HTTP_POST_FILES = &$_FILES; }
$_file_ = $HTTP_POST_FILES['uploaded'];

if(is_uploaded_file($_file_['tmp_name']) && $HTTP_POST_FILES['uploaded']['error'] == 0){
$_ext_ = explode(".", $_file_['name']);
$_ext_ = strtolower($_ext_[count($_ext_)-1]);
if (($_ext_!="csv") && count("csv") > 0) { $errStr = "Invalid File Format.. Please upload only formated csv file."; }
else if(!is_dir("./upload/") && is_writeable("./upload/")){ $errStr = "Destination folder error.. Please contact the administrator."; }
else { $insertSQL = sprintf("INSERT INTO uploadhistory (filelocation, fsize, fname, status) VALUES (%s, %s, %s, %s)",
GetSQLValueString(".".$_ext_, "text"), GetSQLValueString($_file_['size'], "int"), GetSQLValueString($_file_['name'], "text"), GetSQLValueString("File Uploaded.", "text"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($insertSQL, $itest) or die(mysql_error());
echo $maxid = mysql_insert_id();

if(@copy($_file_['tmp_name'],"./upload/" . "/".$maxid."." . $_ext_)){
echo $target="./upload/" . "/".$maxid."." . $_ext_;	
$handle = fopen($target, "r");
$i=0;
while (($data = fgetcsv($handle, 0, ",")) !== FALSE) { if ($i>0) {
if (($data[3]=="H1B") || ($data[3]=="H1") || ($data[3]=="H1 B")) $visaty = "H1"; else $visaty = $data[3];
$insertSQL = sprintf("INSERT HIGH_PRIORITY IGNORE INTO insurance_list (id, insid, firstname, lastname, emailid, contact) VALUES (%d, %s, %s, %s, %s, %s)",
GetSQLValueString($data[0], "int"), GetSQLValueString($data[1], "text"), GetSQLValueString($data[2], "text"), GetSQLValueString($data[3], "text"), GetSQLValueString($data[4], "text"), GetSQLValueString($data[5], "int"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($insertSQL, $itest) or die(mysql_error());
} else $i = $i +1; }
fclose($handle);
$errStr = "File Uploaded & added to the Database successfully.";
header("Location: " . "fileupd.php?s=1");
} else { $errStr = "File Uploaded but not added to the Database."; }}}}

	 if(isset($_POST['update1']))
	 {
		mysql_select_db($database_itest, $itest);
 	    $B= "update master_herelist set i94expirydate= '".$_POST['i94']."', petexpdt= '".$_POST['petexpdt1']."' where id= '".$_POST['updid']."'";
        $result1 = mysql_query($B) or die(mysql_error());
		$abc="Records have been updated Successfully";
		}
		
		if(isset($_POST['delete1']))
	    {
		    mysql_select_db($database_itest, $itest);
		$B= "Delete from master_herelist where id= '".$_POST['id1']."'";
        $result1 = mysql_query($B) or die(mysql_error());
		echo"<br>";
	    $msg = "Records Deleted Successfully";
		
	   } 
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
<meta name="IBM.Industry" scheme="IndustryTaxonomy" content="ZZ" />
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
<meta name="Copyright" content="© Copyright Avishkar Corp. 2015 - Agent Avish" />
<meta name="Reply-to" content="kaali.kiran@gmail.com" />
<meta name="document-class" content="Completed" />
<meta name="document-classification" content="Software" />
<meta name="document-rights" content="Copyrighted Work" />
<meta name="document-type" content="Web Page" />
<meta name="document-rating" content="General" />
<meta name="document-distribution" content="IU" />
<meta name="document-state" content="Dynamic" />
<meta name="cache-control" content="Public" />
<meta name="Publisher" content="Piyush Jain" />
<meta name="Publisher-Email" content="kaali.kiran@gmail.com" />
<meta name="Placename" content="India" />
<meta name="Contributors" content="Kaali Kiran" />

<title>Avishkar</title>

<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<th height="35" align="left" valign="middle" style="font-size:20px"><strong>Insurance Contact Details Dump upload</strong></th>
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
<?php// if (($_SESSION['MM_Empid']=="087183744") || ($_SESSION['MM_Empid']=="AVDXY1744")) { ?>
<td valign="middle"><form id="form2" name="form2" method="post" action="">
<input type="submit" name="flushdb" id="flushdb" value="Flush Database" />
<span style="color:#FF0000; font-weight:bold"><?php if (isset($dbflush)) echo ($dbflush); ?></span>
</form></td>
<?php //} ?>
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
</table>
</form>
</fieldset></td>
</tr>

<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td>
<fieldset><legend>All Records</legend>
<form enctype="multipart/form-data" action="fileupd.php" method="POST">
   <input type="text" name="serch" id="serch" size="30">
   <input type="submit" name="search" id="search" value="Search">
 </form>
		
<?php  
if(isset($_POST['serch']))
{
		mysql_select_db($database_itest, $itest);	   
 	    $B= "select * from insurance_list where insid LIKE '%".$_POST['serch']."%' || firstname LIKE '%".$_POST['serch']."%' || lastname LIKE '%".$_POST['serch']."%'";
        $result1 = mysql_query($B) or die(mysql_error());
        $num=mysql_numrows($result1);
	      		
		    if($num==0) { echo "<strong>Notice : </strong> There are no records found as per the search criterion.";}
				 else
				  {				  
				 echo "<table border='1' cellpadding='2' class='basictable' cellspacing='0'>";
				 echo"<caption>Avish's List - Search Results for ".$_POST['serch']." | ".$num." records found</caption>";
				 echo "<tr>";
				 echo "<th>Slno</th>";
				 echo "<th>insid</th>";
				 echo "<th>First Name</th>";
				 echo "<th>Last Name</th>";	
				 echo "<th>Reminder-1</th>";
				 echo "<th>Reminder-2</th>";
				 echo "<th>Reminder-3</th>";
				 echo "<th>Email</th>";
                 echo"<th>Update</th>";				 
				 echo"<th>Delete</th>";	
				
		    while($row = mysql_fetch_array($result1) )
	        {	 echo "<tr>";
	             echo "<td>".$row['id']."</td>";
	             echo "</td>";
                 echo "<td>"; 
				     echo "<form enctype=\"multipart/form-data\" name=\"speciallist\" id=\"speciallist\" action=\"fileupd.php\" method=\"POST\">";	   
				     echo $ins_id= $row['insid'];
				 echo "</td>";
				 echo "<td>".$row['firstname']."</td>";
			     echo "<td>";
				 echo $row['lastname'];	
				 echo"<td align='center'>";
				 if( $row['rem1senton'] == 0){ echo "Null";} else {echo $row['rem1senton'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['rem2senton'] == 0){ echo "Null";} else {echo $row['rem2senton'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['rem3senton'] == 0){ echo "Null";} else {echo $row['rem3senton'];}
				 echo"</td>";
				 echo"<td>";
				 echo "<input type=\"submit\" value=\"email\" id=\"email\" name=\"email\" method=\"POST\">";
				 echo"</td>";
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"update\" id=\"update\" value=\"Update\">";
				 echo"</td>";
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"delete\" id=\"delete\" value=\"Delete\">";
				 echo "<input type=\"text\" value=\"$ins_id\" name=\"eid\" id=\"eid\"><input type=\"text\" value=\"".$row['firstname']."\" name=\"empname2\" id=\"empname2\"><input type=\"text\" value=\"".$row['id']."\" name=\"id2\" id=\"id2\">";
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
		mysql_select_db($database_itest, $itest);	   
 	    $B= "select * from insurance_list ORDER BY ID ASC";
        $result1 = mysql_query($B) or die(mysql_error());
        $num=mysql_numrows($result1);
	      		
		    if($num==0)
			   {
				echo "<strong>Notice : </strong> There are no records available";	
				}
				 else
				    {				  
				 echo "<table border='1' cellpadding='2' class='basictable' cellspacing='0'>";
				 echo"<caption>Avish's List - All Records</caption>";
				 echo "<tr>";
				 echo "<th>Slno</th>";
				 echo "<th>insid</th>";
				 echo "<th>First Name</th>";
				 echo "<th>Last Name</th>";	
				 echo "<th>Email Address</th>";
				 echo "<th>Reminder-1</th>";
				 echo "<th>Reminder-2</th>";
				 echo "<th>Reminder-3</th>";
				 echo "<th>Email</th>";
                 echo"<th>Update</th>";				 
				 echo"<th>Delete</th>";	
				
		    while($row = mysql_fetch_array($result1) )
	        {	 echo "<tr>";
	             echo "<td>".$row['id']."</td>";
	             echo "</td>";
                 echo "<td>"; 
				     echo "<form enctype=\"multipart/form-data\" name=\"speciallist\" id=\"speciallist\" action=\"fileupd.php\" method=\"POST\">";	   
				     echo $ins_id= $row['insid'];
				     echo $iid= $row['id'];
				 echo "</td>";
				 echo "<td>".$row['firstname']."</td>";
			     echo "<td>";
				 echo $row['lastname'];	
				 echo "</td>";
				 echo "<td>";
				 echo $emailid=$row['emailid'];
				 echo "</td>";
				 echo"<td align='center'>";
				 if( $row['rem1senton'] == 0){ echo "Null";} else {echo $row['rem1senton'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['rem2senton'] == 0){ echo "Null";} else {echo $row['rem2senton'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['rem3senton'] == 0){ echo "Null";} else {echo $row['rem3senton'];}
				 echo"</td>";
				 echo"<td>";
				 echo "<input type=\"submit\" value=\"email\" id=\"email\" name=\"email\" method=\"POST\">";
				 echo"</td>";
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"update\" id=\"update\" value=\"Update\">";
				 echo"</td>";
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"delete\" id=\"delete\" value=\"Delete\">";
				 echo "<input type=\"hidden\" value=\"$emailid\" name=\"eid\" id=\"eid\"><input type=\"hidden\" value=\"".$row['firstname']."\" name=\"empname2\" id=\"empname2\"><input type=\"hidden\" value=\"".$row['insid']."\" name=\"id2\" id=\"id2\">";
				 echo"</form>";
				 echo"</td>";
				 
				 echo"</tr>";
    	}
	    echo"</tr>";
		echo"</table>";
		
	}
	
					  }
           
	 ?>

 <?php
	 if(isset($_POST['update']))
	    {
		    
		    
		   
		    mysql_select_db($database_itest, $itest);

		
 	    $B= "select * from insurance_list where insid= '".$_POST['id2']."'";
        $result1 = mysql_query($B) or die(mysql_error());
		$row = mysql_fetch_array($result1);
		
		echo "<br><form enctype=\"multipart/form-data\" name=\"speciallis\" id=\"speciallis\" action=\"fileupd.php\" method=\"POST\">";	 
		$email= $row['emailid'];
		$contact= $row['contact']; 
        echo"<table border='1' cellpadding='2' cellspacing='2' class='basictable'>";
	    echo"<caption>Update Details</caption>";
	
			 echo "<tr>";
			 echo "<th align='left'>First Name</th>";
			 echo "<td align='left'>".$row['firstname']."</td>";
			 echo "</tr>";
			 
			 echo "<tr>";
			 echo "<th align='left'>Last Name</th>";
			 echo "<td align='left'>".$row['lastname']."</td>";
			 echo "</tr>";
			 
			 echo "<tr>";
			 echo "<th align='left'>Insurance ID</th>";
			 echo "<td align='left'>".$row['insid']."</td>";
			 echo "</tr>";
			 
				 
			 echo "<tr>";
			 echo "<th align='left'>Email Address</th>";
			 echo "<td align='left'><input type=\"text\" value=\"$email\" name=\"eid\" id=\"eid\"></td>";
			 echo "</tr>";
			 
			  echo "<tr>";
			 echo "<th align='left'>Contact</th>";
			 echo "<td align='left'><input type=\"text\" value=\"$contact\" name=\"eid\" id=\"eid\"></td>";
			 echo "</tr>";

			 echo"<tr>";
			 echo"<td align='right'><input type=\"submit\" name=\"cancel1\" id=\"cancel1\" value=\"Cancel\"></td><td><input type=\"hidden\" name=\"updid\" id=\"updid\" value=\"".$_POST['id2']."\"><input type=\"submit\" name=\"update1\" id=\"update1\" value=\"Update\"></td>";
			 echo"</tr>";
			 echo"</table></form>";

		    
		
         }
	 ?>
	 <?php
	 
	  if(isset($_POST['email']))
	          {
	          	
	    mysql_select_db($database_itest, $itest);
		$C= "select * from insurance_list where insid= '".$_POST['id2']."'"; 	
		$result2 = mysql_query($C) or die(mysql_error());
		$custdet = mysql_fetch_array($result2);       
        $email = $custdet["emailid"];   
		
			
             $counter=1; 

			  $to = $email ;
		      $subject  = 'Test Email';
		      $message  = 'Hi ' .$custdet["firstname"]. ',</br>This is a Test Email<p style="font-size:12px; font-family:\'Courier New\';"><strong>Link : </strong>Please <a target="_blank" href="https://lab.bluehost.ibm.com/iis/ext/iform.php"><strong>Click Here</strong></a> to action H1B Visa Extension.</p>';
		      $headers  = 'From: Agent Avish' . "\r\n" .
						  'MIME-Version: 1.0' . "\r\n" .
						  'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
						  'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers))
  {
    echo"<br>";
    echo"SUCCESSFUL DELIVERY MESSAGE: Emails have been Sent to ".$custdet["firstname"]." Successfully";
    $counter = $counter + 1;
    }
else
   {
    echo "<br>";
    echo "<b>Failure Delivery Notice: </b>Email sending failed <br>";
    echo "<b>Possible Failures: </b>Internet Connection or the mail server is down.Please try again.<br>";
					 
			    }
			}

    
		 
		 if(isset($_POST['delete']))
	    {	
		echo "<br><form enctype=\"multipart/form-data\" name=\"speciallis\" id=\"speciallis\" action=\"fileupd.php\" method=\"POST\">";	  
        echo"<table border='1' cellpadding='2' cellspacing='2' class='basictable'>";
		echo "<tr>";
		echo "<th align='left'>Do You really want to delete the record of ".$_POST['empname2'].".</th>";
		echo "<td><input type=\"text\" name=\"id1\" id=\"id1\" value=\"".$_POST['id2']."\"> <input type=\"submit\" name=\"delete1\" id=\"delete1\" value=\"Delete\"> <input type=\"submit\" name=\"cancel1\" id=\"cancel1\" value=\"Cancel\"></td>";
		echo "</tr>";
		echo "</table></form>";
         }
	

		
	 ?>
	 

<?php
if (isset($abc))
{ echo "<br>";
 echo $abc;}
if (isset($msg))
{ echo "<br>";
echo $msg;}
?>
</fieldset></td>
</tr>
<tr>
<td><?php if ($totalRows_finallist > 0) { ?>
<fieldset><legend>Insurance File Upload History</legend>
<table border="0" cellspacing="0" cellpadding="1">
<tr>
<td>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td style="padding-left:3px;"><?php if ($pageNum_finallist > 0) { ?>
<a href="<?php printf("%s?pageNum_finallist=%d%s", $currentPage, 0, $queryString_finallist); ?>">First</a>
<?php } ?></td>
<?php if ($pageNum_finallist > 0) { ?>
<td width="10" align="center" style="padding-left:3px;"> | </td>
<td style="padding-left:3px;">
<a href="<?php printf("%s?pageNum_finallist=%d%s", $currentPage, max(0, $pageNum_finallist - 1), $queryString_finallist); ?>">Previous</a>
</td><?php } ?>
<?php if ($pageNum_finallist < $totalPages_finallist) { ?>
<td width="10" align="center" style="padding-left:3px;"> | </td>
<td style="padding-left:3px;">
<a href="<?php printf("%s?pageNum_finallist=%d%s", $currentPage, min($totalPages_finallist, $pageNum_finallist + 1), $queryString_finallist); ?>">Next</a>
</td><?php } ?>
<?php if ($pageNum_finallist < $totalPages_finallist) { ?>
<td width="10" align="center" style="padding-left:3px;"> | </td>
<td style="padding-left:5px;">
<a href="<?php printf("%s?pageNum_finallist=%d%s", $currentPage, $totalPages_finallist, $queryString_finallist); ?>">Last</a>
</td><?php } ?>
<td>&nbsp;</td>
<td width="100%" align="right">&nbsp;
Records <?php echo ($startRow_finallist + 1) ?> to <?php echo min($startRow_finallist + $maxRows_finallist, $totalRows_finallist) ?> of <?php echo $totalRows_finallist ?></td>
</tr>
</table></td>
</tr>
<tr>
<td>
<table border="1" align="left" cellpadding="2" class="basictable" bordercolor="#CCCCCC" cellspacing="0" style="border-collapse:collapse; border-color:#CCCCCC">
<tr><th align="center"><strong>Uploaded On</strong></th>
<th align="center"><strong>File</strong></th>
<th align="center"><strong>Size (Bytes)</strong></th>
<th align="center"><strong>Status</strong></th>
<th colspan="2" align="center"><strong>Imported Data</strong></th>
</tr>
<?php do { ?>
<tr>
<td align="center"><?php echo $row_finallist['datetime']; ?></td>
<td align="center"><a href="<?php echo ("upload/".$row_finallist['id'].$row_finallist['filelocation']); ?>"><?php echo $row_finallist['fname']; ?></a></td>
<td align="center"><?php echo $row_finallist['fsize']; ?></td>
<td align="center"><?php echo $row_finallist['status']; ?></td>
<td align="center"><a href="records.php?id=<?php echo $row_finallist['id']; ?>" target="_blank">View</a></td>
<td align="center"><a href="records.php?id=<?php echo $row_finallist['id']; ?>&amp;&amp;xls=export" target="_blank">Export</a></td>
</tr>
<?php } while ($row_finallist = mysql_fetch_assoc($finallist)); ?>
</table></td>
</tr>
</table>
</fieldset>
<?php } ?></td>
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
<?php
mysql_free_result($finallist);
?>
