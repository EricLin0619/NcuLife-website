<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>校外租金補貼</title>
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

    h4 {
        margin: 15px;
    }

    h3 {
        font-weight: bold;
        line-height: 2.2;
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

            <h2 style="font-weight: bold; line-height: 3.0">國立中央大學 弱勢學生校外住宿租金補貼 說明暨申請事宜</h2>
            <div style="margin: 15px;">
                <h3 style="line-height: 1.5">
                    一、為協助本校弱勢學生順利就學，租屋於桃園市地區者每人每月補貼2,880元；租金補貼期間，上學期為8月至隔年1月、下學期為2月至7月，每學期以補助6個月為原則(若租約未涵蓋此期間，則依實際涵蓋部分補貼)。
                </h3>

                <h3>
                    二、申請對象
                </h3>

                <p>(一)&nbsp;&nbsp;符合<span style="font-weight: bold;">1.低收入戶、2.中低收入戶、3.大專校院弱勢學生助學計畫助學金補助</span>資格之學生，並實際在校外租屋之同學。</p>
                <p>(二)&nbsp;&nbsp;延長修業年限、重複修讀二個以上同級學位者，不得再申請補貼。</p>
                <p>(三)&nbsp;&nbsp;  已請領其他與本計畫性質相當之政府住宿補貼，或已在他校請領校外住宿租金補貼者，不得重複申請</p>
                <p>(四)&nbsp;&nbsp;學生向直系親屬承租住宅，或該住宅所有權人為學生之直系親屬者(含學生或配偶之父母、養父母或祖父母)，不得申請</p>
                
                <h3>
                    三、申請方式
                </h3>

                <h4>
                    <span style="font-weight: bold;">每學期依作業期程，上學期於 10 月 20 日前 / 下學期於 3 月 20 日前，檢附相關文件向學務處生輔組提出申請</span>，逾期不予受理。
                </h4>

                <p>(一)&nbsp;&nbsp;  初次申請者，請額外檢附前一年度：家戶所得清單、不動產清單(向各地區稅捐機關申辦)。</p>
                <p>(二)&nbsp;&nbsp;申請文件:</p>
                <ul>
                    <li style="font-weight: bold;">低收入戶、中低收入戶學生:</li>
                    <p>檢附 1.申請書、2.租賃契約書影本(合格版本)、3.建物登記第二類謄本、4.低收身分證明。</p>
                    <li style="font-weight: bold;">弱勢助學計畫補助資格學生:</li>
                    <p>檢附 1.申請書、2.租賃契約書影本(合格版本)、3.建物登記第二類謄本、4.含詳細記事之戶口名簿或3個月內戶籍謄本。(※請先確認父母及本人之全年收入+財產，需符合弱勢助學資格，教育部及財政部會同步進行查調作業)</p>
                </ul>

                <h3>
                    四、凡欲申請之同學，需先上學校 portal系統->獎助學金暨工讀管理系統->「各學期教育部大專校院弱勢學生助學計畫-學生校外住宿租金補貼」項目點選申請(個人學籍資料系統中需先填寫郵局帳戶號碼，以利撥款)。
                </h3>

                <h3>
                    五、倘學生本人已申請內政部擴大租金補貼(或其他政府補助)，且為同一租約地址者，不得再重複申請，以免觸法
                </h3>

                <h3>六、倘有疑義請洽生輔組姜德剛教官〈03-4227151轉57212〉</h3>
                <h3>七、檢附「校外住宿租金補貼問答集Q&A」詳如附件，其他「租金補貼申請書」等相關資料，請隨時詳閱學務處生輔組每學期最新公告</h3>
                <div class="list-group" style="margin: 15px;">
                
                <a href="download/學生校外住宿租金補貼Q&Ａ.pdf" class="list-group-item list-group-item-action">大專校院弱勢學生助學計畫學生校外住宿租金補貼Ｑ & Ａ</a>
                
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
mysql_free_result($military_bulletin);

mysql_free_result($military_bulletin_top);
?>
