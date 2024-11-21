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
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php?error";
  
  mysql_select_db($database_conn_CSRC, $conn_CSRC);
  	
  $LoginRS__query=sprintf("SELECT user, password, authority FROM CSRC_user WHERE user='%s' AND password=password('%s')",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $conn_CSRC) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'authority');
    
    //declare two session variables and assign them
    $_SESSION['CSRC_user'] = $loginUsername;
    $_SESSION['CSRC_authority'] = $loginStrGroup;	
	
    $updateSQL = sprintf("UPDATE csrc_user SET `login_time`='%s' WHERE `user`='%s'",date('Y-m-d H:i:s'),$_POST['username']);

    mysql_select_db($database_conn_CSRC, $conn_CSRC);
    $Result1 = mysql_query($updateSQL, $conn_CSRC) or die(mysql_error());   

    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">
<!-- InstanceBegin template="/Templates/CSRC.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>中央大學校園安全中心-活動集錦</title>
    <!-- InstanceEndEditable -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    <style>
        .photo-gallery {
            max-width: 860px; /* 設定最大寬度 */
            margin: auto; /* 水平居中 */
        }
        .photo-row {
            display: flex; /* 使用 flexbox 來排列圖片 */
            justify-content: left; /* 水平居中 */
            margin-bottom: 20px; /* 每行底部的間距 */
        }
        .photo {
            padding: 5px; /* 圖片間的間隔 */
            flex: 0 1 280px; /* flex-grow, flex-shrink 和 flex-basis */
            text-align: center; /* 文字居中，這裡主要是影響圖片 */
        }
        .photo img {
            width: 100%; /* 讓圖片寬度適應容器 */
            height: auto; /* 高度自動 */
            vertical-align: middle; /* 垂直居中 */
        }
    </style>
    </style>
    <!-- InstanceEndEditable -->
</head>

<body>
    <!-- begin #container -->
    <div id="container" style="background-color:#ffffff;">
        <!-- begin #header -->
        <?php include('navbar.php'); ?>
        <!-- end #header -->
        <!-- begin #mainContent -->
        <div id="page" style="background-color:#ffffff;">
            <div id="content">
                <div class="entry">
                    <table width="860" border="1">
                        <tr>
                            <div class="photo-gallery">
                                <?php
                                // 圖片檔案名稱的陣列
                                $imageNames = [
                                    'DSC07544.JPG', 'DSC07545.JPG', 'DSC07546.JPG',
                                    'DSC07547.JPG', 'DSC07548.JPG', 'DSC07549.JPG',
                                    'DSC07550.JPG', 'DSC07551.JPG', 'DSC07552.JPG',
                                    'DSC07553.JPG', 'DSC07554.JPG', 'DSC07555.JPG',
                                    'DSC07556.JPG', 'DSC07557.JPG', 'DSC07558.JPG',
                                    'DSC07559.JPG', 'DSC07560.JPG', 'DSC07561.JPG',
                                    'DSC07562.JPG', 'DSC07563.JPG', 'DSC07564.JPG',
                                    'DSC07565.JPG', 'DSC07566.JPG', 'DSC07567.JPG',
                                    'DSC07568.JPG'
                                ];
                                $count = 0;
                                foreach ($imageNames as $imageName) {
                                    if ($count % 3 == 0 && $count != 0) {
                                        echo '</div><div class="photo-row">'; // 當計數器達到3的倍數時，結束當前行並開始新行
                                    } elseif ($count % 3 == 0) {
                                        echo '<div class="photo-row">';
                                    }
                                    echo "<div class='photo'><img src='images/CSRC_activity/105_new student security/{$imageName}' alt='' /></div>";
                                    $count++;
                                }
                                if ($count % 3 != 0) {
                                    echo '</div>'; // 結束最後一行
                                }
                                ?>
                            </div>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="post">
                <h2>活動照片集錦</h2>
                <div class="entry">
                </div>
            </div>
        </div>
        <div id="mainContent">
            <p>&nbsp; </p>
 
            <!-- end #mainContent -->
            <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
            <!-- begin #footer -->
            <div id="footer">
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
    </div>
</body>
<!-- InstanceEnd -->

</html>
