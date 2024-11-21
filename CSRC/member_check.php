<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //s
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "false";

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
    if (($strUsers == "") && false) { 
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
// *** Redirect if username exists
if($_POST['user']!=NULL){
  $loginUsername = $_POST['user'];
  $LoginRS__query = "SELECT user FROM csrc_user WHERE user='" . $loginUsername . "'";
  mysqli_select_db($conn_CSRC,$database_conn_CSRC);
  $LoginRS=mysqli_query($conn_CSRC,$LoginRS__query) or die(mysqli_connect_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);
  function check_username($loginFoundUser){
  if($loginFoundUser > 0){return '<span style="color:#f00">&#27492;&#24115;&#34399;&#24050;&#34987;&#20351;&#29992;</span>';}
  else{return '<span style="color:#006600">&#27492;&#24115;&#34399;&#21487;&#20351;&#29992;</span>';}
  }
  echo check_username($loginFoundUser);
}
?>