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
    .centered {
        text-align: center !important; /* 水平居中，使用 !important 提升优先级 */
        vertical-align: middle !important; /* 垂直居中，使用 !important 提升优先级 */
    }
    /* 現有樣式 */
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
        color: black;
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

    /* 新增或修改的表格樣式 */
    /* 新增或修改的表格樣式 */
    #member {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }
    #member td, #member th {
        padding: 10px;
        border: 1px solid #ccc;
        vertical-align: top; /* 設定文字的垂直對齊 */
        text-align: left; /* 設定文字的水平對齊 */
    }
    #member .photo {
        text-align: center; /* 照片水平居中 */
        vertical-align: middle; /* 照片垂直居中 */
    }
    #member .photo img {
        width: 180px;
        height: auto;
        border-radius: 5px;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    #member tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    #member tr:hover {
        background-color: #e2e2e2;
    }
    #member a {
        color: #0056b3;
        text-decoration: none;
    }
    #member a:hover {
        text-decoration: underline;
    }
    /* 調整特定欄位的寬度 */
    #member td:nth-child(2) {
        width: 20%; /* 設置職稱、姓名等欄位的寬度 */
    }
    #member td:nth-child(3) {
        width: 55%; /* 為保持整體平衡，可將主要内容欄位設置更寬 */
    }
        /* 調整業務職掌列表樣式 */
    #member ol {
        padding-left: 0; /* 移除預設的內邊距，讓數字靠左 */
        margin-left: 15px; /* 設置適當的左邊距，以便有足夠空間顯示序號 */
        list-style-type: decimal; /* 保持標準的數字序號 */
    }
    #member li {
        text-align: left; /* 確保列表內容靠左對齊 */
    }

</style>



<body>
<?php
$members = [
    [
        'name' => '周毓芳',
        'title' => '組長',
        'photo' => 'images/Members/person.jpg',
        'extension' => '57211',
        'department' => '-',
        'email' => 'yvonnechou@ncu.edu.tw',
        'responsibilities' => [
            '承校長指示，指揮所屬推動本校校園安全及全民國防教育相關工作發展。',
            '策畫督導學生生活輔導業務各項業務工作全般事宜。',
            '校園安全維護，處理緊急突發事件與督導校安事件通報與聯繫。',
            '奉學務長指示，協助原資中心各項業務工作全般事宜。',
            '執行上級交辦事項。'
        ]
    ],
    [
        'name' => '孫守丕',
        'title' => '校安專員',
        'photo' => 'images/Members/person.jpg',
        'extension' => '57212',
        'department' => '管理學院獨立研究所, 資電學院獨立研究所, 工程學院獨立研究所, 地科院獨立研究所, 化學系所, 全校在職專班',
        'email' => 'sops@ncu.edu.tw',
        'responsibilities' => [
            '系所輔導業務。',
            '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
            '校園安全及危機管理事宜。',
            '防制校園霸凌實施計畫訂定、小組委員遴聘與委員會召開、宣導與成果彙整。',
            '校園霸凌案件之申請受理、調查程序執行、申復受理、結案陳報。',
            '校園災害防救規劃與計畫擬訂、防災地圖繪製及修訂。',
            '學生校外租屋訪視。',
            '規劃全校防災演練計畫與演練執行。',
            '臨時交辦事項。'
        ]
    ],
    [
        'name' => '王世博',
        'title' => '校安專員',
        'photo' => 'images/Members/王世博.jpg',
        'extension' => '57212',
        'department' => '企管系所, 財金系所, 經濟系所',
        'email' => 'rukawa@cc.ncu.edu.tw',
        'responsibilities' => [
            '系所輔導業務。',
            '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
            '校園安全及危機管理事宜。',
            '軍訓綜合及公文彙辦業務。',
            '友善校園周宣導及防竊、反詐騙宣導。',
            '志願役軍官、士官、預官考選及相關國軍人才招募工作事宜。',
            '協調友校全民國防課程開課事宜。',
            '協助全民國防課程授課教官，編輯教務系統課程大綱、完成教務處、桃竹苗資源中心有關全民國防課程表報資料事宜。',
            '全民國防課程鐘點費編列與核銷事宜。',
            '配合辦理導師工作會議、親師座談及宿民大會資料彙整及宣導事宜。',
            '轄區警察局支援協定。',
            '校安綜合業務協辦。',
            '學生校外租屋訪視。',
            '生輔組校園安全e化業務及網頁維護管理。',
            '臨時交辦事項。'
        ]
    ],
    // [
    //     'name' => '高潤清',
    //     'title' => '校安專員',
    //     'photo' => 'images/Members/高潤清.jpg',
    //     'extension' => '57212',
    //     'department' => '地科院, 資管系所',
    //     'email' => 'kjching@cc.ncu.edu.tw',
    //     'responsibilities' => [
    //         '系所輔導業務。',
    //         '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
    //         '校園安全及危機管理事宜。',
    //         '行政綜合業務(含百花川詩獎推廣作業)。',
    //         '校安中心財產物品、場地(含教學)、器材整理維護。',
    //         '教育部、校務、學務、資源中心評鑑。',
    //         '學生校外租屋訪視。',
    //         '校務、行政會議業務。',
    //         '個資業務、內控手冊。',
    //         '校安中心預算及經費控管、報支。',
    //         '意見反映信箱意見分配與彙整。',
    //         '臨時交辦事項。'
    //     ]
    // ],
    
    [
        'name' => '鄧伯修',
        'title' => '校安專員',
        'photo' => 'images/Members/鄧伯修.jpg',
        'extension' => '57212',
        'department' => '地科院, 資管系所',
        'email' => 'dds888@ncu.edu.tw',
        'responsibilities' => [
            '系所輔導業務。',
            '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
            '校園安全及危機管理事宜。',
            '學生校外賃居業務綜辦(含處理賃居生糾紛及緊急事件)。',
            '訂頒學生校外賃居輔導服務實施計畫並填報教育部賃居訪視數據資料。',
            '編組校安專員及工讀生執行學生校外賃居關懷訪視。',
            '校外賃居工讀生招募管理、工作執行、經費申報。',
            '辦理各項學生校外賃居安全與權益宣導、校外防災場館參訪體驗活動。',
            '辦理賃居學生、校外房東及社區巡守隊消防安全講習及演練、房東座談會、租屋說明會暨租屋博覽會。',
            '校外賃居建物安全評核及消防設備公安申報檢查(含安全標章核發)。',
            '校外「房東聯誼會」組織運作及聯繫、賃居學生獎助學金申辦。',
            '教育部大專校院弱勢助學計畫-校外租屋租金補貼申辦。',
            '維管及更新本校雲端租屋網頁。',
            '辦理教育部每年度學生賃居服務工作績優學校遴選陳報。',
            '學生校外租屋訪視。',
            '臨時交辦事項。'
        ]
    ],   
    [
        'name' => '姜德剛',
        'title' => '校安專員',
        'photo' => 'images/Members/姜德剛.jpg',
        'extension' => '57212',
        'department' => '理學院(除化學系所), 學士班, 數學系所, 物理系所, 光電系所',
        'email' => 'jdkmc1632@cc.ncu.edu.tw',
        'responsibilities' => [
            '系所輔導業務。',
            '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
            '校園安全及危機管理事宜。',
            '行政綜合業務。',
            '校安中心財產物品、場地(含教學)、器材整理維護。',
            '教育部、校務、學務、資源中心評鑑。',
            '學生校外租屋訪視。',
            '校務、行政會議業務。',
            '個資業務、內控手冊。',
            '校安中心預算及經費控管、報支。',
            '意見反映信箱意見分配與彙整。',
            '臨時交辦事項。'
        ]
    ],
    [
        'name' => '凌志勇',
        'title' => '校安專員',
        'photo' => 'images/Members/person.jpg',
        'extension' => '57212',
        'department' => '工學院學士班, 機械系所',
        'email' => 'cyling@ncu.edu.tw',
        'responsibilities' => [
            '系所輔導業務。',
            '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
            '校園安全及危機管理事宜。',
            '防制學生藥物濫用訂定計畫及宣導事宜。',
            '特定人員清查、輔導相關作業。',
            '尿液篩檢試劑需求調查及申請。',
            '辦理學校春暉小組輔導期程案件審查及獎勵作業相關事宜。',
            '推薦本校反毒人士、團體相關事宜。',
            '學生校外租屋訪視。',
            '國民法官制度校園推廣相關事宜。',
            '法治教育宣導。',
            '智慧財產權宣導。',
            '校園人權法治教育宣導。',
            '國家防災日活動辦理及活動成果薦報。',
            '運動會精神錦標',
            '臨時交辦事項。'
        ]
    ],
    [
        'name' => '蔣家騏',
        'title' => '校安專員',
        'photo' => 'images/Members/蔣家騏.jpg',
        'extension' => '57212',
        'department' => '電機院學士班, 電機系所, 通訊系所',
        'email' => 'jas5592@ncu.edu.tw',
        'responsibilities' => [
            '系所輔導業務。',
            '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
            '校園安全及危機管理事宜。',
            '交通安全宣導及講座。',
            '遺失物處理存管。',
            '學生校外租屋訪視。',
            '臨時交辦事項。'
        ]
    ],
    [
        'name' => '熊英才',
        'title' => '校安專員',
        'photo' => 'images/Members/熊英才.jpg',
        'extension' => '57212',
        'department' => '生科院(全院系所), 資工系所',
        'email' => 'hyt@cc.ncu.edu.tw',
        'responsibilities' => [
            '系所輔導業務。',
            '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
            '校園安全及危機管理事宜。',
            '校安人事業務彙辦。',
            '校安人員召募工作彙辦。',
            '校安中心輪值表排表業務。',
            '校安中心工讀生之召募、訓練、編組、管理。',
            '校安中心工讀生經費編列運用管理。',
            '校安中心人員業務職掌表調整。',
            '校園紅火蟻防治成果通報。',
            '青年動員服勤計畫擬定。',
            '學生校外租屋訪視。',
            '臨時交辦事項。'
        ]
    ],
    [
        'name' => '廖河順',
        'title' => '校安專員',
        'photo' => 'images/Members/廖河順.jpg',
        'extension' => '57212',
        'department' => '客家學院(全院系所), 土木系所, 化材系所',
        'email' => 'mars39569@ncu.edu.tw',
        'responsibilities' => [
            '系所輔導業務。',
            '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
            '校園安全及危機管理事宜。',
            '校園安全綜合業務彙辦。',
            '學生校外租屋訪視。',
            '大專校院自主檢核表彙整陳報。',
            '校園周邊熱點巡查檢整(協調轄區派所及五權里巡守隊)',
            '配合辦理導師工作會議、親師座談及宿民大會資料彙整及宣導事宜。',
            '臨時交辦事項。'
        ]
    ],
    [
        'name' => '陳效邦',
        'title' => '校安專員',
        'photo' => 'images/Members/陳效邦.jpg',
        'extension' => '57212',
        'department' => '文學院(全院系所)',
        'email' => 'hsiaopang@cc.ncu.edu.tw',
        'responsibilities' => [
            '系所輔導業務。',
            '校安值勤 (教職員工生緊急事件處理、通報等安全防護工作)。',
            '校園安全及危機管理事宜。',
            '校園安全綜合業務協辦。',
            '賃居生業務協辦',
            '品德教育宣導相關事宜。',
            '教育部品德教育特色學校資料蒐整薦報相關事宜。',
            '各項師生會議及活動(導師會議、親師座談會、宿舍會議、寒暑假活動)安全宣導聯繫。',
            '新生安全教育業務。',
            '寒暑假安全事項宣導(家長聯繫函)。',
            '臨時交辦事項。'
        ]
    ],
    [
        'name' => '吳孟靜',
        'title' => '專任人員',
        'photo' => 'images/Members/林雅筠.jpg',
        'extension' => '57220, 57221',
        'department' => '-',
        'email' => 'mengjing@ncu.edu.tw',
        'responsibilities' => [
            // '全校研究生獎助學金預算分配及法規制訂修改。',
            '學生兵役緩徵及儘後召集業務每學期大批資料彙整報送、每月離校學生資料彙整報送、出國交換學生緩徵延修報送及控管、兵役系統管理維護。',
            '大專校院弱勢學生助學計畫-弱勢助學金申請受理、審查、彙辦及報送。',
            '大專校院弱勢學生助學計畫-生活助學金申請受理、審查、分配；每月服務反思及考核表彙整、助學金核發。',
            '學生請假案件審核及系統管理維護。',
            // '生輔組各項經費控管及學生公費編列。',
            // '生輔組綜合業務(含公文登記桌、各項數據統計及執行成果撰寫、組務會議召開與記錄)。',
            // '生輔組行政及活動工讀生招募、訓練、管理、僱用。'
            '每學期辦理各項獎助學金頒獎典禮。',
        ]
    ],
    [
        'name' => '楊念儒',
        'title' => '辦事員',
        'photo' => 'images/Members/楊念儒.jpg',
        'extension' => '57224, 57221',
        'department' => '-',
        'email' => 'ericayang@ncu.edu.tw',
        'responsibilities' => [
            '校內各項獎助學金收文、公告、申請受理、彙辦、審查、核發。',
            '校外各項獎助學金收文、公告、申請受理、彙辦、審查、回函、核發。',
            '朱順一合勤獎學金公告、申請受理、彙整、彙辦、核發、辦理頒獎典禮及新聞稿撰寫。',
            '蔡力行先生獎學金公告、申請受理、彙整、彙辦、核發、辦理頒獎典禮及新聞稿撰寫。',
            '每學期書卷獎審查、核發。',
            '校內各項獎助學金獎狀製作、得獎證明開立。',
            '每學年中大獎學金募款成果報告撰寫。'
        ]
    ],
    [
        'name' => '邱琳格',
        'title' => '組員',
        'photo' => 'images/Members/邱琳格.png',
        'extension' => '57223, 57221',
        'department' => '-',
        'email' => 'ringochiu@ncu.edu.tw',
        'responsibilities' => [
            '全校工讀助學金預算分配及法規制訂修改。',
            '全校勞僱型工讀生雇用審核及系統管理維護。',
            '安心就學支持計畫-安心學習助學金法規研議、申請受理、審查、彙辦、核發，並協助規劃發放條件及輔導機制。',
            '全校學生急難救助金申請受理、審查、核發。',
            '教育部學產基金急難慰問金申請受理、報送、核發。',
            // '每學期辦理各項獎助學金頒獎典禮。',
            '生輔組個人資料保護窗口。',
            '學務處資安執行小組窗口。',
            '全校研究生獎助學金預算分配及法規制訂修改。',
            '生輔組各項經費控管及學生公費編列。',
            '生輔組綜合業務(含各項數據統計及執行成果撰寫、組務會議召開與記錄)。',
        ]
    ],
    [
        'name' => '林昕諭',
        'title' => '行政專員',
        'photo' => 'images/Members/林昕諭.jpg',
        'extension' => '57222, 57221',
        'department' => '-',
        'email' => 'hsinyu@ncu.edu.tw',
        'responsibilities' => [
            '全校學生就學貸款公告、申請受理、彙辦、報送。',
            '全校學生學雜費減免申請受理、彙辦、報送。',
            '卹內軍公教遺族公費申請受理、彙辦、報送。',
            '全校學生獎懲案申請受理、審查、銷過及系統管理維護。',
            '全校學生操行成績評定、報送及系統管理維護。',
            '總統教育獎申請受理、彙辦、報送。',
            '教育部學產基金低收入戶助學金受理申請、彙辦、報送。',
            '公文登記桌。',
            '生輔組行政及活動工讀生招募、訓練、管理、僱用。',
        ]
    ]
    // 更多成員資料待添加...
];


?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>成員介紹</title>
    <link rel="stylesheet" href="styles.css"> <!-- 假設所有的 CSS 都在一個文件中 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include "navbar.php"; ?>
<div class="container" style="font-size: 16px;">
    <?php include "header.php"; ?>
    <h2>成員介紹</h2>
    <?php foreach ($members as $member): ?>
    <div style="border: 2px solid #ccc; margin-bottom: 20px; padding: 10px; display: flex; background-color: white; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <div style="flex: 4; border-right: 1px solid #ddd; padding-right: 10px; margin-right: 10px;">
            <p><strong>姓名:</strong> <?php echo $member['name']; ?></p>
            <hr style="border-color: #ddd;">
            <p><strong>職稱:</strong> <?php echo $member['title']; ?></p>
            <hr style="border-color: #ddd;">
            <p><strong>分機號碼:</strong> <?php echo $member['extension']; ?></p>
            <hr style="border-color: #ddd;">
            <p><strong>輔導系所:</strong> <?php echo $member['department']; ?></p>
            <hr style="border-color: #ddd;">
            <p><strong>公務信箱:</strong> <a href="mailto:<?php echo $member['email']; ?>"><?php echo $member['email']; ?></a></p>
        </div>
        <div style="flex: 6; padding-left: 10px;">
            <p><strong>業務職掌:</strong></p>
            <ol>
                <?php foreach ($member['responsibilities'] as $item): ?>
                <li><?php echo $item; ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
    <?php endforeach; ?>
</div>


    <br><br><br><br>
    <?php include "footer.php"; ?>
</body>
</html>


</body>

</html>
