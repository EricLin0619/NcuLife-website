<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>國軍招募</title>
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
        <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1">國軍班隊招募專區</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">活動剪影</a>
                </li>
            </ul>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <marquee>
                <a href="https://rdrc.mnd.gov.tw/" 
                   title="前往國軍人才招募專區網站" 
                   style="font-family: Impact; font-size: 18pt">國軍人才招募專區</a>
            </marquee>
        </div>
        <div class="tab-content">
            <div id="section1" class="container tab-pane active">
                <h2>國軍班隊招募專區</h2>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th class="col-md-3 col-xs-3 col-lg-2">公告年度</th>
                                <th class="col-md-9 col-xs-9 col-lg-8">公告標題</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>113</td>
                                <td>
                                    <a href="Download/國防部114年大學儲備軍官訓練團甄選(招生)簡章.pdf" 
                                       title="下載113年大學儲備軍官訓練團甄選簡章PDF檔案">
                                        113年大學儲備軍官訓練團甄選(招生)簡章
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>109</td>
                                <td>
                                    <a href="Download/109大學儲備軍官甄選簡章.pdf" 
                                       title="下載109大學儲備軍官甄選簡章PDF檔案">
                                        109大學儲備軍官甄選簡章
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>109</td>
                                <td>
                                    <a href="Download/國防部「民國109年國軍志願役專業預備軍官預備士 官班考選簡章」 (1).pdf" 
                                       title="下載國防部「民國109年國軍志願役專業預備軍官預備士 官班考選簡章」PDF檔案">
                                        國防部「民國109年國軍志願役專業預備軍官預備士 官班考選簡章」
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>109</td>
                                <td>
                                    <a href="Download/國防部軍事情報局109年志願役專業預備軍官班簡章.pdf" 
                                       title="下載國防部軍事情報局109年志願役專業預備軍官班簡章PDF檔案">
                                        國防部軍事情報局109年志願役專業預備軍官班簡章
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                    <td colspan="3" class="text-center"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="section2" class="container tab-pane">
                <h3>北區國軍人才招募人員蒞校實施ROTC宣導說明會</h3>
                <div id="pic" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#pic" data-slide-to="0" class="active"></li>
                        <li data-target="#pic" data-slide-to="1"></li>
                        <li data-target="#pic" data-slide-to="2"></li>
                        <li data-target="#pic" data-slide-to="3"></li>
                        <li data-target="#pic" data-slide-to="4"></li>
                        <li data-target="#pic" data-slide-to="5"></li>
                        <li data-target="#pic" data-slide-to="6"></li>
                        <li data-target="#pic" data-slide-to="7"></li>
                        <li data-target="#pic" data-slide-to="8"></li>
                        <li data-target="#pic" data-slide-to="9"></li>
                        <li data-target="#pic" data-slide-to="10"></li>
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/officer_leaflet/ROTC_1.jpg" 
                                 alt="ROTC宣導說明會照片1" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_2.jpg" 
                                 alt="ROTC宣導說明會照片2" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_3.jpg" 
                                 alt="ROTC宣導說明會照片3" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_4.jpg" 
                                 alt="ROTC宣導說明會照片4" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_5.jpg" 
                                 alt="ROTC宣導說明會照片5" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_6.jpg" 
                                 alt="ROTC宣導說明會照片6" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_7.jpg" 
                                 alt="ROTC宣導說明會照片7" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_8.jpg" 
                                 alt="ROTC宣導說明會照片8" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_9.jpg" 
                                 alt="ROTC宣導說明會照片9" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_10.jpg" 
                                 alt="ROTC宣導說明會照片10" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                        <div class="carousel-item">
                            <img src="images/officer_leaflet/ROTC_11.jpg" 
                                 alt="ROTC宣導說明會照片11" 
                                 height="500px" 
                                 style="display: block; margin: auto;">
                        </div>
                    </div>
                    <a href="#pic" class="carousel-control-prev" data-slide="prev" title="顯示上一張圖片">
                        <span class="carousel-control-prev-icon"><</span>
                    </a>
                    <a href="#pic" class="carousel-control-next" data-slide="next" title="顯示下一張圖片">
                        <span class="carousel-control-next-icon">></span>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>