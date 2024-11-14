<?php require_once('conn_military.php');  ?>

<!--?php
    header("Content-Type: text/html; charset=utf-8");
    if(!isset($_SESSION)) { session_start(); }
    if(!isset($_SESSION['browse'])){
        $_SESSION['browse'] = 0;
    }
    $browse = $_SESSION['browse'];
    if ($browse == 0){
        header('Location: epaper/index.php');
        exit;
    }
?-->
<?php

    //今天日期
    $today = intval(date("U",mktime(0,0,0,date('m'),date('d'),date('Y'))/86400));

    //最新消息
    $currentPage = $_SERVER["PHP_SELF"];
    $maxRows_military_bulletin = 5;
    $pageNum_military_bulletin = 0;

    if (isset($_GET['pageNum_military_bulletin'])) {
        $pageNum_military_bulletin = $_GET['pageNum_military_bulletin'];
    }
    $startRow_military_bulletin = $pageNum_military_bulletin * $maxRows_military_bulletin;

    // if (isset($_GET['class'])) { 
    //     $class_select = "WHERE `class` ='".$_GET['class']."' AND `day_end` <= '$today'"; 
    // }
    // else{ 
    //     $class_select = "WHERE `day_end` <= '$today'";
    // }

    mysqli_select_db($conn_military, $database_conn_military);
    $query_military_bulletin = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '交通安全' ORDER BY time DESC");
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

    $query_military_bulletin_top = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '交通安全' ORDER BY time DESC");
    $military_bulletin_top = mysqli_query($conn_military,$query_military_bulletin_top) or die(mysqli_error());
    $row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top);
    $totalRows_military_bulletin_top = mysqli_num_rows($military_bulletin_top);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <?php
    // 根據當前頁面設定適當的標題
    $currentPage = basename($_SERVER['PHP_SELF']);
    
    // 設定頁面標題
    switch($currentPage) {
        case 'traffic.php':
            $pageTitle = '交通安全宣導 - 中央大學交通安全宣導網';
            break;
        case 'post_detail.php':
            $pageTitle = '公告詳情 - 中央大學交通安全宣導網';
            break;
        case 'index.php':
            $pageTitle = '首頁 - 中央大學交通安全宣導網';
            break;
        default:
            $pageTitle = '中央大學交通安全宣導網';
            break;
    }
    ?>
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="中央大學交通安全宣導網，提供交通安全資訊、宣導活動及相關規範">
    <meta name="author" content="國立中央大學">
    <meta name="keywords" content="交通安全,中央大學,道路安全,交通宣導">
    
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="中央大學交通安全資訊及宣導活動">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>">
    
    <!-- CSS 和 JS 引入 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/homepage/logos.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- css -->
    <?php include('call_css.php'); ?>
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

    #header {
        font-size: 18px;
    }
    
    footer {
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
        <div style="text-align:center">
            <a target=_blank><img src="images/traffic/10901交通安全周.jpg" width="50%" alt="109年1月交通安全周宣導活動照片"></a>
        </div>
        
        <div class="content" style="margin-top: 15px; margin-bottom: 15px;">
            <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1">最新消息</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">危險道路示意圖</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">交通安全宣導影片</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section5">中央大學周邊道安資訊查詢網</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section6">中央大學交通安全報您知</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section7">路口交會，誰先誰後</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section8">交通安全宣導月</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section9">學校交通資訊圖</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section10">校園附近車禍肇事排行及分析</a>
                </li>   
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section11">社團校園宣導活動</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section12">交通安全宣導成效</a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section13">本校交通安全微電影</a>
                </li>             
            </ul>
        <div class="tab-content">
                <div id="section1" class="container tab-pane active">
                    <div class="col-md-10">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th class="col-md-3 col-xs-3 col-lg-2">公告日期</th>
                                    <th class="col-md-3 col-xs-3 col-lg-2">公告類別</th>
                                    <th class="col-md-6 col-xs-6 col-lg-8">公告標題</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($totalRows_military_bulletin_top > 0 && $pageNum_military_bulletin == 0){ ?>
                                <?php do { ?>
                                <?php } while ($row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top)); ?>
                                <?php } ?>
                                <?php do { ?>
                                <tr>
                                    <td><?php echo substr($row_military_bulletin['time'],0,10);?></td>
                                    <td><?php echo $row_military_bulletin['class'];?></td>
                                    <td><a href="post_detail.php?no=<?php echo $row_military_bulletin['no'];?>"><?php echo $row_military_bulletin['title'];?></a></td>
                                </tr>
                                <?php } while ($row_military_bulletin = mysqli_fetch_assoc($military_bulletin)); ?>
                                <tr>
                                    <td colspan="3" class="text-center"></td>
                                </tr>
                            </tbody>
                        </table>
                        <nav class="text-center hidden-xs hidden-sm">
                            <ul class="pagination">
                                <?php
                                    $queryString_military_bulletin = "";
                                    if (empty($_GET['class'])){
                                ?>
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, 0, $queryString_military_bulletin); ?>"><span aria-hidden="true">第一頁</span></a></li>
                                <?php
                                            for($i = 1; $i <= $totalPages_military_bulletin; $i++){
                                                ?>
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $i-1, $queryString_military_bulletin); ?>"><?php echo $i ?></a></li>
                                <?php
                                            }
                                            ?>
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $totalPages_military_bulletin, $queryString_military_bulletin); ?>"><span aria-hidden="true">最末頁</span></a></li>
                                <?php
                                        }
                                        else if (!empty($_GET['class']))
                                        {
                                            $c = $_GET['class'];
                                            ?>
                                <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, 0, $queryString_military_bulletin); ?>"><span aria-hidden="true">第一頁</span></a></li>
                                <?php
                                            for($i = 0; $i <= $totalPages_military_bulletin; $i++){
                                                ?>
                                <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, $i, $queryString_military_bulletin); ?>"><?php echo ($i+1) ?></a></li>
                                <?php
                                            }
                                            ?>
                                <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, $totalPages_military_bulletin, $queryString_military_bulletin); ?>"><span aria-hidden="true">最末頁</span></a></li>
                                <?php
                                        }
                                        ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div id="section2" class="container tab-pane ">
                    <h2>校外危險道路示意圖</h2>


                    <div class="block">
                        <a href="images/traffic/危險道路3.png" target="_blank" title="查看校外危險道路示意圖">
                            <img src="images/traffic/危險道路3.png" width="100%" alt="中央大學校外危險道路示意圖">
                        </a>
                    </div>
                    <h2>校內危險路段示意圖</h2>
                    <div class="block">
                        <a href="images/traffic/危險道路4.png" target="_blank" title="查看校內危險路段示意圖">
                            <img src="images/traffic/危險道路4.png" width="100%" alt="中央大學校內危險路段示意圖">
                        </a>
                    </div>
                </div>
                <div id="section3" class="container tab-pane ">
                    <h2>交通安全宣導影片</h2>
                    <div class="row">
                        <h3><strong>高齡者行人安全 好習慣篇</strong></h3>
                    </div>
                    <div class="row">
                        <video width="720" height="540" controls>
                            <source src="./video/traffic/112/高齡者行人安全 好習慣篇.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="row">
                        <h3><strong>路死誰手 (30秒版)</strong></h3>
                    </div>
                    <div class="row">
                        <video width="720" height="540" controls>
                            <source src="./video/traffic/112/路死誰手 (30秒版).mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="row">
                        <h3><strong>一起守道安 Life is beautiful</strong></h3>
                    </div>
                    <div class="row">
                        <video width="720" height="540" controls>
                            <source src="./video/traffic/112/一起守道安 Life is beautiful.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>                    
                    <div class="row">
                        <iframe width="50%" height="300" src="https://www.youtube.com/embed/chQQ2ZhAv8E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <br>
                    <div class="row">
                        <iframe width="50%" height="300" src="https://www.youtube.com/embed/rCEyUnmZtsY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <br>
                    <div class="row">
                        <iframe width="50%" height="300" src="https://www.youtube.com/embed/w8IzdLv7BdU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <br>
                    <div class="row">
                        <iframe width="50%" height="300" src="https://www.youtube.com/embed/aKRO8XVaVwo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <br>
                    <div class="row">
                        <iframe width="50%" height="300" src="https://www.youtube.com/embed/mIiD1NORwrE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <br>
                    <div class="row">
                        <iframe width="50%" height="300" src="https://www.youtube.com/embed/xZLAthFDEYY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <br>
                    <div class="row">
                        <video width="720" height="540" controls>
                            <source src="./video/traffic/安全帶上路及黃金60秒.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="row">
                        <h3><strong>安全帶上路及黃金60秒</strong></h3>
                    </div>
                    <div class="row">
                        <video width="720" height="540" controls>
                            <source src="./video/traffic/2022 甲類 大客車-安全影片(中文).mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="row">
                        <h3><strong>2022 甲類大客車-安全影片</strong></h3>
                    </div>
                    <div class="row">
                        <video width="720" height="540" controls>
                            <source src="./video/traffic/youbike傷害險投保(定稿).mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="row">
                        <h3><strong>youbike傷害險投保</strong></h3>
                    </div>
                    <br>
                </div>
                <div id="section5" class="container tab-pane ">
                    <h2>中央大學周邊道安資訊查詢網</h2>
                    <div class="list-group" style="margin: 15px;">
                        <a href="http://roadsafety.tw/SchoolHotSpots" target="_blank" class="list-group-item list-group-item-action">道安資訊查詢網
                        </a>
                        <a href="images/traffic/危險道路1.png" target="_blank">
                            <img src="images/traffic/中央大學周邊.jpeg" width="100%" alt="中央大學周邊道路安全資訊圖">
                        </a>
                    </div>
                </div>
                <div id="section6" class="container tab-pane ">
                    <h2>中大交通安全報您知</h2>  
                    <div class="block">
                        <a href="images/traffic/投影片1.jpg" target="_blank" title="查看最新期交通安全報">
                            <img src="images/traffic/投影片1.jpg" width="60%" alt="交通安全報您知最新期">
                        </a>
                    </div>  
                    <div class="block">
                        <a href="images/traffic/0034期.jpg" target="_blank" title="查看第34期交通安全報">
                            <img src="images/traffic/0034期.jpg" width="60%" alt="交通安全報您知第34期">
                        </a>
                    </div>  
                    <div class="block">
                        <a href="images/traffic/0033期.jpg" target="_blank" title="查看第33期交通安全報">
                            <img src="images/traffic/0033期.jpg" width="60%" alt="交通安全報您知第33期">
                        </a>
                    </div>  
                    <div class="block">
                        <a href="images/traffic/第0032期.jpg" target="_blank" title="查看第32期交通安全報">
                            <img src="images/traffic/第0032期.jpg" width="60%" alt="交通安全報您知第32期">
                        </a>
                    </div>  
                    <div class="block">
                        <a href="images/traffic/第0031期.jpg" target="_blank" title="查看第31期交通安全報">
                            <img src="images/traffic/第0031期.jpg" width="60%" alt="交通安全報您知第31期">
                        </a>
                    </div>   
                    <div class="block">
                        <a href="images/traffic/第0030期.jpg" target="_blank" title="查看第30期交通安全報">
                            <img src="images/traffic/第0030期.jpg" width="60%" alt="交通安全報您知第30期">
                        </a>
                    </div>   
                    <div class="block">
                        <a href="images/traffic/第0029期.jpg" target="_blank" title="查看第29期交通安全報">
                            <img src="images/traffic/第0029期.jpg" width="60%" alt="交通安全報您知第29期">
                        </a>
                    </div>   
                    <div class="block">
                        <a href="images/traffic/第0028期.jpg" target="_blank" title="查看第28期交通安全報">
                            <img src="images/traffic/第0028期.jpg" width="60%" alt="交通安全報您知第28期">
                        </a>
                    </div>   
                    <div class="block">
                        <a href="images/traffic/第0027期.jpg" target="_blank" title="查看第27期交通安全報">
                            <img src="images/traffic/第0027期.jpg" width="60%" alt="交通安全報您知第27期">
                        </a>
                    </div>                    
                    <div class="block">
                        <a href="images/traffic/第0026期.jpg" target="_blank" title="查看第26期交通安全報">
                            <img src="images/traffic/第0026期.jpg" width="60%" alt="交通安全報您知第26期">
                        </a>
                    </div>    
                    <div class="block">
                        <a href="images/traffic/第0025期.jpg" target="_blank" title="查看第25期交通安全報">
                            <img src="images/traffic/第0025期.jpg" width="60%" alt="交通安全報您知第25期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0024期.jpg" target="_blank" title="查看第24期交通安全報">
                            <img src="images/traffic/第0024期.jpg" width="60%" alt="交通安全報您知第24期">
                        </a>
                    </div>    
                    <div class="block">
                        <a href="images/traffic/第0023期.jpg" target="_blank" title="查看第23期交通安全報">
                            <img src="images/traffic/第0023期.jpg" width="60%" alt="交通安全報您知第23期">
                        </a>
                    </div> 
                    <div class="block">
                        <a href="images/traffic/第0022期.jpg" target="_blank" title="查看第22期交通安全報">
                            <img src="images/traffic/第0022期.jpg" width="60%" alt="交通安全報您知第22期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0021期.jpg" target="_blank" title="查看第21期交通安全報">
                            <img src="images/traffic/第0021期.jpg" width="60%" alt="交通安全報您知第21期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0020期.jpg" target="_blank" title="查看第20期交通安全報">
                            <img src="images/traffic/第0020期.jpg" width="60%" alt="交通安全報您知第20期">
                        </a>
                    </div>     
                    <div class="block">
                        <a href="images/traffic/第0019期.jpg" target="_blank" title="查看第19期交通安全報">
                            <img src="images/traffic/第0019期.jpg" width="60%" alt="交通安全報您知第19期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0017期.jpg" target="_blank" title="查看第17期交通安全報">
                            <img src="images/traffic/第0017期.jpg" width="60%" alt="交通安全報您知第17期">
                        </a>
                    </div>   
                    <div class="block">
                        <a href="images/traffic/第0016期.jpg" target="_blank" title="查看第16期交通安全報">
                            <img src="images/traffic/0016期.jpg" width="60%" alt="交通安全報您知第16期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0015期.jpg" target="_blank" title="查看第15期交通安全報">
                            <img src="images/traffic/第0015期.jpg" width="60%" alt="交通安全報您知第15期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0014期.jpg" target="_blank" title="查看第14期交通全報">
                            <img src="images/traffic/第0014期.jpg" width="60%" alt="交通安全報您知第14期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0013期.jpg" target="_blank" title="查看第13期交通安全報">
                            <img src="images/traffic/第0013期.jpg" width="60%" alt="交通安全報您知第13期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0012期.jpg" target="_blank" title="查看第12期交通安全報">
                            <img src="images/traffic/第00012期.jpg" width="60%" alt="交通安全報您知第12期">
                        </a>
                    </div> 
                    <div class="block">
                        <a href="images/traffic/第0011期.jpg" target="_blank" title="查看第11期交通安全報">
                            <img src="images/traffic/第0011期.jpg" width="60%" alt="交通安全報您知第11期">
                        </a>
                    </div>                   
                    <div class="block">
                        <a href="images/traffic/第0010期.jpg" target="_blank" title="查看第10期交通安全報">
                            <img src="images/traffic/第0010期.jpg" width="60%" alt="交通安全報您知第10期">
                        </a>
                    </div>                   
                    <div class="block">
                        <a href="images/traffic/第0009期.jpg" target="_blank" title="查看第9期交通安全報">
                            <img src="images/traffic/第0009期.jpg" width="60%" alt="交通安全報您知第9期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0008期.jpg" target="_blank" title="查看第8期交通安全報">
                            <img src="images/traffic/第0008期.jpg" width="60%" alt="交通安全報您知第8期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0007期.jpg" target="_blank" title="查看第7期交通安全報">
                            <img src="images/traffic/第0007期.jpg" width="60%" alt="交通安全報您知第7期">
                        </a>
                    </div>   
                    <div class="block">
                        <a href="images/traffic/第0006期.jpg" target="_blank" title="查看第6期交通安全報">
                            <img src="images/traffic/交通安全報您知第0006期.jpg" width="60%" alt="交通安全報您知第6期">
                        </a>
                    </div>   
                    <div class="block">
                        <a href="images/traffic/第0005期.jpg" target="_blank" title="查看第5期交通安全報">
                            <img src="images/traffic/交通安全報您知第0005期.jpg" width="60%" alt="交通安全報您知第5期">
                        </a>
                    </div>   
                    <div class="block">
                        <a href="images/traffic/第0004期.jpg" target="_blank" title="查看第4期交通安全報">
                            <img src="images/traffic/交通安全報您知第0004期.jpg" width="60%" alt="交通安全報您知第4期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0003期.jpg" target="_blank" title="查看第3期交通安全報">
                            <img src="images/traffic/交通安全報您知第0003期.jpg" width="60%" alt="交通安全報您知第3期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0002期.jpg" target="_blank" title="查看第2期交通安全報">
                            <img src="images/traffic/第0002期.jpg" width="60%" alt="交通安全報您知第2期">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/第0001期.jpg" target="_blank" title="查看第1期交通安全報">
                            <img src="images/traffic/交通安全報您知第0001期.jpg" width="60%" alt="交通安全報您知第1期">
                        </a>
                    </div>
                </div>
                <div id="section7" class="container tab-pane ">
                    <h2>路口交會，誰先誰後</h2>
                    <div class="block">
                        <a href="post_attachment/images/20220711-095904.jpg" target="_blank" title="查看路口交會規則說明">
                            <img src="post_attachment/images/20220711-095904.jpg" width="60%" alt="路口交會規則說明圖1">
                        </a>
                    </div>
                    <div class="block">
                        <a href="post_attachment/images/20220711-095905.jpg" target="_blank" title="查看路口交會規則說明">
                            <img src="post_attachment/images/20220711-095905.jpg" width="60%" alt="路口交會規則說明圖2">
                        </a>
                    </div>
                    <div class="block">
                        <a href="post_attachment/images/20220711-095904(1).jpg" target="_blank" title="查看路口交會規則說明">
                            <img src="post_attachment/images/20220711-095904(1).jpg" width="60%" alt="路口交會規則說明圖3">
                        </a>
                    </div>
                    <div class="block">
                        <a href="post_attachment/images/20220711-095906.jpg" target="_blank" title="查看路口交會規則說明">
                            <img src="post_attachment/images/20220711-095906.jpg" width="60%" alt="路口交會規則說明圖4">
                        </a>
                    </div>
                    <div class="block">
                        <a href="post_attachment/images/20220711-095931.jpg" target="_blank" title="查看路口交會規則說明">
                            <img src="post_attachment/images/20220711-095931.jpg" width="60%" alt="路口交會規則說明圖5">
                        </a>
                    </div>
                    <div class="block">
                        <a href="post_attachment/images/20220711-095932.jpg" target="_blank" title="查看路口交會規則說明">
                            <img src="post_attachment/images/20220711-095932.jpg" width="60%" alt="路口交會規則說明圖6">
                        </a>
                    </div>
                </div>
                <div id="section8" class="container tab-pane ">
                    <h2>交通安全宣導月</h2>
                    <div class="block">
                        <a href="post_attachment/images/113年交通安全宣導月.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="post_attachment/images/113年交通安全宣導月.jpg" width="60%" alt="113年交通安全宣導月活動照片1">
                        </a>
                    </div>
                    <div class="block">
                        <video width="720" height="540" controls>
                            <source src="post_attachment/video/112學年交通安全月.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="block">
                        <a href="post_attachment/images/放交通安全1.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="post_attachment/images/放交通安全1.jpg" width="60%" alt="113年交通安全宣導月活動照片1">
                        </a>
                    </div>
                    <div class="block">
                        <a href="post_attachment/images/放交通安全2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="post_attachment/images/放交通安全2.jpg" width="60%" alt="113年交通安全宣導月活動照片2">
                        </a>
                    </div>
                    <div class="block">
                        <a href="post_attachment/images/放交通安全3.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="post_attachment/images/放交通安全3.jpg" width="60%" alt="113年交通安全宣導月活動照片3">
                        </a>
                    </div>
                    <div class="block">
                        <a href="post_attachment/images/放交通安全4.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="post_attachment/images/放交通安全4.jpg" width="60%" alt="113年交通安全宣導月活動照片4">
                        </a>
                    </div>
                </div>
                <div id="section9" class="container tab-pane ">
                    <h2>校園交通資訊圖</h2>
                    <div class="block">
                        <a href="images/traffic/危險道路1.png" target="_blank" title="查看校園交通資訊圖">
                            <img src="images/traffic/危險道路1.png" width="100%" alt="中央大學校園交通資訊圖">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/危險道路2.png" target="_blank" title="查看校園交通資訊圖">
                            <img src="images/traffic/危險道路2.png" width="100%" alt="中央大學校園交通資訊圖">
                        </a>
                    </div>

                </div>               
                <div id="section10" class="container tab-pane ">
                    <h2>校園附近車禍肇事排行及分析</h2>
                    <ul class="nav nav-tabs" style="margin: 15px;">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#secsection1">113年1~8月</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#secsection2">112年</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="secsection1" class="container tab-pane active">
                            <h2>113年1~8月</h2>
                            <div class="block">
                            <a href="images/traffic/交通安全.JPG" target="_blank" title="查看113年車禍肇事分析">
                                <img src="images/traffic/交通安全.JPG" width="60%" alt="113年1-8月校園附近車禍肇事分���圖">
                            </a>
                            </div>
                            <div class="block">
                                <a href="images/traffic/投影片2.JPG" target="_blank" title="查看車禍肇事分析">
                                    <img src="images/traffic/投影片2.JPG" width="60%" alt="113年1-8月校園附近車禍肇事分析圖2">
                                </a>
                            </div>
                            <div class="block">
                                <a href="images/traffic/投影片3.JPG" target="_blank" title="查看車禍肇事分析">
                                    <img src="images/traffic/投影片3.JPG" width="60%" alt="113年1-8月校園附近車禍肇事分析圖3">
                                </a>
                            </div>
                            <div class="block">
                                <a href="images/traffic/投影片4.JPG" target="_blank" title="查看車禍肇事分析">
                                    <img src="images/traffic/投影片4.JPG" width="60%" alt="113年1-8月校園附近車禍肇事分析圖4">
                                </a>
                            </div>
                            <div class="block">
                                <a href="images/traffic/投影片5.JPG" target="_blank" title="查看車禍肇事分析">
                                    <img src="images/traffic/投影片5.JPG" width="60%" alt="113年1-8月校園附近車禍肇事分析圖5">
                                </a>
                            </div>
                            <div class="block">
                                <a href="images/traffic/投影片6.JPG" target="_blank" title="查看車禍肇事分析">
                                    <img src="images/traffic/投影片6.JPG" width="60%" alt="113年1-8月校園附近車禍肇事分析圖6">
                                </a>
                            </div>
                        </div>   
                        <div id="secsection2" class="container tab-pane ">
                            <h2>112年</h2>
                            <div class="block">
                            <a href="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0001.jpg" target="_blank" title="查看112年車禍肇事分析">
                                <img src="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0001.jpg" width="60%" alt="112年中央大學附近1000公尺內肇事排行及原因分析圖1">
                            </a>
                            </div>
                            <div class="block">
                                <a href="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0002.jpg" target="_blank" title="查看112年車禍肇事分析">
                                    <img src="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0002.jpg" width="60%" alt="112年中央大學附近1000公尺內肇事排行及原因分析圖2">
                                </a>
                            </div>
                            <div class="block">
                                <a href="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0003.jpg" target="_blank" title="查看112年車禍肇事分析">
                                    <img src="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0003.jpg" width="60%" alt="112年中央大學附近1000公尺內肇事排行及原因分析圖3">
                                </a>
                            </div>
                            <div class="block">
                                <a href="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0004.jpg" target="_blank" title="查看112年車禍肇事分析">
                                    <img src="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0004.jpg" width="60%" alt="112年中央大學附近1000公尺內肇事排行及原因分析圖4">
                                </a>
                            </div>
                            <div class="block">
                                <a href="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0005.jpg" target="_blank" title="查看112年車禍肇事分析">
                                    <img src="images/traffic/中央大學附近1000公尺內肇事排行及原因分析_page-0005.jpg" width="60%" alt="112年中央大學附近1000公尺內肇事排行及原因分析圖5">
                                </a>
                            </div>
                        </div>                
                    </div>
                </div>
                <div id="section11" class="container tab-pane ">
                    <h2>社團校園宣導活動</h2>
                    <br>
                    <h4>113年7月8日慈幼社新北嘉寶國小交通安全宣導</h4>
                    <div class="block">
                        <a href="images/traffic/113年7月8日慈幼社新北嘉寶國小交通安全宣導.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年7月8日慈幼社新北嘉寶國小交通安全宣導.jpg" width="60%" alt="113年7月8日慈幼社新北嘉寶國小交通安全宣導活動照片">
                        </a>
                        <a href="images/traffic/113年7月8日慈幼社新北嘉寶國小交通安全宣導-2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年7月8日慈幼社新北嘉寶國小交通安全宣導-2.jpg" width="60%" alt="113年7月8日慈幼社新北嘉寶國小交通安全宣導活動照片2">
                        </a>
                    </div>
                    <h4>113年7月28日熱舞社參加龍岡歌酒節交通安全宣導</h4>
                    <div class="block">
                        <a href="images/traffic/113年7月28日熱舞社參加龍岡歌酒節交通安全宣導-1.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年7月28日熱舞社參加龍岡歌酒節交通安全宣導-1.jpg" width="60%" alt="113年7月28日熱舞社參加龍岡歌酒節交通安全宣導活動照片1">
                        </a>
                        <a href="images/traffic/113年7月28日熱舞社參加龍岡歌酒節交通安全宣導-2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年7月28日熱舞社參加龍岡歌酒節交通安全宣導-2.jpg" width="60%" alt="113年7月28日熱舞社參加龍岡歌酒節交通安全宣導活動照片2">
                        </a>
                    </div>
                    <h4>113年1月30日慈幼社沙坑國小交通安全宣導</h4>
                    <div class="block">
                        <a href="images/traffic/慈幼社沙坑國小交通安全宣導.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/慈幼社沙坑國小交通安全宣導.jpg" width="60%" alt="慈幼社沙坑國小交通安全宣導活動照片">
                        </a>
                    </div>
                    <h4>113年1月24日基服社冬令隊德化國小交通安全宣導</h4>                   
                    <div class="block">
                        <a href="images/traffic/基服社冬令隊德化國小交通安全宣導.png" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/基服社冬令隊德化國小交通安全宣導.png" width="60%" alt="基服社冬令隊德化國小交通安全宣導活動照片">
                        </a>
                    </div>
 
                </div>
                <div id="section12" class="container tab-pane ">
                    <h2>交通安全宣導成效</h2>
                    <br>
                    <h4>113年10月8日工學院交通安全宣講</h4>
                    <div class="block">
                        <a href="images/traffic/20241008_103222.jpg" target="_blank" title="查看交通安全宣講照片">
                            <img src="images/traffic/20241008_103222.jpg" width="60%" alt="交通安全宣講照片">
                        </a>
                        <a href="images/traffic/IMG_2215_0.JPG" target="_blank" title="查看交通安全宣講照片">
                            <img src="images/traffic/IMG_2215_0.JPG" width="60%" alt="交通安全宣講照片">
                        </a>
                    </div>
                    <h4>113年10月1日管院交通安全宣講</h4>
                    <div class="block">
                        <a href="images/traffic/20241001_110155.jpg" target="_blank" title="查看交通安全宣講照片">
                            <img src="images/traffic/20241001_110155.jpg" width="60%" alt="交通安全宣講照片">
                        </a>
                        <a href="images/traffic/20241001_120929.jpg" target="_blank" title="查看交通安全宣講照片">
                            <img src="images/traffic/20241001_120929.jpg" width="60%" alt="交通安全宣講照片">
                        </a>
                    </div>
                    <h4>113年9月24日物理所交安宣導</h4>
                    <div class="block">
                        <a href="images/traffic/20240924_144852.jpg" target="_blank" title="查看交通安全宣導照片">
                            <img src="images/traffic/20240924_144852.jpg" width="60%" alt="交通安全宣導照片">
                        </a>
                        <a href="images/traffic/20240924_160657.jpg" target="_blank" title="查看交通安全宣導照片">
                            <img src="images/traffic/20240924_160657.jpg" width="60%" alt="交通安全宣導照片">
                        </a>
                    </div>
                    <h4>113年9月5日新進外籍交換生交通安全宣導</h4>
                    <div class="block">
                        <a href="images/traffic/113年9月5日新進外籍交換生交通安全宣導.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年9月5日新進外籍交換生交通安全宣導.jpg" width="60%" alt="113年9月5日新進外籍交換生交通安全宣導活動照片">
                        </a>
                        <a href="images/traffic/113年9月5日新進外��交換生交通安全宣導-2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年9月5日新進外籍交換生交通安全宣導-2.jpg" width="60%" alt="113年9月5日新進外籍交換生交通安全宣導活動照片2">
                        </a>
                    </div>
                    <h4>113年9月3日新進僑生交通安全宣導</h4>
                    <div class="block">
                        <a href="images/traffic/113年9月3日新進僑生交通安全宣導.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年9月3日新進僑生交通安全宣導.jpg" width="60%" alt="113年9月3日新進僑生交通安全宣導活動照片">
                        </a>
                        <a href="images/traffic/113年9月3日新進僑生交通安全宣導-2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年9月3日新進僑生交通安全宣導-2.jpg" width="60%" alt="113年9月3日新進僑生交通安全宣導活動照片2">
                        </a>
                    </div>
                    <h4>113年9月2日新生安全宣導</h4>
                    <div class="block">
                        <a href="images/traffic/113年9月2日新生安全宣導.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年9月2日新生安全宣導.jpg" width="60%" alt="113年9月2日新生安全宣導活動照片">
                        </a>
                        <a href="images/traffic/113年9月2日新生安全宣導-2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年9月2日新生安全宣導-2.jpg" width="60%" alt="113年9月2日新生安全宣導活動照片2">
                        </a>
                    </div>
                    <h4>113年7月22日辦理教職員工交安宣講肇事重建與當事人權益</h4>
                    <div class="block">
                        <a href="images/traffic/113年7月22日辦理教職員工交安宣講肇事重建與當事人權益-1.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年7月22日辦理教職員工交安宣講肇事重建與當事人權益-1.jpg" width="60%" alt="交通安全宣導活動照片1">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/113年7月22日辦理教職員工交安宣講肇事重建與當事人權益-2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年7月22日辦理教職員工交安宣講肇事重建與當事人權益-2.jpg" width="60%" alt="交通安全宣導活動照片2">
                        </a>
                    </div>
                    <h4>113 年7月9日辦理教職員工交安宣講安全防禦駕駛</h4>
                    <div class="block">
                        <a href="images/traffic/113 年7月9日辦理教職員工交安宣講安全防禦駕駛-1.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113 年7月9日辦理教職員工交安宣講安全防禦駕駛-1.jpg" width="60%" alt="交通安全宣導活動照片1">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/113 年7月9日辦理教職員工交安宣講安全防禦駕駛-2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113 年7月9日辦理教職員工交安宣講安全防禦駕駛-2.jpg" width="60%" alt="交通安全宣導活動照片2">
                        </a>
                    </div>
                    <h4>113年5月14日生醫院交通安全宣導</h4>
                    <div class="block">
                        <a href="images/traffic/113年5月14日生醫院交通安全宣導-1.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年5月14日生醫院交通安全宣導-1.jpg" width="60%" alt="交通安全宣導活動照片1">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/113年5月14日生醫院交通安全宣導-2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/113年5月14日生醫院交通安全宣導-2.jpg" width="60%" alt="交通安全宣導活動照片2">
                        </a>
                    </div>
                    <h4>113年4月30日邀請桃園市政府交通局唐英峰技士入班宣導交通安全</h4>
                    <div class="block">
                        <a href="images/traffic/桃��市政府交通局唐英峰技士1.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/桃園市政府交通局唐英峰技士1.jpg" width="60%" alt="交通安全宣導活動照片1">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/桃園市政府交通局唐英峰技士2.jpg" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/桃園市政府交通局唐英峰技士2.jpg" width="60%" alt="交通安全宣導活動照片2">
                        </a>
                    </div>
                    <h4>113年2月17日陸生交通安全宣教</h4>
                    <div class="block">
                        <a href="images/traffic/陸生交通安全宣教.png" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/陸生交通安全宣教.png" width="60%" alt="交通安全宣導活動照片">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/陸生交通安全宣教2.png" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/陸生交通安全宣教2.png" width="60%" alt="交通安全宣導活動照片">
                        </a>
                    </div>
                    <h4>113年2月17日外籍交換生交通安全宣教</h4>                   
                    <div class="block">
                        <a href="images/traffic/外籍交換生交通安全宣教.png" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/外籍交換生交通安全宣教.png" width="60%" alt="交通安全宣導活動照片">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/外籍交換生交通安全宣教1.png" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/外籍交換生交通安全宣教1.png" width="60%" alt="交通安全宣導活動照片">
                        </a>
                    </div>
                    <h4>113年2月17日外籍學位生交通安全宣教</h4>                   
                    <div class="block">
                        <a href="images/traffic/外籍學位生交通安全宣教01.png" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/外籍學位生交通安全宣教01.png" width="60%" alt="交通安全宣導活動照片">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/外籍學位生交通安全宣教02.png" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/外籍學位生交通安全宣教02.png" width="60%" alt="交通安全宣導活動照片">
                        </a>
                    </div>      
                    <h4>113年2月27日文學院學士班交通安全宣教</h4>                   
                    <div class="block">
                        <a href="images/traffic/文學院學士班交通安全宣教.png" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/文學院學士班交通安全宣教.png" width="60%" alt="交通安全宣導活動照片">
                        </a>
                    </div>
                    <div class="block">
                        <a href="images/traffic/文學院學士班交通安全宣教1.png" target="_blank" title="查看交通安全宣導活動">
                            <img src="images/traffic/文學院學士班交通安全宣教1.png" width="60%" alt="交通安全宣導活動照片">
                        </a>
                    </div>
                </div>
                <div id="section13" class="container tab-pane ">
                    <h2>本校交通安全微電影</h2>
                    <div class="row">
                        <video width="720" height="540" controls>
                            <source src="./video/traffic/112/菜鳥松鼠.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="row">
                        <h3><strong>112年交通安全微電影徵件比賽第一名-菜鳥松鼠</strong></h3>
                    </div>
                    <div class="row">
                        <video width="720" height="540" controls>
                            <source src="./video/traffic/112/Squirrels are watching.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="row">
                        <h3><strong>112年交通安全微電影徵件比賽第二名-Squirrels are watching</strong></h3>
                    </div>
                    <div class="row">
                        <video width="720" height="540" controls>
                            <source src="./video/traffic/112/校內自行車安全猴厲害.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="row">
                        <h3><strong>112年交通安全微電影徵件比賽第三名-校內自行車安全猴厲害</strong></h3>
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
<?php
mysqli_free_result($military_bulletin);

mysqli_free_result($military_bulletin_top);
?>