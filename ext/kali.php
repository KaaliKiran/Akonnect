<?php require_once('../Connections/itest.php'); ?>
<?php require_once('../Connections/session.php'); ?>

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
$query_finallist = "SELECT * FROM master_herelist ORDER BY id DESC";
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
if (isset($_POST['flushdb'])) { $y="TRUNCATE TABLE master_herelist;";
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
else { $insertSQL = sprintf("INSERT INTO finalresult (filelocation, fsize, fname, status) VALUES (%s, %s, %s, %s)",
GetSQLValueString(".".$_ext_, "text"), GetSQLValueString($_file_['size'], "int"), GetSQLValueString($_file_['name'], "text"), GetSQLValueString("File Uploaded.", "text"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($insertSQL, $itest) or die(mysql_error());
$maxid = mysql_insert_id();
if(@copy($_file_['tmp_name'],"./upload/" . "/".$maxid."." . $_ext_)){
$target="./upload/" . "/".$maxid."." . $_ext_;
$handle = fopen($target, "r");
$i=0;
while (($data = fgetcsv($handle, 0, ",")) !== FALSE) { if ($i>0) {
if (($data[3]=="H1B") || ($data[3]=="H1") || ($data[3]=="H1 B")) $visaty = "H1"; else $visaty = $data[3];
$insertSQL = sprintf("INSERT HIGH_PRIORITY IGNORE INTO master_herelist (empid, firstname, lastname, visatype, workcity, workstate, actstartdate, i94expirydate, termdate, clientname, ibmbuisnessunit, counter) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString(str_pad(trim($data[0]), 6, '0', STR_PAD_LEFT)."744", "text"),
GetSQLValueString($data[1], "text"), GetSQLValueString($data[2], "text"), GetSQLValueString($visaty, "text"), GetSQLValueString($data[4], "text"), GetSQLValueString($data[5], "text"), GetSQLValueString(date("Y-m-d", strtotime($data[6])), "date"), GetSQLValueString(date("Y-m-d", strtotime($data[7])), "date"), GetSQLValueString(date("Y-m-d", strtotime($data[8])), "date"), GetSQLValueString($data[9], "text"), GetSQLValueString($data[10], "text"), GetSQLValueString($maxid, "int"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($insertSQL, $itest) or die(mysql_error());
} else $i = $i +1; }
fclose($handle);
$errStr = "File Uploaded & added to the Database successfully.";
header("Location: " . "fileupd.php?s=1");
} else { $errStr = "File Uploaded but not added to the Database."; }}}}

	 if(isset($_POST['update1']))
	          {
		               $con = mysql_connect('localhost', 'test', '');
        if (!$con)
            {
		        die('Could not connect: ' . mysql_error());
                }
		Mysql_select_db("test", $con);
		
 	    $B= "update master_herelist set i94expirydate= '".$_POST['i94']."' where empid= '".$_POST['eid']."'";
        $result1 = mysql_query($B) or die(mysql_error());
		$abc="Records have been updated Successfully";
		}
		
		if(isset($_POST['delete1']))
	    {
		    $con = mysql_connect('localhost', 'test', '');
             if (!$con)
                {
		        die('Could not connect: ' . mysql_error());
                }
		Mysql_select_db("test", $con);
		
		$B= "Delete from master_herelist where empid= '".$_POST['eid']."'";
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

</td>

<a href="mailto:Kali T Kiran/India/Contr/IBM" name="kk" id="kk">kali </a>
</body>


</html>