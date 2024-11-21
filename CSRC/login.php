<?php require_once('Connections/conn_CSRC.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

date_default_timezone_set("Asia/Taipei");

if (isset($_POST['username'])) {
  $loginUsername = $_POST['username'];
  $password = $_POST['password'];
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php?error";

  mysqli_select_db($conn_CSRC, $database_conn_CSRC);

  // 使用準備好的語句來防止 SQL 注入
  $stmt = $conn_CSRC->prepare("SELECT user, password, authority, authority2, department FROM CSRC_user WHERE user=? AND password=password(?)");
  $stmt->bind_param("ss", $loginUsername, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  $loginFoundUser = $result->num_rows;

  if ($loginFoundUser) {
    $row_data = $result->fetch_assoc();

    printf("TID: %s  NAME: %s", $row_data['authority'], $row_data['authority2']);
    $loginStrGroup = $row_data['authority'];
    $loginStrGroup2 = $row_data['authority2'];
    $loginStrGroup3 = $row_data['department'];

    // 宣告兩個 session 變數並賦值
    $_SESSION['CSRC_user'] = $loginUsername;
    $_SESSION['CSRC_authority'] = $loginStrGroup;
    $_SESSION['CSRC_authority2'] = $loginStrGroup2;
    $_SESSION['CSRC_dapartment'] = $loginStrGroup3;

    // 更新登入時間
    $updateSQL = "UPDATE csrc_user SET login_time=? WHERE user=?";
    $stmt = $conn_CSRC->prepare($updateSQL);
    $login_time = date('Y-m-d H:i:s');
    $stmt->bind_param("ss", $login_time, $loginUsername);
    $stmt->execute();

    header("Location: " . $MM_redirectLoginSuccess);
  } else {
    header("Location: " . $MM_redirectLoginFailed);
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
						              <a href="index.php">校安狀況列表</a>　
                          <a href="add.php">填寫校安狀況</a>　
						              <a href="list.php">校安狀況查詢</a>　
						              <a href="search.php">校安狀況搜尋</a>　
						              <a href="statistics.php">校安狀況統計</a>　
						              <a href="statistics_plot.php">校安狀況繪圖</a>　
						              <?php if (isset($_SESSION['CSRC_user'])){?>
						                 <a href="logout.php">使用者登出</a>　
						              <?php }?>
						              </p>
                        <?php }?>
                        <?php if (isset($_SESSION['CSRC_user'])&&($_SESSION['CSRC_dapartment']=="生輔組")){?><p>
						              <a href="worksheet.php">工作日誌列表</a>　						  
                          <a href="worksheet_add.php">填寫工作日誌</a>　
						              <a href="worksheet_list.php">工作日誌查詢</a>　
						              <a href="worksheet_search.php">工作日誌搜尋</a>　
                          <?php if ($_SESSION['CSRC_authority']=='1'){?>
						                <a href="member.php">人員權限管理</a>　
						              <?php }?>
						              </p>
                        <?php }?>
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
                      <form id="form1" name="form1" method="POST" action="" aria-labelledby="login-title">
                        <p align="center" class="smalltitle">
                          <?php if (isset($_GET['error']))  { ?>
                            <span class="style1" role="alert">帳密錯誤! 請重新輸入!</span>
                          <?php } ?>
                        </p>
                        <table width="374" border="0" align="center">
                          <tr>
                            <td width="101">
                              <label for="username" class="text-right">帳號：</label>
                            </td>
                            <td width="263">
                              <input name="username" type="text" id="username" required aria-required="true" />
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="password" class="text-right">密碼：</label>
                            </td>
                            <td>
                              <input name="password" type="password" id="password" required aria-required="true" />
                              <input type="submit" name="Submit" value="登入" title="登入系統" />
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
