<html>
<body>
<?php
    $connect = mysql_connect('localhost','root','');
	if (!$connect) {
	 die('Could not connect to MySQL: ' . mysql_error());
	 }	
	$cid =mysql_select_db('test',$connect);
	$query = "SELECT * FROM REPOSITORY";
	$result=mysql_query($query, $connect );?>
	 <table border='1' cellpadding='2' class='basictable' cellspacing='0'>
	   <caption>SBRTS Master Inventory List</caption>
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
</body>								 
</html>								 
								