<?php
$user   = "root";
$pass   = ""; 
try {
    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
	echo "<table border='1' cellpadding='2' class='basictable' cellspacing='0'>";
	echo"<caption>GAT List - All Country Names</caption>";
		    echo "<tr>";
		    echo "<th>Country Code</th>";
		    echo "<th>Country Name</th>";		    
		    echo "</tr>";
    foreach($dbh->query('SELECT * from country LIMIT 2') as $row) {
        echo"<tr>";
			     echo"<td>".$row['Code']."</td>";
			     echo "<td>".$row['Name']."</td>";				
     			
		   echo"</tr>";
    }
	echo "<table>";
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}		  

$row = 1;
ini_set('auto_detect_line_endings',TRUE); ?>
<table border='1' cellpadding='2' class='basictable' cellspacing='0'>
   <caption>Inventory List Records</caption>
	   <tr>
		 <th>PRODUCT ID</th>
		 <th>PRODUCT DESCRIPTION
		 <th>UNITPRICE</th>
		 <th>TAXTYPE</th>
<?php if (($handle = fopen("upload/Inventorylist.csv", "r")) !== FALSE) 
        {
         while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
                {
					$num = count($data);				
					"<p> $num fields in line $row: <br /></p>\n";
					$row++;
					$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
					{?>
					   <tr>
						   <td>			   
							   <?php 
							   for ($c=0; $c < 1; $c++) 
								 echo $data[$c];
							   ?>
							</td>  
							<td>			   
							   <?php 
							   for ($c=1; $c < 2; $c++) 
								 echo $data[$c]  ;
							   ?>
							</td>  
							<td>			   
							   <?php 
							   for ($c=2; $c < 3; $c++) 
								 echo $data[$c]  ;
							   ?>
							</td>  	
							<td>			   
							   <?php 
							   for ($c=3; $c < 4; $c++) 
								 echo $data[$c]  ;
							   ?>
							</td>  						
					   </tr>
					<?php		
					}
                }
           }    
		   fclose($handle);
	       ini_set('auto_detect_line_endings',FALSE); 
?>
</table>


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