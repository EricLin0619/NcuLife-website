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

    if (isset($_GET['class'])) { 
        $class_select = "WHERE `class` ='".$_GET['class']."' AND `day_end` <= '$today'"; 
    }
    else{ 
        $class_select = "WHERE `day_end` <= '$today'";
    }

    mysqli_select_db($conn_military, $database_conn_military);
    $query_military_bulletin = sprintf("SELECT * FROM `military_bulletin` $class_select ORDER BY time DESC");
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

    $query_military_bulletin_top = sprintf("SELECT * FROM `military_bulletin` $class_select2 ORDER BY time DESC, poster_real DESC");
    $military_bulletin_top = mysqli_query($conn_military,$query_military_bulletin_top) or die(mysqli_error());
    $row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top);
    $totalRows_military_bulletin_top = mysqli_num_rows($military_bulletin_top);
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <title>國立中央大學生活輔導組</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/homepage/logos.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CLHSRC7YPQ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-CLHSRC7YPQ');
    </script>

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
    }

    .row .content {
        vertical-align: bottom;
    }

    .page-link {
        color: black;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    tr {
        border-bottom: 1pt solid #9f9f9f;
    }

    .title img {
        margin-top: 15px;
        margin-bottom: 15px;
        vertical-align: bottom;
    }

    .navbar-brand img {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .row img {
        vertical-align: bottom;
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

    td img {
        height: 21px;
        vertical-align: middle;
    }

    .head {
        width: 20%;
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

    #header {
        font-size: 18px;
    }

    .toggle_menu {
        position: fixed;
        top: 254px;
        z-index: 2;
    }

    .sideMenu {
        width: 180px;
        height: 100%;
        background-color: #EEAA7B;
        border-right: 3px solid #d1d1d1;
        display: flex;
        flex-direction: column;
        padding: 15px 0;
        box-shadow: 5px 0 5px rgba(23, 23, 54, .6);
        position: relative;
        transform: translateX(-100%);
        transition: 0.5s;
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    .sideMenu form {
        display: flex;
        margin: 0 10px 50px;
        border-radius: 100px;
        border: 1px solid #fff;
    }

    .sideMenu form input {
        width: 230px;
    }

    .sideMenu form button {
        width: 50px;
    }

    .sideMenu form input,
    .sideMenu form button {
        border: none;
        padding: 5px 10px;
        background-color: transparent;
        color: #fff;
    }

    .sideMenu form input:focus,
    .sideMenu form button:focus {
        outline: none;
    }

    .sideMenu label {
        position: absolute;
        width: 20px;
        height: 80px;
        background-color: #d1d1d1;
        color: #686666;
        right: -20px;
        top: 0;
        bottom: 0;
        margin: auto;
        line-height: 80px;
        text-align: center;
        border-radius: 0 5px 5px 0;
        box-shadow: 5px 0 5px rgba(23, 23, 54, .6);
    }

    #sideMenu--active:checked+.sideMenu {
        transform: translateX(0);
    }

    #sideMenu--active:checked+.sideMenu label .fas {
        transform: scaleX(-1);
    }

    #sideMenu--active {
        position: absolute;
        opacity: 0;
        z-index: -1;
    }

    nav a {
        display: block;
        color: #fff;
        padding: 20px 10px;
        position: relative;
    }

    nav a .fas {
        margin-right: -1.1em;
        transform: scale(0);
        transition: 0.3s;
    }

    nav a:hover .fas {
        margin-right: 0em;
        transform: scale(1);
    }

    nav a+a::before {
        content: '';
        position: absolute;
        border-top: 1px dashed #fff;
        left: 10px;
        right: 10px;
        top: 0px;
    }

    .dropdown-menu a:hover {
        background-color: white;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    #AZ:focus {
        background-color:red;
    }

</style>

<body>
    <?php
        include('navbar.php');
     ?>
    <div class="container">
        <?php include "header.php"?>

        <!--跑馬燈-->
        <div id="maquee_T">
            <?php include "maquee.php"?>
        </div>
        <!--end 跑馬燈-->
        <div class="col-md-12">
            <?php if(isset($_SESSION['military_Username'])){ ?>
            <button class="btn btn-dark" onclick="location.href='post_add.php'">新增</button>
            <button class="btn btn-dark" onclick="location.href='logout.php'">登出</button>
            <!--h3>
                    <p class="style2">　<a href="post_add.php">【新增】</a>　<a href="logout.php">【登出】</a></p>
                </h3--><?php }?>
        </div>
        <div class="row">
            <div class="col-md-9">
                <h2><a href="index.php" title="前往最新公告列表"><span class="fa fa-bullhorn"> 最新公告</span></a></h2>
            </div>
            <div class="dropdown col-md-2" style="margin-top: 20px;">
                <form name='form1'>
                    <label for="classify">公告類別：</label>
                    <select class="custom-select" 
                            name="classify" 
                            id="classify" 
                            title="選擇要查詢的公告類別"
                            onChange="window.open('?class=' +document.form1.classify.value,'_parent');">
                        <option value="0" selected>查詢類別消息</option>
                        <option value="校園安全">校園安全</option>
                        <option value="交通安全">交通安全</option>
                        <option value="防藥物濫用">防藥物濫用</option>
                        <option value="軍訓通訊">軍訓通訊</option>
                        <option value="遺失物協尋">遺失物協尋</option>
                        <option value="品德教育">品德教育</option>
                        <option value="智慧財產">智慧財產</option>
                        <option value="獎助學金">獎助學金</option>
                        <option value="學生兵役">學生兵役</option>
                        <option value="就學貸款">就學貸款</option>
                        <option value="學雜費減免">學雜費減免</option>
                        <option value="急難救助">急難救助</option>
                        <option value="弱勢助學">弱勢助學</option>
                        <option value="學生請假">學生請假</option>
                        <option value="學生獎懲">學生獎懲</option>
                        <option value="其他">其他</option>
                    </select>
                </form>
            </div>
        </div>
        <!--div class="row">
            <img src="images/plus.png" style="height: 50px">
        </div-->
        <div class="row">
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
                        <tr>
                            <!--置頂公告-->
                            <td><?php echo substr($row_military_bulletin_top['time'],0,10); ?></td>
                            <td><?php echo $row_military_bulletin_top['class']; ?></td>
                            <td><a href="post_detail.php?no=<?php echo $row_military_bulletin_top['no']; ?>" title="查看公告：<?php echo $row_military_bulletin_top['title']; ?>">
                                <?php echo $row_military_bulletin_top['title']; ?>
                                <img src="images/Bulb.gif" width="35" height="40" alt="置頂公告標示" />
                            </a></td>
                        </tr>
                        <?php } while ($row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top)); ?>
                        <?php } ?>
                        <?php do { ?>
                        <tr>
                            <td><?php echo substr($row_military_bulletin['time'],0,10);?></td>
                            <td><?php echo $row_military_bulletin['class'];?></td>
                            <td><a href="post_detail.php?no=<?php echo $row_military_bulletin['no']; ?>" title="查看公告：<?php echo $row_military_bulletin['title']; ?>">
                                <?php echo $row_military_bulletin['title']; ?>
                            </a></td>
                        </tr>
                        <?php } while ($row_military_bulletin = mysqli_fetch_assoc($military_bulletin)); ?>
                        <tr>
                            <td colspan="3" class="text-center"></td>
                        </tr>
                    </tbody>
                </table>
                <nav class="text-center">
                    <ul class="pagination">
                        <?php
                            $queryString_military_bulletin = "";
                            if (empty($_GET['class'])){
					    ?>
                        <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, 0, $queryString_military_bulletin); ?>" title="前往第一頁">
                            <span aria-hidden="true">第一頁</span>
                        </a></li>
                        <?php
                            if($pageNum_military_bulletin>0){?>
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $pageNum_military_bulletin-1, $queryString_military_bulletin); ?>" title="前往上一頁">
                                    <span aria-hidden="true">上一頁</span>
                                </a></li>
                        <?php }?>
                        <?php
							if($pageNum_military_bulletin<$totalPages_military_bulletin){
                                $i = $pageNum_military_bulletin + 1;
                                while($i-$pageNum_military_bulletin <= 10){
                                    if($i-1 <= $totalPages_military_bulletin){
                                        ?>
                        <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $i-1, $queryString_military_bulletin); ?>" title="前往第 <?php echo $i ?> 頁">
                            <?php echo $i ?>
                        </a></li>
                        <?php
                            $i += 1;
                            }
                            else{
                                break;
                            }
                                    }
                                            } 
                        ?>
                        <?php
                            if($pageNum_military_bulletin<$totalPages_military_bulletin){?>
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $pageNum_military_bulletin+1, $queryString_military_bulletin); ?>" title="前往下一頁">
                                    <span aria-hidden="true">下一頁</span>
                                </a></li>
                            <?php }?>
                        <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $totalPages_military_bulletin, $queryString_military_bulletin); ?>" title="前往最末頁">
                            <span aria-hidden="true">最末頁</span>
                        </a></li>
                        <?php
								}
								else if (!empty($_GET['class']))
								{
									$c = $_GET['class'];
									?>
                        <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, 0, $queryString_military_bulletin); ?>" title="前往第一頁">
                            <span aria-hidden="true">第一頁</span>
                        </a></li>
                        <?php
							for($i = 0; $i <= $totalPages_military_bulletin; $i++){
											?>
                        <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, $i, $queryString_military_bulletin); ?>" title="前往第 <?php echo ($i+1) ?> 頁">
                            <?php echo ($i+1) ?>
                        </a></li>
                        <?php
									}
									?>
                        <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, $totalPages_military_bulletin, $queryString_military_bulletin); ?>" title="前往最末頁">
                            <span aria-hidden="true">最末頁</span>
                        </a></li>
                        <?php
								}
								?>
                    </ul>
                </nav>
            </div>
            <!--div class="col-md-2">
                <h4 style="margin: 15px;"><span class="fa fa-link"> 快速連結</span></h4>
                <ul class="nav flex-column bg-orange2 nav-light" style="border-radius: 15px;">
                    <li class="nav-item">
                        <a class="nav-link" href="http://cis.ncu.edu.tw/iNCU/academic/register/checkStudentState" title="前往兵役緩徵查詢系統">兵役緩徵查詢</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Q&A.php" title="查看常見問題與解答">常見Q&A</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://cis.ncu.edu.tw/Scholarship" title="前往獎助學金管理系統">獎助學金管理系統</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://portal.ncu.edu.tw/system/42">就學補助系統</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="review.php">活動回顧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="images/map.png">校園安全地圖</a>
                    </li>
                </ul>
            </div-->
        </div>
        <h2><span class="fa fa-list-alt"> 生輔組活動</span></h2>
        <br>
        <div class="row">
            <div class="card" style="width: 18rem; margin: auto;">
                <img class="card-img-top" src="images/review/110上各項封面.JPG" alt="110學年度上學期獎學金頒獎典禮照片">
                <div class="card-body">
                    <h4 class="card-title"><strong>110上各項獎學金頒獎典禮</strong></h4>
                    <p class="card-text">包含本校各項獎學金，如羅家倫校長紀念獎學金、優學學生獎學金等，圖中為110學年度上學期的得獎者及各級師長。</p>
                    <a href="https://photos.app.goo.gl/R3h4kqcFMiEM6ZDU6" class="btn btn-dark" title="查看110學年度上學期獎學金頒獎典禮相簿">相簿連結</a>
                </div>
            </div>
            <div class="card" style="width: 18rem; margin: auto; ">
                <img class="card-img-top" src="images/review/110朱順一封面.JPG" alt="110學年度朱順一合勤獎學金頒獎典禮照片">
                <div class="card-body">
                    <h4 class="card-title"><strong>朱順一合勤獎學金頒獎典禮</strong></h4>
                    <p class="card-text">合勤科技董事長朱順一博士勉勵同學「態度決定高度」，眼界多大世界就有多大，藉由本項獎學金讓更多優秀學子用教育翻轉人生。</p>
                    <a href="https://photos.app.goo.gl/rGwejUaRcc7Jhvsi7" class="btn btn-dark">相簿連結</a>
                    <!-- "http://studentservices.ncu.edu.tw/wp/simpleviewer/20190614/index.php"-->
                </div>
            </div>
            <div class="card" style="width: 18rem; margin: auto;">
                <img class="card-img-top" src="images/review/109上各項.jpg" alt="109學年度上學期獎學金頒獎典禮照片">
                <div class="card-body">
                    <h4 class="card-title"><strong>109上各項獎學金頒獎典禮</strong></h4>
                    <p class="card-text">包含本校各項獎學金，如羅家倫校長紀念獎學金、優學學生獎學金等，圖中為109學年度上學期的得獎者及各級師長。</p>
                    <a href="https://photos.app.goo.gl/zhZRJdg6Du2W5LD57" class="btn btn-dark">相簿連結</a>
                </div>
            </div>
        </div>
        <br>
        <hr><br>
        
    </div>
    <a href="#Z" title="前往下方功能區塊" id="AZ" accesskey="Z" name="Z">:::</a>
    <?php include "footer.php"?>
</body>

</html>
<?php
mysqli_free_result($military_bulletin);

mysqli_free_result($military_bulletin_top);
?>
