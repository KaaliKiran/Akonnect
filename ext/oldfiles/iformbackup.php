

<?php

$x= 0; if(isset($_SESSION['MM_Empid']))
                {
				  echo $x= $_SESSION['MM_Empid'];
				}
   ?>

   <?php
      
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
<title>Validate i-94 Form Details</title>
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
<form enctype="multipart/form-data" action="iform.php" method="POST">
<div align="left">
  <fieldset>  
    <legend>I94 FORM Details</legend>
    <table cellspacing="10">
	<tr>
      <td>&nbsp;</td>
        </tr>
     <tr>
	<td>
	Note: Please Enter the Accurate Details and please click on Verified and Ok Button and Also please upload the appropriate Artifacts from the Upload Seaction
	</td>
	</tr>
	<tr>
      <td>&nbsp;</td>
        </tr>
		<tr>
      <td>&nbsp;</td>
        </tr>


	<tr>
	 <td>
	Departure Number<input type="text"  name="departno" onblur="deptno(this.value,'deptnoverify');" size="25">
	<p><span id="txtHint1"></span></p>
	  </td>
	  
	  
	  <td>
	  BirthDate(MM/DD/YY)<input type="text" onblur="birthdate(this.value,'bdateveriy');" size="20" />

       <p><span id="txtHint2"></span></p>
	  </td>
	  <tr>
	  
	  <td>
	   Family Name<input type="text" name="familyname" onblur="familyname(this.value,'familyverify');"  size="25">
	   <p><span id="txtHint3"></span></p>
	  </td>
	  
	 
     <td>
	FirstName(Given)<input type="text" onblur="firstname(this.value,'fnameveriy');" size="25">
           <p><span id="txtHint4"></span></p>
	     </td>
		 </tr>
		 <tr>
      <td>&nbsp;</td>
        </tr>

		 </table>
		 </fieldset>
		   <fieldset>
            <legend>Artifact Upload Wizard</legend>
               <table cellspacing="10">
			   <tr>
      <td>&nbsp;</td>
        </tr>
           <tr>
      <td>&nbsp;</td>
        </tr>

			   <tr>
                <td>
                 Please upload a scanned copy of the I94 Copy: <input name="uploaded" type="file" />
                 <input type="submit" id="upload" value="upload" name="upload"/>
                        
                  </td>
                 </tr>
				 <tr>
                <td>
                 Please upload a scanned copy of valid Passport: <input name="uploaded1" type="file" />
                 <input type="submit" id="upload1" value="upload" name="upload1"/>
                
                  </td>
                 </tr>
   <tr>
    <td>
	  <input type="submit" value="Verify & Update" name="verified">
	  
     </td>
    </tr>
	
		    </table>
			</fieldset>	  
		  </form>
		  
<?php
	
if(isset($_POST['upload']))
	{
      $file_name = ( $_FILES['uploaded']['name']);
	  $file_name;
	  $now = date('m/d/Y h:i:s a', time());
	  $file_name1 = explode('.',$file_name);
	  date_default_timezone_set('Asia/Calcutta');
	  $file_name2 = "File Name:".$file_name;
	  $type = $_FILES['uploaded']['type'];
	  $type1= "File Type:".$type;	
	  $size=  $_FILES['uploaded']['size'];
	  $size1="File size:".$size;
	     $target="upload/";
		 $tempname= basename( $_FILES['uploaded']['name']); 						   
		$target = $target.$tempname; 
                          if($type=="image/jpeg")
						  {
						(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)); 			  
						 $con = mysql_connect('localhost', 'root', '');
             if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			Mysql_select_db("ushere", $con);
            
	              $A="update master_herelist SET fileuploadstatus=1 where empid='000377744'";
				   $result=  mysql_query($A) or die(mysql_error());
             $A="update master_herelist SET filelocation1= '".$target."' where empid='000377744' ";
			 $result = mysql_query($A) or die(mysql_error());
            
			         }
					  else
					   {
					   echo"No valid";
					   }

	  
	  }
	  ?>
		<?php
	
if(isset($_POST['upload1']))
	{
      $file_name = ( $_FILES['uploaded1']['name']);
	  $now = date('m/d/Y h:i:s a', time());
	  $file_name1 = explode('.',$file_name);
	  date_default_timezone_set('Asia/Calcutta');
	  $file_name2 = "File Name:".$file_name;
	  $type = $_FILES['uploaded1']['type'];
	  $type1= "File Type:".$type;	
	  $size=  $_FILES['uploaded1']['size'];
	  $size1="File size:".$size;
	     $target1="upload/";
		 $tempname= basename( $_FILES['uploaded1']['name']); 						   
					echo $target1 = $target1.$tempname; 
 
						 (move_uploaded_file($_FILES['uploaded1']['tmp_name'], $target1)); 			  
						 $con = mysql_connect('localhost', 'root', '');
             if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			Mysql_select_db("ushere", $con);
            echo $A="update master_herelist SET fileuploadstatus=1 where empid='000377744'";
				   $result=  mysql_query($A) or die(mysql_error());
				    $A="update master_herelist SET responsereceived=1 where empid='000377744'";
				   $result=  mysql_query($A) or die(mysql_error());
           
            $A="update master_herelist SET filelocation2= '".$target1."' where empid='000377744' ";
			 $result = mysql_query($A) or die(mysql_error());
            
			

	   
			   
	       

	  
	  }
	  ?>
		  
  <?php
  
    if(isset($_POST['verified']))
	  {
	     $con = mysql_connect('localhost', 'root', '');
             if (!$con)
               {
               die('Could not connect: ' . mysql_error());
               }
			Mysql_select_db("ushere", $con);
			
			 $A="update master_herelist SET responsereceived='1' where empid='000377744' ";
			 $result = mysql_query($A) or die(mysql_error());
			 
			 $A="update master_herelist SET reminder2='1' where empid='000377744' ";
			  $result = mysql_query($A) or die(mysql_error());
			  
			 $A="update master_herelist SET reminder3='1' where empid='000377744' ";
			 $result = mysql_query($A) or die(mysql_error());
			
			
            
            
	  
	   }
  
   ?>
   	   
 


</body>
</html>