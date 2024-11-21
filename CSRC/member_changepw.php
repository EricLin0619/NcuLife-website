<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}
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
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); } 
?>
<?php
if ($_POST['password'] != $_POST['password2'] )
   {
	  header ("Location: member_changepw.php?error");
      exit;
   }

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE `csrc_user` SET `password`=password(%s) WHERE user=%s",
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['username'], "text"));


  mysqli_select_db($conn_CSRC,$database_conn_CSRC);
  $Result1 = mysqli_query($conn_CSRC, $updateSQL) or die(mysqli_connect_error());
  ?>
  <script>
  window.opener.location.href="logout.php";
  window.opener=null;
  window.close();
  </script>
  <?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>使用者更換密碼</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body>
  <?php if (isset($_GET['error']))  { // Show If Var Is Set ?>
  <p align="center" class="style1"><strong>錯誤!! 兩次密碼不相符!</strong></p>
  <?php } // Show If Var Is Set ?>
<form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td width="112" align="right" nowrap="nowrap"><div align="right"><strong>新密碼：</strong></div></td>
      <td width="224"><input type="password" name="password" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>新密碼確認：</strong></td>
      <td><input name="password2" type="password" id="password2" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="center"></div></td>
      <td><div align="center">
          <input name="submit" type="submit" value="更換密碼" />
      </div></td>
    </tr>
  </table>
  <div align="center">
    <input type="hidden" name="MM_update" value="form1" />
    <input name="username" type="hidden" id="username" value="<?php echo $_SESSION['CSRC_user']; ?>" />
    <br />
    </p>
    <span class="style1">為了尊重隱私權，登入密碼有加密處理！<br />
    網站管理員也無法得知您的密碼。<br />
    設定密碼時，請選擇自己容易記憶的！</span>
  </div>
</form>
<p>&nbsp;</p>
</body>
</html>