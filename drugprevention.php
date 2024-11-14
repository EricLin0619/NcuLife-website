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
    $query_military_bulletin = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '防藥物濫用' ORDER BY time DESC");
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

    $query_military_bulletin_top = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '防藥物濫用' ORDER BY time DESC");
    $military_bulletin_top = mysqli_query($conn_military,$query_military_bulletin_top) or die(mysqli_error());
    $row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top);
    $totalRows_military_bulletin_top = mysqli_num_rows($military_bulletin_top);
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>藥物防治</title>
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
                    <a class="nav-link active" data-toggle="tab" href="#section1" title="查看防毒最新消息">防毒最新消息</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2" title="查看防毒組織架構">防毒組織架構</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3" title="查看反毒法令計畫">反毒法令計畫</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section4" title="查看反毒宣導海報">反毒宣導海報</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section5" title="查看活動剪影">活動剪影</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section6" title="查看認識毒品">認識毒品</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section7" title="查看影音專區">影音專區</a>
                </li>
            </ul>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <marquee>
                    <p style="font-family: Impact; font-size: 18pt">危險場所不涉足，拒絕毒品才是酷! Say No to Drugs!</p>
                </marquee>
                <marquee>
                    <p style="font-family: Impact; font-size: 18pt">
                    <<槍砲彈藥刀械管制條例>>修法通過囉! 修法後操作槍將全面納管，如果手上還有操作槍，請於109年6月12日至12月11日帶著操作槍及身分證明文件到戶籍地的警察局或警察分局辦理報備持有，逾期最高將面臨20萬元罰緩。</p>
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
                                    <td><a href="post_detail.php?no=<?php echo $row_military_bulletin['no'];?>" 
                                          title="查看「<?php echo htmlspecialchars($row_military_bulletin['title']); ?>」詳細內容">
                                        <?php echo htmlspecialchars($row_military_bulletin['title']); ?>
                                    </a></td>
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
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, 0, $queryString_military_bulletin); ?>" 
                                      title="前往第一頁">
                                    <span aria-hidden="true">第一頁</span>
                                </a></li>
                                <?php
                                    for($i = 1; $i <= $totalPages_military_bulletin; $i++){
                                        ?>
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $i-1, $queryString_military_bulletin); ?>" 
                                      title="前往第<?php echo $i ?>頁">
                                    <?php echo $i ?>
                                </a></li>
                                <?php
                                    }
                                    ?>
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $totalPages_military_bulletin, $queryString_military_bulletin); ?>" 
                                      title="前往最末頁">
                                    <span aria-hidden="true">最末頁</span>
                                </a></li>
                                <?php
                                }
                                else if (!empty($_GET['class']))
                                {
                                    $c = $_GET['class'];
                                    ?>
                                <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, 0, $queryString_military_bulletin); ?>" 
                                      title="前往第一頁">
                                    <span aria-hidden="true">第一頁</span>
                                </a></li>
                                <?php
                                    for($i = 0; $i <= $totalPages_military_bulletin; $i++){
                                        ?>
                                <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, $i, $queryString_military_bulletin); ?>" 
                                      title="前往第<?php echo ($i+1) ?>頁">
                                    <?php echo ($i+1) ?>
                                </a></li>
                                <?php
                                    }
                                    ?>
                                <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, $totalPages_military_bulletin, $queryString_military_bulletin); ?>" 
                                      title="前往最末頁">
                                    <span aria-hidden="true">最末頁</span>
                                </a></li><br>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div id="section2" class="container tab-pane">
                    <p>我國毒品防制工作，由中央部會與地方政府共同推動，中央係於行政院毒品防制會報下，分「防毒監控組」、「拒毒預防組」、「緝毒合作組」「毒品戒治組」及「綜合規劃組」等5大工作分組；至地方政府之反毒工作，則由各直轄市及縣(市)政府之「毒品危害防制中心」負責，整合衛政、警政、社政、教育、勞政等相關局處資源，推動各項反毒工作。</p>
                    <p>面對社會急遽變遷及新興毒品的推陳出新，校園防制毒品入侵議題面臨強大挑戰，亟待與時俱進，由中央與地方政府、教育部學生校外生活輔導會、各級學校及家長團體建立協力的夥伴關係，以發揮綜效。</p>
                    <p>「教育部防制學生藥物濫用行政支援網絡」即以現行教育督導體制為垂直面，跨單位資源整合與運用為水平面，在中央層級，透過行政院毒品防制會報各分組工作會議、教育部及警政署定期聯繫會議等，建立決策面之溝通協調平臺；在地方行政層級，除毒品危害防制中心定期工作會議外，置重點於地方政府教育局處及學生校外生活輔導會(包括直轄市政府教育局處校安室/軍訓室、各縣市聯絡處，)與警政、社政、衛政聯繫平臺的建立，並結合地檢署、少年法院(庭)、家長團體與民間單位等資源橫向聯繫作為；在學校端，則強化學校-社區-家庭的連結服務。（如圖）</p>
                    <img src="images/DrugPrevention/防治學生藥物濫用行政支援網絡架構圖.png" 
                         alt="防學生藥物濫用行政支援網絡架構圖" 
                         style="display: block; margin: auto;">
                    <br><br>
                    <p>
                        <h3>本校防制學生藥物濫用實施方式：</h3>
                        <b>（一) 教育宣導：</b><br>
                        <a>透過各學期友善校園週、大一新生訓練、各院系週會等方式，邀請專家學者宣教毒品危害所衍生的治安與社會問題，適時提出因應對策，使同學瞭解「防制學生藥物濫用」之重要性，及毒品對國家、社會及個人之危害，增進反毒知能，防微杜漸，以遏止毒品潛入校園。
                        </a><br><br>
                        <b>（二）校外參訪：</b><br>
                        <a>辦理校外參訪，推廣「防制學生藥物濫用」宣導，參訪法務部調查局、警政機關、防毒機構等單位，落實資源分享與互助，更加認識毒品危害，藉此體認我國目前對毒品犯罪防制與緝毒之成效，從多元角度認識「防制學生藥物濫用」重要性。
                        </a><br><br>
                        <b>（三）結合課程：</b><br>
                        <a>結合「服務學習課程」，將毒品危害融入課程中，寓教於樂，以提昇反毒教育學習功效，杜絕毒品滲透校園。
                        </a><br><br>
                        <b>（四）下鄉服務：</b><br>
                        <a>培養服務性社團，結合社區、家庭與學校，回饋鄉里，投入參與「拒毒萌芽大手牽小手」反毒宣導行列，有效深耕偏鄉學童，強化「推動防制學生藥物濫用」教育目標。
                        </a><br><br>
                        <b>（五）輔導安置：</b><br>
                        <a>成立「春暉小組」實施個案輔導，並依規定至教育部藥物濫用學生個案輔導管理系統填報輔導期程資料。
                        </a><br><br>
                    </p>
                    
                </div>

                <div id="section3" class="container tab-pane">
                    <h2>反毒法令計畫</h2>
                    <div class="list-group">
                        <a href="https://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=I0030020" 
                           class="list-group-item list-group-item-action" 
                           title="查看防制毒品危害獎懲辦法">防制毒品危害獎懲辦法</a>
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=D0050001" 
                           class="list-group-item list-group-item-action"
                           title="查看兒童及少年福利與權益保障法">兒童及少年福利與權益保障法</a>
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=D0080028" class="list-group-item list-group-item-action">少年不良行為及虞犯預防辦法</a>
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=I0030026" class="list-group-item list-group-item-action">特定人員尿液採驗辦法</a>
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=C0010011" class="list-group-item list-group-item-action">少年事件處理法</a>
                        <a href="https://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=C0000008" class="list-group-item list-group-item-action">毒品危害防制條例</a>
                    </div>
                    <br><br>
                </div>

                <div id="section4" class="container tab-pane">
                    <div id="poster" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                            <li data-target="#poster" data-slide-to="0" class="active"></li>
                            <li data-target="#poster" data-slide-to="1" class="active"></li>
                            <li data-target="#poster" data-slide-to="2" class="active"></li>
                            <li data-target="#poster" data-slide-to="3" class="active"></li>
                            <li data-target="#poster" data-slide-to="4" class="active"></li>
 
                        </ul>
                        <div class="carousel-inner">                            
                            <div class="carousel-item active">
                                <img src="images/DrugPrevention/謠言終結站.jpg" 
                                     alt="謠言終結站宣導海報" 
                                     height="500px" 
                                     style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/網路商品藏毒機.jpg" 
                                     alt="網路商品藏毒機宣導海報" 
                                     height="500px" 
                                     style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/當心販毒車手新騙局.jpg" height="500px" style="display: block; margin: auto;" alt="當心販毒車手新騙局宣導海報">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/預防網路涉毒與販毒.jpg" height="500px" style="display: block; margin: auto;" alt="預防網路涉毒與販毒宣導海報">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/新興毒品網路流竄.jpg" height="500px" style="display: block; margin: auto;" alt="新興毒品網路流竄宣導海報">
                            </div>
 

                        </div>
                        <a href="#poster" 
                           class="carousel-control-prev" 
                           data-slide="prev" 
                           title="查看上一張宣導海報">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="sr-only">上一張</span>
                        </a>
                        <a href="#poster" 
                           class="carousel-control-next" 
                           data-slide="next" 
                           title="查看下一張宣導海報">
                            <span class="carousel-control-next-icon"></span>
                            <span class="sr-only">下一張</span>
                        </a>
                        <br><br>
                    </div>
                </div>
                <div id="section5" class="container tab-pane">
                    <div id="album" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                            <li data-target="#album" data-slide-to="0" class="active"></li>
                            <li data-target="#album" data-slide-to="1"></li>
                            <li data-target="#album" data-slide-to="2"></li>
                            <li data-target="#album" data-slide-to="3"></li>
                            <li data-target="#album" data-slide-to="4"></li>
                            <li data-target="#album" data-slide-to="5"></li>
                            <li data-target="#album" data-slide-to="6"></li>
                            <li data-target="#album" data-slide-to="7"></li>
                            <li data-target="#album" data-slide-to="8"></li>
                            <li data-target="#album" data-slide-to="9"></li>
                            <li data-target="#album" data-slide-to="10"></li>
                            <li data-target="#album" data-slide-to="11"></li>
                            <li data-target="#album" data-slide-to="12"></li>
                            <li data-target="#album" data-slide-to="13"></li>
                            <li data-target="#album" data-slide-to="14"></li>
                            <li data-target="#album" data-slide-to="15"></li>
                            <li data-target="#album" data-slide-to="16"></li>
                            <li data-target="#album" data-slide-to="17"></li>
                            <li data-target="#album" data-slide-to="18"></li>
                            <li data-target="#album" data-slide-to="19"></li>
                            <li data-target="#album" data-slide-to="20"></li>
                            <li data-target="#album" data-slide-to="21"></li>
                            <li data-target="#album" data-slide-to="22"></li>
                            <li data-target="#album" data-slide-to="23"></li>
                            <li data-target="#album" data-slide-to="24"></li>
                            <li data-target="#album" data-slide-to="25"></li>
                            <li data-target="#album" data-slide-to="26"></li>
                            <li data-target="#album" data-slide-to="27"></li>
                            <li data-target="#album" data-slide-to="28"></li>
                            <li data-target="#album" data-slide-to="29"></li>
                            <li data-target="#album" data-slide-to="30"></li>
                            <li data-target="#album" data-slide-to="31"></li>
                            <li data-target="#album" data-slide-to="32"></li>
                            <li data-target="#album" data-slide-to="33"></li>
                            <li data-target="#album" data-slide-to="34"></li>
                        </ul>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/DrugPrevention/108/1.jpg" 
                                     alt="108年度反毒宣導活動照片1" 
                                     height="500px" 
                                     style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/6.jpg" 
                                     alt="108年度反毒宣導活動照片6" 
                                     height="500px" 
                                     style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/7.jpg" 
                                     alt="108年度反毒宣導活動照片7" 
                                     height="500px" 
                                     style="display: block; margin: auto;">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/107大手牽小手反毒1.jpg" height="500px" style="display: block; margin: auto;" alt="107大手牽小手反毒1">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/107大手牽小手反毒2.jpg" height="500px" style="display: block; margin: auto;" alt="107大手牽小手反毒2">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/107反毒宣教1.jpg" height="500px" style="display: block; margin: auto;" alt="107反毒宣教1"   >
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/107反毒宣教2.jpg" height="500px" style="display: block; margin: auto;" alt="107反毒宣教2">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/107反毒宣教3.jpg" height="500px" style="display: block; margin: auto;" alt="107反毒宣教3"       >
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/107校園反毒宣傳車.jpg" height="500px" style="display: block; margin: auto;" alt="107校園反毒宣傳車">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/0428全大運部隊展示.jpg" height="500px" style="display: block; margin: auto;" alt="0428全大運部隊展示">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/0428全大運憲兵重機.jpg" height="500px" style="display: block; margin: auto;" alt="0428全大運憲兵重機">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/0522反毒講座.jpg" height="500px" style="display: block; margin: auto;" alt="0522反毒講座">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/0522調查局主任來訪.jpg" height="500px" style="display: block; margin: auto;" alt="0522調查局主任來訪">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/0602畢業典禮4.jpg" height="500px" style="display: block; margin: auto;" alt="0602畢業典禮4">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/0809反毒桌遊4.jpg" height="500px" style="display: block; margin: auto;" alt="0809反毒桌遊4">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/1542692826626.jpg" height="500px" style="display: block; margin: auto;" alt="1542692826626">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/1544513785505.jpg" height="500px" style="display: block; margin: auto;" alt="1544513785505">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/1544513787718.jpg" height="500px" style="display: block; margin: auto;" alt="1544513787718">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/1544513802285.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="108年度反毒宣導活動照片">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20180522100048.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="107年5月22日反毒宣導活動照片">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20180522102332.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="107年5月22日反毒宣導活動照片2">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20181215091005.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="107年12月15日反毒宣導活動照片">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20181215091242.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="107年12月15日反毒宣導活動照片2">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20190410111827.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="108年4月10日反毒宣導活動照片">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20190410115641.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="108年4月10日反毒宣導活動照片2">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20190410115645.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="108年4月10日反毒宣導活動照片3">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20190410115729.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="108年4月10日反毒宣導活動照片4">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20190504102631.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="108年5月4日反毒宣導活動照片">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/IMG20190504124837.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="108年5月4日反毒宣導活動照片2">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/中央火舞社-保護智財權1.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="中央火舞社保護智財權宣導活動照片1">
                            </div>
                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/中央火舞社-保護智財權2.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="中央火舞社保護智財權宣導活動照片2">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/中央火舞社-保護智財權3.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="中央火舞社保護智財權宣導活動照片3">
                            </div>

                            <div class="carousel-item">
                                <img src="images/DrugPrevention/108/全民國防及法治教育.jpg" 
                                     height="500px" 
                                     style="display: block; margin: auto;"
                                     alt="全民國防及法治教育宣導活動照片">
                            </div>

                        </div>
                        <a href="#album" 
                           class="carousel-control-prev" 
                           data-slide="prev" 
                           title="查看上一張宣導海報">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="sr-only">上一張</span>
                        </a>
                        <a href="#album" 
                           class="carousel-control-next" 
                           data-slide="next" 
                           title="查看下一張宣導海報">
                            <span class="carousel-control-next-icon"></span>
                            <span class="sr-only">下一張</span>
                        </a>
                        <br><br>
                    </div>
                </div>
                <div id="section6" class="container tab-pane">
                    <h2>認識毒品</h2>
                    <div class="list-group">
                        <a href="http://enc.moe.edu.tw/UploadFile/eBook/20190509103853865730/mobile/index.html#p=1" class="list-group-item list-group-item-action">青少年常用毒品簡介</a>
                    </div>
                    <div class="block">
                        <img src="images/DrugPrevention/防毒海報7.png" 
                             alt="防毒宣導海報7" 
                             width="300px" 
                             style="display: block; margin: auto;">
                        <img src="images/DrugPrevention/防毒海報5.jpg" 
                             alt="防毒宣導海報5" 
                             width="300px" 
                             style="display: block; margin: auto;">
                        <img src="images/DrugPrevention/防毒海報6.jpg" 
                             alt="防毒宣導海報6" 
                             width="300px" 
                             style="display: block; margin: auto;">
                    </div>
                </div>
                <div id="section7" class="container tab-pane">
                    <div class="row">
                        <iframe width="25%" 
                                height="150" 
                                src="https://www.youtube.com/embed/jpx0plo3X2E" 
                                title="反毒宣導影片：青少年反毒教育" 
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" 
                                height="150" 
                                src="https://www.youtube.com/embed/Lf0z02GvcmM" 
                                title="反毒宣導影片：毒品危害防制" 
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/smeXLBn1-JA" frameborder="1" allowfullscreen title="反毒宣導影片：毒品危害防制"></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/MFOl3vM7gCs" frameborder="1" allowfullscreen title="反毒宣導影片：毒品危害防制"></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/jDPkgDGxcVc" frameborder="1" allowfullscreen title="反毒宣導影片：毒品危害防制"></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/R3gUYZ7W9uE" frameborder="1" allowfullscreen title="反毒宣導影片：毒品危害防制"></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/G1YrxL9wJVE" frameborder="1" allowfullscreen title="反毒宣導影片：毒品危害防制"></iframe>
                        <iframe width="25%" height="150" src="https://www.youtube.com/embed/aXn81_9Suq0" frameborder="1" allowfullscreen title="反毒宣導影片：毒品危害防制"></iframe>
                    </div>
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