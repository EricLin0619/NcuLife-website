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

        .flexslider .slides img {
            max-height: 60%;
            /*maximum height for all slides*/
            width: auto;
            /*proper aspect ratio of images*/
            max-width: 100%;
            /*maximum width for all slides*/
            margin: 0 auto;
            /*centering images in the container*/
        }

    </style>
    <!– jQuery.flexslider css –>
        <link href="https://cdn.bootcss.com/flexslider/2.6.3/flexslider.min.css" rel="stylesheet">
        <!– jQuery.flexslider js –>
            <script src="https://cdn.bootcss.com/jquery/2.2.2/jquery.min.js"></script>
            <script src="https://cdn.bootcss.com/flexslider/2.6.3/jquery.flexslider-min.js"></script>
            <script type="text/javascript">
                $(function() {
                    $(".flexslider").flexslider({
                        animation: "slide",
                    });
                });
            </script>
</head>

<body>
    <div id="container">
        <h1>112年10月:112學年賃居建物消防設備申報安檢</h1>
        <div class="demo">
            <div id="slider" class="flexslider">
                <ul class="slides">
                    <?php
                    if ($handle = opendir('./42/')) {

                        while (false !== ($entry = readdir($handle))) {

                            if ($entry != "." && $entry != "..") {

                                echo "<li><img src='./42/$entry' alt=''></li>";
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