<?php require_once('../../conn_military.php'); ?>
<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<?php
// *** Validate request to login to this site.

if(isset($_SESSION['military_Username'])){
 echo "<script language=\"javascript\">document.location.href=\"Student_Visit.php\";</script>";
}


$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "authority";
  $MM_redirectLoginSuccess = "Student_Visit.php";
  $MM_redirectLoginFailed = "loginforlodger.php?error";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($conn_military, $database_conn_military);
  
  $sql_login = "SELECT user, password FROM `CSRC_user` WHERE (`department`='生輔組' OR `department`='訪視工讀生') AND `user`= '$loginUsername' AND password=password('$password')";
  $LoginRS = mysqli_query($conn_military, $sql_login) or die(mysqli_error()); 
  $loginFoundUser = mysqli_num_rows($LoginRS);
  
  if ($loginFoundUser) {
    //declare two session variables and assign them
    $_SESSION['military_Username'] = $loginUsername;      
    
    // update ip address and datetime when login
    $ip = $_SERVER['REMOTE_ADDR'];
    $sql_update = "UPDATE `CSRC_user` SET `ip`='$ip' WHERE `user`= '$loginUsername'";
    mysqli_query($conn_military, $sql_update) or die(mysql_error()); 

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];  
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<!-- saved from url=(0038)https://kkbruce.tw/bs3/Examples/signin -->
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="https://kkbruce.tw/Content/AssetsBS3/img/favicon.ico">
	<title>中央大學賃居生實地訪視紀錄網登入頁面</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet">
	<!--[if lt IE 9]><script src=~/Scripts/AssetsBS3/ie8-responsive-file-warning.js></script><![endif]-->
	<script src="/js/newjs/ie-emulation-modes-warning.js"></script>
	<!--[if lt IE 9]><script src=https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js></script><script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script><![endif]-->
</head>

<body>
	<div class="wrap">
		<div id="banner col-md-12 col-lg-12 col-xs-12 col-sm-12">
			<a href="/">
				<img src="../../images/Banner.jpg" class="img-responsive" style="display:block; margin:auto;">
				<!--之後要加返回首頁的超連結-->
			</a>
		</div>
		<div class="container">
			<form class="form-signin" role="form" action="loginforlodger.php" method="post">
				<h2 class="form-signin-heading">管理者登入</h2>
				<label for="username" class="sr-only">帳號</label>
				<input type="text" id="username" name="username" class="form-control" placeholder="請輸入帳號" required="" autofocus="">
				<label for="password" class="sr-only">密碼</label>
				<input type="password" id="password" name="password" class="form-control" placeholder="請輸入密碼" required="">
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="Submit">登入</button>
				<p align="center" class="smalltitle">
					<?php if (isset($_GET['error']))  { // Show If Var Is Set ?>
					<span class="style1">帳密錯誤! 請重新輸入!</span>
					<?php } // Show If Var Is Set ?>
				</p>
			</form>
		</div>
		<script src="./Signin Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
	</div>
</body>

</html>
