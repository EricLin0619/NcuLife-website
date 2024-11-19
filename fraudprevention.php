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
    <title>防制詐騙</title>
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
                    <a class="nav-link" data-toggle="tab" href="#section2">重要政策</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">反詐騙海報</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section4">活動剪影</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section5">詐騙個案語音專區</a>
                </li>

            </ul>
            <!-- <div class="alert alert-danger alert-dismissible" role="alert">
                <marquee>
                    <p style="font-family: Impact; font-size: 18pt">一、詐騙手法日益新，你我務必要小心！
                    二、詐騙知識不可少，多方求證保荷包！
                    三、陌生電話不牢靠，反覆查詢很重要！
                    四、反詐資訊不能少，一旦受騙錢難保！
                    五、網路購物要小心，低價商品莫貪心！ 
                    六、千騙、萬騙，就是不離ATM！</p>
                </marquee>
 
            </div> -->
        
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
                        <div class="p-1 p-md-2 p-lg-3">
                        <img width="80%" src="\images\FraudPrevention\反詐騙宣傳.png" style="display: block; margin:auto;" alt="反詐騙宣傳"><br><br>
                        </div>
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
                    <h3 style="text-align: center;"><b>新世代打擊詐欺策略行動綱領 1.5版 </b></h3>
                    <h5 style="text-align: right;">日期：112-05-16</h5>
                    <h5 style="text-align: right;">資料來源：新聞傳播處</h5>
                    <h5 style="text-align: right;">原文連結：<a href="https://www.ey.gov.tw/Page/5A8A0CB5B41DA11E/f70eba6b-d72b-4b00-9942-b9e00aa34e4b">行政院官網</a></h5>
                    <p><b>一、前言:</b><br>
                        近年來詐騙猖獗，已影響人民生活及財產安全，為懲凶罰惡，行政院於111年7月15日訂頒「新世代打擊詐欺策略行動綱領」，
                        透過跨部會合作共同打擊詐欺，如111年減少民眾遭詐騙金額逾67億元、111年8 - 12月詐騙簡訊案件數大幅下降9成、疑涉詐欺境外警示帳戶全年成功攔阻135案，
                        金額1億4千多萬元、111年較110年查獲詐欺集團件數提升30%、查獲嫌犯數提升40%。<br>
                        面對電信等詐欺案件犯罪型態與技術不斷演化，行政院已陸續通過「打詐5 法」（《中華民國刑法》、《人口販運防制法》、《個人資料保護法》、《洗錢防制法》、《證券投資信託及顧問法》）修正草案，
                        嚴懲深偽詐騙、私行拘禁及人口販運，並加重相關詐欺罰則，強化網路平臺落實廣告實名制，並於112年5月4日通過「新世代打擊詐欺策略行動綱領 1.5 版」，精進「識詐、堵詐、阻詐、懲詐」4大面向，
                        運用公私協力推動各項防詐作為，達到「減少接觸、減少誤信、減少損害」3減目標，以全面降低詐騙受害事件。</p>
                    <img alt="新世代打擊詐欺策略行動綱領 1.5版" width="500" src="\images\FraudPrevention\新世代打擊詐欺策略行動綱領 1.5版 .jpg" style="display: block; margin:auto;  "><br><br>
                    <p><b>二、推動重點</b><br>
                    <ul>
                        <li>識詐（教育宣導面）</li>
                            <ol>
                                <li>精進作法：中央結合地方，公私協力合作，實施百工百業宣導措施，並將反詐騙觀念納入法治教育課程，建立防詐知能。</li>
                                <li>目標：每年宣導觸及3,000萬人次、防詐簡訊1億4,000萬則、攔阻率提高 5%。</li>
                            </ol>
                        <li>堵詐（電信網路面）</li>
                                <ol>
                                    <li>精進作法：攔阻及警示國際偽冒來話、攔阻惡意簡訊、建立公益簡訊專用代表門號、研發數位防詐工具，以及輔導電商業者推動物流隱碼技術及網購防詐警示。另與 Meta 建立「綠色通道」下架涉詐廣告，與LINE公司研議建置「紅色通道」下架涉詐帳號，也與Google建立打詐聯繫管道，加速冒名投資廣告下架，從源頭攔阻詐騙資訊流。</li>
                                    <li>目標：每年攔阻詐騙簡訊3,000萬則（採滾動修正）、人頭門號停斷話5,000門（採滾動修正）、開發2種以上數位防詐工具、輔導3大公協會會員辦理網購程序之防詐警示措施及物流隱碼技術。</li>
                                </ol>
                        <li>阻詐（贓款流向面）</li>
                                <ol>
                                    <li>精進作法：強化申請約定轉帳防詐措施、漸進式納管虛擬資產交易平臺業者、就源頭處理網路假投資廣告、遊戲點數防詐鎖卡及內控機制、第三方支付業者建立客戶審查機制，以及金融機構全臺宣導等，更有效攔阻非法詐欺金流。</li>
                                    <li>目標：每年本國銀行100%將共通性異常交易態樣納入內部預警指標、100%完成申請約定轉帳加強防詐措施。</li>
                                </ol>
                        <li>懲詐（偵查打擊面）</li>
                                <ol>
                                    <li>精進作法：成立「查緝詐欺及資通犯罪督導中心」，查緝重點為檢肅暴力幫派、嚴懲詐欺集團、截斷不法金流。另加強查扣犯罪所得、落實罪贓返還及強化犯罪被害人關懷，同時優化境內外虛擬通貨調取、凍結及查扣機制。</li>
                                    <li>目標：每年電信詐騙案件查獲集團數提高5％。</li>
                                </ol>
                    </ul>

                    <p><b>三、結語</b><br>
                        詐騙是讓最多國人受害的犯罪型態，打詐已列為政府治安工作的重中之重。「打詐行動綱領1.5版」將透過公私協力合作，組成打詐國家隊，精進打詐策略，從法律面和技術面減少通信流及加重詐欺刑責，
                        發揮「前端阻卻及「後端查緝」之效用，以減少受害者，掃除詐騙集團。
                    
                    
                   

                    <h3 style="text-align: center;"><b>相關連結</b></h3>
                    <div class="list-group">
                        <a href="https://www.ey.gov.tw/PageRedirect.aspx?l=0ccb2443-cc31-4627-a77a-d200d4d573fe" class="list-group-item list-group-item-action">中華民國憲法</a>
                        <a href="https://www.ey.gov.tw/PageRedirect.aspx?l=3794807c-df83-4f68-aaa7-2db631427032" class="list-group-item list-group-item-action">人口販運防制法</a>
                        <a href="https://law.moj.gov.tw/LawClass/LawAll.aspx?pcode=I0050021&kw=%e5%80%8b%e4%ba%ba%e8%b3%87%e6%96%99%e4%bf%9d%e8%ad%b7%e6%b3%95" class="list-group-item list-group-item-action">個人資料保護法</a>
                        <a href="https://law.moj.gov.tw/LawClass/LawAll.aspx?pcode=G0380131&kw=%e6%b4%97%e9%8c%a2%e9%98%b2%e5%88%b6%e6%b3%95" class="list-group-item list-group-item-action">洗錢防制法</a>
                        <a href="https://law.moj.gov.tw/LawClass/LawAll.aspx?pcode=G0400121&kw=%e8%ad%89%e5%88%b8%e6%8a%95%e8%b3%87%e4%bf%a1%e8%a8%97" class="list-group-item list-group-item-action">證券投資信託及顧問法</a>
                    </div>
                    <br><br>
                </div>

                <div id="section3" class="container tab-pane">

                    <h3 style="text-align: center;"><b>常見詐騙手法話術解析與預防策略(最新版)</b></h3>
                    <h5 style="text-align: right;">更新日期：2023-04-11 18:05</h5>
                    <h5 style="text-align: right;">資料來源：內政部警政署</h5>
                    <h5 style="text-align: right;">原文連結：<a href="https://165.npa.gov.tw/#/article/A/1023">警政署Q&A</a></h5>
                    <img width="500" src="\images\FraudPrevention\人頭帳戶詐騙.png" style="display: block; margin:auto;  " alt="人頭帳戶詐騙"><br><br>
                    <img width="500" src="\images\FraudPrevention\假投資詐騙.png" style="display: block; margin:auto;  " alt="假投資詐騙"><br><br>
                    <img width="500" src="\images\FraudPrevention\假愛情交友詐騙.png" style="display: block; margin:auto;  " alt="假愛情交友詐騙"><br><br>
                    <img width="500" src="\images\FraudPrevention\假網拍詐騙.png" style="display: block; margin:auto;  " alt="假網拍詐騙"><br><br>
                    <img width="500" src="\images\FraudPrevention\假檢警詐騙.png" style="display: block; margin:auto;  " alt="假檢警詐騙"><br><br>
                    <img width="500" src="\images\FraudPrevention\辨識解除分期詐騙.png" style="display: block; margin:auto;  " alt="辨識解除分期詐騙"><br><br>
                    <br><br>
                </div>

                <div id="section4" class="container tab-pane">
                    <ul>
                        <li>
                            <details>
                                <summary><h4><u>活動1: 配合全民國防課程實施反詐騙宣導(112年4月25日)</u></h4></summary>
                                    <span>
                                        <div class="row">
                                            <div class="column">
                                                <img width="20%"src="\images\FraudPrevention\毒品及反詐騙宣導活動\毒品及反詐騙宣導1.jpg" alt="毒品及反詐騙宣導1">
                                                <img width="20%"src="\images\FraudPrevention\毒品及反詐騙宣導活動\毒品及反詐騙宣導2.jpg" alt="毒品及反詐騙宣導2">
                                                <img width="20%"src="\images\FraudPrevention\毒品及反詐騙宣導活動\毒品及反詐騙宣導3.jpg" alt="毒品及反詐騙宣導3">
                                                <img width="20%"src="\images\FraudPrevention\毒品及反詐騙宣導活動\毒品及反詐騙宣導4.jpg" alt="毒品及反詐騙宣導4">
                                                <img width="20%"src="\images\FraudPrevention\毒品及反詐騙宣導活動\毒品及反詐騙宣導5.jpg" alt="毒品及反詐騙宣導5">
                                                <img width="20%"src="\images\FraudPrevention\毒品及反詐騙宣導活動\毒品及反詐騙宣導6.jpg" alt="毒品及反詐騙宣導6">
                                                <img width="20%"src="\images\FraudPrevention\毒品及反詐騙宣導活動\毒品及反詐騙宣導7.jpg" alt="毒品及反詐騙宣導7">
                                                <img width="20%"src="\images\FraudPrevention\毒品及反詐騙宣導活動\毒品及反詐騙宣導8.jpg" alt="毒品及反詐騙宣導8">
                                            </div>
                                        </div> 
                                    </span>
                            </details>
                        </li>
                        <li>
                            <details>
                                <summary><h4><u>活動2: 刑事警察局徐健銘偵查員實施反詐騙宣教(112年12月26日)</u></h4></summary>
                                    <span>
                                        <div class="row">
                                            <div class="column">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_1.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片1">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_2.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片2">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_3.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片3">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_4.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片4">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_5.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片5">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_6.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片6">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_7.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片7">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_8.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片8">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_9.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片9">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_10.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片10">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_11.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片11">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_12.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片12">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_13.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片13">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_14.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片14">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_15.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片15">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_16.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片16">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_17.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片17">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_18.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片18">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_19.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片19">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_20.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片20">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_21.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片21">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_22.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片22">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_23.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片23">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_24.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片24">
                                                <img width="20%" src="\images\FraudPrevention\刑事警察局徐健銘偵查員實施反詐騙宣教\photo_25.jpg" alt="刑事警察局徐健銘偵查員實施反詐騙宣教活動照片25">
                                            </div>
                                        </div> 
                                    </span>
                            </details>
                        </li>
                    </ul>

                </div>
                <div id="section5" class="container tab-pane">
                    <div class="row">
                        
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/Q3QbrNWo2jA" 
                                title="反詐騙宣導影片：假冒銀行客服詐騙手法解析"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/uTUrBfR7dJg" 
                                title="反詐騙宣導影片：假投資詐騙手法剖析"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/_ATVbFT4wxo" 
                                title="反詐騙宣導影片：網路購物詐騙防範指南"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/7T6c_zBpxS8" 
                                title="反詐騙宣導影片：假冒公務機關詐騙手法示警"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/2cbtmF9Db9c" 
                                title="反詐騙宣導影片：解析常見詐騙類型與防範"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/jurvPO_o3sQ" 
                                title="反詐騙宣導影片：網路交友詐騙防範教學"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/pjeN_8m93hE" 
                                title="反詐騙宣導影片：假投資APP詐騙手法揭露"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/RrLtLBe2uR4" 
                                title="反詐騙宣導影片：假求職詐騙手法預防"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/mM5MPUqUTs4" 
                                title="反詐騙宣導影片：解析詐騙集團慣用手法"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/bZv13fCiU3s" 
                                title="反詐騙宣導影片：網路購物安全守則"
                                frameborder="1" 
                                allowfullscreen></iframe>
                        <iframe width="25%" height="150" 
                                src="https://www.youtube.com/embed/5c7JeQOelis" 
                                title="反詐騙宣導影片：防範詐騙基本準則"
                                frameborder="1" 
                                allowfullscreen></iframe>
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