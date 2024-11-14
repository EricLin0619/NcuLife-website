<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>聯絡我們</title>
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
        .dropdown-menu a:hover {
    background-color: white;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>
<body>
    <?php include "navbar.php"?>
    <div class="container">
        <?php include "header.php"?>
        <div class="content" style="margin-top: 15px; margin-bottom: 15px;">
            <div>
                <h2>地理位置</h2>
                <p>本校生活輔導組位於中正圖書館1樓（面志希館）。</p>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d904.2340595443861!2d121.19388548808294!3d24.96828391476272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346823c1e0193afd%3A0x710895ef871b6ecd!2z5ZyL56uL5Lit5aSu5aSn5a245Lit5q2j5ZyW5pu46aSo!5e0!3m2!1szh-TW!2stw!4v1580451877770!5m2!1szh-TW!2stw"
                    title="國立中央大學生活輔導組位置地圖，位於中正圖書館1樓（面志希館）"
                    width="99%" 
                    height="450px" 
                    frameborder="0" 
                    style="border:0; margin: 15px;" 
                    allowfullscreen="true"
                    aria-label="生活輔導組位置地圖">
                </iframe>
            </div>
            <div>
                <h2>服務電話</h2>
                <table class="table table-hover" style="margin: 15px; width: 100%;">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td>電話</td>
                            <td>(03)4227151 #57212</td>
                        </tr>
                        <tr>
                            <td>校安專線</td>
                            <td>03-2805666 / 0911-949-630</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <hr><br>
        <br>
        <hr><br>
            <a href="#Z" title="下方功能區塊" id="AZ" accesskey="Z" name="Z">:::</a>

    </div>

    <?php include "footer.php"?>
</body>

</html>