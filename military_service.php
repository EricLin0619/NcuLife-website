<a?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>學生兵役</title>
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
        <div>
            <div class="list-group" style="margin: 15px;">
                <h2 style="font-weight:bold;">緩徵作業</h2>
                <a class="list-group" style="margin: 15px;font-size:20px">  新生於入學時，須至【本校portal入口網→便捷窗口→服務櫃台(iNCU)→教務專區→學籍/註冊→學籍登錄】填寫兵役資料，生輔組將於每學期開學後一個月內辦理緩徵，學生無須另外申請。
                </a>
                <div>
                    <a href="images/Service Delayed homework.jpg" target=_blank><img src="images/Service Delayed homework.jpg" width="100%"></a>
                </div>
                <h2 style="font-weight:bold;">儘召作業</h2>
                <a class="list-group" style="margin: 15px;font-size:20px">  學生如已服過兵役，須至【本校portal入口網→便捷窗口→服務櫃台(iNCU)→教務專區→學籍/註冊→學籍登錄】填寫兵役資料並上傳退伍令，生輔組將於每學期開學後一個月內辦理儘後召集，讓同學於在學期間得暫緩召集。
                </a>
                <h2 style="font-weight:bold;">替代役教召</h2>
                <p style="margin: 15px;font-size:20px">學生若為備役替代役身分(非緩徵、後備軍人身分)，於在學期間收到教召通知/教召令：</p>
                <ol style="margin: 15px;font-size:20px">
                    <li>可至戶籍區公所，依照相關規定及資格申請「免除當次召集申請」</li>
                    <li>需持教召令至生輔組將協助辦理「暫緩徵召用證明書」</li>
                </ol>
                <p style="font-size: 20px;">相關兵役法規定請參考<a style="font-weight: bold;" href="https://dca.moi.gov.tw/scrs/">內政部役政司備役替代役資訊網</a></p>

                <h2 style="font-weight:bold;">役男出境</h2>
                <a class="list-group" style="margin: 15px;font-size:20px"> 請參考以下連結 <a style="margin: 15px;font-size:20px" href="download/在學役男出境申請須知(1091026).pdf" target="_blank" title="【在學役男出境申請須知】">【在學役男出境申請須知】</a>
                </a>

                <h2><a style="font-weight:bold; color:#343A42;" href="derate.php">折抵役期</a></h2>
                <h2><a style="font-weight:bold; color:#343A42;" href="officer_leaflet.php">國軍招募資訊</a></h2>

                <h2 style="font-weight:bold;">常見問題</h2>
                <h3 style="font-weight:bold;">一、什麼是緩徵？</h3>
                <a class="list-group" style="margin: 15px;font-size:20px">  年滿19歲役男在學期間，由學校造冊通知學生戶籍所在地之縣市政府，暫緩同學之兵役徵召。
                </a>
                <h3 style="font-weight:bold;">二、大學部延畢生(含未能在6月底畢業之研究生)的緩徵如何辦理？收到徵集令怎麼辦？</h3>
                <a class="list-group" style="margin: 15px;font-size:20px">1.&nbsp;&nbsp;&nbsp;&nbsp;7月至9月間如接獲徵集令，請攜帶您的徵集令(紙本或影像皆可)，至生輔組辦理暫緩徵集證明，憑此證明即可向戶籍所在地鄉鎮市區公所申請暫緩徵集。(實際緩徵期限視各鄉鎮市區公所而定)
                </a>
                <a class="list-group" style="margin: 15px;font-size:20px">2.&nbsp;&nbsp;&nbsp;&nbsp;開學後一個月內，生輔組會主動幫您辦理緩徵，無須提出申請。
                </a>
                <h3 style="font-weight:bold;">三、碩博新生的緩徵如何辦理？收到徵集令怎麼辦？</h3>
                <a class="list-group" style="margin: 15px;font-size:20px">1.&nbsp;&nbsp;&nbsp;&nbsp;7月至9月間如接獲徵集令，請持「錄取通知」或「研究所報到通知」向戶籍所在地鄉鎮市區公所申請暫緩徵集。
                </a>
                <a class="list-group" style="margin: 15px;font-size:20px">2.&nbsp;&nbsp;&nbsp;&nbsp;如您已完成註冊流程的學籍登錄，生輔組會在開學後一個月內主動幫您辦理緩徵，無須提出申請。
                </a>
                <h3 style="font-weight:bold;">四、要如何知道學校是否幫我辦理緩徵？</h3>
                <a class="list-group" style="margin: 15px;font-size:20px">  請至【本校portal入口網→便捷窗口→服務櫃台(iNCU)→教務專區→學籍/註冊→學籍登錄】的兵役資料表查詢。
                </a>
                <h3 style="font-weight:bold;">五、什麼是緩徵原因消滅？休學中途離校會不會被調去當兵？</h3>
                <a class="list-group" style="margin: 15px;font-size:20px">緩徵消滅原因為：一、畢業。二、休學、退學等中途離校。有以上情形的同學，生輔組依規定於會在您離校之日起30天內，通知戶籍所在地之縣市政府；緩徵消滅後有可能收到徵集令，但實際徵集狀況需視各鄉鎮市區公所而定。

                </a>
                <h3 style="font-weight:bold;">六、役男如何申請出境？短期出境跟出國交換有什麼差別？</h3>
                <a class="list-group" style="margin: 15px;font-size:20px">請參考以下連結 <a style="margin: 15px;font-size:20px" href="download/在學役男出境申請須知(1091026).pdf" target="_blank" title="【在學役男出境申請須知】">【在學役男出境申請須知】</a>
                </a>
            </div>
            <h2 style="font-weight:bold; font-size: 20px">相關連結</h2>
            <div class="list-group" style="margin: 15px;">
                <a href="http://cis.ncu.edu.tw/iNCU/academic/register/checkStudentState" target="_blank" class="list-group-item list-group-item-action">兵役緩徵辦理進度查詢</a>
                <a href="https://www.ris.gov.tw/departure/app/" target="_blank" class="list-group-item list-group-item-action">役男線上申請短期出境(內政部役政署)</a>
                <a href="https://www.nca.gov.tw/stage/hp2/hp1.aspx" target="_blank" class="list-group-item list-group-item-action">分階段接受常備兵役軍事訓練系統(內政部役政署)</a>
                <a href="https://www.nca.gov.tw/sugsys/" target="_blank" class="list-group-item list-group-item-action">一般替代役申請(內政部役政署)</a>
                <a href="https://www.mnd.gov.tw/PublishTable.aspx?title=%E9%87%8D%E8%A6%81%E6%94%BF%E7%AD%96&Types=1%E5%B9%B4%E6%9C%9F%E7%BE%A9%E5%8B%99%E5%BD%B9%E5%B0%88%E5%8D%80/" target="_blank" class="list-group-item list-group-item-action">1年期義務役專區(國防部全球資訊網)</a>
            </div>
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>