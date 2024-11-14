<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>表單下載</title>
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
            <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1">學生兵役</a>
                </li>
<!--
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">學生獎懲／操行／請假</a>
                </li>
-->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">學雜費減免</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section4">急難救助金</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section5">生活助學金</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section6">學生獎懲</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">
                    <h2>學生兵役</h2>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/國立中央大學學生申請暫緩徵集用證明書.docx" class="list-group-item list-group-item-action">國立中央大學學生申請暫緩徵集用證明書 (.doc)</a>
                        <a href="download/國立中央大學學生申請暫緩徵集用證明書.odt" class="list-group-item list-group-item-action">國立中央大學學生申請暫緩徵集用證明書 (.odt)</a>
                        <a href="download/具有役男身分因奉派或推薦出國學生名冊.docx" class="list-group-item list-group-item-action">具有役男身分因奉派或推薦出國學生名冊 (.doc)</a>
                        <a href="download/具有役男身分因奉派或推薦出國學生名冊.odt" class="list-group-item list-group-item-action">具有役男身分因奉派或推薦出國學生名冊 (.odt)</a>
                        <!-- <a href="download/國立中央大學役男兵役資料表.doc" class="list-group-item list-group-item-action">國立中央大學役男兵役資料表 (.doc)</a>
                        <a href="download/國立中央大學役男兵役資料表.odt" class="list-group-item list-group-item-action">國立中央大學役男兵役資料表 (.odt)</a> -->
                        <a href="download/折抵役期申請文件.doc" class="list-group-item list-group-item-action">折抵役期申請文件 (.doc)</a>
                        <a href="download/折抵役期申請文件.odt" class="list-group-item list-group-item-action">折抵役期申請文件 (.odt)</a>
                    </div>
                </div>
<!--
                <div id="section2" class="container tab-pane">
                    <h2>學生獎懲／操行／請假</h2>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/國立中央大學學生愛校服務銷過申請表.odt" class="list-group-item list-group-item-action">國立中央大學學生愛校服務銷過申請表</a>
                        <a href="download/國立中央大學獎懲建議表.odt" class="list-group-item list-group-item-action">國立中央大學獎懲建議表</a>
                        <a href="download/國立中央大學學生請假單.doc" class="list-group-item list-group-item-action">國立中央大學學生請假單</a>
                        <a href="download/國立中央大學學生銷過申請愛校服務考核表.odt" class="list-group-item list-group-item-action">國立中央大學學生銷過申請愛校服務考核表</a>
                    </div>
                </div>
-->
                <div id="section3" class="container tab-pane">
                    <h2>學雜費減免</h2>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/軍公教遺族子女就學優待申請書.doc" class="list-group-item list-group-item-action">軍公教遺族子女就學優待申請書 (.doc)</a>
                        <a href="download/軍公教遺族子女就學優待申請書.odt" class="list-group-item list-group-item-action">軍公教遺族子女就學優待申請書 (.odt)</a>
                        <a href="download/學生報告.docx" class="list-group-item list-group-item-action">學生報告 (.docx)</a>
                        <a href="download/學生報告.odt" class="list-group-item list-group-item-action">學生報告 (.odt)</a>
                        
                    </div>
                </div>
                <div id="section4" class="container tab-pane">
                    <h2>急難救助金</h2>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/教育部學產基金申請表及檢核清單20200414.pdf" class="list-group-item list-group-item-action">教育部學產基金申請表及檢核清單 (.pdf)</a>
                        <a href="download/國立中央大學學生急難救助金申請表(1090416).doc" class="list-group-item list-group-item-action">國立中央大學學生急難救助金申請表 (.doc)</a>
                        <a href="download/國立中央大學學生急難救助金申請表(1090416).odt" class="list-group-item list-group-item-action">國立中央大學學生急難救助金申請表 (.odt)</a>
                        <a href="download/英文版_國立中央大學學生急難救助金申請表_1090416.pdf" class="list-group-item list-group-item-action">Application Form for Emergency Relief Fund (.pdf)</a>
                        <a href="download/2-行天宮急難濟助個案轉介申請表.pdf" class="list-group-item list-group-item-action">行天宮急難濟助個案轉介申請表 (.pdf)</a>
                        <a href="download/中華民國諸聖功德會急難救助個案申請表.pdf" class="list-group-item list-group-item-action">中華民國諸聖功德會急難救助個案申請表 (.pdf)</a>
                    </div>
                </div>
                <div id="section5" class="container tab-pane">
                    <h2>生活助學金</h2>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/113年度生活助學金申請表.pdf" class="list-group-item list-group-item-action">113年度生活助學金申請表(113年1月至12月) (.pdf)</a>
                    </div>
                </div>
                <div id="section6" class="container tab-pane">
                    <h2>學生獎懲</h2>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/學生請假獎懲系統權限申請表.docx" class="list-group-item list-group-item-action">學生請假獎懲系統權限申請表 (.docx)</a>
                        <a href="download/學生請假獎懲系統權限申請表.odt" class="list-group-item list-group-item-action">學生請假獎懲系統權限申請表 (.odt)</a>
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