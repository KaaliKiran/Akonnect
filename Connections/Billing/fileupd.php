<?php require_once('../Connections/itest.php'); ?>
<?php
//To Flush the database
$con = mysql_connect("localhost","root" ,"");
mysql_select_db("test", $con);
if (isset($_POST['flushdb'])) { $y="TRUNCATE TABLE repository;";
$resulty=mysql_query($y) or die(mysql_error());
$dbflush = "Database has been flushed";}
?>
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
//To upload the File into the Local Drive
if(isset($_POST['upload']))
	{
	  $file_name = ($_FILES['uploaded']['name']);
	  $file_name;
	  $file_name1 = explode('.',$file_name);
	  $file_name2 = "File Name:".$file_name;
	  $type = $_FILES['uploaded']['type'];
	  $type1= "File Type:".$type;	
	  $size=  $_FILES['uploaded']['size'];
	  $size1="File size:".$size;	  
		if(($_FILES['uploaded']['type'])!= "application/vnd.ms-excel")
			   {
				$msg= "Invalid File Format.. Please upload only formated csv file.";
				}
				else    
				 {				
				$target = "upload/";
				 $tempname= basename( $_FILES['uploaded']['name']); 						   
				$target = $target.$tempname; 	
				(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)); 
				$msg="File uploaded successfully";
				 }		 
				 $i=1;				
    
?>	

<?php 
						//To Import the data into the Database
						$connect = mysql_connect('localhost','root','');
						if (!$connect) {
						 die('Could not connect to MySQL: ' . mysql_error());
						 }
						$cid =mysql_select_db('test',$connect);
						define('CSV_PATH',$target);
						$csv_file = $target; ?>						  
									<?php		 
									//Reading the data from the files stored on the local drive line by line
									if (($getfile = fopen($csv_file, "r")) !== FALSE) 
									   { 
										$data = fgetcsv($getfile, 1000, ",");
										while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) 
											{
												 $num = count($data); 
												 for ($c=0; $c <1; $c++) 
													{
														 $result = $data; 
														 $str = implode(",", $result); 
														 $slice = explode(",", $str);
														 $col1 = $slice[0]; 
														 $col2 = $slice[1];
														 $col3 = $slice[2];
														 $col4 = $slice[3];
													  
													  // SQL Query to insert data into DataBase
														$query = "INSERT INTO repository(PRODID,PRODDESC,UNITPRICE,TAXTYPE)
															VALUES('".$col1."','".$col2."','".$col3."','".$col4."')";
															mysql_query($query, $connect );
															?> 													 
															
													<?php
												   }
											} 
										} 
	}//If (UPLOAD) loop									
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
<title>IIS</title>
<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
</head>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="300">
				    <table border="0" border="0" cellspacing="0" cellpadding="0">  
					<tr>
					<td><img src="../images/sbrts.jpg" alt="some_text" width="60" height="50"></td>
					<td><b>SBR TECHNOLOGY SERVICES</b></td>
					</tr>
					<tr>
					<td>Estd. 2008</td>
					</tr> 	            
					</table>										
				</td>
				<td>
					<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<font style="color:#C0C0C0; text-decoration:none; font:25px bold arial,sans-serif;"><strong>I&nbsp; 
					N&nbsp; V&nbsp; E&nbsp; N&nbsp; T&nbsp; O&nbsp; R&nbsp; Y&nbsp;</strong>
					  </font>
			    </td>
				<td width="200">&nbsp;</td>
			  </tr>
			   <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			</table>
		 </td>
	   </tr>	 
      <tr>
        <td align="left">
		    <table  border="0" align="left" cellpadding="0" cellspacing="0">
			 <tr>
			    <td>
				  <form enctype="multipart/form-data" action="fileupd.php" method="POST">
				  <input type="submit" name="flushdb" id="flushdb" value="Flush Database" />
				  </form>
				</td>
			  </tr>
			  <tr>
			    <td>
				  &nbsp;
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
                <tr>
                    <td width="400">
						<form enctype="multipart/form-data" action="fileupd.php" method="POST">
							 <fieldset>
								 <legend>Inventory Upload Wizard</legend>
										 Please upload the File as in the sample Format
									<table border="0" class="basictable" cellpadding="3" >
										 <tr>
											 <td>
											 <a target="I-Target" href="file:///C:/wamp/www/iis/Billing/upload/Inventorylist.csv">Please click on for the	sample Format
												</a>
											 </td>
										 </tr>
										 <tr> 	 
											 <td>
												 </br>
												 Please choose a file: <input name="uploaded" type="file" />
												 <input type="submit" id="upload" value="upload" name="upload"/>
											</td>
										</tr>
									</table>
							</fieldset>		
						 </form>
					</td>
				  </tr>
				</table>
			</td>
         </tr>			
		 <tr>
           <td>
		   <table  border="0" align="left" cellpadding="0" cellspacing="0">
		          <tr>
				     <td>
					 &nbsp;
					 </td>
				  </tr>
				  <tr>
					<td width="500">
				         <?php
							$connect = mysql_connect('localhost','root','');
							if (!$connect) {
							 die('Could not connect to MySQL: ' . mysql_error());
							 }	
							$cid =mysql_select_db('test',$connect);
							$query = "SELECT * FROM REPOSITORY LIMIT 10";
							$result=mysql_query($query, $connect );?>
							<fieldset>
							<legend>Master Inventory List</legend>								   
                            <?php if($result) { ?> 							
							<table border='1' align="left" cellpadding='2' class='basictable' cellspacing='0'>
							     <tr>
									 <th>PRODUCT ID</th>
									 <th>PRODUCT DESCRIPTION
									 <th>UNITPRICE</th>
									 <th>TAXTYPE</th>	
									</tr>
							   <?php	
									while($row = mysql_fetch_array($result))
										{?>	
										<tr>
										   <td align="center"><?php echo $row['PRODID']; ?></td>
										   <td align="left"><?php echo $row['PRODDESC']; ?></td>
										   <td align="center"><?php echo $row['UNITPRICE']; ?></td>
										   <td align="center"><?php echo $row['TAXTYPE']; ?></td>
										</tr>	
									<?php } ?>
                             </table>	
                              <?php } else {?> <tr><td>No Records in the Master Inventory List <?php } ?> </td></tr>							 
					</td>
                  </tr>
                               
      </tr>
	  <tr>
		 <td>
		 &nbsp;
		 </td>
	  </tr>	  
      <tr>
        <td><?php echo "<b>Message: Successfully imported to the Database"; ?>	</td></td>
      </tr>
   </table>
</body>
</html>