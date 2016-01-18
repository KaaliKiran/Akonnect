<?php
//$connect = odbc_connect("test", "root", "");
//$server="Localhost";
//$database="test";
$user="root";
$password="";
//$connect = odbc_connect("DRIVER={mySQL};Server=Localhost; Database=test;", $user, $password);
$connect= odbc_connect("Driver={MySQL};Server=localhost;Database=test;",$user, $password);
# query the users table for name and surname 
$query = "SELECT name, surname FROM country";
# perform the query 
$result = odbc_exec($connect, $query);
# fetch the data from the database
 while(odbc_fetch_row($result)){ $name = odbc_result($result, 1); $countrycode = odbc_result($result, 2); print("$name $countrycode\n"); }
# close the connection 
odbc_close($connect); 

?> 