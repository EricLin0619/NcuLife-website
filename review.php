<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>活動回顧</title>
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
            <h2>活動回顧</h2>
            <div class="table-responsive-md" style="margin: 15px;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">學期</th>
                            <th class="text-center">時間</th>
                            <th class="text-center">連結</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--tr>
                            <td class="text-center">108上</td>
                            <td class="text-center">108.12.24</td>
                            <td class="text-center">獎學金頒獎典禮</td>
                            <td class="text-center">
                                <a href="./images/review/simpleviewer/1081224獎學金頒獎典禮照片A/index.html">A</a>
                                <a href="./images/review/simpleviewer/1081224獎學金頒獎典禮照片B/index.html">B</a>
                                <a href="./images/review/simpleviewer/1081224獎學金頒獎典禮照片C/index.html">C</a>
                            </td>
                        </tr-->
                        <tr>
                            <td class="text-center">110上</td>
                            <td class="text-center">110.12.21</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/R3h4kqcFMiEM6ZDU6">110上各項獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">110上</td>
                            <td class="text-center">110.12.21</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/rGwejUaRcc7Jhvsi7">110學年度朱順一合勤獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">109上</td>
                            <td class="text-center">109.12.15</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/zhZRJdg6Du2W5LD57">109上各項獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">109上</td>
                            <td class="text-center">109.10.13</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/hoCfGZtgY428PzJD8">109學年度朱順一合勤獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">108下</td>
                            <td class="text-center">109.07.01</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/zmWBoSWqHe5crsSj6">108學年度蔡力行先生獎學金頒獎典禮</a>    
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">108下</td>
                            <td class="text-center">109.05.26</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/zk8Uo1fMvLzrBD869">各項獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">108上</td>
                            <td class="text-center">108.12.24</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/xfeuGkJF7bjDzrhX7">各項獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">107下</td>
                            <td class="text-center">108.06.14</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/R36MgB56hJj2z8M26">107學年度蔡力行先生獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">107下</td>
                            <td class="text-center">108.05.28</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/6nn5oupKST5H46Ub7">各項獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">107上</td>
                            <td class="text-center">107.12.25</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/bvGTTtjJCXfNPGuu5">各項獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">107上</td>
                            <td class="text-center">107.11.27</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/jpf1qX7aTiPp2CAr7">107學年度朱順一合勤獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">106下</td>
                            <td class="text-center">107.07.24</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/RVhJWNv8LmcNujdU9">106學年度蔡力行先生獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">106下</td>
                            <td class="text-center">107.05.29</td>
                            <td class="text-center">
                                 <a href="https://photos.app.goo.gl/8b3Qfv25DDjQ5xiL7">各項獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">106上</td>
                            <td class="text-center">106.12.24</td>
                            <td class="text-center"><a href="https://photos.app.goo.gl/U8RUv9kwVqvUDLaE6">各項獎學金頒獎典禮</a></td>
                        </tr>
                        <tr>
                            <td class="text-center">105下</td>
                            <td class="text-center">106.06.06</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/3rozwExdVb5619837">各項獎學金頒獎典禮</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">105上</td>
                            <td class="text-center">105.12.20</td>
                            <td class="text-center">
                                <a href="https://photos.app.goo.gl/y4mWA52DwEgkYMDq9">各項獎學金頒獎典禮</a>
                            </td>             
                            <!--<a href="./images/review/simpleviewer/20161220-3/index.html">C</a>--> 
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