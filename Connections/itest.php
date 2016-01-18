<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_itest = "localhost";
$database_itest = "test";
$username_itest = "root";
$password_itest = "";
$itest = mysql_pconnect($hostname_itest, $username_itest, $password_itest) or trigger_error(mysql_error(),E_USER_ERROR); 
?>