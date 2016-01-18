<?php require_once('../Connections/itest.php'); ?>

<?php
if (isset($_GET['xls'])&&($_GET['xls']=="export")){
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=records.xls");
	header("Content-Type: application/force-download");
	header("Cache-Control: post-check=0, pre-check=0", false);
} 
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_filedet = "-1";
if (isset($_GET['id'])) {
  $colname_filedet = $_GET['id'];
}
mysql_select_db($database_itest, $itest);
$query_filedet = sprintf("SELECT * FROM timetablestore1 WHERE `counter` = %s", GetSQLValueString($colname_filedet, "int"));
$filedet = mysql_query($query_filedet, $itest) or die(mysql_error());
$row_filedet = mysql_fetch_assoc($filedet);
$totalRows_filedet = mysql_num_rows($filedet);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
<title>Untitled Document</title>
</head>

<body>
<?php if ($totalRows_filedet > 0) { // Show if recordset not empty ?>
  <table border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse:collapse; border-color:#CCCCCC;">
    <tr>
      <td align="center" bgcolor="#CCCCCC">Employee ID</td>
      <td bgcolor="#CCCCCC">First Name</td>
      <td bgcolor="#CCCCCC">Last Name</td>
      <td align="center" bgcolor="#CCCCCC">Visa Type</td>
      <td align="center" bgcolor="#CCCCCC">Work City</td>
      <td align="center" bgcolor="#CCCCCC">Work State</td>
      <td align="center" bgcolor="#CCCCCC">Account Start Date</td>
      <td align="center" bgcolor="#CCCCCC">i94 Expiry Date</td>
      <td align="center" bgcolor="#CCCCCC">Term Date</td>
      <td align="center" bgcolor="#CCCCCC">Client Name</td>
      <td align="center" bgcolor="#CCCCCC">IBM Buisness Unit</td>
    </tr>
    <?php do { ?>
      <tr>
        <td align="center"><?php echo $row_filedet['empid']; ?></td>
        <td><?php echo $row_filedet['firstname']; ?></td>
        <td><?php echo $row_filedet['lastname']; ?></td>
        <td align="center"><?php echo $row_filedet['visatype']; ?></td>
        <td align="center"><?php echo $row_filedet['workcity']; ?></td>
        <td align="center"><?php echo $row_filedet['workstate']; ?></td>
        <td align="center"><?php echo $row_filedet['actstartdate']; ?></td>
        <td align="center"><?php echo $row_filedet['i94expirydate']; ?></td>
        <td align="center"><?php echo $row_filedet['termdate']; ?></td>
        <td align="center"><?php echo $row_filedet['clientname']; ?></td>
        <td align="center"><?php echo $row_filedet['ibmbuisnessunit']; ?></td>
      </tr>
      <?php } while ($row_filedet = mysql_fetch_assoc($filedet)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_filedet == 0) { // Show if recordset empty ?>
  No Data Uploaded
  <?php } // Show if recordset empty ?>
</body>
</html>
<?php
mysql_free_result($filedet);
?>
