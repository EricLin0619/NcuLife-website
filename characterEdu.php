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
    $query_military_bulletin = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '智慧財產' ORDER BY time DESC");
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

    $query_military_bulletin_top = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '智慧財產' ORDER BY time DESC");
    $military_bulletin_top = mysqli_query($conn_military,$query_military_bulletin_top) or die(mysqli_error());
    $row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top);
    $totalRows_military_bulletin_top = mysqli_num_rows($military_bulletin_top);
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>智慧財產</title>
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
                    <a class="nav-link active" data-toggle="tab" href="#section1">最新公告</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">侵權處理程序</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">活動剪影</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section4">影音資料</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section5">相關連結</a>
                </li>
            </ul>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <marquee>
                    <p style="font-family: Impact; font-size: 18pt">使用未取得合法授權之教材或將試用版教材以公開傳輸利用者，皆屬侵害他人著作權，將處刑責、拘役及罰金，請勿以身試法。</p>
                </marquee>
            </div>
        
            <!--div class="col-md-2">
                <h4 style="margin: 15px;"><span class="fa fa-link"> 快速連結</span></h4>
                <ul class="nav flex-column bg-orange2 nav-light" style="border-radius: 15px;">
                    <li class="nav-item">
                        <a class="nav-link" href="">測試</a>
                </ul>
            </div-->
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">
                    <div class="col-md-12">
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
                                    <td><a href="post_detail.php?no=<?php echo $row_military_bulletin['no'];?>"><?php echo $row_military_bulletin['title'];?></a> </td>
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
                                <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, $totalPages_military_bulletin, $queryString_military_bulletin); ?>"><span aria-hidden="true">最末頁</span></a></li><br>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div id="section2" class="container tab-pane">
                     <img src="images/DrugPrevention/疑似侵害他人智慧財產權處理程序.jpg" style="display: block; margin: auto; width: 100%"><br><br>
                </div>

                <div id="section3" class="container tab-pane">
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
                            <li data-target="#pic" data-slide-to="11"></li>
                            <li data-target="#pic" data-slide-to="12"></li>
                            <li data-target="#pic" data-slide-to="13"></li>
                            <li data-target="#pic" data-slide-to="14"></li>
                            <li data-target="#pic" data-slide-to="15"></li>
                            <li data-target="#pic" data-slide-to="16"></li>
                            <li data-target="#pic" data-slide-to="17"></li>
                            <li data-target="#pic" data-slide-to="18"></li>
                        </ul>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/characterEdu/智財1.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財2.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財3.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財4.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財5.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財6.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財7.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財8.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財9.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財10.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財11.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財12.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財13.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財14.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財15.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財15.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財16.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財17.jpg" height="500px" style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/characterEdu/智財18.jpg" height="500px" style="display: block; margin: auto;">
                            </div>                            
                        </div>
                        <a href="#pic" class="carousel-control-prev" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a href="#pic" class="carousel-control-next" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                        <br><br>
                    </div>
                </div>

                <div id="section4" class="container tab-pane">
                    <div class="row">
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/DiguOPxK-5c" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/3PYN0pm5lL8" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/Oqwiye40OIA" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/dIweUUsOveo" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/uacyxvF73Iw" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/IAHYwqK9PTI" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/yw2OJ6u-luc" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/vU-xWsRhHCw" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/xqNz-n-kv4M" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/vJ_rKEYJaEU" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/5XzJh-OTg_4" frameborder="1" allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/dm-_6IA5M6Q" frameborder="1" allowfullscreen></iframe>
                    </div>
                </div>
                <div id="section5" class="container tab-pane">
                    <div class="list-group">
                        <a href="https://www.tipo.gov.tw/tw/mp-1.html" class="list-group-item list-group-item-action">經濟部智慧財產局</a>
                        <a href="http://www.caic.ncu.edu.tw/index.php?option=com_content&view=article&id=216&Itemid=1529&lang=tw" class="list-group-item list-group-item-action">中央大學產學營運中心</a>
                        <a href="https://www.judicial.gov.tw/tw/lp-1473-1.html" class="list-group-item list-group-item-action">司法院智慧財產訊息公告</a>
                        <a href="https://zh.wikipedia.org/zh-tw/%E7%9F%A5%E8%AF%86%E4%BA%A7%E6%9D%83" class="list-group-item list-group-item-action">維基百科: 智慧財產權</a>

                    </div>
            </div>
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