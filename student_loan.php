<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>就學貸款</title>
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
            <h2>相關規定</h2>
            <div class="list-group" style="margin: 15px;">
                <a href="download/高級中等以上學校學生就學貸款辦法.pdf" class="list-group-item list-group-item-action">高級中等以上學校學生就學貸款辦法 (.pdf)</a>
                <a href="download/高級中等以上學校學生就學貸款作業要點.pdf" class="list-group-item list-group-item-action">高級中等以上學校學生就學貸款作業要點 (.pdf)</a>
                <a href="download/宣導EDM1.jpg" class="list-group-item list-group-item-action">就學貸款輕鬆還新措施 - 宣傳單</a>
                <!--<a href="https://drive.google.com/open?id=1GkwezFutK-adzjK8vekkbuljs2sXhSA" class="list-group-item list-group-item-action">就學貸款輕鬆還新措施 - 宣傳影片</a>-->
            </div>
            <h2>作業流程</h2>
            <div class="list-group" style="margin: 15px;">
                <a href="download/就學貸款作業程序.odt" class="list-group-item list-group-item-action">就學貸款作業程序 (.odt)</a>
                <a href="download/就學貸款作業程序.docx" class="list-group-item list-group-item-action">就學貸款作業程序 (.docx)</a>
            </div>
            <h2>相關連結</h2>
            <div class="list-group" style="margin: 15px;">
                <a href=" https://sloan.bot.com.tw/newsloan/login/SLoanLogin.action" class="list-group-item list-group-item-action">臺灣銀行就學貸款入口網</a>
            </div>    
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>