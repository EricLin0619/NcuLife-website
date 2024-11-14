<?php require_once('conn_military.php'); ?>
<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>研究生獎助學金</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/homepage/logos.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- css -->
    <?php
        include('call_css.php');
     ?>
</head>
<style>
        .bg-green {
        background-color: #07889B;
        color: black;
    }
    
    .dropdown-menu a:hover {
    background-color: white;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }
    
    .bg-orange {
        background-color: #e37222;
        color: black;
    }
    
    .bg-orange2 {
        background-color: #EEAA7B;
        color: black;
    }
    
    .bg-green2 {
        background-color: #66B9BF;
        color: black;
    }
    
    .nav-link {
        color: black;
    }
    
    .navbar-light .navbar-nav .nav-link {
        color: black
    }
    
    .navbar-dark .navbar-nav .nav-link {
        color: black;
    }
    
    .navbar-inverse .navbar-brand {
        color: black;
    }
    
    .navbar-expand-sm {
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-pack: start;
        justify-content: space-around;
    }
    
    .row .content {
        vertical-align: bottom;
    }
    
    .page-link {
        color: black;
    }
    
    tr {
        border-bottom: 1pt solid #9f9f9f;
    }
    
    img {
        margin-top: 15px;
        margin-bottom: 15px;
        vertical-align: bottom;
    }
    
    .navbar-brand img {
        margin-top: 0px;
        margin-bottom: 0px;
    }
    
    h2 {
        margin-top: 15px;
        margin-left: 15px;
    }
    
    a {
        color: black;
    }
    
    li {
        float: initial;
    }
    
    p {
        margin: 15px;
    }
    
    #header { font-size: 18px; } footer {
        text-align: center;
        font-size: 8px;
        left: 0;
        bottom: 0;
        width: 100%;
        color: black;
    }
    
    .photo {
        text-align: center;
    }
</style>
<body>
    <?php include "navbar.php"?>
    <div class="container">
        <?php include "header.php"?>
        <div class="content" style="margin-top: 15px; margin-bottom: 15px;">
            <h2>研究生獎助學金</h2>
            <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1">獎助學金系統</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">辦法</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">Q&A</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">
                    <h2>獎助學金系統</h2>
                    <div class="list-group" style="margin: 15px;">
                        <a href="https://portal.ncu.edu.tw/system/134" class="list-group-item list-group-item-action">獎助學金系統</a>
                        <a href="download/獎助學金暨工讀系統~~申請研究生獎學金說明.pptx" class="list-group-item list-group-item-action">系統操作說明</a>
                    </div>
                </div>   
                <div id="section2" class="container tab-pane ">
                    <h2>辦法</h2>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/研究生獎助學金辦法-109年6月1日行政會議通過.pdf" class="list-group-item list-group-item-action">國立中央大學研究生獎助學金辦法(109年6月1日修訂)</a>
                    </div>
                </div>
                <div id="section3" class="container tab-pane ">
                    <h2>Q&A</h2>
                    <div class="list-group" style="margin: 15px;">
                        <span style="font-weight:bold;">Q1：我是在職學生可以申請研究生獎助學金？</span><br>
                        A1：本校研究生獎助學第三條有規定~全職工作者不得申請獎助學金
                        <p>&nbsp;</p>

                        <span style="font-weight:bold;">Q2：我前學期成績有一科不到60分，本學期可以申請研究生獎助學金？</span><br>
                        A2：研究生的成績本70分以下屬不及格，前學期不及格本學期不可以申領研究生獎助學金
                        <p>&nbsp;</p>

                        <span style="font-weight:bold;">Q3：我前學期成績有一科不到60分，本學期可以申請研究生獎助學金？</span><br>
                        A3：研究生的成績本70分以下屬不及格，前學期不及格本學期不可以申領研究生獎助學金
                        <p>&nbsp;</p>

                        <span style="font-weight:bold;">Q4：我是陸生可以申請研究生獎助學金？</span><br>
                        A4：陸生可以申請研究生獎學金，但是不可以擔任勞僱型兼任助理。
                    </div>         
                </div>
            </div>
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>