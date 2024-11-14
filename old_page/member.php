<?php require_once('conn_military.php'); ?>
<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>成員介紹</title>
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

    .dropdown-menu a:hover {
    background-color: white;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

</style>

<body>
    <?php include "navbar.php"?>
    <div class="container">
        <?php include "header.php"?>
        <div style="margin-bottom: 15px;">
            <h2>成員介紹</h2>
            <table class="table">
                <!-- <thead>
                    <tr class="pull-left">
                        <td colspan="3">生活輔導組提供以下服務：疾病照料、車禍處理、安全維護、生活服務、緊急聯絡、國軍招募作業、學生全民國防課程選修、抵免及加退選、宿舍輔導、租屋訊息以及防制學生藥物濫用暨交通安全等。</td>
                    </tr>
                </thead> -->
                <tbody id="org">
<!--                     <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/%E5%AD%AB%E4%B8%AD%E9%81%8B.jpg" alt="" width="180" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;上校生輔組長</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;孫中運</td>
                        </tr>
                        <tr>
                        <td>&nbsp;輔導宿舍</td><td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57211</td>
                        </tr>
                        <tr>
                            <td>&nbsp;輔導系所</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;scy777@ncu.edu.tw</td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、督導生活輔導組各項業務工作全般事宜。
                            <br>&nbsp;二、負責校安中心事務。</td>
                        </tr>
                    </table>

                    <td>&nbsp;</td> -->
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src=" images/Members/person.jpg " alt="" width="180" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;組長</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;周毓芳</td>
                        </tr>
                        <!-- <tr>
                  <td>&nbsp;輔導宿舍</td><td>&nbsp;女二舍<br/>&nbsp;女四舍<br/>&nbsp;女六舍<br/>&nbsp;男十二舍</td>
                  </tr> -->
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57211</td>
                        </tr>
                        <tr>
                            <td>&nbsp;輔導系所</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:yvonnechou@ncu.edu.tw">yvonnechou@ncu.edu.tw</td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、承校長指示，指揮所屬推動本校校園安全及全民國防教育相關工作發展。
                            <br>&nbsp;二、策畫督導學生生活輔導業務各項業務工作全般事宜。
                            <br>&nbsp;三、校園安全維護，處理緊急突發事件與督導校安事件通報與聯繫。
                            <br>&nbsp;四、奉學務長指示，協助原資中心各項業務工作全般事宜。
                            <br>&nbsp;五、執行上級交辦事項。
                            </td>
                        </tr>
                    </table>
                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/person.jpg" alt="" width="220" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;校安專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;孫守丕</td>
                        </tr>
                        <!-- <tr>
                  <td>&nbsp;輔導宿舍</td><td>&nbsp;</td>
                  </tr> -->
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57212</td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;輔導系所
                            </td>
                            <td>
                                &nbsp;管理學院獨立研究所<br>
                                &nbsp;資電學院獨立研究所<br>
                                &nbsp;工程學院獨立研究所<br>
                                &nbsp;地科院獨立研究所<br>
                                &nbsp;化學系所<br>
                                &nbsp;全校在職專班
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:sops@ncu.edu.tw">sops@ncu.edu.tw</a></td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、系所輔導業務。
                            <br>&nbsp;二、校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。
                            <br>&nbsp;三、校園安全及危機管理事宜。
                            <br>&nbsp;四、防制校園霸凌實施計畫訂定、小組委員遴聘與委員會召開、宣導與成果彙整。
                            <br>&nbsp;五、校園霸凌案件之申請受理、調查程序執行、申復受理、結案陳報。
                            <br>&nbsp;六、校園災害防救規劃與計畫擬訂、防災地圖繪製及修訂。
                            <br>&nbsp;七、學生校外租屋訪視。
                            <br>&nbsp;八、規劃全校防災演練計畫與演練執行。
                            <br>&nbsp;九、校園災害潛勢資料更新。
                            <br>&nbsp;十、颱風與防汛通報作業。
                            <br>&nbsp;十一、臨時交辦事項。</td>


                        </tr>
                    </table>
                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/%E7%8E%8B%E4%B8%96%E5%8D%9A.jpg" alt="" width="180" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;校安專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;王世博</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57212</td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;輔導系所
                            </td>
                            <td>
                                &nbsp;企管系所<br>
                                &nbsp;財金系所<br>
                                &nbsp;經濟系所
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:rukawa@cc.ncu.edu.tw">rukawa@cc.ncu.edu.tw</a></td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、系所輔導業務。
                            <br>&nbsp;二、校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。
                            <br>&nbsp;三、校園安全及危機管理事宜。
                            <br>&nbsp;四、軍訓綜合及公文彙辦業務。
                            <br>&nbsp;五、友善校園周宣導及防竊、反詐騙宣導。
                            <br>&nbsp;六、志願役軍官、士官、預官考選及相關國軍人才招募工作事宜。
                            <br>&nbsp;七、協調友校全民國防課程開課事宜。
                            <br>&nbsp;八、協助全民國防課程授課教官，編輯教務系統課程大綱、完成教務處、桃竹苗資 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;源中心有關全民國防課程表報資料事宜。
                            <br>&nbsp;九、全民國防課程鐘點費編列與核銷事宜。
                            <br>&nbsp;十、配合辦理導師工作會議、親師座談及宿民大會資料彙整及宣導事宜。
                            <br>&nbsp;十一、轄區警察局支援協定。
                            <br>&nbsp;十二、校安綜合業務協辦。
                            <br>&nbsp;十三、學生校外租屋訪視。
                            <br>&nbsp;十四、生輔組校園安全e化業務及網頁維護管理。
                            <br>&nbsp;十五、臨時交辦事項。</td>
                        </tr>
                    </table>
                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/%E9%AB%98%E6%BD%A4%E6%B8%85.jpg" alt="" width="180" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;校安專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;高潤清</td>
                        </tr>
                        <!-- <tr>
                  <td>&nbsp;輔導宿舍</td><td>&nbsp;男九舍</td>
                  </tr> -->
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57212</td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;輔導系所
                            </td>
                            <td>
                                &nbsp;地科院<br>
                                &nbsp;(除獨立系所)<br>
                                &nbsp;資管系所
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:kjching@cc.ncu.edu.tw">kjching@cc.ncu.edu.tw</a></td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、    系所輔導業務。
                            <br>&nbsp;二、    校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。
                            <br>&nbsp;三、    校園安全及危機管理事宜。
                            <br>&nbsp;四、    行政綜合業務(含百花川詩獎推廣作業)。
                            <br>&nbsp;五、    校安中心財產物品、場地(含教學)、器材整理維護。
                            <br>&nbsp;六、    教育部、校務、學務、資源中心評鑑。
                            <br>&nbsp;七、    學生校外租屋訪視。
                            <br>&nbsp;八、    校務、行政會議業務。
                            <br>&nbsp;九、個資業務、內控手冊。
                            <br>&nbsp;十、校安中心預算及經費控管、報支。
                            <br>&nbsp;十一、意見反映信箱意見分配與彙整。
                            <br>&nbsp;十二、臨時交辦事項。</td>
                        </tr>
                    </table>
                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/姜德剛.jpg" alt="" width="160" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;校安專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;姜德剛</td>
                        </tr>
                        <!-- <tr>
                  <td>&nbsp;輔導宿舍</td><td>&nbsp;男七舍<br/>&nbsp;國際學舍</td>
                  </tr> -->
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57212</td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;輔導系所
                            </td>
                            <td>
                                &nbsp;理學院(除化學系所)<br>
                                &nbsp;學士班<br>
                                &nbsp;數學系所<br>
                                &nbsp;物理系所<br>
                                &nbsp;光電系所
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:jdkmc1632@cc.ncu.edu.tw">jdkmc1632@cc.ncu.edu.tw</a></td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、    系所輔導業務。。
                            <br>&nbsp;二、    校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。
                            <br>&nbsp;三、    校園安全及危機管理事宜。
                            <br>&nbsp;四、    學生校外賃居業務綜辦(含處理賃居生糾紛及緊急事件)。
                            <br>&nbsp;五、    訂頒學生校外賃居輔導服務實施計畫並填報教育部賃居訪視數據資料。
                            <br>&nbsp;六、    編組校安專員及工讀生執行學生校外賃居關懷訪視。
                            <br>&nbsp;七、    校外賃居工讀生招募管理、工作執行、經費申報。
                            <br>&nbsp;八、    辦理各項學生校外賃居安全與權益宣導、校外防災場館參訪體驗活動。
                            <br>&nbsp;九、    辦理賃居學生、校外房東及社區巡守隊消防安全講習及演練、房東座談會、租 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;屋說明會暨租屋博覽會。
                            <br>&nbsp;十、    校外賃居建物安全評核及消防設備公安申報檢查(含安全標章核發)。
                            <br>&nbsp;十一、   校外「房東聯誼會」組織運作及聯繫、賃居學生獎助學金申辦。
                            <br>&nbsp;十二、   教育部大專校院弱勢助學計畫-校外租屋租金補貼申辦。
                            <br>&nbsp;十三、   維管及更新本校雲端租屋網頁。
                            <br>&nbsp;十四、   辦理教育部每年度學生賃居服務工作績優學校遴選陳報。
                            <br>&nbsp;十五、   學生校外租屋訪視。
                            <br>&nbsp;十六、   臨時交辦事項。</td>
                        </tr>
                    </table>
                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/person.jpg" alt="" width="200" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;校安專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;凌志勇</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57212</td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;輔導系所
                            </td>
                            <td>
                                &nbsp;工學院學士班<br>
                                &nbsp;機械系所
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:cyling@ncu.edu.tw">cyling@ncu.edu.tw</a></td>
                        </tr>
                        <tr style="height: 100%;">
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、    系所輔導業務。
                            <br>&nbsp;二、    校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。
                            <br>&nbsp;三、    校園安全及危機管理事宜。
                            <br>&nbsp;四、    防制學生藥物濫用訂定計畫及宣導事宜。
                            <br>&nbsp;五、    特定人員清查、輔導相關作業。
                            <br>&nbsp;六、    尿液篩檢試劑需求調查及申請。
                            <br>&nbsp;七、    辦理學校春暉小組輔導期程案件審查及獎勵作業相關事宜。
                            <br>&nbsp;八、    推薦本校反毒人士、團體相關事宜。
                            <br>&nbsp;九、    學生校外租屋訪視。
                            <br>&nbsp;十、    國民法官制度校園推廣相關事宜。
                            <br>&nbsp;十一、   法治教育宣導。
                            <br>&nbsp;十二、   智慧財產權宣導。
                            <br>&nbsp;十三、   校園人權法治教育宣導。
                            <br>&nbsp;十四、   國家防災日活動辦理及活動成果薦報。
                            <br>&nbsp;十五、運動會精神錦標
                            <br>&nbsp;十六、   臨時交辦事項。</td>
                        </td>
                        </tr>
                    </table>
                    <td>&nbsp;</td> 
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/%E8%94%A3%E5%AE%B6%E9%A8%8F.jpg" alt="" width="250" height="225" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;校安專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;蔣家騏</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57212</td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;輔導系所
                            </td>
                            <td>
                                &nbsp;電機院學士班<br>
                                &nbsp;電機系所<br>
                                &nbsp;通訊系所
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:jas5592@ncu.edu.tw">jas5592@ncu.edu.tw</a></td>
                        </tr>
                        <tr style="height: 100%;">
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、    系所輔導業務。。
                            <br>&nbsp;二、    校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。
                            <br>&nbsp;三、    校園安全及危機管理事宜。
                            <br>&nbsp;四、    交通安全宣導及講座。

                            <br>&nbsp;五、    遺失物處理存管。
                            <br>&nbsp;六、    學生校外租屋訪視。

                            <br>&nbsp;七、    臨時交辦事項。</td>
                        </tr>
                    </table>
                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/%E7%86%8A%E8%8B%B1%E6%89%8D.jpg" alt="" width="180" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;校安專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;熊英才</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57212</td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;輔導系所
                            </td>
                            <td>
                                &nbsp;生科院(全院系所)<br>
                                &nbsp;資工系所  
                            
                        </td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:hyt@cc.ncu.edu.tw">hyt@cc.ncu.edu.tw</a></td>
                        </tr>
                        <tr style="height: 100%;">
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、    系所輔導業務。
                            <br>&nbsp;二、    校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。
                            <br>&nbsp;三、    校園安全及危機管理事宜。
                            <br>&nbsp;四、    校安人事業務彙辦。
                            <br>&nbsp;五、    校安人員召募工作彙辦。
                            <br>&nbsp;六、    校安中心輪值表排表業務。
                            <br>&nbsp;七、    校安中心工讀生之召募、訓練、編組、管理。
                            <br>&nbsp;八、    校安中心工讀生經費編列運用管理。
                            <br>&nbsp;九、    校安中心人員業務職掌表調整。
                            <br>&nbsp;十、    校園紅火蟻防治成果通報。
                            <br>&nbsp;十一、   青年動員服勤計畫擬定。
                            <br>&nbsp;十二、   學生校外租屋訪視。
                            <br>&nbsp;十三、   臨時交辦事項。</td>
                        </tr>
                    </table>
                    <!--
                  原生輔組成員
                  -->
                     <td>&nbsp;</td>
                                
                                <table id="member" width="100%" height="162" border="1">
                                    <tr>
                                        <td rowspan="6" width="25%" class="photo"><img src="images/Members/廖河順.jpg" alt="" width="180" height="214" /></td>
                                        <td width="25%">&nbsp;職稱</td>
                                        <td width="50%">&nbsp;校安專員</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;姓名</td>
                                        <td>&nbsp;廖河順</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;分機號碼</td><td>&nbsp;57212</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;輔導系所</td>
                                        <td>&nbsp;客家學院(全院系所)
                                        <br>&nbsp;土木系所
                                        <br>&nbsp;化材系所</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;公務信箱</td>
                                        <td>&nbsp;<a href="mailto:mars39569@ncu.edu.tw">mars39569@ncu.edu.tw</a></td>
                                    </tr>
                                    <tr style="height: 100%;">
                                        <td>&nbsp;業務職掌</td>
                                        <td>&nbsp;一、    系所輔導業務。
                                        <br>&nbsp;二、    校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。
                                        <br>&nbsp;三、    校園安全及危機管理事宜。
                                        <br>&nbsp;四、    校園安全綜合業務彙辦。
                                        <br>&nbsp;五、    學生校外租屋訪視。
                                        <br>&nbsp;六、    大專校院自主檢核表彙整陳報。
                                        <br>&nbsp;七、    校園周邊熱點巡查檢整(協調轄區派所及五權里巡守隊)
                                        <br>&nbsp;八、    配合辦理導師工作會議、親師座談及宿民大會資料彙整及宣導事宜。
                                        <br>&nbsp;九、    臨時交辦事項。</td>  
                                       
                                    </tr>
                                </table>

                                <td>&nbsp;</td>
                                
                                <table id="member" width="100%" height="162" border="1">
                                    <tr>
                                        <td rowspan="6" width="25%" class="photo"><img src="images/Members/陳效邦.jpg" alt="" width="180" height="214" /></td>
                                        <td width="25%">&nbsp;職稱</td>
                                        <td width="50%">&nbsp;校安專員</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;姓名</td>
                                        <td>&nbsp;陳效邦</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;分機號碼</td><td>&nbsp;57212</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;輔導系所</td>
                                        <td>&nbsp;文學院
                                        <br>&nbsp;(全院系所)</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;公務信箱</td>
                                        <td>&nbsp;<a href="hsiaopang@cc.ncu.edu.tw">hsiaopang@cc.ncu.edu.tw</a></td>
                                    </tr>
                                    <tr style="height: 100%;">
                                        <td>&nbsp;業務職掌</td>
                                        <td>&nbsp;一、    系所輔導業務。
                                        <br>&nbsp;二、    校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。
                                        <br>&nbsp;三、    校園安全及危機管理事宜。
                                        <br>&nbsp;四、    校園安全綜合業務協辦。
                                        <br>&nbsp;五、    賃居生業務協辦
                                        <br>&nbsp;六、    品德教育宣導相關事宜。
                                        <br>&nbsp;七、    教育部品德教育特色學校資料蒐整薦報相關事宜。
                                        <br>&nbsp;八、    各項師生會議及活動(導師會議、親師座談會、宿舍會議、寒暑假活動)安全宣導聯繫。   
                                        <br>&nbsp;九、    新生安全教育業務。
                                        <br>&nbsp;十、    寒暑假安全事項宣導(家長聯繫函)。
                                        <br>&nbsp;十一、    臨時交辦事項。</td>
                                    </tr>
                                </table>                
                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/林雅筠.jpg" alt="" width="180" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;林雅筠</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57220、57221</td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:yylin@ncu.edu.tw">yylin@ncu.edu.tw</a></td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、全校研究生獎助學金預算分配及法規制訂修改。
                                <br>&nbsp;二、學生兵役緩徵及儘後召集業務每學期大批資料彙整報送、每月離校學生資料彙 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                整報送、出國交換學生緩徵延修報送及控管、兵役系統管理維護。
                                <br>&nbsp;三、大專校院弱勢學生助學計畫-弱勢助學金申請受理、審查、彙辦及報送。
                                <br>&nbsp;四、大專校院弱勢學生助學計畫-生活助學金申請受理、審查、分配；每月服務反 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;思及考核表彙整、助學金核發。
                                <br>&nbsp;五、學生請假案件審核及系統管理維護。
                                <br>&nbsp;六、生輔組各項經費控管及學生公費編列。
                                <br>&nbsp;七、生輔組綜合業務(含公文登記桌、各項數據統計及執行成果撰寫、組務會議召 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                開與記錄)。
                                <br>&nbsp;八、生輔組行政及活動工讀生招募、訓練、管理、僱用。
                            </td>
                        </tr>
                    </table>

                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/楊念儒.jpg" alt="" width="150" height="200" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;辦事員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;楊念儒</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57224、57221</td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:ericayang@ncu.edu.tw">ericayang@ncu.edu.tw</a></td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、 校內各項獎助學金收文、公告、申請受理、彙辦、審查、核發。
                                <br>&nbsp;二、 校外各項獎助學金收文、公告、申請受理、彙辦、審查、回函、核發。
                                <br>&nbsp;三、 朱順一合勤獎學金公告、申請受理、彙整、彙辦、核發、辦理頒獎典禮及新聞 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;稿撰寫。
                                <br>&nbsp;四、 蔡力行先生獎學金公告、申請受理、彙整、彙辦、核發、辦理頒獎典禮及新聞 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;稿撰寫。
                                <br>&nbsp;五、 每學期書卷獎審查、核發。
                                <br>&nbsp;六、 校內各項獎助學金獎狀製作、得獎證明開立。
                                <br>&nbsp;七、 每學年中大獎學金募款成果報告撰寫。
                                
                            </td>
                        </tr>
                    </table>

                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/邱琳格.png" alt="" width="150" height="200" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;組員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;邱琳格</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57223、57221</td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:ringochiu@ncu.edu.tw">ringochiu@ncu.edu.tw</a></td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td >&nbsp;一、全校工讀助學金預算分配及法規制訂修改。
                                <br>&nbsp;二、全校勞僱型工讀生雇用審核及系統管理維護。
                                <br>&nbsp;三、安心就學支持計畫-安心學習助學金法規研議、申請受理、審查、彙辦、核
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;發，並協助規劃發放條件及輔導機制。
                                <br>&nbsp;四、全校學生急難救助金申請受理、審查、核發。
                                <br>&nbsp;五、教育部學產基金急難慰問金申請受理、報送、核發。
                                <br>&nbsp;六、每學期辦理各項獎助學金頒獎典。
                                <br>&nbsp;七、生輔組個人資料保護窗口。
                                <br>&nbsp;八、學務處資安執行小組窗口。
                        </tr>
                    </table>
<!--
                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/%E6%88%B4%E8%BE%B0%E7%8F%8A.png" alt="" width="180" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;行政專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;戴辰珊</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57221</td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:toineete@cc.ncu.edu.tw">toineete@cc.ncu.edu.tw</a></td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、學生就學貸款。
                                <br>&nbsp;二、學雜費減免及卹內軍公教遺族公費業務。
                                <br>&nbsp;三、學生獎懲案及操行成績。
                                <br>&nbsp;四、總統教育獎。
                                <br>&nbsp;五、臨時交辦事項。</td>
                        </tr>
                    </table>
-->
                    <td>&nbsp;</td>
                    <table id="member" width="100%" height="162" border="1">
                        <tr>
                            <td rowspan="6" width="25%" class="photo"><img src="images/Members/林昕諭.jpg" alt="" width="180" height="214" /></td>
                            <td width="25%">&nbsp;職稱</td>
                            <td width="50%">&nbsp;行政專員</td>
                        </tr>
                        <tr>
                            <td>&nbsp;姓名</td>
                            <td>&nbsp;林昕諭</td>
                        </tr>
                        <tr>
                            <td>&nbsp;分機號碼</td><td>&nbsp;57222、57221</td>
                        </tr>
                        <tr>
                            <td>&nbsp;公務信箱</td>
                            <td>&nbsp;<a href="mailto:hsinyu@ncu.edu.tw">hsinyu@ncu.edu.tw</a></td>
                        </tr>
                        <tr>
                            <td>&nbsp;業務職掌</td>
                            <td>&nbsp;一、 全校學生就學貸款公告、申請受理、彙辦、報送。
                                <br>&nbsp;二、 全校學生學雜費減免申請受理、彙辦、報送。
                                <br>&nbsp;三、 卹內軍公教遺族公費申請受理、彙辦、報送。
                                <br>&nbsp;四、 全校學生獎懲案申請受理、審查、銷過及系統管理維護。
                                <br>&nbsp;五、 全校學生操行成績評定、報送及系統管理維護。
                                <br>&nbsp;六、 總統教育獎申請受理、彙辦、報送。
                                <br>&nbsp;七、 教育部學產基金低收入戶助學金受理申請、彙辦、報送。
                            </td>
                        </tr>
                    </table>
                </tbody>
            </table>
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>
