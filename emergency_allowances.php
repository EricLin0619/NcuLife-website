<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>急難救助金</title>
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
        <div>
            <h2>作業流程</h2>
            <div class="list-group" style="margin: 15px;">
                <a href="download/1090521急難救助金流程.doc" class="list-group-item list-group-item-action">急難救助金流程</a>
            </div>
            <h2>表單下載</h2>
            <div class="list-group" style="margin: 15px;">
                <a href="download/教育部學產基金申請表及檢核清單20200414.pdf" class="list-group-item list-group-item-action">教育部學產基金申請表及檢核清單 (.pdf)</a>
                <a href="download/國立中央大學學生急難救助金申請表(1090416).doc" class="list-group-item list-group-item-action">國立中央大學學生急難救助金申請表 (.doc)</a>
                <a href="download/國立中央大學學生急難救助金申請表(1090416).odt" class="list-group-item list-group-item-action">國立中央大學學生急難救助金申請表 (.odt)</a>
                <a href="download/英文版_國立中央大學學生急難救助金申請表_1090416.pdf" class="list-group-item list-group-item-action">Application Form for Emergency Relief Fund (.pdf)</a>
                <a href="download/行天宮急難濟助個案轉介申請表20200414.pdf" class="list-group-item list-group-item-action">行天宮急難濟助個案轉介申請表 (.pdf)</a>
                <a href="download/中華民國諸聖功德會急難救助個案申請表.pdf" class="list-group-item list-group-item-action">中華民國諸聖功德會急難救助個案申請表 (.pdf)</a>
            </div>
            <h2>相關法規</h2>
            <div class="list-group" style="margin: 15px;">
                <a href="download/國立中央大學學生急難救助金實施辦法(民國110年7月12日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生急難救助金實施辦法(民國110年7月12日修訂) (.pdf)</a>
            </div>
        </div>
        <br>
        <hr><br>
    </div>
    <?php include "footer.php"?>    
</body>

</html>
