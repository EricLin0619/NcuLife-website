<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
    if (!isset($_SESSION)) { session_start(); }
    date_default_timezone_set("Asia/Taipei");
?>
<?php
// *** Validate request to login to this site.

if (isset($_POST['username'])) {
    $loginUsername=$_POST['username'];
    $password=$_POST['password'];
    $MM_redirectLoginSuccess = "index.php";
    $MM_redirectLoginFailed = "login.php?error";

    mysqli_select_db($conn_CSRC,$database_conn_CSRC);

    $LoginRS__query=sprintf("SELECT user, password, authority FROM CSRC_user WHERE user='%s' AND password=password('%s')",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 

    $LoginRS = mysqli_query($conn_CSRC,$LoginRS__query) or die(mysql_error());
    $loginFoundUser = mysqli_num_rows($LoginRS);

    if ($loginFoundUser) {

        $loginStrGroup  = mysql_result($LoginRS,0,'authority');

        //declare two session variables and assign them
        $_SESSION['CSRC_user'] = $loginUsername;
        $_SESSION['CSRC_authority'] = $loginStrGroup;	

        $updateSQL = sprintf("UPDATE csrc_user SET `login_time`='%s' WHERE `user`='%s'",date('Y-m-d H:i:s'),$_POST['username']);

        mysqli_select_db($conn_CSRC,$database_conn_CSRC);
        $Result1 = mysqli_query($conn_CSRC,$updateSQL) or die(mysqli_connect_error());   

        header("Location: " . $MM_redirectLoginSuccess );
    }
    else {
        header("Location: " . $MM_redirectLoginFailed );
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- InstanceBegin template="/Templates/CSRC.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>中央大學校園安全中心-災害防救</title>
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
        .style1 {
            color: #FF0000;
            font-weight: bold;
        }

        -->
        <!--/*
        .photo{
            position: relative;
            top: -200px;
            left: 300px;
        }
        */-->
    </style>
    <!-- InstanceEndEditable -->
</head>
<!--This template was created by www.flash-templates-today.com
Flash-Templates-Today.com - Gives a possibility to obtain a ready free flash template, free css template and other kind of website template!-->

<body>
    <!-- begin #container -->
    <div id="container">
        <!-- begin #header -->
        <div id="header">
            <div class="headerBackground">&nbsp;</div>
            <div id="navcontainer" style="font-family:Microsoft JhengHei; font-weight:bold;">
                <ul id="navlist">
                    <li><a href="https://military.ncu.edu.tw/index.php">首頁</a></li>
                    <li><a href="disaster.php" id="current">災害防救</a></li>
                    <li><a href="actForDisas.php">活動集錦</a></li>
                </ul>
            </div>
        </div>
        <!-- end #header -->
        <!-- begin #mainContent -->
        <div id="mainContent">
            <a href="download/110_校園災害防救計畫書-本文-110.3.8.pdf" target="_blank">
                <font color="black" size="4">校園災害防救計畫</font>
            </a>
            <p></p>
            <a href="download/附件一校園災害潛勢評估報告(109年).pdf" target="_blank">
                <font color="black" size="4">校園災害潛勢評估報告</font>
            </a>
            <p></p>
            <a href="download/防災地圖-112年.pdf" target="_blank">
                <font color="black" size="4">校園防災地圖</font>
            </a>
            <p></p>
            <a href="download/New_Evacuation_Map.pdf" target="_blank">
                <font color="black" size="4">校園防災地圖(New_Evacuation_Map)</font>
            </a>
            <p></p>
            <a href="download/桃園市民防災手冊電子書.pdf" target="_blank">
                <font color="black" size="4">桃園市民防災手冊電子書</font>
            </a>
            <p></p>
            <a href="download/地震避難逃生要領.wmv" target="_blank">
                <font color="black" size="4">地震避難逃生要領影片</font>
            </a>
            <p></p>
            <a href="download/105_NCU_National_Disaster_Prevention_Day_Earthquake_Plan.doc" target="_blank">
                <font color="black" size="4">國家防災日地震避難掩護演練實施計畫</font>
            </a>
            <p></p>
            <a href="download/大地震模擬演練.pdf" target="_blank">
                <font color="black" size="4">大地震模擬演練</font>
            </a>
            <p></p>
            <a href="download/防災活動.pdf" target="_blank">
                <font color="black" size="4">防災活動</font>
            </a>
            <p></p>
            <a href="download/其他災害與對策.pdf" target="_blank">
                <font color="black" size="4">其他災害與對策</font>
            </a>
            <p></p>
            <a href="download/防災手冊.pdf" target="_blank">
                <font color="black" size="4">防災手冊</font>
            </a>
            <p></p>
            <a href="download/防災知識.pdf" target="_blank">
                <font color="black" size="4">防災知識</font>
            </a>
            <p></p>
            <a href="https://www.nfa.gov.tw/cht/index.php?" target="_blank">
                <font color="black" size="4">中華民國內政部消防署全球資訊網</font>
            </a>
            <p></p>
            <div class="photo">
                <img src="images/災害防救1.jpg" width="30%">
                <img src="images/災害防救2.jpg" width="30%"><br>
                <img src="images/災害防救3.jpg" width="30%">
                <img src="images/災害防救4.jpg" width="30%">
            </div>
            <!-- end #mainContent -->
            <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
            <!-- begin #footer -->
            <div id="footer">
                <p>
                    中央大學校園安全中心 (03)-422-7151 #57212 , 57999 校安專線 03-280-5666
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
