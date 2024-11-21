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
<html xmlns="http://www.w3.org/1999/xhtml">
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

        -->
    </style>
    <!-- InstanceEndEditable -->
</head>
<!--This template was created by www.flash-templates-today.com
Flash-Templates-Today.com - Gives a possibility to obtain a ready free flash template, free css template and other kind of website template!-->

<body>
    <!-- begin #container -->
    <div id="container">
        <!-- begin #header -->
        <?php include('navbar.php'); ?>
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
                                            <a href="Download/floorMap/01-大講堂.pdf">
                                                <font color="black" size="4">◎01-大講堂</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/02-總圖書館.pdf">
                                                <font color="black" size="4">◎02-總圖書館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/03-中大會館.pdf">
                                                <font color="black" size="4">◎03-中大會館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/04-中正圖書館.pdf">
                                                <font color="black" size="4">◎04-中正圖書館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/05-學生松苑餐廳.pdf">
                                                <font color="black" size="4">◎05-學生松苑餐廳</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/06-羽球館.pdf">
                                                <font color="black" size="4">◎06-羽球館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/07-依仁堂(體育館).pdf">
                                                <font color="black" size="4">◎07-依仁堂(體育館)</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/08-室內游泳池.pdf">
                                                <font color="black" size="4">◎08-室內游泳池</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/09-中大附設幼兒園.pdf">
                                                <font color="black" size="4">◎09-中大附設幼兒園</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/10-車庫倉庫垃圾處理場機車棚.pdf">
                                                <font color="black" size="4">◎10-車庫倉庫垃圾處理場機車棚</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/11-志道樓.pdf">
                                                <font color="black" size="4">◎11-志道樓</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/12-學生活動中心游藝館.pdf">
                                                <font color="black" size="4">◎12-學生活動中心游藝館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/13-國鼎圖書資料館.pdf">
                                                <font color="black" size="4">◎13-國鼎圖書資料館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/14-志希館.pdf">
                                                <font color="black" size="4">◎14-志希館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/15-科一館-地物應地.pdf">
                                                <font color="black" size="4">◎15-科一館-地物應地</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/16-科二館.pdf">
                                                <font color="black" size="4">◎16-科二館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/17-科三館.pdf">
                                                <font color="black" size="4">◎17-科三館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/18-科四館.pdf">
                                                <font color="black" size="4">◎18-科四館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/19-科五館.pdf">
                                                <font color="black" size="4">◎19-科五館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/20-工程一館-土木化材.pdf">
                                                <font color="black" size="4">◎20-工程一館-土木化材</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/21-工程二館-資策會(二期).pdf">
                                                <font color="black" size="4">◎21-工程二館-資策會(二期)</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/22-工程二館-電機館(三期).pdf">
                                                <font color="black" size="4">◎22-工程二館-電機館(三期)</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/23-工程二館-通訊館.pdf">
                                                <font color="black" size="4">◎23-工程二館-通訊館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/24-工程三館-機械館.pdf">
                                                <font color="black" size="4">◎24-工程三館-機械館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/25-機械實習三廠.pdf">
                                                <font color="black" size="4">◎25-機械實習三廠</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/26-工四-機電實驗室.pdf">
                                                <font color="black" size="4">◎26-工四-機電實驗室</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/27-工四環化館.pdf">
                                                <font color="black" size="4">◎27-工四環化館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/28-工四大型力學館.pdf">
                                                <font color="black" size="4">◎28-工四大型力學館</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/29-工五館AB棟.pdf">
                                                <font color="black" size="4">◎29-工五館AB棟</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/30-工五館B棟增建.pdf">
                                                <font color="black" size="4">◎30-工五館B棟增建</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/31-工五館C棟.pdf">
                                                <font color="black" size="4">◎31-工五館C棟</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/32-研究中心大樓-太遙一期.pdf">
                                                <font color="black" size="4">◎32-研究中心大樓-太遙一期</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/33-研究中心大樓-太遙二期.pdf">
                                                <font color="black" size="4">◎33-研究中心大樓-太遙二期</font>
                                            </a>
                                            <p></p>
                                            <a href="Download/floorMap/34-管理二館.pdf">
                                                <font color="black" size="4">◎34-管理二館</font>
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
