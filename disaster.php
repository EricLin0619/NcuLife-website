<?php require_once('conn_military.php');  ?>

<?php
    // header("Content-Type: text/html; charset=utf-8");
    // if(!isset($_SESSION)) { session_start(); }
    // if(!isset($_SESSION['browse'])){
    //     $_SESSION['browse'] = 0;
    // }
    // $browse = $_SESSION['browse'];
    // if ($browse == 0){
    //     header('Location: epaper/index.php');
    //     exit;
    // }
?>
<?php

    //今天日期
    $today = intval(date("U",mktime(0,0,0,date('m'),date('d'),date('Y'))/86400));

    //最新消息
    $currentPage = $_SERVER["PHP_SELF"];
    $maxRows_military_bulletin = 8;
    $pageNum_military_bulletin = 0;

    if (isset($_GET['pageNum_military_bulletin'])) {
        $pageNum_military_bulletin = $_GET['pageNum_military_bulletin'];
    }
    $startRow_military_bulletin = $pageNum_military_bulletin * $maxRows_military_bulletin;

    if (isset($_GET['class'])) { 
        $class_select = "WHERE `class` ='".$_GET['class']."' AND `day_end` <= '$today'"; 
    }
    else{ 
        $class_select = "WHERE `day_end` <= '$today'";
    }

    mysqli_select_db($conn_military, $database_conn_military);
    $query_military_bulletin = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '防制詐騙' ORDER BY time DESC");
    $query_limit_military_bulletin = sprintf("%s LIMIT %d, %d", $query_military_bulletin, $startRow_military_bulletin, $maxRows_military_bulletin);
    $military_bulletin = mysqli_query($conn_military,$query_limit_military_bulletin) or die(mysqli_connect_error());
    $row_military_bulletin = mysqli_fetch_assoc($military_bulletin);
    $totalRows_military_bulletin = mysqli_num_rows($military_bulletin);

    if (isset($_GET['totalRows_military_bulletin'])) {
        $totalRows_military_bulletin = $_GET['totalRows_military_bulletin'];
    } else {
        $all_military_bulletin = mysqli_query($conn_military,$query_military_bulletin);
        $totalRows_military_bulletin = mysqli_num_rows($all_military_bulletin);
    }
    $totalPages_military_bulletin = ceil($totalRows_military_bulletin/$maxRows_military_bulletin)-1;

    //最新消息(置頂)

    if (isset($_GET['class'])) { $class_select2 = "WHERE `class` ='".$_GET['class']."' AND `day_end` > '$today'"; }else{ $class_select2 = "WHERE `day_end` > '$today'";}

    $query_military_bulletin_top = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '防制詐騙' ORDER BY time DESC");
    $military_bulletin_top = mysqli_query($conn_military,$query_military_bulletin_top) or die(mysqli_error());
    $row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top);
    $totalRows_military_bulletin_top = mysqli_num_rows($military_bulletin_top);
?>

<!DOCTYPE html>
<html lang="zh">
 
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>災害防救</title>
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
        <h2>災害防救</h2>
        <br>
            <ul>
                <li>
                    <details>
                        <summary><h4><u><a href = "./download/112_0008_校園災害防救計畫書-本文-112.3.28.pdf">相關資料 1 : 校園災害防救計畫書(112年3月)</a></u></h4></summary>
                    </details>
                </li>
                <li>
                    <details>
                        <summary><h4><u><a href = "./download/防災地圖-最後修正版.pdf">相關資料 2 : 防災地圖-最後修正版(111年9月)</a></u></h4></summary>
                    </details>
                </li>
                <li>
                    <details>
                        <summary><h4><u><a href = "./download/113年全民地震避難網路演練開跑了!.mp4">113年全民地震避難網路演練開跑了!</a></u></h4></summary>
                    </details>                      
                </li>
                <li>
                    <details>
                        <summary><h4><u><a href = "./download/地震時的應變 微學習影片.mp4">地震時的應變</a></u></h4></summary>
                    </details>                      
                </li>
            </ul>
                
             <br>
        </div>
    </div>

    <?php include "footer.php"?>
</body>

</html>
<?php
mysqli_free_result($military_bulletin);

mysqli_free_result($military_bulletin_top);
?>