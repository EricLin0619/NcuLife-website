<?php require_once('Connections/conn_CSRC.php'); ?>
<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); } 
?>
<?php
// *** Logout the current user.
$logoutGoTo = "login.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['CSRC_user'] = NULL;
$_SESSION['CSRC_authority'] = NULL;
$_SESSION['CSRC_authority2'] = NULL;
$_SESSION['CSRC_dapartment'] = NULL;
unset($_SESSION['CSRC_user']);
unset($_SESSION['CSRC_authority']);
unset($_SESSION['CSRC_authority2']);
unset($_SESSION['CSRC_dapartment']);
session_destroy();
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>使用者登出</title>
</head>
<body>
</body>
</html>