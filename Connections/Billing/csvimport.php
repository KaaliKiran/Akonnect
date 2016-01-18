<?php 
//database connection details
$connect = mysql_connect('localhost','root','');
if (!$connect) {
 die('Could not connect to MySQL: ' . mysql_error());
 }
//your database name
$cid =mysql_select_db('test',$connect);
// path where your CSV file is located
define('CSV_PATH','upload/');
// Name of your CSV file
$csv_file = CSV_PATH . "Inventorylist.csv";
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
					 echo $col1 = $slice[0]; 
					 echo $col2 = $slice[1];
					 echo $col3 = $slice[2];
					 echo $col4 = $slice[3]; 
					 echo"</br>----------------------------------</br>";
					// SQL Query to insert data into DataBase
					$query = "INSERT INTO repository(PRODID,PRODDESC,UNITPRICE,TAXTYPE)
					VALUES('".$col1."','".$col2."','".$col3."','".$col4."')";
					mysql_query($query, $connect );
               }
        } 
    }
echo "File data successfully imported to database!!"; 
mysql_close($connect); 
?>