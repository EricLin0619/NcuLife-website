<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>學生請假</title>
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
            <h2>學生請假</h2>
            <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1">辦法</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">學生請假系統操作說明</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">Q&A</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">  
                    <h2>辦法</h2>
                    <div class="list-group" style="margin: 15px;">                
                    <a href="download/國立中央大學學生請假規則（民國113年6月7日修訂）.pdf" class="list-group-item list-group-item-action">國立中央大學學生請假規則</a>
                    </div>  
                </div>
                <div id="section2" class="container tab-pane"> 
                    <div class="list-group" style="margin: 15px;">                 
                    <a href="download/學生請假系統操作說明-學生(中文版)-1090907.pdf" class="list-group-item list-group-item-action">學生請假系統操作說明-學生(中文版)</a>  
                    <a href="download/Manual of Student Leave Request System– Student  (iNcu).pdf" class="list-group-item list-group-item-action">Manual of Student Leave Request System– Student  (iNcu)</a>
                    <a href="download/學生請假系統操作說明-師長.pdf" class="list-group-item list-group-item-action">學生請假系統操作說明-師長版</a>
                    <a href="download/學生請假系統操作說明-行政人員-1090907.pdf" class="list-group-item list-group-item-action">學生請假系統操作說明-行政人員版</a>  
                    </div>
                </div>
                <div id="section3" class="container tab-pane">
                	<h2>Q&A</h2>  
                	<div class="list-group" style="margin: 15px;">
                		Q1：請假系統支援什麼瀏覽器?<br>
 						A1：Chrome、Microsoft Edge（不支援Firefox、Safari）
 						<p>&nbsp;</p>
						Q2：我想請假，該如何填寫請假單?<br>
						A2：請同學輸入帳號/密碼進入portal，點選便捷窗口/服務櫃台(iNCU)/學務專區/假單申請即可申請。
						<p>&nbsp;</p>
						Q3：連續請假天數較多跨假日，系統會不會自動扣除例假日?<br>
						A3：請較多天的假，系統不扣除例假日及國定假日，同學可考量是否分次分批申請。
						<p>&nbsp;</p>
						Q4：假單送簽核後，會不會通知授課老師?<br>
						A4：假單(申請、撤銷)完成簽核後，系統才會通知授課老師，如有必要同學可於事前以口頭或mail向老師先行報備。
						<p>&nbsp;</p>
						Q5：假單送簽核完成後，學生會不會收到通知?<br>
						A5：假單(申請、撤銷)完成簽核後都會通知同學。
						<p>&nbsp;</p>
						Q6：可以在手機及平板電腦請假?<br>
						A6：手機及平板電腦、個人電腦都可以很方便的操作。
						<p>&nbsp;</p>
						Q7：在假單送出後，請假原因不存在不想請假該如何?<br>
						A7：在送出簽核但未完成簽核流程前可以點選”抽單”，如已全部簽核完成，可以點選撤銷。
                    	<p>&nbsp;</p>      
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