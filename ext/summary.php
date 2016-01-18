<?php require_once('../Connections/session.php'); ?>
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
        <th height="35" align="left" valign="middle" style="font-size:20px"><strong>H1B Extention Summary</strong></th>
      </tr>
      <tr>
        <td><hr style="border-bottom: #333 1px solid"/></td>
      </tr>
      <tr>
        <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
<fieldset>
 <legend>DASH BOARD</legend>
<table border="1" cellpadding="2" style="border-collapse:collapse" align="left" bordercolorlight="#CCCCCC">
				 
			<tr>
<td valign="left" width="350">			


<?php

$con = mysql_connect('localhost', 'aztoolz', 'bluehost');
             if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			Mysql_select_db("aztoolz", $con);
		
		   $future = mktime(0,0,0,date("m"),date("d")+180,date("Y"));
           $final=date("Y-m-d", $future);
		   $today= date("Y-m-d");
 
          $B= "select firstname, lastname, empid, i94expirydate from master_herelist where reminder1= '0' && i94expirydate <= '$final' && i94expirydate>'$today'";
          $result = mysql_query($B) or die(mysql_error());
          $num=mysql_numrows($result);
          
		   echo "<b>Reminder-1</b>: There are ".$num." Reminder1s Left to be attendeded";
		   
		    $future = mktime(0,0,0,date("m"),date("d")+195,date("Y"));
            $final=date("Y-m-d", $future);
			$today= date("Y-m-d");
 
	    $B= "select firstname, lastname, empid, i94expirydate from master_herelist where i94expirydate <= '$final' && i94expirydate > '$today' && reminder1='1' && reminder2='0' && responsereceived='0'";
        $result1 = mysql_query($B) or die(mysql_error());
         $num=mysql_numrows($result1);
		  	
          echo "<br><b>Reminder-2</b>: There are ".$num." Reminder2s Left to be attendeded";

         $future = mktime(0,0,0,date("m"),date("d")+210,date("Y"));
            $final=date("Y-m-d", $future);
			$today= date("Y-m-d");
 
	     $B= "select firstname, lastname, empid, i94expirydate from master_herelist where i94expirydate <= '$final' && i94expirydate > '$today' && reminder1='1' && reminder2='1' && reminder3='0' && responsereceived='0'";
         $result1 = mysql_query($B) or die(mysql_error());
         $num=mysql_numrows($result1);
		  	echo "<br><b>Reminder-3</b>: There are ".$num." Reminder3s Left to be attendeded";
            
?>
</td>
</tr>

</table>
</fieldset>
</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
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