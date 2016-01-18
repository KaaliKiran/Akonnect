<?php require_once('../Connections/itest.php'); ?>
<?php

       if (!function_exists("GetSQLValueString")) {
				function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
					{ 
					if (PHP_VERSION < 6) 
					    {$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue; }
					$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
					}
				
					$currentPage = $_SERVER["PHP_SELF"];
  }
		$con = mysql_connect("localhost","root" ,"");
		if (!$con)
			{
			die('Could not connect: ' . mysql_error());
			}
		   // $insertSQL = sprintf("INSERT INTO inventory (PRODID, PRODDESC, UNITPRICE, TAXTYPE) VALUES ('4567', 'SACHIN', '564', 'A')");
	       mysql_select_db("test", $con); 
           // $Result1 = mysql_query($insertSQL, $con) or die(mysql_error());
           $i=1;
		   $handle = fopen("upload/Inventorylist.csv.xlsx", "r");
		   $data = fgetcsv($handle, 1000, ",");		
		while (($data = fgetcsv($handle, 0, ",")) !== FALSE)
		{ 
		  if ($i>0)
     		  {
				echo $insertSQL = sprintf("INSERT INTO repository(PRODID, PRODDESC, UNITPRICE, TAXTYPE) VALUES (%s, %s, %s, %s)",
				GetSQLValueString($data[1], "int"), GetSQLValueString($data[2], "text"), GetSQLValueString($data[3], "int"), GetSQLValueString($data[4], "text"));
				odbc_exec($itest, $insertSQL) or die("<p>".odbc_errormsg());
			  } 
			  else $i = $i +1; 
		}	
		    fclose($handle);
		    $errStr = "File Uploaded & added to the Database successfully.";
		    header("Location: " . "fileupd.php?s=1");				   
		   
		   
		   $query_iformdet = sprintf("SELECT * FROM repository");
           $iformdet = mysql_query($query_iformdet, $con) or die(mysql_error());
		   $row_iformdet = mysql_fetch_assoc($iformdet);		   
		   $totalRows_iformdet = mysql_num_rows($iformdet); ?>
		  <table border="1" align="left" cellpadding="2" class="basictable" bordercolor="#CCCCCC" cellspacing="0" style="border-collapse:collapse; border-color:#CCCCCC">
		   <tr>
		       <th>
			    PRODUCT ID
			   </th>
			   <th>
			    PRODUCT DESCRIPTION
			   </th>
			   <th>
			    UNIT PRICE
			   </th>			   
		   </tr>		  
		 <?php    do { ?>
             <tr>
             <td align="center"><?php echo $row_iformdet['PRODID']; ?></td>
			 <td align="center"><?php echo $row_iformdet['PRODDESC']; ?></td>
			 <td align="center"><?php echo $row_iformdet['UNITPRICE']; ?></td>
             </tr>
           <?php } while ($row_iformdet = mysql_fetch_assoc($iformdet)); ?>
		   </table>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="schema.DC" href="http://purl.org/DC/elements/1.0/"/>
	<link rel="SHORTCUT ICON" href="../images/logo.jpg"/>
	<meta name="Keywords" content="kms, IBM HR, Global Immigration, Knowledge Management, Knowledge"/>
	<meta name="Description" content="IBM CHQ - Global Immigration - HR : Knowledge Management Suite."/>
	<meta name="Abstract" content="IBM CHQ - Global Immigration - HR : Knowledge Management Suite."/>
	<meta name="IBM.Effective" scheme="W3CDTF" content="2013-11-15"/>
	<meta name="IBM.Industry" scheme="IBM_IndustryTaxonomy" content="ZZ" />
	<meta name="IBM.Country" content="US"/>
	<meta name="DC.Rights" content="© Copyright Phoenix Solutions 2013"/>
	<meta name="DC.Date" scheme="iso8601" content="2012-05-10"/>
	<meta name="DC.Subject" scheme="IBM_SubjectTaxonomy" content=""/>
	<meta name="DC.Language" scheme="rfc1766" content="en-US"/>
	<meta name="DC.Type" scheme="IBM_ContentClassTaxonomy" content="ZZ999"/>
	<meta name="DC.publisher" content="IBM Corporation" />
	<meta name="Security" content="Public"/>
	<meta name="Robots" content="index,follow"/>
	<meta name="Source" content="v17 Template Generator, Template 17.02"/>
	<meta name="Owner" content="Kali Kiran"/>
	<meta name="Feedback" content="kali.kiran@gmail.com" />
	<meta name="Language" content="en" />
	<meta name="Author" content="Kali Kiran" />
	<meta name="Copyright" content="© Copyright Phoenix Solutions 2013" />
	<meta name="Reply-to" content="kali.kiranh@gmail.com" />
	<meta name="document-class" content="Completed" />
	<meta name="document-classification" content="Software" />
	<meta name="document-rights" content="Copyrighted Work" />
	<meta name="document-type" content="Web Page" />
	<meta name="document-rating" content="General" />
	<meta name="document-distribution" content="IU" />
	<meta name="document-state" content="Dynamic" />
	<meta name="cache-control" content="Public" />
	<meta name="Publisher" content="Kali Kiran" />
	<meta name="Publisher-Email" content="kali.kiran@gmail.com" />
	<meta name="Placename" content="India" />
	<meta name="Contributors" content="Kali Kiran" />
	<title>ASKLEPIUS</title>
	<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
	</head>	
	<body>			
		
	</body>
   </html>