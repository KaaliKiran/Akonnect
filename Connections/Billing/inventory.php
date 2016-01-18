<?php
if (isset($_POST['flushdb'])) { 
$q="Truncate table MASTER_HERELIST IMMEDIATE;";
odbc_exec($btest, $q) or die("<p>".odbc_errormsg());
$dbflush = "Database has been flushed";}


if ((isset($_GET['s'])) && ($_GET['s']==1)) $errStr = "File Uploaded & added to the Database successfully."; else $errStr = "";
if ((isset($_POST['MM_insert'])) && ($_POST['MM_insert']=="upload"))
{if (phpversion() > "4.0.6") { $HTTP_POST_FILES = &$_FILES; }
$_file_ = $HTTP_POST_FILES['uploaded'];
if(is_uploaded_file($_file_['tmp_name']) && $HTTP_POST_FILES['uploaded']['error'] == 0){
$_ext_ = explode(".", $_file_['name']);
$_ext_ = strtolower($_ext_[count($_ext_)-1]);
if (($_ext_!="csv") && count("csv") > 0) { $errStr = "Invalid File Format.. Please upload only formated csv file."; }
else if(!is_dir("./upload/") && is_writeable("./upload/")){ $errStr = "Destination folder error.. Please contact the administrator."; }
else { $insertSQL = sprintf("INSERT INTO FINALRESULT(FILELOCATION, FSIZE, FNAME, STATUS) VALUES (%s, %s, %s, %s)",
GetSQLValueString(".".$_ext_, "text"), GetSQLValueString($_file_['size'], "int"), GetSQLValueString($_file_['name'], "text"), GetSQLValueString("File Uploaded.", "text"));
$result=odbc_exec($btest, $insertSQL) or die("<p>".odbc_errormsg());

$max= "Select MAX(ID) as Maximum from FINALRESULT";
$maxi=odbc_exec($btest, $max) or die("<p>".odbc_errormsg());
$maxid=odbc_result($maxi, 1);
 
if(@copy($_file_['tmp_name'],"./upload/" . "/".$maxid."." . $_ext_)){
$target="./upload/" . "/".$maxid."." . $_ext_;
$handle = fopen($target, "r");
$i=0;
while (($data = fgetcsv($handle, 0, ",")) !== FALSE) { if ($i>0) {
if (($data[3]=="H1B") || ($data[3]=="H1") || ($data[3]=="H1 B")) $visaty = "H1"; else $visaty = $data[3];
echo $insertSQL = sprintf("INSERT INTO MASTER_HERELIST(EMPID, FIRSTNAME, LASTNAME, VISATYPE, WORKCITY, WORKSTATE, ACTSTARTDATE, I94EXPIRYDATE, PETEXPDT, TERMDATE, CLIENTNAME, IBMBUISNESSUNIT, COUNTER) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString(str_pad(trim($data[0]), 6, '0', STR_PAD_LEFT)."744", "text"),
GetSQLValueString($data[1], "text"), GetSQLValueString($data[2], "text"), GetSQLValueString($visaty, "text"), GetSQLValueString($data[4], "text"), GetSQLValueString($data[5], "text"), GetSQLValueString(date("Y-m-d", strtotime($data[6])), "date"), GetSQLValueString(date("Y-m-d", strtotime($data[7])), "date"), GetSQLValueString(date("Y-m-d", strtotime($data[8])), "date"), GetSQLValueString(date("Y-m-d", strtotime($data[9])), "date"), GetSQLValueString($data[10], "text"), GetSQLValueString($data[11], "text"), GetSQLValueString($maxid, "int"));
odbc_exec($btest, $insertSQL) or die("<p>".odbc_errormsg());

} else $i = $i +1; }	
fclose($handle);
$errStr = "File Uploaded & added to the Database successfully.";
header("Location: " . "fileupd.php?s=1");
} else { $errStr = "File Uploaded but not added to the Database."; }}}}


	 if(isset($_POST['update1']))
	 {
	  $B= "update MASTER_HERELIST set I94EXPIRYDATE= '".$_POST['i94']."', PETEXPDT= '".$_POST['petexpdt1']."' where ID= '".$_POST['updid']."'";
      odbc_exec($btest, $B) or die("<p>".odbc_errormsg());
	  $abc="Records have been updated Successfully";
	 }
		
		if(isset($_POST['delete1']))
	    {		    
		$B= "Delete from MASTER_HERELIST where ID= '".$_POST['id1']."'";
        odbc_exec($btest, $B) or die("<p>".odbc_errormsg());
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
<?php if (($_SESSION['MM_Empid']=="087183744") || ($_SESSION['MM_Empid']=="AVDXY1744")) { ?>
<td valign="middle"><form id="form2" name="form2" method="post" action="">
<input type="submit" name="flushdb" id="flushdb" value="Flush Database" />
<span style="color:#FF0000; font-weight:bold"><?php if (isset($dbflush)) echo ($dbflush); ?></span>
</form></td>
<?php } ?>
</tr>
<tr>
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
<?php if ($totalRows_finallist > 0) { ?>
<fieldset><legend>GAT List</legend>
<form enctype="multipart/form-data" action="fileupd.php" method="POST">
   <input type="text" name="serch" id="serch" size="30">
   <input type="submit" name="search" id="search" value="Search">
 </form>

<?php  
if(isset($_POST['serch']))
{
			   
    $con=odbc_connect("DRIVER={IBM DB2 ODBC DRIVER};DATABASE=IIS;HOSTNAME=9.184.114.113;PORT=60000;PROTOCOL=TCPIP;CurrentSchema=DB2INST1;", 'iisrdr', 'iisrdr');
    echo $B= "select * from MASTER_HERELIST where EMPID LIKE 'AVDXY1' OR FIRSTNAME LIKE '%".$_POST['serch']."%' OR LASTNAME LIKE '%".$_POST['serch']."%'";
    $result=odbc_exec($con, $B) or die("<p>".odbc_errormsg());
	echo $num=odbc_num_rows($result);
    
	    if(!$num)
			{
	      	    echo "<strong>Notice : </strong> There are no records found as per the search criterion.";}
		    else
	        {				  
				echo "<table border='1' cellpadding='2' class='basictable' cellspacing='0'>";
				echo"<caption>GAT List - Search Results for ".$_POST['serch']." | ".$num." records found</caption>";
				echo "<tr>";
				echo "<th>First Name</th>";
				echo "<th>Last Name</th>";
			    echo "<th>EMPID</th>";
				echo "<th>I94 Expiry Date</th>";
				echo "<th>Petition Expiry Date</th>";
				echo "<th>Reminder-1</th>";
				echo "<th>Reminder-2</th>";
				echo "<th>Reminder-3</th>";
                echo "<th>Email</th>";
                echo"<th>Update</th>";				 
				echo"<th>Delete</th>";	
		    while($row = odbc_fetch_array($result))
	        {	 echo "<tr>";
				 echo "<td>".$row['FIRSTNAME']."</td>";
			     echo "<td>";
				 echo $row['LASTNAME'];	
				 echo "</td>";
                 echo "<td>"; 
				 echo "<form enctype=\"multipart/form-data\" name=\"speciallist\" id=\"speciallist\" action=\"fileupd.php\" method=\"POST\">";	   
				 echo $empids= $row['EMPID'];
				 echo "</td>";
				 echo"<td align='center'>";  
				 echo $row['I94EXPIRYDATE'];	  
				 echo"</td>";
				 echo"<td align='center'>";  
				 echo $row['PETEXPDT'];
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['REM1SENTON'] == 0){ echo "Null";} else {echo $row['REM1SENTON'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['REM2SENTON'] == 0){ echo "Null";} else {echo $row['REM2SENTON'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['REM3SENTON'] == 0){ echo "Null";} else {echo $row['REM3SENTON'];}
				 echo"</td>";
				 echo"<td>";
				 echo "<input type=\"submit\" value=\"email\" id=\"email\" name=\"email\" method=\"POST\">";
				 echo"</td>";
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"update\" id=\"update\" value=\"Update\">";
				 echo"</td>";
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"delete\" id=\"delete\" value=\"Delete\">";
				 echo "<input type=\"hidden\" value=\"$empids\" name=\"eid\" id=\"eid\"><input type=\"hidden\" value=\"".$row['FIRSTNAME']."\" name=\"empname2\" id=\"empname2\"><input type=\"hidden\" value=\"".$row['ID']."\" name=\"id2\" id=\"id2\">";
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
		$con=odbc_connect("DRIVER={IBM DB2 ODBC DRIVER};DATABASE=IIS;HOSTNAME=9.184.114.113;PORT=60000;PROTOCOL=TCPIP;CurrentSchema=DB2INST1;", 'iisrdr', 'iisrdr');
 	    $B= "select * from master_herelist ORDER BY ID DESC";
        $result=odbc_exec($con, $B) or die("<p>".odbc_errormsg());
        $num=odbc_num_rows($result);
	      		
		    if($num==0)
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
				 echo "<th>EMPID</th>";
				 echo "<th>I94 Expiry Date</th>";
				 echo "<th>Petition Expiry Date</th>";
				 echo "<th>Reminder-1</th>";
				 echo "<th>Reminder-2</th>";
				 echo "<th>Reminder-3</th>";
                 echo "<th>Email</th>";
                 echo"<th>Update</th>";				 
				 echo"<th>Delete</th>";	
		    while($row = odbc_fetch_array($result) )
	        {	
	             echo"<tr>";
			     echo"<td>";
			     echo $row['FIRSTNAME'];
			     echo "</td>";
			     echo"<td>";
				 echo $row['LASTNAME'];	
				 echo"</td>";
                 echo"<td>"; 
				 echo "<form enctype=\"multipart/form-data\" name=\"speciallist\" id=\"speciallist\" action=\"fileupd.php\" method=\"POST\">";	   
				 echo $empids= $row['EMPID'];
				 echo "</td>";
				 echo"<td align='center'>";  
				 echo $row['I94EXPIRYDATE'];	  
				 echo"</td>";
				 echo"<td align='center'>";  
				 echo $row['PETEXPDT'];
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['REM1SENTON'] == 0){ echo "Null";} else {echo $row['REM1SENTON'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['REM2SENTON'] == 0){ echo "Null";} else {echo $row['REM2SENTON'];}
				 echo"</td>";
				 echo"<td align='center'>";
				 if( $row['REM3SENTON'] == 0){ echo "Null";} else {echo $row['REM3SENTON'];}
				 echo"</td>";
				 echo"<td>";
				 echo "<input type=\"submit\" value=\"email\" id=\"email\" name=\"email\" method=\"POST\">";
				 echo"</td>";
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"update\" id=\"update\" value=\"Update\">";
				 echo"</td>";
				 echo"<td align='center'>";
				 echo "<input type=\"submit\" name=\"delete\" id=\"delete\" value=\"Delete\">";
				 echo "<input type=\"hidden\" value=\"$empids\" name=\"eid\" id=\"eid\"><input type=\"hidden\" value=\"".$row['FIRSTNAME']."\" name=\"empname2\" id=\"empname2\"><input type=\"hidden\" value=\"".$row['ID']."\" name=\"id2\" id=\"id2\">";
				 echo"</form>";
				 echo"</td>";
				 
				 echo"</tr>";
    	}
		echo"</td>";
	    echo"</tr>";
		echo"</table>";
		
	}
	
					  }
					  
					  if(isset($_POST['delete']))
	    {	
		echo "<br><form enctype=\"multipart/form-data\" name=\"speciallis\" id=\"speciallis\" action=\"fileupd.php\" method=\"POST\">";	  
        echo"<table border='1' cellpadding='2' cellspacing='2' class='basictable'>";
		echo "<tr>";
		echo "<th align='left'>Do You really want to delete the record of ".$_POST['empname2'].".</th>";
		echo "<td><input type=\"hidden\" name=\"id1\" id=\"id1\" value=\"".$_POST['id2']."\"> <input type=\"submit\" name=\"delete1\" id=\"delete1\" value=\"Delete\"> <input type=\"submit\" name=\"cancel1\" id=\"cancel1\" value=\"Cancel\"></td>";
		echo "</tr>";
		echo "</table></form>";
         }
		 if(isset($_POST['update']))
	    {
		  
		
 	    $B= "select * from MASTER_HERELIST where ID= '".$_POST['id2']."'";
         $result1=odbc_exec($btest, $B) or die("<p>".odbc_errormsg());
		$row = odbc_fetch_array($result1);
		
		echo "<br><form enctype=\"multipart/form-data\" name=\"speciallis\" id=\"speciallis\" action=\"fileupd.php\" method=\"POST\">";	  
        echo"<table border='1' cellpadding='2' cellspacing='2' class='basictable'>";
	    echo"<caption>Update Details</caption>";
	
			 echo "<tr>";
			 echo "<th align='left'>First Name</th>";
			 echo "<td align='left'>".$row['FIRSTNAME']."</td>";
			 echo "</tr>";
			 
			 echo "<tr>";
			 echo "<th align='left'>Last Name</th>";
			 echo "<td align='left'>".$row['LASTNAME']."</td>";
			 echo "</tr>";
			 
			 echo "<tr>";
			 echo "<th align='left'>Employee ID</th>";
			 echo "<td align='left'>".$row['EMPID']."</td>";
			 echo "</tr>";
			 
			 echo "<tr>";
			 echo "<th align='left'>I94 Expiry Date</th>";
			 echo "<td align='left'><input type='text' id='i94' name='i94' value='".$row['I94EXPIRYDATE']."'></td>";
			 echo "</tr>";
			 
			 echo "<tr>";
			 echo "<th align='left'>Petition Expiry Date</th>";
			 echo "<td align='left'><input type='text' id='petexpdt1' name='petexpdt1' value='".$row['PETEXPDT']."'><input type=\"hidden\" value=\"$empids\" name=\"eid\" id=\"eid\"></td>";
			 echo "</tr>";
			 
			 echo"<tr>";
			 echo"<td align='right'><input type=\"submit\" name=\"cancel1\" id=\"cancel1\" value=\"Cancel\"></td><td><input type=\"hidden\" name=\"updid\" id=\"updid\" value=\"".$_POST['id2']."\"><input type=\"submit\" name=\"update1\" id=\"update1\" value=\"Update\"></td>";
			 echo"</tr>";
			 echo"</table></form>";
         }          
	 ?>
<?php } ?>
</td>
</fieldset>
</tr>

<tr>
<td><?php if ($totalRows_finallist > 0) { ?>
<fieldset><legend>File Upload History</legend>
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
<td align="center"><?php echo $row_finallist['DATETIME']; ?></td>
<td align="center"><a href="<?php echo ("upload/".$row_finallist['ID'].$row_finallist['FILELOCATION']); ?>"><?php echo $row_finallist['FNAME']; ?></a></td>
<td align="center"><?php echo $row_finallist['FSIZE']; ?></td>
<td align="center"><?php echo $row_finallist['STATUS']; ?></td>
<td align="center"><a href="records.php?id=<?php echo $row_finallist['ID']; ?>" target="_blank">View</a></td>
<td align="center"><a href="records.php?id=<?php echo $row_finallist['ID']; ?>&amp;&amp;xls=export" target="_blank">Export</a></td>
</tr>
<?php } while ($row_finallist = odbc_fetch_array($finallist)); ?>
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
odbc_free_result($finallist);
?>
