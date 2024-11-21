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
    $loginUsername = $_POST['username'];
    $password = $_POST['password'];
    $MM_redirectLoginSuccess = "index.php";
    $MM_redirectLoginFailed = "login.php?error";

    mysql_select_db($database_conn_CSRC, $conn_CSRC);

    $LoginRS__query = sprintf(
        "SELECT user, password, authority FROM CSRC_user WHERE user='%s' AND password=password('%s')",
        get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername),
        get_magic_quotes_gpc() ? $password : addslashes($password)
    );

    $LoginRS = mysql_query($LoginRS__query, $conn_CSRC) or die(mysql_error());
    $loginFoundUser = mysql_num_rows($LoginRS);

    if ($loginFoundUser) {

        $loginStrGroup  = mysql_result($LoginRS, 0, 'authority');

        //declare two session variables and assign them
        $_SESSION['CSRC_user'] = $loginUsername;
        $_SESSION['CSRC_authority'] = $loginStrGroup;

        $updateSQL = sprintf("UPDATE csrc_user SET `login_time`='%s' WHERE `user`='%s'", date('Y-m-d H:i:s'), $_POST['username']);

        mysql_select_db($database_conn_CSRC, $conn_CSRC);
        $Result1 = mysql_query($updateSQL, $conn_CSRC) or die(mysql_error());

        header("Location: " . $MM_redirectLoginSuccess);
    } else {
        header("Location: " . $MM_redirectLoginFailed);
    }
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>中央大學校園安全中心-校安中心</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!--[if IE 5]>
    <style type="text/css"> 
        #sidebar1 { width: 220px; }
    </style>
    <![endif]-->
    <!--[if IE]>
    <style type="text/css"> 
        #mainContent { zoom: 1; }
    </style>
    <![endif]-->
    <style type="text/css">
        .style1 {
            color: #FF0000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- begin #container -->
    <div id="container" style="background-color:#f0f0f0;">
        <?php include('navbar.php'); ?>
        <main id="mainContent" style="font-family:微軟正黑體; background-color:#f0f0f0;">
            <section class="document-list">
                <h2 class="visually-hidden">校園安全文件列表</h2>
                <ul style="list-style: none; padding: 0;">
                    <li>
                        <a href="download/校園安全管理委員會設置辦法.pdf" target="_blank">
                            <h3>◎校園安全管理委員會設置辦法</h3>
                        </a>
                    </li>
                    <li>
                        <a href="images/中央大學安全地圖.png" target="_blank">
                            <h3>◎校園安全地圖</h3>
                        </a>
                    </li>
                    <li>
                        <a href="download/4教育部大專校院校園安全參考彙編.pdf" target="_blank">
                            <h3>◎校園安全彙編</h3>
                        </a>
                    </li>
                    <li>
                        <a href="download/4加強安全意識及被害預防觀念.pdf" target="_blank">
                            <h3>◎加強安全意識及被害預防觀念宣導</h3>
                        </a>
                    </li>
                    <li>
                        <a href="download/5中英對照--校園安全宣導.pdf" target="_blank">
                            <h3>◎學生活動安全注意事項</h3>
                        </a>
                    </li>
                    <li>
                        <a href="download/6視訊會議用─校園安全緊急事件處理流程.pdf" target="_blank">
                            <h3>◎校園緊急事件處理流程</h3>
                        </a>
                    </li>
                    <li>
                        <h3>◎自主檢核表-行政單位</h3>
                        <div class="links">
                            <a href="download/7-1範例：大學校院校園環境安全自主檢核表─全校.pdf" target="_blank">範例</a>
                            <a href="https://docs.google.com/spreadsheets/d/168kX_AEmmyIRnsnXbvR08bpAQ8oRB3jEGDjme5gdWMo/edit?usp=drive_link" target="_blank">表單填寫</a>
                        </div>
                    </li>
                    <li>
                        <h3>◎自主檢核表-系所館舍單位</h3>
                        <div class="links">
                            <a href="download/8-1範例：大學校院校園環境安全自主檢核表-各系所.pdf" target="_blank">範例</a>
                            <a href="https://docs.google.com/forms/d/1fQESFnA3_nK4QpUhm8mBdmG326_7FwcRqh3UbbhU7Do/edit" target="_blank">表單填寫</a>
                        </div>
                    </li>
                    <li>
                        <h3>◎緊急連絡人登記表</h3>
                        <div class="links">
                            <a href="https://docs.google.com/forms/d/1hfCW1Ls0Q6GfL6IPeLUa3AFfJmm6MgS6yysG4ie3-n4/edit" target="_blank">表單填寫</a>
                            <a href="https://docs.google.com/forms/d/1yZ1Jbw-DojgrxZxbp-vvfCBSdzjjK24G7l3yb8geApU/edit" target="_blank">廠商</a>
                        </div>
                    </li>
                    <li>
                        <h3>◎學生戶外活動紀錄</h3>
                        <div class="links">
                            <a href="download/10-1請各級學校持續宣導辦理2天1夜以上之戶外活動，應填報「各級學校戶外活動登錄系統」案.PDF" target="_blank">函</a>
                            <a href="download/10國立中央大學學生戶外活動紀錄表格.docx" target="_blank">表格</a>
                        </div>
                    </li>
                    <li>
                        <a href="download/全校緊急聯絡人LINE群組.pdf" target="_blank">
                            <h3>◎加入緊急連絡人LINE群組</h3>
                            <a href="download/1131018校安工作說明會簡報.pptx" target="_blank">簡報</a>
                        </a>
                    </li>
                </ul>
            </section>
        </main>

        <footer id="footer">
            <div class="contact-info" style="text-align: center;">
                <p>中央大學生輔組 (03)-422-7151 #57212 , 57999 校安專線 03-280-5666</p>
            </div>
            <div class="copyright">
                <p>Copyright © 2012 Web Design by 
                    <a title="Free Flash Templates" href="http://www.flash-templates-today.com">Free Flash Templates</a> 
                    System made by <strong>Tu</strong>
                </p>
            </div>
        </footer>
    </div>
</body>
</html>