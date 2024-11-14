<?php require_once('Connections/conn_LAF.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}

date_default_timezone_set("Asia/Taipei");

?>
<?php
// *** Validate request to login to this site.

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php?error";
  # 無權限提示
  $MM_redirectLoginDenied = "login.php?nopermission";  
  
  mysqli_select_db($conn_LAF,$database_conn_LAF);
  	
  $LoginRS__query=sprintf("SELECT user, password, authority FROM CSRC_user WHERE `department`='生輔組' AND user='%s' AND password=password('%s')",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysqli_query($conn_LAF,$LoginRS__query) or die(mysqli_connect_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);
  

  if ($loginFoundUser) {
    # 蔣教官說只有他開權限&網管
    if($loginUsername=='H145558' OR $loginUsername=='misadmin'){
      //query職員資料  
      $row_data = mysqli_fetch_array($LoginRS, MYSQLI_ASSOC);
      $loginStrGroup  = $row_data['authority'] ;
      
      //declare two session variables and assign them
      $_SESSION['LAF_user'] = $loginUsername;
      $_SESSION['LAF_authority'] = $loginStrGroup;	
    
      $updateSQL = sprintf("UPDATE CSRC_user SET `login_time`='%s' WHERE `user`='%s'",date('Y-m-d H:i:s'),$_POST['username']);

      mysqli_select_db($conn_LAF,$database_conn_LAF);
      $Result1 = mysqli_query($conn_LAF,$updateSQL) or die(mysqli_connect_error());   

      header("Location: " . $MM_redirectLoginSuccess );
    }
    else{
      header("Location: ". $MM_redirectLoginDenied );
    }
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/LAF.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>國立中央大學 失物招領資訊網-使用者登入</title>
<!-- InstanceEndEditable -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
#sidebar1 { width: 220px; }
</style>
<![endif]--><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
#mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<!-- InstanceEndEditable -->
</head>
<!--This template was created by www.flash-templates-today.com
Flash-Templates-Today.com - Gives a possibility to obtain a ready free flash template, free css template and other kind of website template!-->
<body>
<!-- begin #container -->
<p>&nbsp;</p>
<div id="container">
    <!-- begin #header -->
    <div id="header">
    	<div class="headerBackground">&nbsp;</div>
        <div id="navcontainer">
            <ul id="navlist">
				<li><a href="index.php">全部</a></li>
                <li><a href="index.php?class_type=1">有價票券</a></li>               
                <li><a href="index.php?class_type=2">3C電子</a></li>
                <li><a href="index.php?class_type=3">身份證件</a></li>
				<li><a href="index.php?class_type=4">運動物品</a></li>
                <li><a href="index.php?class_type=5">眼鏡服裝</a></li>
                <li><a href="index.php?class_type=6">文具書籍</a></li>
                <li><a href="index.php?class_type=7">保溫瓶</a></li>
                <li><a href="index.php?class_type=8">手錶</a></li>
                <li><a href="index.php?class_type=9">鑰匙</a></li>
                <li><a href="index.php?class_type=10">雨傘</a></li>
                <li><a href="index.php?class_type=99">其它</a></li>
            </ul>
      </div>
  </div>
    <!-- end #header -->
    <!-- begin #mainContent -->
<div id="mainContent">
        <div class="t">
          <div class="b">
            <div class="l">
              <div class="r">
                <div class="bl">
                  <div class="br">
                    <div class="tl">
                      <div class="tr">
                        <p>
                        <?php if (isset($_SESSION['LAF_user'])){?>
                        <a href="add.php">填寫</a>　 
                        <a href="list.php">查詢</a>　 
                        <a href="search.php">搜尋</a>　 
                        <a href="statistics.php">學院-類別統計</a>　 
                        <a href="statistics2.php">月份-類別統計</a>　 
                        <a href="statistics3.php">月份-地點統計</a>　 
                        <a href="statistics4.php">結果-類別統計</a>　 
                        <a href="logout.php">使用者登出</a>
                        <?php }else{?>
                        <a href="login.php">管理專區</a>
                        <?php }?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		<p></p>
      <!-- InstanceBeginEditable name="EditRegion1" -->
      <div class="t">
        <div class="b">
          <div class="l">
            <div class="r">
              <div class="bl">
                <div class="br">
                  <div class="tl">
                    <div class="tr">
                      <h2>使用者登入</h2>
                      <form id="form1" name="form1" method="POST" action="">
                  <p align="center" class="smalltitle">
                    <?php 
                    if (isset($_GET['error']))  { // Show If Var Is Set ?>
                      <span class="style1">帳密錯誤! 請重新輸入!</span>
                    
                      <?php } // Show If Var Is Set ?>
                    <?php
                    if (isset($_GET['nopermission']))  { // Show If Var Is Set ?>
                    <span class="style1">該帳號無此權限!</span>
                  
                    <?php } // Show If Var Is Set ?></p>
                  <table width="374" border="0" align="center">
                    <tr>
                      <td width="101"><div align="right">帳號：</div></td>
                      <td width="263"><input name="username" type="text" id="username" /></td>
                    </tr>
                    <tr>
                      <td><div align="right">密碼：</div></td>
                      <td><input name="password" type="password" id="password" />
                      　  
                        <input type="submit" name="Submit" value="登入" /></td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- InstanceEndEditable -->
        </div>
    <!-- end #mainContent -->
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <!-- begin #footer -->
    <div id="footer">
	<p align="center">中央大學生輔組 (03)-422-7151 #57212 , 57999</p>
	<div align="right">
	  <pre>
        Copyright © 2013 Web Design by <a title="Free Flash Templates" href="http://www.flash-templates-today.com" class="footerLink">Free Flash Templates</a> System made by <strong>Tu　</strong>
    </pre>
	  </div>
	<pre>&nbsp;	</pre>
  </div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
<!-- InstanceEnd --></html>
