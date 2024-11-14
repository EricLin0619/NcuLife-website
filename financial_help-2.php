<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>弱勢助學計畫-生活助學金</title>
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
            <h2>弱勢助學計畫-生活助學金</h2>
            <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1">辦法</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">申請程序</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">申請表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section4">Q&A</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">
                    <div id="辦法" class="tabcontent" style="display: block;">
                        <h2>辦法</h2>
                        <div class="list-group" style="margin: 15px;">
                            <a href="download/國立中央大學學生生活助學金實施辦法(民國106年10月23日修正).pdf" class="list-group-item list-group-item-action">國立中央大學學生生活助學金實施辦法</a>
                        </div>
                    </div>
                </div>
                <div id="section2" class="container tab-pane">
                    <div id="申請流程" class="tabcontent" style="display: block;">
                        <h2>申請程序</h2>
                        <div class="list-group" style="margin: 15px;">
                            <h4>一、申請資格 :</h4>
                            <p>1. 前一年度全戶所得70萬元以下、全戶所得650萬元以下全戶利息不得超過2萬元。</p>
                            <p>2. 中低收入戶。</p>
                            <h4>二、申請期間 : <span style="font-weight:bold;">即日起至10月18日止。</span></h4>
                            <h4>三、申請方式 :</h4>
                            <p>表格 : 生活助學申請表</p>
                            <p>附件 :</p>
                            <p>1. 請檢附全戶戶籍謄本、</p>
                            <p>2. 國稅局核發之各類所得資料清單、</p>
                            <p>3. 財產歸屬清單及生活助學服務學習申請表</p>
                            <p>逕向學務處生活輔導組申辦。</p>
                        </div>
                    </div>
                </div>
                <div id="section3" class="container tab-pane">
                    <div id="表格" class="tabcontent" style="display: block;">
                        <h2>申請表</h2>
                        <div class="list-group" style="margin: 15px;">
                            <p style="font-weight:bold; color: red;">申請期間：即日起至10月18日</p>
                            <a href="download/113年度生活助學金申請表.pdf" class="list-group-item list-group-item-action">113年度生活助學金申請表(113年1月至12月)</a>
                            <a href="download/114年度生活助學金申請表.pdf" class="list-group-item list-group-item-action">114年度生活助學金申請表(114年1月至12月)</a>
                        </div>  
                    </div>
                </div>
                <div id="section4" class="container tab-pane">
                    <div id="Q&A" class="tabcontent" style="display: block;">
                        <h2>Q&A</h2>                    
                        <div class="list-group" style="margin: 15px;">
                            Q1：生活助學金每月應配合服務幾小時?去哪兒服務<br>
                            A1：每月應服務25小時，生輔組會分配學生至校內單位內服務，儘量固定單位服務。
                            <p>&nbsp;</p>

                            Q2：生活助學金每月多少錢？<br>
                            A2：每月支付生活助學學生6,000元之助學金
                            <p>&nbsp;</p>

                            Q3：我前學期成績有一科不到60分，本學期可以申請生活助學金？<br>
                            A3：前學期成績未超過60分，本學期不得申請生活助學金
                            <p>&nbsp;</p>

                            Q4：請問寒暑假有生活助學服務學習？<br>
                            A4：寒、暑假(2月、7月、8月)不必生活助學服務學習也不支付助學金。
                            <p>&nbsp;</p>
                        </div>
                        
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