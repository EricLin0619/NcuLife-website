<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}
  $MM_redirect = "floorPlanLogin.php";
  if (!isset($_SESSION['CSRC_user'])) {header("Location: " . $MM_redirect);}
?>
<?php
//使用者資料
$colname_csrc_user = "-1";
if (isset($_SESSION['CSRC_user'])) {
  $colname_csrc_user = (get_magic_quotes_gpc()) ? $_SESSION['CSRC_user'] : addslashes($_SESSION['CSRC_user']);
}
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_user = sprintf("SELECT * FROM `csrc_user` WHERE `user` = '%s'", $colname_csrc_user);
$csrc_user = mysqli_query($conn_CSRC,$query_csrc_user) or die(mysqli_connect_error());
$row_csrc_user = mysqli_fetch_assoc($csrc_user);

//暫存檔
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_data_temp = sprintf("SELECT * FROM `csrc_data` WHERE `user`='".$_SESSION['CSRC_user']."' AND `temp`='Y' ORDER BY time DESC, time2 DESC, date DESC ");
$csrc_data_temp = mysqli_query($conn_CSRC,$query_csrc_data_temp) or die(mysqli_connect_error());
$row_csrc_data_temp = mysqli_fetch_assoc($csrc_data_temp);
$totalRows_csrc_data_temp = mysqli_num_rows($csrc_data_temp);

//最新10件
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_data = sprintf("SELECT * FROM `csrc_data` WHERE `temp`='N' ORDER BY time DESC, time2 DESC, date DESC LIMIT 0,20");
$csrc_data = mysqli_query($conn_CSRC,$query_csrc_data) or die(mysqli_connect_error());
$row_csrc_data = mysqli_fetch_assoc($csrc_data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">
<!-- InstanceBegin template="/Templates/CSRC.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>中央大學校園安全中心</title>
    <!-- InstanceEndEditable -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
#sidebar1 { width: 220px; }
</style>
<![endif]-->
    <!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
#mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
    <!-- InstanceBeginEditable name="head" -->
    <style type="text/css">
        <!--
        .style3 {
            color: #FFFFFF;
            font-weight: bold;
        }

        .style4 {
            color: #990000;
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
                                                <?php if (isset($_SESSION['CSRC_user'])){?>
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
                                            <p></p>
                                            <a href="http://in.ncu.edu.tw/ncu57303/document.php?select=3&class1=%E7%B7%8A%E6%80%A5%E6%87%89%E8%AE%8A%E6%A8%93%E5%B1%A4%E5%B9%B3%E9%9D%A2%E5%9C%96" target="_blank">
                                                <font color="black" size="4">◎環安中心</font>
                                            <p></p>
                                            <a href="floorMap.php">
                                                <font color="black" size="4">◎中央大學各場館平面圖</font>
                                            </a>
                                            <p></p>
                                            <?php } while ($row_csrc_data = mysqli_fetch_assoc($csrc_data)); ?>
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
<!-- InstanceEnd -->

</html>
<?php
mysqli_free_result($csrc_data_temp);
mysqli_free_result($csrc_data);
?>
