<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_rabbitfarm = "localhost";
$database_rabbitfarm = "rabbitfarm";
$username_rabbitfarm = "root";
$password_rabbitfarm = "";
$rabbitfarm = mysql_pconnect($hostname_rabbitfarm, $username_rabbitfarm, $password_rabbitfarm) or trigger_error(mysql_error(),E_USER_ERROR); 
?>