<!DOCTYPE HTML>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="图片轮播，图片切换，焦点图" />
    <meta name="description" content="这是一个基于jquery的图片轮播效果演示页" />
    <title>國立中央大學外宿資訊網 活動花絮</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <link rel="stylesheet" type="text/css" href="flexslider.css" />
    <style type="text/css">
        h1 {
            font-weight: bold;
            font-size: 50px;
            font-family: "微軟正黑體";
            text-align: center
        }

        h3 {
            height: 42px;
            line-height: 42px;
            font-size: 16px;
            font-weight: normal;
            text-align: center
        }

        h3 a {
            margin: 10px
        }

        h3 a.cur {
            color: #f30
        }

        .demo {
            width: 800px;
            margin: 20px auto
        }
    </style>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
    <script type="text/javascript" src="jquery.flexslider-min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 210,
                itemMargin: 5,
                asNavFor: '#slider'
            });

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel"
            });
        });
    </script>
</head>

<body>
    <div id="container">
        <h1>111年11月3日：本校獲選為111年度學生賃居服務工作優等學校</h1>
        <div class="demo">
            <div id="slider" class="flexslider">
                <ul class="slides">
                    <?php
                    if ($handle = opendir('./32/')) {

                        while (false !== ($entry = readdir($handle))) {

                            if ($entry != "." && $entry != "..") {

                                echo "<li><img src='./32/$entry' alt=''></li>";
                            }
                        }

                        closedir($handle);
                    }
                    ?>
                </ul>
            </div>

        </div>

    </div>

    <!--BY Jeff Lin -->


</body>

</html>