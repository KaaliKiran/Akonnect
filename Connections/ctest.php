<?php
$host= "localhost";
$db = "test";
$user   = "root";
$pass   = ""; 
$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
/*try {
    $dbh = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
} catch (PDOException $e) {
    error(false, "PDO ERROR: " . $e->getMessage());
}*/
?>