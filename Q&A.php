<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Q&A</title>
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
/*        margin-left: 15px;*/
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
                    <a class="nav-link active" data-toggle="tab" href="#section1">獎懲／操行／請假</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">弱勢助學</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">就學貸款</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section4">學生工讀</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section5">兵役業務</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section6">學雜費減免</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section9">研究生獎助學金</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section7">獎學金</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section8">校園安全</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">
                    <p style="font-weight:bold;">☆在學校被核予記小過，是否會通知家長?</p>
                    <p>依本校學生獎懲辦法規定，核予記大功、大過以上者，將通知學生家長或監護人。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆如何辦理學生請假?</p>
                    <p>portal，點選 便捷窗口/服務櫃台(iNCU)/學務專區/假單申請 即可申請。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆學生集體請假至校外參加比賽時，該如何辦理請假事宜?</p>
                    <p>檢附相關證明文件(內含學生名單)，並依請假規定至線上辦理公假申請。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆請假可以事後補辦嗎?</p>
                    <p>一學生請假規則第五條之規定：須事先辦理，因重大疾病及不可抗拒之重大事故，得補請假。</p>
                    <p>&nbsp;</p>
                </div>
                <div id="section2" class="container tab-pane ">
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
                                        <th colspan="2">給付優先順序</th>
                                        <th colspan="2">項目</th>
                                    </tr>
                                    <tr>
                                        <th>級距</th>
                                        <th>家庭年收入</th>
                                        <th>學校類別</th>
                                        <th>大專院校</th>
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
                                        <th colspan="2">給付優先順序</th>
                                        <th colspan="2">項目</th>
                                    </tr>
                                    <tr>
                                        <th>級距</th>
                                        <th>家庭年收入</th>
                                        <th>學校類別</th>
                                        <th>大專院校</th>
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
                                        <td>教育部弱勢學生助學計畫</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>勞動部勞工子女助學金/文化部蒙蔵委員會助學金</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>內政部單親培力計畫</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>農委會農漁民子女助學金</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>行政院退輔會榮民子女助學金/屏東鎮公所</td>
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
                <div id="section3" class="container tab-pane ">
                    <p style="font-weight:bold;">Q1：我可以辦就學貸款嗎？條件是什麼？</p>
                    <p>符合以下條件之一者均可辦理；採先申請後查核方式，開學後本校將申貸者資料送教育部，由教育部送財稅中心查核家庭收入，資格不符者將取消申貸，並請自行補繳學費。(註: 繳款方式依出納組公告為準。)</p>
                    <p>(一) A類：家庭年收入114 萬元以下者(以稅務單位計算的所得為準)，指學生本人及家長(含監護人)，已婚者則為本人及配偶，貸款利息均由政府負擔。</p>
                    <p>(二) B類：家庭年收入在114~120萬元之間者，貸款人與政府各付一半利息。</p>
                    <p>(三) C類：家庭年收入在120萬元以上，且學生本人及其兄弟姐妹有二人以上就讀高中職以上學校者，但利息全數自行負擔。（請備妥另一兄弟姐妹之學生證影本，並需蓋有學期註冊章）</p>
                    <br>
                    <p style="font-weight:bold;">Q2：什麼身分無法申請就學貸款？</p>
                    <p>已享受全部公費待遇者、全部學雜費減免或已獲得政府主辦之其他無息助學貸款者，但享受部分公費、部分減免或已請領教育補助費者，其差額部份仍可申請貸款。</p>
                    <br>
                    <p style="font-weight:bold;">Q3：我的繳費單上沒有學分費要如何辦理？</p>
                    <p style="color:red;">「研究生」及「大學延畢生」需先上網預估學分數。</p>
                    <p>請至【中大Portal入口網→學生相關服務→生活助學服務→就學補助系統→就學貸款】預估學分登錄後，繳費單上隔天會更新加上學分費，依此向銀行貸款，選課確定後再多退少補。</p>
                    <br>
                    <p style="font-weight:bold;">Q4：貸款的流程是什麼？需要帶什麼東西到銀行？在銀行辦完就算完成了嗎？</p>
                    <p>(1) 自行上網列印繳費單後，至<a href="https://sloan.bot.com.tw/newsloan/login/SLoanLogin.action">臺灣銀行就貸入口網站</a>進行就貸線上申請，填寫基本資料及預約辦理時間。</p>
                    <p>(2) 備齊下列文件，親至臺灣銀行各地分行辦理借貸手續：</p>
                    <ol>
                        <li>攜帶學生證(新生憑錄取通知單)、繳費通知單、國民身分證、印章、本人及保證人最近三個月戶籍謄本(第一次申貸者)，學生及家長(保證人或法定監護人)本人親自至銀行辦理對保手續。</li>
                        <li>每一教育階段(高中、專科、大學、研究所各自為一階段，並無連續)第一次辦理時，需由家長或監護人(保證人或法定監護人)陪同，爾後由學生自己攜帶身分證、印章、戶籍謄本至銀行辦理借款手續即可。</li>
                        <li>學生未滿十八歲者：
                            <ol>
                                <li>應由父親及母親共同擔任保證人。</li>
                                <li>非雙親家庭者，由監護人擔任保證人。</li>
                            </ol>
                        </li>
                    </ol>
                    <p>(3) 臺銀撥款通知書第二聯，請於每學期規定期限內繳交至生活輔導組，遲交者視同未貸款，屆時須補繳學費。</p>
                    <br>
                    <p style="font-weight:bold;">Q5：如何辦理線上申貸？</p>
                    <p>請至【中大Portal入口網→學生相關服務→生活助學服務→就學補助系統→最新公告】填寫線上表單並送出或電洽生活輔導組林小姐，電話03-4227151分機57222。</p>
                    <br>
                    <p style="font-weight:bold;">Q6：我有貸書籍費及校外住宿費，這筆金額我要如何領取？</p>
                    <p>請至【本校portal入口網→便捷窗口→服務櫃台(iNCU)→學生學籍登錄】填寫「郵局局帳號」，所貸的書籍費、校外住宿費，將於學期中後退至個人帳戶；學分費多貸者，則退至銀行以按實貸款。</p>
                    <br>
                    <p style="font-weight:bold;">Q7：什麼是「教育部疫後就學貸款補助辦法」？誰可以申請？</p>
                    <p>為配合一百十二年二月二十一日立法院三讀通過且經總統公布施行之「疫後強化經濟與社會韌性及全民共享經濟成果特別條例」，協助經濟負擔重之「在學中已申請就學貸款之弱勢學生」及「畢業後符合撫育十二歲以下子女或平均月收入未達四萬元等資格之貸款人」償還一年本息，減輕貸款人就學貸款還款負擔。</p>
                    <p>申請資格:</p>
                    <p>一、   在學貸款人：具一百十一學年度第二學期正式學籍並有就學貸款之學生，及一百十二學年度第一學期入學具正式學籍並有該學期就學貸款之學生，且各該學期具下列資格之一者：</p>
                    <ol>
                        <li>獲低收入戶或中低收入戶學雜費減免。</li>
                        <li>獲特殊境遇家庭子女孫子女學雜費減免。</li>
                        <li>獲身心障礙學生及身心障礙人士子女學雜費減免。</li>
                        <li>獲原住民學生學雜費減免。</li>
                        <li>獲大專校院弱勢學生助學計畫助學金。</li>
                        <li>有十二歲以下子女。</li>
                        <li>本人或其配偶已懷孕。</li>
                    </ol>
                    <p>二、   非在學貸款人：未具一百十一學年度第二學期正式學籍並有就學貸款，且具下列資格之一者：</p>
                    <ol>
                        <li>低收入戶或中低收入戶。</li>
                        <li>於一百十一年度平均每月所得未達新臺幣四萬元：以財政部財政資訊中心一百十一年度各類所得資料清單之所得總額除以十二個月計算。</li>
                        <li>有十二歲以下子女。</li>
                        <li>本人或其配偶已懷孕。</li>
                    </ol>
                    <br>
                    <p style="font-weight:bold;">Q8：「教育部疫後就學貸款補助辦法」補助多少？</p>
                    <p>一、   在學貸款人：</p>
                    <ol>
                        <li>一百十一學年度第二學期之貸款人該學期之實際就學貸款額度；該學期無就學貸款者，以過去最近一學期實際就學貸款額度定之。</li>
                        <li>一百十二學年度第一學期之貸款人該學期之實際就學貸款額度。</li>
                    </ol>
                    <p>二、   非在學貸款人：依就學貸款辦法第十條第二項及第五項本文按月平均攤還本息數額，計算之一年就學貸款本息額度。</p>
                    <br>
                    <p style="font-weight:bold;">Q9：如果法定代理人沒辦法跟我一同前往台銀辦理就學貸款怎麼辦？</p>
                    <p>如法定代理人因故無法行使同意權，導致同學無法申貸就學貸款，若屬特殊且緊急之狀況，學生家庭可申請民事法庭緊急監護認定，取得裁定書後以完成申貸流程。</p>
                    <p style="color:red;">【注意】提醒同學畢業後應依所簽訂借據之約定還款。如無法依約履償者，請妥善利用台灣銀行或教育部的緩繳機制，並主動向台灣銀行提出申請辦理展延還款。</p>
                </div>
                <div id="section4" class="container tab-pane ">
                    <p style="font-weight:bold;">☆學生申請工讀有無學業成績上的限制?</p>
                    <p>依本校學生工讀助學辦法第四條之規定，並無學業成績之限制，但有規定不得受記小過以上之處份，如受處分已屆滿一年，或已完成銷過者則不再此限。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆學生申請工讀每月時數是否有上限?</p>
                    <p>依本校學生工讀助學辦法第七條規定，學期間每月工讀時數不得超過60小時，寒暑假期間每月不得超過160小時：但特殊需求之工讀生經專案會簽學生事務處核准後，得不受上述限制，惟不得超過勞動基準法規定每週工時之限制。</p>
                    <p>&nbsp;</p>
                </div>
                <div id="section5" class="container tab-pane ">
                    <p style="font-weight:bold;">Q1. 一、 什麼是緩徵?</p>
                    <p>ANS：年滿19歲役男在學期間，由學校造冊通知學生戶籍所在地之縣市政府，暫緩同學之兵役徵召。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q2. 大學部延畢生(含未能在6月底畢業之研究生)的緩徵如何辦理？收到徵集令怎麼辦？</p>
                    <p>ANS：1. 7月至9月間如接獲徵集令，請攜帶您的徵集令(紙本或影像皆可)，至生輔組辦理暫緩徵集證明，憑此證明即可向戶籍所在地鄉鎮市區公所申請暫緩徵集。(實際緩徵期限視各鄉鎮市區公所而定)
                    2.  開學後一個月內，生輔組會主動幫您辦理緩徵，無須提出申請。
                    </p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q3.碩博新生的緩徵如何辦理？收到徵集令怎麼辦？</p>
                    <p>ANS：</p>
                    <p>&nbsp;&nbsp;1.   7月至9月間如接獲徵集令，請持「錄取通知」或「研究所報到通知」向戶籍所在地鄉鎮市區公所申請暫緩徵集。
                    2.  如您已完成註冊流程的學籍登錄，生輔組會在開學後一個月內主動幫您辦理緩徵，無須提出申請。
                    </p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q4. 要如何知道學校是否幫我辦理緩徵？</p>
                    <p>ANS：</p>
                    <p> 請至【本校portal入口網→便捷窗口→服務櫃台(iNCU)→教務專區→學籍/註冊→學籍登錄】的兵役資料表查詢。</p>
                    
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q5. 什麼是緩徵原因消滅？休學中途離校會不會被調去當兵？</p>
                    <p>ANS：</p>
                    <p> 緩徵消滅原因為：一、畢業。 二、休學、退學等中途離校。有以上情形的同學，生輔組依規定於會在您離校之日起30天內，通知戶籍所
                    在地之縣市政府；緩徵消滅後有可能收到徵集令，但實際徵集狀況需視各鄉鎮市區公所而定。
                    </p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q6. 役男如何申請出境？短期出境跟出國交換有什麼差別？</p>
                    <p>ANS：請參考<a href="download/在學役男出境申請須知(1091026).pdf" target="_blank" title="【在學役男出境申請須知】">【在學役男出境申請須知】</a>
                </a>。</p>
                    <p>&nbsp;</p>
                    
                </div>
                <div id="section6" class="container tab-pane ">
                    <p style="font-weight:bold;">Q1. 學雜費減免辦理項目?</p>
                    <p>ANS：</p>
                    <p>目前辦理的有以下 軍公教遺族(卹內、卹滿) 、原住民籍學生、軍人子女、低收入戶學生、中低收入戶學生、身心障礙生及身心障礙人士子女、特殊境遇家庭之子女等八項。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q2. 何時申請學雜費減免?</p>
                    <p>ANS：</p>
                    <p>&nbsp;&nbsp;1.每學期期末開始，依公告時程辦理，逾期者於申請送件3天後自行到 PORTAL入口列印正確繳費單後再繳費。請勿先行繳費。</p>
                    <p>&nbsp;&nbsp;2.申請路徑：本校首頁右上方之Portal入口→就學補助系統→學雜費減免申請。</p>
                    <p>&nbsp;&nbsp;3.線上填寫申請表時，請填寫常用email，以便聯繫相關事宜。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q3. 收到繳費單後發現忘了辦減免，如何補辦?</p>
                    <p>ANS：</p>
                    <p>繳費前趕快到就學補助系統登錄，並將所需資料繳到生輔組(郵寄請附回郵信封)辦妥後請自行到學校首頁→學生→第一銀行or Portal入口自行列印繳費單繳費。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q4. 身心障礙學生及子女規定?</p>
                    <p>ANS：</p>
                    <p>前一年度家庭所得低於220萬元，採計人數(本人+父+母+配偶)。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q5. 在職專班學生可否申請身心障礙人士子女學雜費減免?</p>
                    <p>ANS：</p>
                    <p>在職專班學生本人具身心障礙學生身份可申請學雜費減免，身心障礙人士子女不可申請學雜費減免。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q6 身心障礙學生延修可否申請學雜費減免?</p>
                    <p>ANS：</p>
                    <p>身心障礙學生就學費用減免，包括重修、補修、輔系、雙主修、教育學程及延長修業年限。前項就學費用之減免，同一科目重修、補修者，以一次為限。</p>
                    <p>&nbsp;</p>
                </div>
                <div id="section7" class="container tab-pane ">
                    <p style="font-weight:bold;">Q1 校內外獎學金怎麼申請？</p>
                    <p>ANS：</p>
                    <p>&nbsp;&nbsp;1.申請路徑：中大首頁(右上方)Portal→學生相關服務→生活助學服務→獎助學金暨工讀管理系統（網址<a href="https://cis.ncu.edu.tw/Scholarship">https://cis.ncu.edu.tw/Scholarship</a>）</p>
                    <p>&nbsp;&nbsp;2. 凡由「學校送件」之申請案，請依系統登錄步驟線上登錄，並下載各該獎學金專有之申請表格，按各該規定送生輔組辦理申請手續。</p>
                    <p>&nbsp;&nbsp;3.每學期約公告150種校內外獎學金，資訊隨時更新，歡迎踴躍上網查詢。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q2 怎麼找自己可申請的獎學金？</p>
                    <p>ANS：</p>
                    <p>在｢學生專區-獎學金｣，可以列表方式瀏覽各項獎學金，也可以關鍵字搜尋(如：戶籍地、科系等)。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q3 如何確認申請進度？</p>
                    <p>ANS：</p>
                    <p>在｢學生專區-獎學金-查詢個人獎學金紀錄」，可瀏覽目前進度(如：申請中、錄取、未錄取等)。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q4 如何申請未領獎學金證明?</p>
                    <p>ANS：</p>
                    <p>在｢學生專區-獎學金-申請未領其他獎學金證明」線上申請，將該獎學金申請表攜至本組蓋章，或由本組列印未領獎學金證明給同學。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q5 怎麼領取獎學金？</p>
                    <p>ANS：</p>
                    <p>請登錄郵局帳號：portal-學生相關服務-學籍成績服務-學生學籍成績-學籍登錄-確認-修改其他資料</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q6 清寒證明包括什麼?</p>
                    <p>ANS：</p>
                    <p>&nbsp;&nbsp;1.如：低收證明、中低收證明、特殊境遇家庭子女、里長清寒證明書等。</p>
                    <p>&nbsp;&nbsp;2.依各獎學金辦法規定繳交。</p>
                    <p>&nbsp;&nbsp;3.持低收證明.中低收證明者，無須繳交所得及財產清單，若校外獎學金有其他規定，則從其規定。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q7 所得清單及財產清單怎麼申請?</p>
                    <p>ANS：</p>
                    <p>1.申辦各類所得或財產歸戶資料清單，請攜帶國民身分證正本，如委託他人代辦，則受託人要帶國民身分證正本，並檢附委任書或授權書正本及委託人國民身分證正本，就近至國稅局申請。</p>
                    <p>2.若申請校內獎學金，只須檢附父+母+本人之所得及財產清單。 (參考值:年收入70萬元以下、利息2萬以下、不動產650萬以下)</p>
                    <p>3.務請電洽就近國稅局詳細申請流程及應備文件。</p>
                    <p>&nbsp;</p>
                </div>
                <div id="section8" class="container tab-pane ">
                    <p style="font-weight:bold;">☆在校外賃居要如何簽約？房屋租賃定型化契約應記載及不得記載事項為何？</p>
                    <p>可依據行政院消費者保護委員會第47次委員會議通過:中華民國105年6月23日內政部內授中辦地字第1051305384號公告(中華民國106年1月1日生效)，相關內容請參考<a href="http://military.ncu.edu.tw/house/Contract.html">此連結</a>。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆遺失物認領程序？</p>
                    <p>經當事人於公告網頁照片中確認為物品當事人後，攜雙證件至軍訓室辦理簽收領取。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆學校辦理年度遺失物義(拍)賣活動時間為何？</p>
                    <p>每年1月與7月辦理前年度遺失物義(拍)賣活動，相關訊息公告於軍訓室與中大首頁外，學生宿舍各院系FB均會公告。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆在學校遺失財物若要調閱監視器，如何申請？</p>
                    <p>若物件遺失在環校道路或廣場，向駐警隊申請；各場館內向各場館申請；宿舍內向宿舍管理中心申請。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆發生遭詐騙情形如何處理？</p>
                    <p>1. 請保留相關物證(電話號碼、匯款記錄等)。</p>
                    <p>2. 立即打165反詐騙專線報案。</p>
                    <p>3. 向學校反映及報警處理。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆大專校院學生申請二階段常備兵役軍事訓練之對象為何？</p>
                    <p>1. 83年次以後役男目前就讀國內、國外或大陸地區之大學第一學年或五專第三學年在學學生。</p>
                    <p>2. 85年次接近役齡男子符合上揭條件者（渠等申請二階段常備兵役軍事訓練，即視為志願提前接受徵兵處理），亦可提出申請。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆大專校院學生申請二階段常備兵役軍事訓練，如何提出申請？</p>
                    <p>1. 申請時間、地點及受理單位：每年11 月15日前，由役男或家長（或有行為能力家屬）向戶籍地鄉（鎮、市、區）公所兵役單位提出申請，逾期不予受理。</p>
                    <p>2. 申請時須檢附證件：</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;(1). 學生證正反面（或在學證明）影本 (國外或大陸地區須經驗證)。</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;(2). 役男及家長（法定代理人）印章。</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;(3). 委託有行為能力家屬申請時，須備妥委託人身分證明文件。</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">☆我是轉學生，在中大有修習全民國防教育軍事訓練課程，在之前學校也有修，如何辦理折抵役期？</p>
                    <p>除了申請目前就讀學校的成績單外，請至前一所學校申請成績單後，在未核定折抵天數的情形下，一併攜至後面就讀的學校(中大軍訓室)核定折抵役期章。</p>
                    <p>&nbsp;</p>
                </div>
                <div id="section9" class="container tab-pane">
                    <p style="font-weight:bold;">Q1：我是在職學生可以申請研究生獎助學金？</p>
                    <p>ANS：</p>
                    <p>本校研究生獎助學第三條有規定~全職工作者不得申請獎助學金</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q2：我前學期成績有一科不到60分，本學期可以申請研究生獎助學金？</p>
                    <p>ANS：</p>
                    <p>研究生的成績本70分以下屬不及格，前學期不及格本學期不可以申領研究生獎助學金</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q3：我前學期成績有一科不到60分，本學期可以申請研究生獎助學金？</p>
                    <p>ANS：</p>
                    <p>研究生的成績本70分以下屬不及格，前學期不及格本學期不可以申領研究生獎助學金</p>
                    <p>&nbsp;</p>
                    <p style="font-weight:bold;">Q4：我是陸生可以申請研究生獎助學金？</p>
                    <p>ANS：</p>
                    <p>陸生可以申請研究生獎學金，但是不可以擔任勞僱型兼任助理。</p>
                </div>
            </div>
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>