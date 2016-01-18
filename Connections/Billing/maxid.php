
<?php
$itest = mysql_connect("localhost","root" ,"");
Mysql_select_db("test", $itest);
$query_petdet = sprintf("SELECT MAX(ID) as maxid FROM eweight1");
$petdet = mysql_query($query_petdet, $itest) or die(mysql_error());
$row_petdet = mysql_fetch_assoc($petdet);
echo ($row_petdet['maxid']);


   
?>
<html>
<body>
</body>
</html>