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
$colname_petdet = "-1";

if (isset($_SESSION['MM_Empid'])) {
 $colname_petdet = $_SESSION['MM_Empid']; }
 
 
mysql_select_db($database_itest, $itest);
$query_petdet = sprintf("SELECT * FROM master_herelist WHERE empid = %s AND responsereceived = 0", GetSQLValueString($colname_petdet, "text"));
$petdet = mysql_query($query_petdet, $itest) or die(mysql_error());
$row_petdet = mysql_fetch_assoc($petdet);

$totalRows_petdet = mysql_num_rows($petdet);
$mhidval = $row_petdet['id'];
$colname_iformdet = "-1";

if (isset($_SESSION['MM_Empid'])) {
$colname_iformdet = $_SESSION['MM_Empid'];}
$colnamee_iformdet = "-1";
if (isset($mhidval)) { $colnamee_iformdet = $mhidval;}
mysql_select_db($database_itest, $itest);
$query_iformdet = sprintf("SELECT * FROM empi94details WHERE empid = %s AND mhid = %s", GetSQLValueString($colname_iformdet, "text"),GetSQLValueString($colnamee_iformdet, "int"));
$iformdet = mysql_query($query_iformdet, $itest) or die(mysql_error());
$row_iformdet = mysql_fetch_assoc($iformdet);
$totalRows_iformdet = mysql_num_rows($iformdet);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "iform")) {
$updateSQL = sprintf("UPDATE empi94details SET mhid=%s, iexpdat=%s, petexpdt=%s, departureno=%s, birthdate=%s, familyname=%s, givenfname=%s, extensionstatus=%s WHERE id=%s",
GetSQLValueString($_POST['mhid'], "int"), GetSQLValueString($_POST['iexpdat'], "date"),GetSQLValueString($_POST['petexpdat'], "date"), GetSQLValueString($_POST['departno'], "text"), GetSQLValueString($_POST['bdate'], "date"), GetSQLValueString($_POST['familyname'], "text"), GetSQLValueString($_POST['firstname'], "text"), GetSQLValueString($_POST['choice'], "int"), GetSQLValueString($_POST['id'], "int"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($updateSQL, $itest) or die(mysql_error());
if ($_POST['choice']==0) { $updateSQL = sprintf("UPDATE master_herelist set responsereceived=1, newi94date=%s where id=%s",
GetSQLValueString($_POST['iexpdat'], "date"),
GetSQLValueString($_POST['mhid'], "int"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($updateSQL, $itest) or die(mysql_error());}
$updateGoTo = "iform.php";
if (isset($_SERVER['QUERY_STRING'])) { $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
$updateGoTo .= $_SERVER['QUERY_STRING']; }
header(sprintf("Location: %s", $updateGoTo));}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "iform")) {
echo $insertSQL = sprintf("INSERT INTO empi94details (empid, mhid, iexpdat, petexpdt,departureno, birthdate, familyname, givenfname, extensionstatus) VALUES (%s,%s, %s, %s, %s, %s, %s, %s, %s)", GetSQLValueString($colname_iformdet, "text"), GetSQLValueString($_POST['mhid'], "int"), GetSQLValueString($_POST['iexpdat'], "date"),GetSQLValueString($_POST['petexpdat'], "date"), GetSQLValueString($_POST['departno'], "text"), GetSQLValueString($_POST['bdate'], "date"), GetSQLValueString($_POST['familyname'], "text"), GetSQLValueString($_POST['firstname'], "text"), GetSQLValueString($_POST['choice'], "int"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($insertSQL, $itest) or die(mysql_error());
if ($_POST['choice']==0) { $updateSQL = sprintf("UPDATE master_herelist set responsereceived='1', newi94date=%s where id=%s",
GetSQLValueString($_POST['iexpdat'], "date"),
GetSQLValueString($_POST['mhid'], "int"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($updateSQL, $itest) or die(mysql_error());}
$insertGoTo = "iform.php";
header(sprintf("Location: %s", $insertGoTo)); }
if ((isset($_POST['sub'])) && ($_POST['sub']=="final"))
{ $updateSQL = sprintf("UPDATE empi94details set extreason=%s where id=%s AND mhid=%s",
GetSQLValueString($_POST['extreason'], "text"), GetSQLValueString($row_iformdet['id'], "int"), GetSQLValueString($row_petdet['id'], "int"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($updateSQL, $itest) or die(mysql_error());
$updateSQL = sprintf("UPDATE master_herelist set responsereceived='1', fileuploadstatus='1', filelocation1=%s, filelocation2=%s where id=%s",
GetSQLValueString($_POST['fupdone'], "text"), GetSQLValueString($_POST['fupdtwo'], "text"), GetSQLValueString($row_petdet['id'], "int"));
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($updateSQL, $itest) or die(mysql_error());
$insertGoTo = "iform.php";
header(sprintf("Location: %s", $insertGoTo)); }
$x= 0; if(isset($_SESSION['MM_Empid'])) {$x= $_SESSION['MM_Empid'];} ?>
<?php

if (isset($_POST['upload']))
{ $file_name = ( $_FILES['uploaded']['name']);
$type = $_FILES['uploaded']['type'];
$size=  $_FILES['uploaded']['size'];
$ok=1;
if(($_FILES['uploaded']['type'])!= "image/jpeg")
{ $msg1= "can not upload the file as its not a JPG file";
$ok=0; }
else
{ echo $target = "upload/".$_SESSION['MM_Empid']."/";
mkdir($target);
$tempname= basename( $_FILES['uploaded']['name']); 						   
$target = $target.$tempname;
$A="update empi94details SET filelocation1='".$target."' where id=".$row_iformdet['id']." AND mhid=" . $row_petdet['id'];
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($A, $itest) or die(mysql_error());
$A="update master_herelist SET filelocation1='".$target."' where id=". $row_petdet['id'];
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($A, $itest) or die(mysql_error());
(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)); }
header(sprintf("Location: %s", "iform.php")); }


if (isset($_POST['upload1']))
{ $file_name = ( $_FILES['uploaded1']['name']);
$type = $_FILES['uploaded1']['type'];
$size=  $_FILES['uploaded1']['size'];
$ok=1;
if(($_FILES['uploaded1']['type'])!= "image/jpeg")
{ $msg1= "can not upload the file as its not a JPG or Gif or Png file";
$ok=0; }
else
{ echo $target = "upload/".$_SESSION['MM_Empid']."/";
mkdir($target);
$tempname= basename( $_FILES['uploaded1']['name']); 						   
$target = $target.$tempname;
$A="update empi94details SET filelocation2='".$target."' where id=".$row_iformdet['id']." AND mhid=" . $row_petdet['id'];
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($A, $itest) or die(mysql_error());
$A="update master_herelist SET filelocation2='".$target."' where id=". $row_petdet['id'];
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($A, $itest) or die(mysql_error());
(move_uploaded_file($_FILES['uploaded1']['tmp_name'], $target)); }
header(sprintf("Location: %s", "iform.php")); }

if (isset($_POST['upload2']))
{ $file_name = ( $_FILES['uploaded2']['name']);
$type = $_FILES['uploaded2']['type'];
$size=  $_FILES['uploaded2']['size'];
$ok=1;
if(($_FILES['uploaded2']['type'])!= "image/jpeg")
{ $msg1= "can not upload the file as its not a JPG or Gif or Png file";
$ok=0; }
else
{ echo $target = "upload/".$_SESSION['MM_Empid']."/";
mkdir($target);
$tempname= basename( $_FILES['uploaded2']['name']); 						   
$target = $target.$tempname;
$A="update empi94details SET filelocation3='".$target."' where id=".$row_iformdet['id']." AND mhid=" . $row_petdet['id'];
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($A, $itest) or die(mysql_error());
$A="update master_herelist SET filelocation3='".$target."' where id=". $row_petdet['id'];
mysql_select_db($database_itest, $itest);
$Result1 = mysql_query($A, $itest) or die(mysql_error());
(move_uploaded_file($_FILES['uploaded2']['tmp_name'], $target)); }
header(sprintf("Location: %s", "iform.php")); }

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
<meta name="DC.Rights" content=" Copyright IBM Corp. 2011"/>
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
<meta name="Copyright" content=" Copyright IBM Corp. 2011 - Global Immigration" />
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
<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
<title>Validate i-94 Form Details</title>
<link href="../scripts/calendar/calendar.css" type="text/css" rel="stylesheet" />
<script src="../scripts/calendar/jsl.js" type="text/javascript"></script>
<script src="../scripts/calendar/common.js" type="text/javascript"></script>
<script src="../scripts/calendar/calendar.js" type="text/javascript"></script>

<script type="text/javascript">
function init() {
	calendar.set("bdate");
	calendar.set("iexpdat");
}
</script>
<script>
function birthdate(str, str1)
{
  
if (str.length==0)
  {
  document.getElementById("txtHint2").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
	    }
  }
xmlhttp.open("GET","bdatevalidate.php?q="+str +"&q1="+str1 ,true);
xmlhttp.send();
}

function deptno(str, str1)
{
  
if (str.length==0)
  {
  document.getElementById("txtHint1").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
	    }
  }
xmlhttp.open("GET","deptnovalidate.php?q="+str +"&q1="+str1 ,true);
xmlhttp.send();
}
function familyname(str, str1)
{
  
if (str.length==0)
  {
  document.getElementById("txtHint3").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint3").innerHTML=xmlhttp.responseText;
	    }
  }
xmlhttp.open("GET","familynamevalidate.php?q="+str +"&q1="+str1 ,true);
xmlhttp.send();
}


function firstname(str, str1)
{
  
if (str.length==0)
  {
  document.getElementById("txtHint4").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint4").innerHTML=xmlhttp.responseText;
	    }
  }
xmlhttp.open("GET","firstnamevalidate.php?q="+str +"&q1="+str1 ,true);
xmlhttp.send();
}

</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<?php // if ($totalRows_petdet > 0) 
{ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<th height="35" align="left" valign="middle" style="font-size:20px"><strong>Validate i-94 Form Details</strong></th>
</tr>
<tr>
<td><hr style="border-bottom: #333 1px solid"/></td>
</tr>
<tr>
<td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<form name="iform" action="<?php echo $editFormAction; ?>" method="POST" id="iform">
<fieldset>  
<legend>I94 Form Details</legend>
Note: Please Enter the Accurate Details as per I94 Copy and click on the Proceed Button. In case of extension upload appropriate Artifacts.<br> <br>
<table border="0" cellspacing="0" cellpadding="2" class="basictable">
<tr>
<th valign="top" align="left">I94 Expiry Date :</th>
<td><input name="iexpdat" type="text" id="iexpdat" onfocus="document.iform.iexpdat.click();" value="<?php if ($row_iformdet['iexpdat']=="") echo $row_petdet['i94expirydate']; else echo $row_iformdet['iexpdat']; ?>" size="12" />
<img src="../images/date_icon.gif" alt="" width="22" height="20" border="0" class="element12pxmid" onclick="document.iform.iexpdat.click();" /><span id="txtHint5"></span></td>
<th valign="top" align="left">Petition Expiry Date :</th>
<td><input name="petexpdat" type="text" id="petexpdat" onfocus="document.iform.petexpdat.click();" value="<?php if ($row_iformdet['petexpdt']=="") echo $row_petdet['petexpdt']; else echo $row_iformdet['petexpdt']; ?>" size="12" />
<img src="../images/date_icon.gif" alt="" width="22" height="20" border="0" class="element12pxmid" onclick="document.iform.iexpdat.click();" /><span id="txtHint5"></span></td>
</tr>
<tr>
<th valign="top" align="left">Departure Number : </th>
<td><input name="departno" type="text" id="echo $_POST['departno'];" onBlur="deptno(this.value,'deptnoverify');" value="<?php echo $row_iformdet['departureno']; ?>" size="25"><span id="txtHint1"></br></span></td>
<th valign="top" align="left">Birth Date : yyyy-mm-dd</th>
<td><input name="bdate" type="text" id="bdate" onFocus="document.iform.bdate.click();" onBlur="birthdate(this.value,'bdateveriy');" value="<?php echo $row_iformdet['birthdate']; ?>" size="12" readonly /> <img src="../images/date_icon.gif" width="22" height="20" border="0" class="element12pxmid" onClick="document.iform.bdate.click();" /><span id="txtHint2"></span></td>
</tr>
<tr>
<th valign="top" align="left">Family Name : </th>
<td><input name="familyname" type="text" onBlur="familyname(this.value,'familyverify');" value="<?php echo $row_iformdet['familyname']; ?>" size="25"><span id="txtHint3"></span></td>
<th valign="top" align="left">First Name (Given) :</th>
<td><input name="firstname" type="text" onBlur="firstname(this.value,'fnameveriy');" value="<?php echo $row_iformdet['givenfname']; ?>" size="25"><span id="txtHint4"></span></td>
</tr>
<tr>
<td colspan="3" align="left">Do you want an extension? 
<input <?php if (!(strcmp($row_iformdet['extensionstatus'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="choice" value="1" onClick="onselect="formSubmit();" onselect="formSubmit();">
YES <input <?php if (!(strcmp($row_iformdet['extensionstatus'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="choice" value="0" onClick="onselect="formSubmit();" onselect="formSubmit();">
NO
<?php if ($totalRows_iformdet == 0) { ?>
<input type="hidden" name="MM_insert" value="iform" />
<?php } ?>      <input name="mhid" type="hidden" id="mhid" value="<?php echo $row_petdet['id']; ?>" /></td>
<td align="right"><?php if ($totalRows_iformdet > 0) { ?>
<input type="hidden" name="MM_update" value="iform" />
<input name="id" type="hidden" id="id" value="<?php echo $row_iformdet['id']; ?>" />
<?php } ?>
<input type="submit" value="Proceed" name="proceed" id="proceed"></td>
</tr>
</table>
</fieldset>
</form>                			  
<?php if (($totalRows_iformdet > 0) &&  ($row_iformdet['extensionstatus'] == 1)) { ?>					  

<fieldset>
<legend>Artifact Upload Wizard</legend>

<table cellpadding="2" cellspacing="0">

<tr>
<td>Please upload a valid copyy of I94 (jpg): </td>
<td>&nbsp;</td>
<td><form enctype="multipart/form-data" action="iform.php" method="POST" id="f1"> <input id="uploaded" name="uploaded" type="file" />
<input type="submit" id="upload" value="Upload" name="upload"/></form>	
</td>
<td><?php if ($row_iformdet['filelocation1']!="") { ?><a href="<?php echo $row_iformdet['filelocation1']; ?>" target="_blank">File Uploaded</a><?php } ?></td>
</tr>

<tr>
<td>Please upload a valid copyy of Petition Expiry date Document (jpg): </td>
<td>&nbsp;</td>
<td><form enctype="multipart/form-data" action="iform.php" method="POST" id="f2"> <input id="uploaded1" name="uploaded1" type="file" />
<input type="submit" id="upload1" value="Upload" name="upload1"/></form>	
</td>
<td><?php if ($row_iformdet['filelocation2']!="") { ?><a href="<?php echo $row_iformdet['filelocation2']; ?>" target="_blank">File Uploaded</a><?php } ?></td>
</tr>

<tr>
<td>Please upload a valid copy of the Passport (jpg): </td>
<td>&nbsp;</td>
<td><form enctype="multipart/form-data" action="iform.php" method="POST" id="f3"> <input id="uploaded2" name="uploaded2" type="file" />
<input type="submit" id="upload2" value="Upload" name="upload2"/></form>	
</td>

<td><?php if ($row_iformdet['filelocation3']!="") { ?><a href="<?php echo $row_iformdet['filelocation3']; ?>" target="_blank">File Uploaded</a><?php } ?></td>
</tr>	  
<tr>
<td>Reason for extension : </td>
<td>&nbsp;</td>
<td colspan="2"><form id="form1" name="form1" method="post" action=""> 
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td align="left"><label for="extreason"></label>
<input name="extreason" type="text" id="extreason" size="50" maxlength="250" /></td>
<td align="right" valign="middle"><input name="fupdtwo" type="hidden" id="fupdtwo" value="<?php echo $row_iformdet['filelocation2']; ?>" />
<input name="fupdone" type="hidden" id="fupdone" value="<?php echo $row_iformdet['filelocation1']; ?>" />
<input name="sub" type="hidden" id="sub" value="final" /><?php if (($row_iformdet['filelocation1']!="") && ($row_iformdet['filelocation2']!="")) { ?><input type="submit" name="Submit" id="Submit" value="Submit" /><?php } ?></td>
</tr>
</table>
</form></td>
</tr>
</table>
</fieldset>  
<?php } ?></td>
</tr>
</table></td>
</tr>
<tr>
<td></td>
</tr>
</table><?php } ?></td>
</tr>
</table>
</body>
</html>
<?php
mysql_free_result($iformdet);

mysql_free_result($petdet);
?>
