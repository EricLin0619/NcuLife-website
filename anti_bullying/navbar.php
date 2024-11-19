<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <title>國立中央大學防制霸凌專區</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- 外部資源 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <style>  
        .logo { max-width: 50%; }
        .top-container {
            background-color: #23a8bd;
            color: white;
            padding: 5px;
            text-align: center;
        }
        .navbar-nav { color: rgb(255, 255, 255); }
        .dropdown:hover>.dropdown-menu { display: block; }
        .bg-green {
            background-color: #07889B;
            color: white;
        }
        .navbar-item { color: rgb(255, 255, 255); }
    </style>
</head>

<body>
    <header>
        <!-- 主標題區域 -->
        <div class="bg-green top-container">
            <h1>
                <a href="./index.php" title="回到首頁">
                    <img class="logo" 
                         src="./static/logo_v4.png" 
                         alt="國立中央大學防制霸凌專區標誌">
                </a>
            </h1>
        </div>

        <!-- 導航區域 -->
        <nav class="navbar navbar-expand-md bg-green navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" 
                        type="button" 
                        data-toggle="collapse" 
                        data-target="#collapsibleNavbar"
                        aria-label="導航選單"
                        aria-expanded="false"
                        aria-controls="collapsibleNavbar"
                        title="展開導航選單">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item dropdown">
                            <h2 class="nav-link dropdown" id="navbardrop" data-toggle="dropdown" title="查看法令規章相關內容">
                                <a href="#" title="查看法令規章相關內容" style="color: white;">法令規章</a>
                            </h2>
                            <div class="dropdown-menu">
                                <h3><a class="dropdown-item" href="https://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=H0020081" 
                                   title="查看教育部校園霸凌防制準則">教育部校園霸凌防制準則</a></h3>
                                <h3><a class="dropdown-item" href="show_pdf.php?pdf_file=校園霸凌防制準則QA" 
                                   title="查看教育部校園霸凌防制準則QA">教育部校園霸凌防制準則QA</a></h3>
                            </div>
                        </li>
                        <li class="nav-item">
                            <h2><a class="nav-link" href="show_pdf.php?pdf_file=有關學生為霸凌行為之法律責任" 
                               title="了解霸凌行為的法律責任" style="color: white;">霸凌行為法律責任</a></h2>
                        </li>
                        <li class="nav-item">
                            <h2><a class="nav-link" href="show_pdf.php?pdf_file=國立中央大學防制校園霸凌實施計畫" 
                               title="查看防制校園霸凌實施計畫" style="color: white;">防制校園霸凌實施計畫</a></h2>
                        </li>
                        <li class="nav-item dropdown">
                            <h2 class="nav-link dropdown" id="navbardrop" data-toggle="dropdown" 
                               title="了解校園霸凌申請調查程序" style="color: white;">
                                <a href="#" title="了解校園霸凌申請調查程序" style="color: white;">校園霸凌之申請調查程序</a>
                            </h2>
                            <div class="dropdown-menu">
                                <h3><a class="dropdown-item" href="show_pdf.php?pdf_file=校園霸凌之申請調查程序" 
                                   title="查看申請程序詳細說明">申請程序</a></h3>
                                <h3><a class="dropdown-item" href="show_pdf.php?pdf_file=霸凌事件申請書" 
                                   title="下載霸凌事件調查申請書">調查申請書</a></h3>
                            </div>
                        </li>
                        <li class="nav-item">
                            <h2><a class="nav-link" href="show_pdf.php?pdf_file=反霸凌流程圖" 
                               title="查看校園霸凌事件處理流程圖" style="color: white;">校園霸凌事件處理流程圖</a></h2>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>