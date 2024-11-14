<?php require_once('conn_military.php'); ?>
<?php require_once('const_variable.php'); ?>
<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }

 $MM_redirect = "login.php";
 if (!isset($_SESSION['military_Username'])) {header("Location: " . $MM_redirect);}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

if ((isset($_GET['no'])) && ($_GET['no'] != "")) {

  mysqli_select_db($conn_military,$database_conn_military);
  $query_military_bulletin = sprintf("SELECT * FROM `military_bulletin` WHERE `no`='".$_GET['no']."'");
  $military_bulletin = mysqli_query($conn_military,$query_military_bulletin) or die(mysqli_connect_error());
  $row_military_bulletin = mysqli_fetch_assoc($military_bulletin);

  $deleteSQL = sprintf("DELETE FROM `military_bulletin` WHERE `no`=%s", GetSQLValueString($_GET['no'], "int"));
  
  for( $i=1 ; $i <= Max_File_Num && $row_military_bulletin['attachment' . $i] !='' ; $i++ )
	unlink($row_military_bulletin['attachment' . $i]);

  mysqli_select_db($conn_military,$database_conn_military);
  $Result1 = mysqli_query($conn_military,$deleteSQL) or die(mysqli_connect_error());

  $deleteGoTo = "index.php";
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
