<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //
if (!isset($_SESSION)) {
  session_start();
}

$MM_restrictGoTo = "index.php"; //拒絕存取後，要請往的頁面

//非允許的使用者
/*(IE7不支援)
if(strstr($_SERVER['HTTP_REFERER'],'?')){$http_ref = explode('?',$_SERVER['HTTP_REFERER']);}
else{$http_ref[0]=$_SERVER['HTTP_REFERER'];}


if (($http_ref[0]!=$URL_home."index.php")&&($http_ref[0]!=$URL_home."search.php")&&($http_ref[0]!=$URL_home."list.php")){ 
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
*/
$MM_authorizedUsers = "4";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['CSRC_user'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['CSRC_user'], $_SESSION['CSRC_authority'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
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
  $deleteSQL = sprintf("DELETE FROM `csrc_data` WHERE `no`=%s",
                       GetSQLValueString($_GET['no'], "int"));

  mysqli_select_db($conn_CSRC,$database_conn_CSRC);
  $Result1 = mysqli_query($conn_CSRC,$deleteSQL) or die(mysqli_connect_error());

  $deleteGoTo = "index.php";
  header(sprintf("Location: %s", $deleteGoTo));
}
?>