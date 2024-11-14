<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>學雜費減免</title>
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
        <div id="content">

            <h2>國立中央大學 就學補助措施-學雜費減免作業說明</h2>
            <div style="margin: 15px;">
                <p>(一)辦理時間：依每學期公告時間為準</p>
                <p>(二)辦理步驟：依公告時限到就學補助系統登錄並列印申請表 繳交所需文件。</p>
                <p>網址：本校首頁→Portal(輸入ID及密碼)→就學補助系統→學雜減免申請→登錄申請所需資料。逾期辦理者請至先至生活輔導組補辦3天後逕自上網列印正確的繳費單後，再行繳費(切勿先行繳費，如有疑問請洽承辦人)。</p>
                <p>(三)辦理單位：生活輔導組 分機57221</p>
                <p>(四)教育部學雜費減免類別：[以下各類僅能擇一辦理]</p>

                <div class="table-responsive">
                    <table class="table table-striped" style="margin: 15px;">
                        <thead class="thead-dark">
                            <tr>
                                <th>減免身分類別</th>
                                <th>應備證明文件</th>
                                <th>補助額度</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>低收入戶子女</td>
                                <td>申請表、113年度有效之低收入戶證明影本（縣市政府、鄉鎮市區公所開具之證明）。</td>
                                <td>補助學雜費全額</td>
                            </tr>
                            <tr>
                                <td>中低收入戶子女</td>
                                <td>申請表、113年度有效之中低收入戶證明影本（縣市政府、鄉鎮市區公所開具之證明）。</td>
                                <td>學雜費減免60%</td>
                            </tr>
                            <tr>
                                <td>特殊境遇家庭之子女孫子女</td>
                                <td>申請表、113年社會局或鄉鎮市區公所開立有效期限之特殊境遇家庭身份證明文件、新式戶口名簿影本或三個月內戶籍謄本(以上需包括詳細記事)。</td>
                                <td>學雜費減免60%</td>
                            </tr>
                            <tr>
                                <td>身心障礙學生及其子女</td>
                                <td>申請表、身心障礙手冊(或鑑輔會證明)影本、新式戶口名簿影本或三個月內全戶戶籍謄本(含本人+父+母，已婚者應含配偶)(以上需包括詳細記事)。</td>
                                <td>
                                    <ul>
                                        <li>輕度：學雜費減免40%</li>
                                        <li>中度：學雜費減免70%</li>
                                        <li>重度：學雜費全免</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>原住民學生</td>
                                <td>申請表、新式戶口名簿影本或三個月內戶籍謄本(以上需包括詳細記事)。</td>
                                <td>依就讀院系不同，減免學雜費約20,200~22,800元</td>
                            </tr>
                            <tr>
                                <td>卹內/卹滿軍公教遺族學生</td>
                                <td>初次辦理者：撫卹令或年撫卹金證書影本、新式戶口名簿影本或三個月內全戶戶籍謄本(以上需包括詳細記事)、軍公教遺族子女就學優待申請書一式二份；已申請過者僅需繳交申請表。</td>
                                <td>依教育部頒規定標準核減</td>
                            </tr>
                            <tr>
                                <td>現役軍人子女</td>
                                <td>申請表、家長在職服務證明或在營服役證明、新式戶口名簿影本或三個月內戶籍謄本(以上需包括詳細記事)。</td>
                                <td>學費減免30%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p>(五)限制性規定：</p>
                <p>1.<span style="font-weight:bold;">政府各類助學措施僅能擇一申領：</span>以上各類減免及政府其他助學措施（農委會農漁民子女就學獎助學金、勞委會失業勞工子女就學補助、勞工子女發展技藝能助學金、人事行政局公教人員子女教育補助、國軍退除役官兵輔導委員會清寒榮民子女獎助學金、臺北市失業勞工子女就學補助、原民會補助等）<span style="font-weight:bold;">均不得重複申請，請務必審慎選擇。</span></p>
                <p>2.<span style="font-weight:bold;">先減免後繳費：</span>需先至生輔組補辦理減免後，確認持正確的學費單再行繳費。</p>
                <p>3.本減免不包含延長修業年限(身心障礙學生除外)、暑期（重）補修、重修及補修之學分費。</p>
                <p>4.學生轉學、休學、退學、開除學籍者，當學期已減免之費用，不予追繳。重讀、復學或再行入學時，休學、退學前所就讀之相當學期、年級已享受減免之費用，不得重複減免。</p>
                <p>5.已取得專科以上教育階段之學位，再行修讀同級學位，或同時修讀二以上同級學位者，不得重複申請減免。</p>
                <p>6.就讀各類在職進修專班學生，比照各大學日間部應繳就學費用減免之，且最高以實際繳納數額為限。(身心障礙人士子女就讀研究所在職專班，不可辦理學雜費減免)</p>

            </div>
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>
<?php
mysql_free_result($military_bulletin);

mysql_free_result($military_bulletin_top);
?>
