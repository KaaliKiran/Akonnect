<?php require_once('../Connections/session.php'); ?>
<?php require_once('../Connections/iisqc.php'); ?>
<?php require_once('../Connections/itest.php'); ?>


<?php
    mysql_select_db($database_itest, $itest);        
	$p="update master_herelist SET i94expirydate='2013-08-03 03:30:00' where id='1' ";
	mysql_query($p) or die(mysql_error());
	$p="update master_herelist SET petexpdt='2013-08-05 03:30:00' where id='1' ";
	mysql_query($p) or die(mysql_error());
    echo "done";
?>