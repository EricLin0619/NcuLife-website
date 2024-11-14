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
    $query_military_bulletin = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '折抵役期' ORDER BY time DESC");
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
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>折抵役期</title>
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

    table, th, td {
        border: 1px solid grey;
        border-collapse: collapse;
    }
    th, td {
        text-align: center !important;
        padding: 10px;
    }

</style>

<body>
    <?php include "navbar.php"?>
    <div class="container">
        <?php include "header.php"?>
        <div class="content" style="margin-top: 15px; margin-bottom: 15px;">
            <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1" title="查看役期折抵相關法規">役期折抵相關法規</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2" title="查看最新軍訓課程折抵役期說明">最新軍訓課程折抵役期相關說明</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3" title="查看中央大學學生修習軍訓折抵役期辦法">中央大學學生修習軍訓折抵役期辦法</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section4" title="查看軍訓課程折算役期實施辦法">軍訓課程折算役期實施辦法</a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="section1" class="container tab-pane active" style="padding-right: 100px;">
                    <h3>全民國防教育軍事訓練(軍訓)課程折抵役期相關說明</h3>
                    <ol>
                        <li>依教育部99年1月29日台參字第0990001450A號書函：「『軍訓課程折算役期實施辦法』，教育部部會銜國防部、內政部預定於中華民國99年2月3日訂定發布施行。」
                        </li>
                        <li>「全民國防教育軍事訓練課程折減常備兵役役期與軍事訓練期間實施辦法」業經教育部會銜國防部、內政部於中華民國102年3月13日以臺教學(六)字第1020021454C號、國規委會字第1020000135號、台內役字第1020831115A號令訂定發布施行。
                        </li>
                        <li>依教育部106年3月17日臺教學(六)字第1060035632號函：「檢送修正『高級中等以上學校辦理學生兵役役(訓)期折減作業��意事項』乙案」
                        </li>
                    </ol>
                        <strong>相關連結：</strong>
                        <div class="list-group" style="margin: 15px;">
                            <a href="https://law.moj.gov.tw/LawClass/LawAll.aspx?pcode=H0140017" 
                               title="查看全民國防教育軍事訓練課程折抵常備兵役役期與軍事訓練期間實施辦法">
                                <font color="red">全民國防教育軍事訓練課程折抵常備兵役役期與軍事訓練期間實施辦法</font>
                            </a>
                    </div>
                </div>
                <div id="section2" class="container tab-pane" style="padding-right: 100px;">
                    <h3>最新軍訓課程折抵役期相關說明</h3>
                    <p>配合募兵制推動，教育部已於102年3月13日依兵役法第16條第4項規定，教育部會同國防部及內政部訂定發布「全民國防教育軍事訓練課程折減常備兵役役期與軍事訓練期間實施辦法」。</p>
                    <p>國防部及內政部於100年12月30日公告，83年次以後出生之役男，自102年1月1日起，改接受4個月常備兵役軍事訓練；82年次以前出生之役男，仍需服1年現役（或替代役）。依照兵役法第16條規定，役男於高級中等以上學校修習且成績合格之「全民國防教育軍事訓練課程」，得折減其常備兵役現役役期或軍事訓練期間；得折減之現役役期或常備兵役軍事訓練之時數，分別不得逾30日及15日（如附表）。本項辦法明定可折減之「全民國防教育軍事訓練課程」，係於全民國防教育架構下納入軍事訓練相關課目，除可增進學子防衛意識與知能，培養愛鄉愛國情操，並可提供學子先備性軍事知能，以提升其未來接受軍事訓練之成效。課程折減方式如下：</p>
                    <p>
                        <b>一、高級中等學校（含五專前三年及相當層級之進修學校）</b><br>
                    </p>
                    <p>
                        除現行「全民國防教育課程」（必修2學分）內既有之相關課程外，另學校實施災害防救暨青年服勤動員、實彈射擊等實務課程，皆可納入折減範疇；依每8堂課折算1日，可折減現役役期7日或常備兵役軍事訓練期間5日。
                    </p>
                    <p>
                        <b>二、  大專校院（含五專後二年及相當層級之進修學校）</b><br>
                    </p>
                    <p>
                        學校依照全民國防教育「國際情勢」、「國防政策」、「全民國防」、「防衛動員」、「國防科技」等5大領域規劃課程，並配合納入相關軍事訓練課目及時數；依每8堂課折算1日，至多可折減現役役期22日或常備兵役軍事訓練期間10日。
                        我國之國防為全民國防，募兵制是國家既定之重要政策，教育部本於部會分工，從教育層面著手，致力全民國防教育之落實，期藉由課程之潛移默化，奠定學子軍事訓練基礎、深化國防意識、凝聚全民國防共識，為國家安全儲備無形之精神戰力。
                    </p>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col" colspan="7">役男修習全民國防教育軍事訓練(軍訓)課程折減兵役日數對照表</th>
                            </tr>
                            <tr>
                                <th scope="col" rowspan="2">役男年次</th>
                                <th scope="col" rowspan="2">役種(時間)</th>
                                <th scope="col" rowspan="2">修習課程</th>
                                <th scope="colgroup" colspan="3">可折減役(訓)期日數</th>
                                <th scope="col" rowspan="2">折減起算日</th>
                            </tr>
                            <tr>
                                <th scope="col">高級中等學校、五專前3年及相當層級進修學校</th>
                                <th scope="col">大專校院、五專後2年及相當層級進修學校</th>
                                <th scope="col">折減上限</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <th scope="rowgroup" rowspan="2">82年次以前</th>
                                <td rowspan="2">常備兵役現役或替代役(1年)</td>
                                <td>軍訓課程</td>
                                <td colspan="2">每8堂課折算1日</td>
                                <td rowspan="2">30日</td>
                                <td rowspan="2">退伍日</td>
                            </tr>
                            <tr>
                                <td>全民國防教育軍事訓練課程</td>
                                <td>至多7日</td>
                                <td>至多22日</td>
                            </tr>
                            <tr>
                                <th scope="row">83年次以後</th>
                                <td>常備兵役軍事訓練(4個月)</td>
                                <td>全民國防教育軍事訓練課程</td>
                                <td>至多5日</td>
                                <td>至多10日</td>
                                <td>15日</td>
                                <td>第2階段(專長訓練)結訓日</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            <div id="section3" class="container tab-pane" style="padding-right: 100px;">
                <p>
                    <b>ㄧ、親自辦理</b><br>
                </p>
                <ol>
                    <li>請同學攜帶成績單正本至生輔組填寫折抵役期申請書(或先行下載填妥)。
                    </li>
                    <li>值班教官審核並於成績單正本右下角簽證軍訓成績合格學期數及折抵役期日數。
                    </li>
                    <li>生輔組將簽證之成績單影印存檔後，同學即完成所有程序，可帶回已簽證之成績單正本。
                    </li>
                </ol>
                <p><b>二、代辦</b><br></p>
                <ol>
                    <li>請代辦人攜帶役男之成績單正本至生輔組填寫折抵役期申請書(或先行下載填妥)。
                    </li>
                    <li>值班教官審核並於成績單正本右下角簽證軍訓成績合格學期數及折抵役期日數。
                    </li>
                    <li>生輔組將簽證之成績單影印存檔後，代辦人即完成申請程序，可帶回已簽證之成績單正本。
                    </li>
                </ol>
                <p><b>三、郵寄辦理</b><br></p>
                <ol>
                    <li>申請人請將成績單正本、填妥之回郵信封及黏貼35元郵票、抵役期申請書(請先行下載並填妥)寄至中央大學生輔組(地址：32001桃園市中壢區中大路300號)。
                    </li>
                    <li>軍訓教育業務承辦教官審核並於成績單正本右下角簽證軍訓成績合格學期數及折抵役期日數。
                    </li>
                    <li>生輔組將簽證之成績單影印存檔後，以申請人寄來之回郵信封將已簽證之成績單正本寄回給申請人。
                    </li>
                </ol>
                <p><b>四、折抵役期申請文件下載</b><br></p>
                <ul>
                    <li>
                        <a href="download/國立中央大學義務役役男辦理軍訓課程折抵役期申請文件審核核定存根(83年次前).doc" 
                           title="下載83年次(不含)以前申請文件 Word 格式">
                            83年次(不含)以前 (.docx)
                        </a>
                    </li>
                    <li>
                        <a href="download/國立中央大學義務役役男辦理軍訓課程折抵役期申請文件審核核定存根(83年次前).odt" 
                           title="下載83年次(不含)以前申請文件 OpenDocument 格式">
                            83年次(不含)以前 (.odt)
                        </a>
                    </li>
                    <li>
                        <a href="download/國立中央大學義務役役男辦理軍訓課程折抵役期申請文件審核核定存根(83年次後).doc" 
                           title="下載83年次(含)以後申請文件 Word 格式">
                            83年次(含)以後 (.docx)
                        </a>
                    </li>
                    <li>
                        <a href="download/國立中央大學義務役役男辦理軍訓課程折抵役期申請文件審核核定存根(83年次後).odt" 
                           title="下載83年次(含)以後申請文件 OpenDocument 格式">
                            83年次(含)以後 (.odt)
                        </a>
                    </li>
                </ul>
                </div>
                <div id="section4" class="container tab-pane" style="padding-right: 100px;">
                    <h3>軍訓課程折算役期實施辦法</h3>
                    <p>
                        <b>第一條</b><br>
                    </p>
                    <p>
                        本辦法依兵役法(以下簡稱本法)
                    </p>
                    <p>
                        第十六條第四項及本法施行法第五十二條規定訂定之。
                    </p>
                    <p>
                        本法第十六條第二項所定軍訓課程，其得折減常備兵役現役役期之相關事項，依軍訓課程折算役期實施辦法規定辦理。
                    </p>
                    <p>
                        <b>第二條</b><br>
                    </p>
                    <p>
                        依法受徵集服常備兵役現役或軍事訓練之役男，其曾於高級中等以上學校修習且成績合格之全民國防教育軍事訓練課程，得依本法第十六條第二項或第三項規定申請折減役期或軍事訓練期間。
                    </p>
                    <p>
                        前項所稱高級中等以上學校，指高級中等學校、專科學校、大學及其相當層級之進修學校。
                    </p>
                    <p>
                        第一項所定得折減役期或軍事訓練期間之課程內容、課目、時數，規定如附表。
                    </p>
                    <p>
                        <b>第三條</b><br>
                    </p>
                    <p>
                        學生修習全民國防教育軍事訓練課程且成績合格者，應分別按各學制，以每八堂課折算一日，折減常備兵役役期或軍事訓練期間（如附表附註）；其得折減之現役役期，不得逾三十日，得折減之軍事訓練時數，不得逾十五日。
                    </p>
                    <p>
                        同等學制修習之全民國防教育軍事訓練課程折減常備兵役現役或軍事訓練，以一次為限，因故重(復)修或留級再修者，不得重複折減。

                    </p>
                    <p>
                        <b>第四條</b><br>
                    </p>
                    <p>
                        申請全民國防教育軍事訓練課程折減常備兵役役期或軍事訓練期間者，應將就讀學校成績單正本送交該校軍訓單位審查，經核對無誤，由軍訓主管於成績單右下角加蓋印記，並載明成績合格之全民國防教育軍事訓練課程內容、時數及得折減日數後，其正本發還申請人，副本由學校保存；學校未設軍訓單位或未置軍訓主管者，由教務單位辦理。
                    </p>
                    <p>
                        前項申請折減之成績單所顯示課程，應與第二條第三項附表所列之課程相符。
                    </p>
                    <p>
                        第一項印記格式，由教育部定之。
                    </p>
                    <p>
                        <b>第五條</b><br>
                    </p>
                    <p>
                        前條第一項申請人應檢具加蓋印記之成績單正本及其他相關證明文件，依現行常備兵役徵集作業流程，向服役或訓練單位申請折減役期或軍事訓練期間。
                    </p>
                    <p>
                        <b>第六條</b><br>
                    </p>
                    <p>
                        教育部應不定期對學校辦理折減常備兵役役期或軍事訓練期間相關之全民國防教育軍事訓練課程及折減作業，實施考核。
                    </p>
                    <p>
                        <b>第七條</b><br>
                    </p>
                    <p>
                        替代役役期之折減，依本法施行法第五十二條規定及本辦法規定辦理。
                    </p>
                    <p>
                        <b>前項替代役役期之折減日數，依下列規定辦理</b><br>
                    </p>
                    <p>
                        一、中華民國八十二年十二月三十一日以前出生之役男，其得折減之役期，不得逾三十日。
                    </p>
                    <p>
                        二、中華民國八十三年一月一日以後出生之役男，其得折減之役期，不得逾十五日。
                    </p>
                    <p>
                        <b>第八條</b><br>
                    </p>
                    <p>
                        本辦法自發布日施行。
                    </p>
                    <p>
                        <a href="download/軍訓課程折算役期實施辦法.docx" 
                           title="下載軍訓課程折算役期實施辦法 Word 格式">
                            <font color="blue">軍訓課程折算役期實施辦法 (.docx)</font>
                        </a>
                    </p>
                    <p>
                        <a href="download/軍訓課程折算役期實施辦法.odt" 
                           title="下載軍訓課程折算役期實施辦法 OpenDocument 格式">
                            <font color="blue">軍訓課程折算役期實施辦法 (.odt)</font>
                        </a>
                    </p>
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