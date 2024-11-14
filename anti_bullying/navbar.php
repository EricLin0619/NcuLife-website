<style>  
    .logo{
      max-width: 50%;
    }
    .top-container {
      background-color: #23a8bd;
      color: white;
      padding: 5px;
      text-align: center;
    }
    .navbar-nav{
      color: rgb(255, 255, 255);
    }
    .dropdown:hover>.dropdown-menu {
      display: block;
    }
    
</style>
<head>
  <title>國立中央大學防制霸凌專區</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .bg-green {
      background-color: #07889B;
      color: white;
    }
    .top-container {
      background-color: #23a8bd;
      color: white;
      padding: 5px;
      text-align: center;
    }
    .navbar-item {
    color: rgb(255, 255, 255);
}
  </style>
</head>
<!-- navbar -->
<header>

    <div class="bg-green top-container" >
        <a href="./index.php"><img  class="logo" src="./static/logo_v4.png"></img></a>
    </div>
    <nav class="navbar navbar-expand-md bg-green navbar-dark ">
    <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">功能清單</a> -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="collapsibleNavbar">
        <ul class="navbar-nav mx-auto"  >
            <li class="nav-item dropdown">
                <a class="nav-link dropdown" href="#" id="navbardrop" data-toggle="dropdown">法令規章</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="https://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=H0020081">教育部校園霸凌防制準則</a>
                    <a class="dropdown-item" href="show_pdf.php?pdf_file=校園霸凌防制準則QA">教育部校園霸凌防制準則QA</a>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="show_pdf.php?pdf_file=有關學生為霸凌行為之法律責任" id="navbardrop" >霸凌行為法律責任</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="show_pdf.php?pdf_file=國立中央大學防制校園霸凌實施計畫" id="navbardrop" > 防制校園霸凌實施計畫</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown" href="show_pdf.php?pdf_file=" id="navbardrop" data-toggle="dropdown">校園霸凌之申請調查程序</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="show_pdf.php?pdf_file=校園霸凌之申請調查程序">申請程序</a>
                    <a class="dropdown-item" href="show_pdf.php?pdf_file=霸凌事件申請書">調查申請書</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="show_pdf.php?pdf_file=反霸凌流程圖" id="navbardrop"  >校園霸凌事件處理流程圖</a>
            </li>  
        </ul>
        </div>

        </div>
    </nav>

 
</header>