<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_iisqc = "localhost";
$database_iisqc = "iis_qc";
$username_iisqc = "root";
$password_iisqc = "";
$iisqc = mysql_pconnect($hostname_iisqc, $username_iisqc, $password_iisqc) or trigger_error(mysql_error(),E_USER_ERROR); 
?>