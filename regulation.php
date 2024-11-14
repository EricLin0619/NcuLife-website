<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>相關法規</title>
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
                    <a class="nav-link active" data-toggle="tab" href="#section1">學生兵役</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">獎學金</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">助學措施</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section4">學生獎懲／操行</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section5">請假</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section6">研究生獎助學金</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">
                    <h2>學生兵役</h2>
                    <p style="font-weight:bold;">校外法規</p>
                    <div class="list-group" style="margin: 15px;">
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=F0040001" class="list-group-item list-group-item-action">兵役法</a>
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=F0040002" class="list-group-item list-group-item-action">兵役法施行法</a>
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=D0040006" class="list-group-item list-group-item-action">役男出境處理辦法</a>
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=F0120002" class="list-group-item list-group-item-action">妨害兵役治罪條例</a>
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=D0040001" class="list-group-item list-group-item-action">徵兵規則(含應徵役男延期徵集入營事故表)</a>
                        <a href="http://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=D0040004" class="list-group-item list-group-item-action">免役禁役緩徵緩召實施辦法</a>
                        <a href="https://edu.law.moe.gov.tw/LawContent.aspx?id=FL019646&KeyWord=%e7%b7%a9%e5%be%b5" class="list-group-item list-group-item-action">高級中等以上學校學生申請緩徵作業要點</a>
                    </div>
                </div>
                <div id="section2" class="container tab-pane">
                    <h2>獎學金</h2>
                    <p style="font-weight:bold;">校內法規</p>
                    <div class="list-group" style="margin: 15px;">

                        <a href="download/國立中央大學羅家倫校長紀念獎學金辦法-1090720.pdf" class="list-group-item list-group-item-action">國立中央大學羅家倫校長紀念獎學金辦法(民國109年7月20日修訂)  (.pdf)</a>
                        <a href="download/國立中央大學朱順一合勤獎學金辦法1110627.pdf" class="list-group-item list-group-item-action">國立中央大學朱順一合勤獎學金辦法(民國111年6月27日修訂)  (.pdf)</a>
                        <a href="download/國立中央大學蔡力行先生獎學金辦法(民國109年11月9日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學蔡力行先生獎學金辦法(民國109年11月9日修訂) (.pdf)</a>
                        <a href="download/國立中央大學方頌仁校友獎學金辦法1121023.pdf" class="list-group-item list-group-item-action">國立中央大學方頌仁校友獎學金辦法(民國112年10月23日修訂) (.pdf)</a>
                        <a href="download/國立中央大學補助清寒學生出國研修獎學金辦法.pdf" class="list-group-item list-group-item-action">國立中央大學補助清寒學生出國研修獎學金辦法(民國108年10月7日修訂)  (.pdf)</a>
                        <a href="download/國立中央大學李國鼎先生紀念獎學金辦法1110815.pdf" class="list-group-item list-group-item-action">國立中央大學李國鼎先生紀念獎學金辦法(民國111年8月15日修訂)  (.pdf)</a>
                        <a href="download/國立中央大學上詮光纖興學獎學金辦法1130715.pdf" class="list-group-item list-group-item-action">國立中央大學上詮光纖興學獎學金辦法(民國113年7月15日修訂) (.pdf)</a>
                        <a href="download/國立中央大學優秀學生獎學金辦法991229.pdf" class="list-group-item list-group-item-action">國立中央大學優秀學生獎學金辦法(民國99年12月29日修訂)  (.pdf)</a>
                        <a href="download/國立中央大學勵學獎學金發放要點1120306.pdf" class="list-group-item list-group-item-action">國立中央大學勵學獎學金發放要點(民國112年3月6日修訂)  (.pdf)</a>
                        <a href="download/國立中央大學殷省三先生紀念獎助學金辦法(民國106年6月19日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學殷省三先生紀念獎助學金辦法(民國106年6月19日修訂)  (.pdf)</a>
                        <a href="download/國立中央大學林鄧碧鳳女士紀念獎學金辦法1101018.pdf" class="list-group-item list-group-item-action">國立中央大學林鄧碧鳳女士紀念獎學金辦法(民國110年10月18日修訂) (.pdf)</a>
                        <a href="download/國立中央大學學業成績優良書卷獎獎勵辦法(民國106年6月2日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學業成績優良書卷獎獎勵辦法(民國106年6月2日修訂)  (.pdf)</a>
                        <a href="download/財團法人中大學術基金會「天成醫療體系張育美董事長」希望獎學金辦法(民國105年4月15日修訂).pdf" class="list-group-item list-group-item-action">財團法人中大學術基金會「天成醫療體系張育美董事長」希望獎學金辦法(民國105年4月15日修訂) (.pdf)</a>
                        <a href="download/國立中央大學學生獎助學金審核辦法(民國100年6月13日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生獎助學金審核辦法(民國100年6月13日修訂)  (.pdf)</a>
                        <a href="download/國立中央大學獎助學金接受捐贈辦法(民國106年11月6日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學獎助學金接受捐贈辦法(民國106年11月6日修訂) (.pdf)</a>                        
                    </div>
                </div>
                <div id="section3" class="container tab-pane">
                    <h2>助學措施</h2>
                    <p style="font-weight:bold;">校內法規</p>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/國立中央大學學生工讀助學辦法(民國112年6月19日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生工讀助學辦法(民國112年6月19日修訂) (.pdf)</a>
                        <a href="download/國立中央大學學生生活助學金實施辦法(民國106年10月23日修正).pdf" class="list-group-item list-group-item-action">國立中央大學學生生活助學金實施辦法(民國106年10月23日修正) (.pdf)</a>
                        <a href="download/國立中央大學學生急難救助金實施辦法(民國110年7月12日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生急難救助金實施辦法(民國110年7月12日修訂) (.pdf)</a>
                        <a href="download/Implementation Regulations of National Central University’s Student Emergency Relief Fund.pdf" class="list-group-item list-group-item-action">Implementation Regulations of National Central University’s Student Emergency Relief Fund (.pdf)</a>
                    </div>
                    <p style="font-weight:bold;">校外法規</p>
                    <div class="list-group" style="margin: 15px;">
                        <a href="https://edu.law.moe.gov.tw/LawContent.aspx?id=FL035980&kw=%e6%95%99%e8%82%b2%e9%83%a8%e5%ad%b8%e7%94%a2%e5%9f%ba%e9%87%91%e8%a8%ad%e7%bd%ae%e6%80%a5%e9%9b%a3%e6%85%b0%e5%95%8f%e9%87%91%e5%af%a6%e6%96%bd%e8%a6%81%e9%bb%9e" class="list-group-item list-group-item-action">教育部學產基金設置急難慰問金實施要點</a>
                        <a href="https://www.ht.org.tw/religion12.htm" class="list-group-item list-group-item-action">財團法人台北行天宮 急難濟助辦法</a>
                        <a href="https://www.edu.tw/helpdreams/cp.aspx?n=294130B70B308624&s=A8A03607552A5F17" class="list-group-item list-group-item-action">大專校院弱勢學生助學計畫</a>
                        <a href="http://edu.law.moe.gov.tw/LawContent.aspx?id=FL008414" class="list-group-item list-group-item-action">高級中等以上學校學生就學貸款辦法(民國113年1月16日修訂)</a>
                        <a href="https://edu.law.moe.gov.tw/LawContent.aspx?id=FL008654&kw=%e9%ab%98%e7%b4%9a%e4%b8%ad%e7%ad%89%e4%bb%a5%e4%b8%8a%e5%ad%b8%e6%a0%a1%e5%ad%b8%e7%94%9f%e5%b0%b1%e5%ad%b8%e8%b2%b8%e6%ac%be%e4%bd%9c%e6%a5%ad%e8%a6%81%e9%bb%9e" class="list-group-item list-group-item-action">高級中等以上學校學生就學貸款作業要點(民國113年1月17日修訂)</a>
                        <a href="download/高級中等以上學校學生就學貸款辦法第10條、第11條(教育部臺高(四)字第1040106587B號令修正).pdf" class="list-group-item list-group-item-action">高級中等以上學校學生就學貸款辦法第10條、第11條(教育部臺高(四)字第1040106587B號令修正)</a>
                        <a href="download/高級中等以上學校學生就學貸款作業要點第18點(教育部臺高(四)字第1040107187B號令修正).pdf" class="list-group-item list-group-item-action">高級中等以上學校學生就學貸款作業要點第18點(教育部臺高(四)字第1040107187B號令修正)</a>
                        <a href="https://edu.law.moe.gov.tw/LawContent.aspx?id=GL000545&kw=%e4%bd%8e%e6%94%b6%e5%85%a5%e6%88%b6%e5%ad%b8%e7%94%9f%e5%8f%8a%e4%b8%ad%e4%bd%8e%e6%94%b6%e5%85%a5%e6%88%b6%e5%ad%b8%e7%94%9f%e5%b0%b1%e8%ae%80%e9%ab%98%e7%b4%9a%e4%b8%ad%e7%ad%89%e4%bb%a5%e4%b8%8a%e5%ad%b8%e6%a0%a1%e5%ad%b8%e9%9b%9c%e8%b2%bb%e6%b8%9b%e5%85%8d%e8%be%a6%e6%b3%95" class="list-group-item list-group-item-action">低收入戶學生及中低收入戶學生就讀高級中等以上學校學雜費減免辦法</a>
                        <a href="https://edu.law.moe.gov.tw/LawContent.aspx?id=FL009158&kw=%e8%ba%ab%e5%bf%83%e9%9a%9c%e7%a4%99%e5%ad%b8%e7%94%9f%e5%8f%8a%e8%ba%ab%e5%bf%83%e9%9a%9c%e7%a4%99%e4%ba%ba%e5%a3%ab%e5%ad%90%e5%a5%b3%e5%b0%b1%e5%ad%b8%e8%b2%bb%e7%94%a8%e6%b8%9b%e5%85%8d%e8%be%a6%e6%b3%95" class="list-group-item list-group-item-action">身心障礙學生及身心障礙人士子女就學費用減免辦法</a>
                        <a href="https://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=H0020016" class="list-group-item list-group-item-action">
                        軍公教遺族就學費用優待條例</a>
                        <a href="https://edu.law.moe.gov.tw/LawContent.aspx?id=FL036693&kw=%e5%8e%9f%e4%bd%8f%e6%b0%91%e5%ad%b8%e7%94%9f%e5%b0%b1%e8%ae%80%e5%9c%8b%e7%ab%8b%e5%8f%8a%e7%a7%81%e7%ab%8b%e5%b0%88%e7%a7%91%e4%bb%a5%e4%b8%8a%e5%ad%b8%e6%a0%a1%e5%ad%b8%e9%9b%9c%e8%b2%bb%e6%b8%9b%e5%85%8d%e8%be%a6%e6%b3%95" class="list-group-item list-group-item-action">原住民學生就讀國立及私立專科以上學校學雜費減免辦法</a>
                        <a href="https://edu.law.moe.gov.tw/LawContent.aspx?id=GL001194" class="list-group-item list-group-item-action">特殊境遇家庭子女孫子女就讀高級中等以上學校學雜費減免辦法</a>
                        <a href="https://edu.law.moe.gov.tw/LawContent.aspx?id=FL008421&kw=%e7%8f%be%e5%bd%b9%e8%bb%8d%e4%ba%ba%e5%ad%90%e5%a5%b3%e5%b0%b1%e8%ae%80%e4%b8%ad%e7%ad%89%e4%bb%a5%e4%b8%8a%e5%ad%b8%e6%a0%a1%e6%b8%9b%e5%85%8d%e5%ad%b8%e8%b2%bb%e8%be%a6%e6%b3%95" class="list-group-item list-group-item-action">
                        現役軍人子女就讀中等以上學校減免學費辦法</a>
                        <a href="download/教育部疫後就學貸款補助辦法.pdf" class="list-group-item list-group-item-action">
                        教育部疫後就學貸款補助辦法  (.pdf)</a>
                    </div>
                </div>
                <div id="section4" class="container tab-pane">
                    <h2>學生獎懲／操行</h2>
                    <p style="font-weight:bold;">校內法規</p>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/國立中央大學學生獎懲辦法(民國112年11月14日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生獎懲辦法(民國112年11月14日修訂)</a>
                        <a href="download/國立中央大學學生獎懲辦法(The Regulations of NCU Student Rewards and Punishments).pdf" class="list-group-item list-group-item-action">國立中央大學學生獎懲辦法(The Regulations of NCU Student Rewards and Punishments)</a>
                        <a href="download/學生獎懲委員會設置辦法109年11月17日修訂.pdf" class="list-group-item list-group-item-action">學生獎懲委員會設置辦法(109年11月17日修訂)</a>
                        <a href="download/國立中央大學學生銷過實施要點(民國112年6月2日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生銷過實施要點(民國112年6月2日修訂)</a>
                        <a href="download/學生操行成績評定辦法(民國112年6月2日修訂).pdf" class="list-group-item list-group-item-action">國立中央大學學生操行成績評定辦法(民國112年6月2日修訂)</a>
                    </div>
                </div>
                <div id="section5" class="container tab-pane">
                    <h2>請假</h2>
                    <p style="font-weight:bold;">校內法規</p>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/國立中央大學學生請假規則（民國113年6月7日修訂）.pdf" class="list-group-item list-group-item-action">國立中央大學學生請假規則(民國113年6月7日修訂) (.pdf)</a>
                    </div>
                </div>
                <div id="section6" class="container tab-pane">
                    <h2>研究生獎助學金</h2>
                    <p style="font-weight:bold;">校內法規</p>
                    <div class="list-group" style="margin: 15px;">
                        <a href="download/研究生獎助學金辦法-109年6月1日行政會議通過.pdf" class="list-group-item list-group-item-action">研究生獎助學金辦法(109年6月1日行政會議通過) (.pdf)</a>
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