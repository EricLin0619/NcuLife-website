<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>獎學金</title>
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
            <h2>國立中央大學各項獎學金</h2>
            <p style="text-align: right;">113年08月29日更新</p>
            <div class="table-responsive-md" style="margin: 15px;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th class="text-center" style="width:190;">獎學金名稱</th>
                            <th class="text-center" style="width:200;">金額<span style="font-size:10%;">（元/人）</span></th>
                            <th class="text-center" style="width:200;">名額</th>
                            <th class="text-center" style="width:280;">說明</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        
                        
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學羅家倫校長紀念獎學金辦法-1090720.pdf" class="list-group-item list-group-item-light">國立中央大學羅家倫校長紀念獎學金</a>
                            </td>
                            <td class="text-center">100000</td>
                            <td class="text-center">3(大學部)<br>3(研究所)</td>
                            <td class="text-center">大二以上或碩二清寒優秀學生</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學朱順一合勤獎學金辦法1110627.pdf" class="list-group-item list-group-item-light">國立中央大學朱順一<br>合勤獎學金</a>
                            </td>
                            <td class="text-center">100000(學業優良)<br>20000(運動績優)</td>
                            <td class="text-center">10(學業優良) 5(運動績優)</td>
                            <td class="text-center">獎勵品行良好且學業或運動競賽表現優異之大三學生</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學蔡力行先生獎學金辦法(民國109年11月9日修訂).pdf" class="list-group-item list-group-item-light">國立中央大學蔡力行先生<br>獎學金</a>
                            </td>
                            <td class="text-center">100000(傑出領導)<br>至多300000(出國研修)</td>
                            <td class="text-center">2(傑出領導)<br>8(出國研修)</td>
                            <td class="text-center">獎助品學兼優之大學部學生，包含傑出領導獎學金及優秀學生出國研修獎學金</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學方頌仁校友獎學金辦法1121023.pdf" class="list-group-item list-group-item-light">方頌仁校友獎學金</a>
                            </td>
                            <td class="text-center">80000</td>
                            <td class="text-center">3</td>
                            <td class="text-center">限大學部學生(原住民、新住民)優秀學生</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學補助清寒學生出國研修獎學金辦法.pdf" class="list-group-item list-group-item-light">國立中央大學補助清寒學生<br>出國研修獎學金</a>
                            </td>
                            <td class="text-center">1年至多50萬</td>
                            <td class="text-center">2</td>
                            <td class="text-center">獎助大學部低收入戶、中低收入戶、特殊境遇家庭子女學生出國交換研修獎學金</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學李國鼎先生紀念獎學金辦法1110815.pdf" class="list-group-item list-group-item-light">李國鼎先生紀念獎學金</a>
                            </td>
                            <td class="text-center">30000</td>
                            <td class="text-center">10</td>
                            <td class="text-center">限大學部大二以上清寒優秀學生</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學上詮光纖興學獎學金辦法1130715.pdf" class="list-group-item list-group-item-light">上詮光纖興學獎學金</a>
                            </td>
                            <td class="text-center">30000</td>
                            <td class="text-center">10</td>
                            <td class="text-center">限彰化地區大學部學生</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學優秀學生獎學金辦法991229.pdf" class="list-group-item list-group-item-light">國立中央大學優秀學生獎學金</a>
                            </td>
                            <td class="text-center">20000</td>
                            <td class="text-center">60</td>
                            <td class="text-center">本校優秀學生，每學期辦理一次</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學勵學獎學金發放要點1120306.pdf" class="list-group-item list-group-item-light">勵學獎學金</a>
                            </td>
                            <td class="text-center">至多10000</td>
                            <td class="text-center">不定</td>
                            <td class="text-center">獎助本校清寒優秀學生</td>
                        </tr>
                        <tr>
                            <td class="text-center">國立中央大學安心就學支持計畫安心學習助學金</td>
                            <td class="text-center">學期間以每月3,000元為原則</td>
                            <td class="text-center">150</td>
                            <td class="text-center">1.每學期辦理一次，須繳交自主學習計畫書、參與輔導活動3次、與導師晤談2次。</br>
                            2.大學部之低收、中低收或特殊境遇家庭者優先，並需經委員會審查。
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                 <a href="download/國立中央大學殷省三先生紀念獎助學金辦法(民國106年6月19日修訂).pdf" class="list-group-item list-group-item-light">殷省三先生紀念獎助學金</a>
                             </td>
                            <td class="text-center">25000</td>
                            <td class="text-center">5</td>
                            <td class="text-center">獎助大學部清寒優秀學生</td>
                        </tr>
                        <tr>
                            <td class="text-center">數學系第一屆校友獎學金</td>
                            <td class="text-center">25000</td>
                            <td class="text-center">3</td>
                            <td class="text-center">獎助大二以上清寒學生，數學系2名，其餘科系1名</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學林鄧碧鳳女士紀念獎學金辦法1101018.pdf" class="list-group-item list-group-item-light">國立中央大學林鄧碧鳳女士紀念獎學金</a>
                            </td>
                            <td class="text-center">50000</td>
                            <td class="text-center">2</td>
                            <td class="text-center">大氣系大學部二年級以上優秀清寒學生兩名</td>
                        </tr>

                        <tr>
                            <td class="text-center">國立中央大學學生傑出領導獎</td>
                            <td class="text-center">20000</td>
                            <td class="text-center">10</td>
                            <td class="text-center">鼓勵本校學生學業與群育並重，促進學生熱心參與團隊活動，培育傑出領導人才</td>
                        </tr>
                        <tr>
                            <td class="text-center">國立中央大學建德傑出領導獎學金</td>
                            <td class="text-center">100000</td>
                            <td class="text-center">1</td>
                            <td class="text-center">選拔培育本校優秀領導人才</td>
                        </tr>
                        <tr>
                            <td class="text-center">國立中央大學學生<br>服務學習績優獎學金</td>
                            <td class="text-center">10,000(個人)<br>20,000(團體)</td>
                            <td class="text-center">不定</td>
                            <td class="text-center">遴選服務學習績優個人及團隊</td>
                        </tr>
                        <tr>
                            <td class="text-center">國立中央大學國際<br>服務學習獎學金辦法</td>
                            <td class="text-center">25,000(亞洲地區)<br>35,000(其他地區)</td>
                            <td class="text-center">不定</td>
                            <td class="text-center">遴選國際志工服務團隊。</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/國立中央大學學業成績優良書卷獎獎勵辦法(民國106年6月2日修訂).pdf" class="list-group-item list-group-item-light">國立中央大學<br>學業成績優良書卷獎</a>
                            </td>
                            <td class="text-center">5000</td>
                            <td class="text-center">不定</td>
                            <td class="text-center">大學部各班前一學期學業成績名列該班前百分之五之在學學生</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/財團法人中大學術基金會「天成醫療體系張育美董事長」希望獎學金辦法(民國105年4月15日修訂).pdf" class="list-group-item list-group-item-light">中大學術基金會各類獎學金</a>
                            </td>
                            <td class="text-center">依獎學金孳息</td>
                            <td class="text-center">不定</td>
                            <td class="text-center">每學年辦理一次</td>
                        </tr>
                        <tr>
                            <td class="text-center">戴運軌學術基金會獎學金</td>
                            <td class="text-center">10000</td>
                            <td class="text-center">2</td>
                            <td class="text-center">地球科學學院大學部優秀學生</td>
                        </tr>
                        <tr>
                            <td class="text-center">學產基金會低收入戶助學金</td>
                            <td class="text-center">5,000</td>
                            <td class="text-center">不定</td>
                            <td class="text-center">限大學部低收入戶學生申請</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="download/113年房東聯誼會賃居學生獎助學金.pdf" class="list-group-item list-group-item-light">校外賃居學生獎助學金</a>
                            </td>
                            <td class="text-center">3000</td>
                            <td class="text-center">30</td>
                            <td class="text-center">1.需為租賃「房東聯誼會」會員房舍之賃居生(由房東聯誼會查核)。<br>2.前一學期學業成績平均75分以上(至少需修習3門以上課程)、操行成績80分以上，且各科成績均需及格。</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>