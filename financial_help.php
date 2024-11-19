<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>弱勢助學計畫-弱勢助學金</title>
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
            <h2>弱勢助學計畫-弱勢助學金</h2>
            <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1">申請作業</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">就補系統</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">辦法</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section4">Q&A</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">
                    <div id="申請作業" class="tabcontent" style="display: block;">
                        <h2>申請作業</h2>
                        <p>申請期間：<span style="font-weight:bold;">依每學期公告時間為準</span></p>
                        <p>依據：【<a href="download/大專校院弱勢學生助學計畫.pdf">教育部–大專校院弱勢學生助學計畫辦法</a>】</p>
                        <p>重要說明：</p>
                        <p>一、<span style="font-weight:bold;">一學年僅補助一次，採上學期申請，下學期扣抵學雜費</span>。</p>
                        <p>二、每學年第1學期申請收件，經教育部查核，於同學年第2學期扣抵註冊繳費單上之學雜費。</p>
                        <p>三、不得重複申領政府其他助學措施，各類助學金<span style="color:red;">重複申請時給付優先順序</span>。</p>
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin: 15px;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>給付優先順序</th>
                                        <th>項目</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>教育部學雜費減免</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>人事行政總處子女教育補助費</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>法敄部被害人子女助學金/受刑人子女助學金</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>臺北市勞工局及新北市勞工局勞工子女助學金</td>
                                    </tr>  
                                    <tr>
                                        <td>5</td>
                                        <td>勞動部勞工子女助學金/文化部蒙蔵委員會助學金</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>內政部單親培力計畫</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>農委會農漁民子女助學金</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>行政院退輔會榮民子女助學金/屏東鎮公所</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>教育部弱勢學生助學計畫</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <p>助學金給付標準-學士班</p>
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin: 15px;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="colgroup" colspan="2">給付優先順序</th>
                                        <th scope="colgroup" colspan="2">項目</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">級距</th>
                                        <th scope="col">家庭年收入</th>
                                        <th scope="col">學校類別</th>
                                        <th scope="col">大專院校</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>第1 級</td>
                                        <td>70萬以下</td>
                                        <td>公立學校</td>
                                        <td>20,000</td>
                                    </tr>
                                    <tr>
                                        <td>第2 級</td>
                                        <td>超過70萬～90萬以下</td>
                                        <td>公立學校</td>
                                        <td>15,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <p>助學金給付標準-碩博士班</p>
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin: 15px;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="colgroup" colspan="2">給付優先順序</th>
                                        <th scope="colgroup" colspan="2">項目</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">級距</th>
                                        <th scope="col">家庭年收入</th>
                                        <th scope="col">學校類別</th>
                                        <th scope="col">大專院校</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>第1 級</td>
                                        <td>30萬以下</td>
                                        <td>公立學校</td>
                                        <td>16,500</td>
                                    </tr>
                                    <tr>
                                        <td>第2 級</td>
                                        <td>超過30萬～40萬以下</td>
                                        <td>公立學校</td>
                                        <td>12,500</td>
                                    </tr>
                                    <tr>
                                        <td>第3 級</td>
                                        <td>超過40萬～50萬以下</td>
                                        <td>公立學校</td>
                                        <td>10,000</td>
                                    </tr>
                                    <tr>
                                        <td>第4 級</td>
                                        <td>超過50萬～60萬以下</td>
                                        <td>公立學校</td>
                                        <td>7,500</td>
                                    </tr>
                                    <tr>
                                        <td>第5 級</td>
                                        <td>超過60萬～70萬以下</td>
                                        <td>公立學校</td>
                                        <td>5,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <p>申請對象：</p>
                        <p>有戶籍登記之中華民國國民且就讀國內大專校院具有學籍（不包括研究所在職專班及社會救助法第5條第3項第7款對象），於修業年限內之學生，且無下列情事之一者：</p>
                        <p>一、學士班學生:家庭<span style="font-weight:bold;">年所得逾新臺幣70萬元。</span></p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;碩博士班學生:家庭<span style="font-weight:bold;">年所得逾新臺幣90萬元。</span></p>
                        <p>二、家庭應計列人口之<span style="font-weight:bold;">利息所得合計逾新臺幣2萬元</span>。利息所得來自優惠存款且存款本金未逾 新臺幣100萬元者，得檢附相關佐證資料，由學校/教育部審核認定並報部備查。</p>
                        <p>三、<span style="font-weight:bold;">家庭應計列人口合計擁有不動產價值合計超過新臺幣650萬元</span>。</p>
                        <p>四、<span style="font-weight:bold;">前一學期學業成績平均低於60分</span>(備註：新生及轉學生除外，<span style="font-weight:bold;">如學生如因前一學期未修習課程無學業可採計，得以最近一學期學業成績計算</span>)。</p>
                        <p>五、前目家庭年所得(包括分離課稅所得)、利息及不動產總額，應計列人口之計算方式如下：</p>
                        <p>(一)學生未婚者：</p>
                        <p>&nbsp;&nbsp;1.未成年:與其法定代理人合計。</p>
                        <p>&nbsp;&nbsp;2.己成年:與其父母合計。</p>
                        <p>(二)學生己婚者:與其配偶合計。</p>
                        <p>(三)學生離婚或配偶死亡者:為其本人之所得總額。</p>
                        <p>備註:學生因父母離婚、遺棄或其他特殊因素，與父母或法定代理人合計顯失公平者，得具明理由並檢具相關文件資料，經審查且報部認定後，該父母或法定代理人免予合計。</p>
                        <br>
                        <p style="font-weight:bold;">補助範圍</p>
                        <p>一、本項補助範圍包括且學費、雜費、學分費、學雜費基數，不包括延長修業年限、重修及補修等就學費用。</p>
                        <p>二、學生轉學、休學、退學、遭開除學籍或其他情形之助學金核發方式：</p>
                        <p>&nbsp;&nbsp;(一)學生未完成上學期學業者，不予核發。</p>
                        <p>&nbsp;&nbsp;(二)學生完成上學期學業後下學期不再就學者，核發1/2補助金額。</p>
                        <br>
                        <p style="font-weight:bold;">應備資料</p>
                        <p>一、申請書</p>
                        <p>&nbsp;&nbsp;(一)請至portal登錄-&gt;學生服務-&gt;生活助學服務-&gt;就學補助系統-&gt;填寫資料後-&gt;列印繳交</p>
                        <p>&nbsp;&nbsp;(二)申請表請簽名(全名)及蓋章</p>
                        <p>二、最近三個月內戶籍謄本或新式戶口名簿(不可省略記事欄位)</p>
                        <p>&nbsp;&nbsp;(一)未婚學生：學生與父親、母親或法定監護人(如在不同戶籍地請分別申請)</p>
                        <p>&nbsp;&nbsp;(二)已婚學生：學生與配偶(如在不同戶籍地請分別申請)</p>
                        <br>
                        <p style="font-weight: bold;">聯絡方式</p>
                        <p>&nbsp;&nbsp;聯絡人 : 吳孟靜專員</p>
                        <p>&nbsp;&nbsp;電話 : (03)4227151 &nbsp;&nbsp; ; &nbsp;&nbsp; 分機 57220</p>
                        <p>&nbsp;&nbsp;E-mail : mengjing@ncu.edu.tw</p>
                    </div>
                </div>
                <div id="section2" class="container tab-pane ">
                    <h2>就補系統</h2>
                    <p><a href="https://portal.ncu.edu.tw/system/42" class="list-group-item list-group-item-action">就學補助系統</a></p>
                </div>
                <div id="section3" class="container tab-pane">
                    <h2>辦法</h2>
                    <p><a href="download/大專校院弱勢學生助學計畫(113年1月31日修正).pdf" class="list-group-item list-group-item-action">大專校院弱勢學生助學計畫</a></p>
                </div>
                <div id="section4" class="container tab-pane ">
                    <h2>Q&A</h2>
                    <div id="FAQ" class="tabcontent" style="display: block;">
                        <p style="font-weight:bold;">Q1：申請的資格條件？</p>
                        <p>A1：需符合下列條件</p>
                        <p>1、學籍資格：中華民國國民且具備本校正式學籍者（不含碩專班、學分班及延修生）</p>
                        <p>2、學生成績：申請之<u>前一學期</u>平均成績需達60分以上（新生及轉學生除外）</p>
                        <p>3、家庭年所得：
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;學士班－<u>家庭應列計人口</u>年所得須在<span style="font-weight:bold;">90</span>萬元以下</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;碩博班－<u>家庭應列計人口</u>年所得須在<span style="font-weight:bold;">70</span>萬元以下</p>
                        <p>※應列計人口：</p>
                        <p>（1）未婚者：學生本人及父母親（或法定監護人）等人年所得總計</p>
                        <p>（2）已婚者：學生本人及配偶年所得總計</p>
                        <p>4、家庭年利息所得：家庭應列計人口年利息所得合計2萬元以下（利息所得為去年一年，家庭應列計人口之存款之孳息）</p>
                        <p>5、不動產價值：家庭應列計人口擁有不動產價值總計不超過650萬元</p>
                        <p>&nbsp;</p>
                        <p style="font-weight:bold;">Q2：該如何申領呢？要準備哪些文件？向什麼單位申請？申請截止時間為何？</p>
                        <p>A2：申請程序：由同學於每學年第一學期於申辦時間內自行提出申請</p>
                        <p>申請時間：每學年申請一次，自開學日起至10月18日止（實際日期依當年度公告為主）</p>
                        <p>繳交文件：</p>
                        <p>1、申請表（請登錄<u style="font-weight:bold;">portal</u>進入本校<span style="font-weight:bold;">就學補助系統</span>填寫並列印簽名）</p>
                        <p>2、近三個月內全戶戶籍謄正本本或新式戶口名簿影本（記事欄為不可空白）</p>
                        <p>承辦單位：生活輔導組（洽詢電話：03-4267124專線/校內分機：57221）</p>
                        <p>&nbsp;</p>
                        <p style="font-weight:bold;">Q3：家庭經濟條件是否合格由誰查核？如何知道查核結果？</p>
                        <p>A3：1、家庭年所得、家庭年利息所得及不動產價值均由教育部委託國稅局查詢。</p>
                        <p>2、每年11月中旬及12月中旬（實際日期依本校搶先報公告為主）分別公告第一次及第二次審查結果，請同學由<a href="http://140.127.2.7/Disadvantaged/">助學金資料登錄處</a>進入查詢，如有疑義亦請依公告時程備件進行複查。</p>
                        <p>※第一次審查內容為家庭經濟狀況是否有符合辦法規範</p>
                        <p>第二次審查公告內容為 是否通過本次助學金補助</p>
                        <p>&nbsp;</p>
                        <p style="font-weight:bold;">Q4：申請通過後，補助金額是多少呢？如何核發？</p>
                        <p>A4：學士班</p>
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin: 15px;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="colgroup" colspan="2">給付優先順序</th>
                                        <th scope="colgroup" colspan="2">項目</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">級距</th>
                                        <th scope="col">家庭年收入</th>
                                        <th scope="col">學校類別</th>
                                        <th scope="col">大專院校</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>第1 級</td>
                                        <td>70萬以下</td>
                                        <td>公立學校</td>
                                        <td>20,000</td>
                                    </tr>
                                    <tr>
                                        <td>第2 級</td>
                                        <td>超過70萬～90萬以下</td>
                                        <td>公立學校</td>
                                        <td>15,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>碩博士班</p>
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin: 15px;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="colgroup" colspan="2">給付優先順序</th>
                                        <th scope="colgroup" colspan="2">項目</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">級距</th>
                                        <th scope="col">家庭年收入</th>
                                        <th scope="col">學校類別</th>
                                        <th scope="col">大專院校</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>第1 級</td>
                                        <td>30萬以下</td>
                                        <td>公立學校</td>
                                        <td>16,500</td>
                                    </tr>
                                    <tr>
                                        <td>第2 級</td>
                                        <td>超過30萬～40萬以下</td>
                                        <td>公立學校</td>
                                        <td>12,500</td>
                                    </tr>
                                    <tr>
                                        <td>第3 級</td>
                                        <td>超過40萬～50萬以下</td>
                                        <td>公立學校</td>
                                        <td>10,000</td>
                                    </tr>
                                    <tr>
                                        <td>第4 級</td>
                                        <td>超過50萬～60萬以下</td>
                                        <td>公立學校</td>
                                        <td>7,500</td>
                                    </tr>
                                    <tr>
                                        <td>第5 級</td>
                                        <td>超過60萬～70萬以下</td>
                                        <td>公立學校</td>
                                        <td>5,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>&nbsp;</p>
                        <p>因第一學期仍在申請審查中，學雜費無法扣除助學金，故申請通過後全學年「助學金」自申請人第2學期學雜費中一次扣扺，申請人於列印第2學期繳費單時注意是否已扣除本助學金。</p>
                        <p>請注意：公立大學與私立大學補助金額不同，上表補助金額為公立學校補助標準。</p>
                        <p>&nbsp;</p>
                        <p style="font-weight:bold;">Q5：申請「弱勢助學金」後還可以辦理就學貸款嗎？兩者有衝突嗎？</p>
                        <p>A5：兩者可同時申請，並無限制僅能擇一申辦。</p>
                        <p>&nbsp;</p>
                        <p style="font-weight:bold;">Q6：申請「弱勢助學金」後還可以辦理「學雜費減免」或「農委會農漁民子女就學獎助學金」等政府就學補助嗎？</p>
                        <p>A6：不可以，政府就學補助僅能擇一請領。</p>
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin: 15px;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>給付優先順序</th>
                                        <th>項目</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>教育部學雜費減免</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>人事行政總處子女教育補助費</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>法敄部被害人子女助學金/受刑人子女助學金</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>臺北市勞工局及新北市勞工局勞工子女助學金</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>勞動部勞工子女助學金/文化部蒙蔵委員會助學金</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>內政部單親培力計畫</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>農委會農漁民子女助學金</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>行政院退輔會榮民子女助學金/屏東鎮公所</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>教育部弱勢學生助學計畫</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>&nbsp;</p>
                        <p style="font-weight:bold;">Q7：申請「弱勢助學金」後還可以辦理「生活助學金」或「生活服務學習助學金」嗎？</p>
                        <p>A7：可以，兩者可同時申請。</p>
                        <p>提醒您：同性質的補助不能重複請領。「助學金」與「學雜費減免」等同屬學費補助性質，故不能同時申請，但與生活費補助性質的「生活助學金」或「生活服務學習助學金」在申請上則不衝突。（同理，生活助學金與生活服務學習助學金同屬生活費補助性質，所以兩者不能重複請領喔。）</p>
                        <p>&nbsp;</p>
                        <p style="font-weight:bold;">Q8：辦理「弱勢助學金」申請後發現自己亦具備其他學雜費減免，想&lt;改申請學雜費減免可以嗎？</p>
                        <p>A8：可以。請至生活輔導組填具改申領其他學雜費減免確認書即可。</p>
                        <p>第一學期改申請其他學雜費減免者，無法重複請領弱勢助學金；</p>
                        <p>第一學期通過弱勢助學金申請，第二學期改申請其他學雜費減免者，核發1/2弱勢助學金。</p>
                        <p>&nbsp;</p>
                        <p style="font-weight:bold;">Q9：申請「弱勢助學金」後還可以辦理「ＯＯ政府清寒優秀學生獎助學金」或「財團法人ＯＯＯ獎助學金」等校外獎助學金嗎？</p>
                        <p>A9：可以。除所申請的校外獎助學金申請辦法上有規定說明不得重複申請外，弱勢助學金可與其他校外獎助學金同時請領。</p>
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