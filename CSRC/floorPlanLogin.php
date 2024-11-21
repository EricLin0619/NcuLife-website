<?php require_once('Connections/conn_CSRC.php'); ?>
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
  $MM_redirectLoginSuccess = "floorPlanIndex.php";
  $MM_redirectLoginFailed = "floorPlanLogin.php?error";
  
  mysqli_select_db($conn_CSRC,$database_conn_CSRC);
  	
  $LoginRS__query=sprintf("SELECT user, password, authority, authority2, department FROM CSRC_user WHERE user='%s' AND password=password('%s')",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysqli_query($conn_CSRC,$LoginRS__query) or die(mysqli_connect_error());

  $loginFoundUser = mysqli_num_rows($LoginRS);
    
  if ($loginFoundUser) {
//  $loginStrGroup  = mysql_result($LoginRS,0,'authority');
//	$loginStrGroup2 = mysql_result($LoginRS,0,'authority2');
//	$loginStrGroup3 = mysql_result($LoginRS,0,'department');
//    mysql_result($LoginRS);
    //query職員資料  
    $row_data = mysqli_fetch_array($LoginRS, MYSQLI_ASSOC);
    
    printf ("TID: %s  NAME: %s", $row_data['authority'], $row_data['authority2']);
    $loginStrGroup = $row_data['authority'] ;
    $loginStrGroup2 = $row_data['authority2'] ;
    $loginStrGroup3 = $row_data['department'] ;
    
    
    
    //declare two session variables and assign them
    $_SESSION['CSRC_user'] = $loginUsername;
    $_SESSION['CSRC_authority'] = $loginStrGroup;
	$_SESSION['CSRC_authority2'] = $loginStrGroup2;
	$_SESSION['CSRC_dapartment'] = $loginStrGroup3;	
	
    $updateSQL = sprintf("UPDATE csrc_user SET `login_time`='%s' WHERE `user`='%s'",date('Y-m-d H:i:s'),$_POST['username']);

    mysqli_select_db($conn_CSRC,$database_conn_CSRC);
    $Result1 = mysqli_query($conn_CSRC,$updateSQL) or die(mysqli_connect_error());   

    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW"><!-- InstanceBegin template="/Templates/CSRC.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>中央大學校園安全中心使用者登入</title>
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
>
</style>
<!-- InstanceEndEditable -->
</head>
<!--This template was created by www.flash-templates-today.com
Flash-Templates-Today.com - Gives a possibility to obtain a ready free flash template, free css template and other kind of website template!-->
<body>
<!-- begin #container -->
<div id="container" style="background-color:#f0f0f0;">
    <!-- begin #header -->
    <?php include('navbar.php'); ?>
    <!-- end #header -->
<!-- begin #mainContent -->
<div id="mainContent" style="background-color:#f0f0f0;">
        <div class="t">
          <div class="b">
            <div class="l">
              <div class="r">
                <div class="bl">
                  <div class="br">
                    <div class="tl">
                      <div class="tr">
                        <?php if (isset($_SESSION['CSRC_user'])){?><p>
						              <a href="logout.php">使用者登出</a>　
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
                      <h2 id="login-title">使用者登入</h2>
                      <form id="form1" name="form1" method="POST" action="" aria-labelledby="login-title">
                        <p align="center" class="smalltitle">
                          <?php if (isset($_GET['error'])) { ?>
                            <span class="style1" role="alert">帳密錯誤! 請重新輸入!</span>
                          <?php } ?>
                        </p>
                        <table width="374" border="0" align="center">
                          <tr>
                            <td width="101">
                              <label for="username" class="text-right">帳號：</label>
                            </td>
                            <td width="263">
                              <input 
                                name="username" 
                                type="text" 
                                id="username" 
                                required 
                                aria-required="true"
                                aria-label="請輸入帳號"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="password" class="text-right">密碼：</label>
                            </td>
                            <td>
                              <input 
                                name="password" 
                                type="password" 
                                id="password" 
                                required 
                                aria-required="true"
                                aria-label="請輸入密碼"
                              />
                              <input 
                                type="submit" 
                                name="Submit" 
                                value="登入" 
                                title="登入系統"
                                aria-label="提交登入表單"
                              />
                            </td>
                          </tr>
                        </table>
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
    <div id="footer" style="font-family:Microsoft JhengHei;">
	<p>
	中央大學生輔組 (03)-422-7151 #57212 , 57999 校安專線 03-280-5666
	</p>
	<pre>
        Copyright © 2012 Web Design by <a title="Free Flash Templates" href="http://www.flash-templates-today.com" class="footerLink">Free Flash Templates</a> System made by <strong>Tu</strong>
	</pre>
    </div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
<!-- InstanceEnd --></html>
