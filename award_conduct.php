<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>學生獎懲／操行</title>
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
            <h2>學生獎懲／操行</h2>
            <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1">辦法</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">學生獎懲系統操作說明</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">獎懲紀錄證明</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">  
                    <h2>辦法</h2>
                    <div class="list-group" style="margin: 15px;">                
                    <a href="download/中央大學學生獎懲處理流程112.3.6修.pdf" class="list-group-item list-group-item-action">獎懲處理流程 (.pdf)</a>
                    <a href="download/國立中央大學學生獎懲辦法(民國112年11月14日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生獎懲辦法(民國112年11月14日修訂) (.pdf)</a>
                    <a href="download/國立中央大學學生銷過實施要點(民國112年6月2日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生銷過實施要點(民國112年6月2日修訂) (.pdf)</a>
                    <a href="download/學生操行成績評定辦法(民國112年6月2日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生操行成績評定辦法(民國112年6月2日修訂) (.pdf)</a>
                </div>  
                </div>
                    <div id="section2" class="container tab-pane">   
                        <div class="list-group" style="margin: 15px;">               
                        <a href="download/學生獎懲建議功能之操作手冊.pdf" class="list-group-item list-group-item-action">學生獎懲系統操作說明-行政人員版 (.pdf)</a>  
                </div>
                </div>
                    <div id="section3" class="container tab-pane">   
                        <div class="list-group" style="margin: 15px;">               
                        <a href="https://docs.google.com/forms/d/14WdJDTGVy-usEjEPJIQPGrW8ClD-z4OUiyp0SwL7AIY/viewform?edit_requested=true" class="list-group-item list-group-item-action">獎懲紀錄證明申請(限中央大學已畢業學生)</a>  
                </div>
            </div>
        </div>
        <br>
        <hr><br>
        <a href="#Z" title="下方功能區塊" id="AZ" accesskey="Z" name="Z">:::</a>

    </div>

    <?php include "footer.php"?>
</body>

</html>