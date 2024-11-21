<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn_CSRC = "localhost";
$database_conn_CSRC = "csrc";
$username_conn_CSRC = "csrc";
$password_conn_CSRC = "57212";
$conn_CSRC = mysqli_connect($hostname_conn_CSRC, $username_conn_CSRC, $password_conn_CSRC) or trigger_error(mysqli_connect_error(),E_USER_ERROR); 
mysqli_query($conn_CSRC,"SET NAMES 'utf8'");
$URL_home="https://military.ncu.edu.tw/CSRC/";
?>