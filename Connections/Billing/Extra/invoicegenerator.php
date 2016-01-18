<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="schema.DC" href="http://purl.org/DC/elements/1.0/"/>
<link rel="SHORTCUT ICON" href="../images/SBRTS.jpg"/>
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
<title>INVOICE</title>
<link rel="stylesheet" type="text/css" href="../scripts/iis.css"/>
<link href="../scripts/calendar/calendar.css" type="text/css" rel="stylesheet" />
<script src="../scripts/calendar/jsl.js" type="text/javascript"></script>
<script src="../scripts/calendar/common.js" type="text/javascript"></script>
<script src="../scripts/calendar/calendar.js" type="text/javascript"></script>

<script type="text/javascript">
function init() {
	calendar.set("emphiredate");
	}
	
function validate() {
var travelstartf, travelendf, emphiredatef, hostcountryf, visatypef;

travelstartf = document.getElementById("travelstart").value;
travelendf = document.getElementById("travelend").value;
emphiredatef = document.getElementById("emphiredate").value;
visatypef = document.getElementById("visatype").value;
hostcountryf = document.getElementById("hostcountry").value;

var todaydate = new Date();
var one_day = 1000*60*60*24;
var one_week = 1000*60*60*24*7;
var one_month = 1000*60*60*24*30.44;
var one_year = 1000*60*60*24*365;

travelstartd = new Date(travelstartf);
travelendd = new Date(travelendf);
emphiredated = new Date(emphiredatef);
var passdurfd = parseInt(Math.ceil((travelendd.getTime()-travelstartd.getTime())/(one_day)));
var passtenurefd = parseInt(Math.ceil((todaydate.getTime()-emphiredated.getTime())/(one_day)));
var passstartfd = parseInt(Math.ceil((todaydate.getTime()-travelstartd.getTime())/(one_day)));
var passtenurefdm = parseInt(Math.ceil((todaydate.getTime()-emphiredated.getTime())/(one_month)));
var passtenurefdy = parseInt(Math.ceil((todaydate.getTime()-emphiredated.getTime())/(one_year)));

//alert ("Working");
var years = parseInt(passtenurefd/365.25);
var months = parseInt((passtenurefd%365.25)/30.44);
var days = parseInt(((passtenurefd%365.25)%30.44)/1);

if (years == 1) var yr = "Year"; else var yr = "Years";
if (months == 1) var mon = "Month"; else var mon = "Months";
if (years == 0)
{document.getElementById("tenure").value= months + " " + mon}
if (months == 0)
{document.getElementById("tenure").value= years + " " + yr}
if ((years > 0) && (months > 0))
{document.getElementById("tenure").value= years + " " + yr + " " + months + " " + mon}

//alert (years + " Years" + months + " Months");

if (visatypef=="-1")
{alert ("Please select the type of Visa");
return false;}
if (hostcountryf=="-1")
{alert ("Please select the Host Country");
return false;}
if (travelstartf=="")
{alert ("Please select the Travel Start Date");
return false;}
if (travelendf=="")
{alert ("Please select the Travel End Date");
return false;}
if (emphiredatef=="")
{alert ("Please select your date of Hire");
return false;}

if (passdurfd > 1)
var sign = "s";
else
var sign = "";

if (passdurfd < 0)
{alert ("Invalid Dates : Travel End Date is earlier than Travel Start.");
return false;}
else
document.getElementById("travelduration").value= passdurfd+" day"+sign;

if (passtenurefd < 0)
{alert ("Invalid Hire Date : Hire Date can not be a future date.");
return false;}
if (passstartfd > 0)
{alert ("Travel Start date cannot be an earlier date.");
return false;}
}
</script>
</head>

<body bgcolor="#99CC99" style="background: url('../images/SBRTS.jpg') center no-repeat fixed;">

<table width="1145" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table border="0" border="0" cellspacing="0" cellpadding="0" width="1180">	    
        <tr>
		    <td colspan="2">
			    <div align="left" id="content" style="background-color:white;height:69px;width:298px;float:left">
					<table border="0" border="0" cellspacing="0" cellpadding="0">  
						<tr>
						   <td><img src="../images/sbrts.jpg" alt="some_text" width="60" height="50"></td>
						   <td><b>SBR TECHNOLOGY SERVICES</b></td>
						</tr>
						<tr>
						   <td>Estd. 2008</td>
						</tr> 	            
					</table>
 				</div>	
            </td>					
		    <td width="284">
		     &nbsp;
		  </td>
		  <td width="181">
		      &nbsp;
          	</td>
		  <td width="283">		      
          		<table border="0" align="left" cellpadding="0" cellspacing="0" width="273">
			          <tr>                         
						<td style="color:black; text-decoration:none; font:15px bold arial,sans-serif;">			   
					       <b><font size="3" color="#C0C0C0">Invoice Number</font><font size="4">:</font></font></b>
							<font size="2">XXX XXX XXX</font></td>
					  </tr>
 					  <tr>
						<td>
						   <b>Date<input name="emphiredate" type="text" class="element10px" id="emphiredate" size="10" readonly="readonly" /> 
								  <img src="../images/date_icon.gif" alt="" border="0" align="absbottom" class="element" onclick="document.form1.emphiredate.click();" />

						</td>
					  </tr>	
				      <tr> 
				         <td>
						    <b>Delivery From: </b>Bengaluru
						 </td>
					  </tr>	
				
				</td>
                      </tr>
                  </table>
          	</td>
       		<td>			 
			    &nbsp;</td>			
        </tr>
		<tr>            
            <td width="239">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<font color="#C0C0C0">&nbsp;<b>Head Office</b></font></td>
			<td width="182" rowspan="3">
			    &nbsp;
			</td>
			<td width="284" valign="center" style="color:black; text-decoration:none; font:20px bold arial,sans-serif;" rowspan="3">
		    <p align="center"><font color="#C0C0C0"><strong>I&nbsp; N&nbsp; V&nbsp; 
			O&nbsp; I&nbsp; C&nbsp; E</strong>
		  	</font>
		  </td>
			<td width="181" rowspan="3">
			    &nbsp;
			</td>
			<td width="283" valign="Top" style="color:black; text-decoration:none; font:15px bold arial,sans-serif;" rowspan="3">
		           <table border="0" align="left" cellpadding="0" cellspacing="0" width="283">
			          <tr>
                         <td style="color:black; text-decoration:none; font:15px bold arial,sans-serif;">
                         <font size="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<font color="#C0C0C0">&nbsp;&nbsp; </font> </font>
							<font size="3" color="#C0C0C0">Delivery To</font><font size="3"> </font>
                         </td>
                      </tr>
                      <tr>
                         <td>
                             <input type="text" size="50" bgcolor="#CCCCCC" name="Name" Value="Mr. XXXXXXXXXXXXXX(50 Characters)">
                         </td>
                      </tr>
                      <tr>
                         <td>
                             <input type="text" size="50" bgcolor="#CCCCCC" name="add1" Value="Address Line1">
                         </td>
                      </tr>
                      <tr>
                         <td>
                             <input type="text" size="50" bgcolor="#CCCCCC" name="regtime5" Value="Address Line 2, City">
                        </td>
                      </tr>
                  </table>
			 </td>		
		</tr>		
		<tr>
            
            <td width="239">#81, II Floor, Ramachandrappa Road</td>
			</tr>
		<tr>
            
            <td width="239">Kammanahalli Circle, Bangalore-84</td>
			</tr>
</table>
<hr align="right" color="#C0C0C0" width="98%">
</td>
</tr>
<tr>
 <td>
    &nbsp;
 </td>
</tr>
</table>
<table border="1" width="88%" cellpadding="2">
	<tr>
		<th width="101">&nbsp;&nbsp;&nbsp; SL NO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</th>
		<th width="474">PRODUCT DESCRIPTION</th>
		<th width="115">QUANTITY</th>
		<th>UNIT PRICE</th>
		<th width="206">AMOUNT</th>
	</tr>
	<tr>
		<td width="101">
		<p align="center">1</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
	<tr>
		<td width="101">
		<p align="center">2</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
	<tr>
		<td width="101">
		<p align="center">3</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
	<tr>
		<td width="101">
		<p align="center">4</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
	<tr>
		<td width="101">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		5</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
	<tr>
		<td width="101">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		6</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
	<tr>
		<td width="101">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		7</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
	<tr>
		<td width="101">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		8</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
	<tr>
		<td width="101">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		9</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
	<tr>
		<td width="101">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 10</td>
		<td width="474">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="206">&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
<table border="1" width="87%">
	<tr>
		<th width="586" rowspan="2">E. &amp; O.E</th>
		<th width="276">SUB TOTAL</th>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<th width="276">KVAT/CST(14.5%)</th>
		<td>&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
<table border="1" width="87%">
	<tr>
		<td width="102">
		<p align="center">11</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<th width="277">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</th>
		<td width="193">&nbsp;</td>
	</tr>
	<tr>
		<td width="102">
		<p align="center">12</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<th width="277">&nbsp;</th>
		<td width="193">&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
<table border="1" width="87%">
	<tr>
		<th width="585" rowspan="2">&nbsp;&nbsp;&nbsp;
		<font size="4" color="#C0C0C0">Total Amount in Words:</font><p>&nbsp;</th>
		<th>SUBTOTAL</th>
		<td width="192" rowspan="2">&nbsp;</td>
	</tr>
	<tr>
		<th>KVAT/CST(5.5%)</th>
	</tr>
</table>
<table border="1" width="87%">
	<tr>
		<th width="586" rowspan="3">RECEIVED THE MATERIALS IN GOOD WORKING 
		CONDITION<p align="left"><font size="2">RECEIVED BY:</font></p>
		<p align="left"><font size="2">SIGNATURE:</font></p>
		<p align="left"><font size="2">DATE:</font></th>
		<th width="281">INSTALLATION</th>
		<td width="191" rowspan="3">&nbsp;</td>
	</tr>
	<tr>
		<th width="281">
		<p align="center">DISCOUNT</th>
	</tr>
	<tr>
		<th width="281">&nbsp;&nbsp; TOTAL</th>
	</tr>
</table>
</body>
</html>