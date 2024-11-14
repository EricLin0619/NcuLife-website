<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn_LAF = "localhost";
$database_conn_LAF = "csrc";
$username_conn_LAF = "csrc";
$password_conn_LAF = "57212";
$conn_LAF = mysqli_connect($hostname_conn_LAF, $username_conn_LAF, $password_conn_LAF) or trigger_error(mysqli_connect_error(),E_USER_ERROR); 
mysqli_query($conn_LAF,"SET NAMES 'utf8'");
$URL_home="https://military.ncu.edu.tw/LAF/";
?>