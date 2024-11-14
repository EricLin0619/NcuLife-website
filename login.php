<?php require_once('conn_military.php'); ?>
<?php
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) { session_start(); }
?>
<?php
// *** Validate request to login to this site.

if(isset($_SESSION['military_Username'])){
    echo "<script language=\"javascript\"> document.location.href=\"index.php\";</script>";
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
function mysqli_result($LoginRS, $row,  $field=0) { 
    $LoginRS->data_seek($row); 
    $datarow = $LoginRS->fetch_array(); 
    return $datarow[$field]; 
} 
if (isset($_POST['username'])) {
    $loginUsername=$_POST['username'];
    $password=$_POST['password'];
    $MM_fldUserAuthorization = "authority";
    $MM_redirectLoginSuccess = "index.php";
    $MM_redirectLoginFailed = "login.php?error";
    $MM_redirecttoReferrer = false;
    mysqli_select_db($conn_military,$database_conn_military);

    // 使用參數化查詢防範 SQL 注入
    $sql_login = "SELECT user, password FROM `CSRC_user` WHERE `department`='生輔組' AND `user`= ? AND password=password(?)";
    $stmt = $conn_military->prepare($sql_login);
    $stmt->bind_param("ss", $loginUsername, $password);
    $stmt->execute();
    $LoginRS = $stmt->get_result();
    $loginFoundUser = mysqli_num_rows($LoginRS);

    if ($loginFoundUser) {
        $loginStrGroup  = mysqli_result($LoginRS,'authority');

        // declare two session variables and assign them
        $_SESSION['military_Username'] = $loginUsername;      

        // update ip address and datetime when login
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql_update = "UPDATE `CSRC_user` SET `ip`='$ip' WHERE `user`= ?";
        $stmt = $conn_military->prepare($sql_update);
        $stmt->bind_param("s", $loginUsername);
        $stmt->execute(); 

        if (isset($_SESSION['PrevUrl']) && false) {
            $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];    
        }
        header("Location: " . $MM_redirectLoginSuccess );
    } else {
        header("Location: ". $MM_redirectLoginFailed );
    }
}
?>


<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理者登入</title>
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

    <script LANGUAGE="javascript">
        function show(a) {
            var IsIE = false;
            var sAgent = navigator.userAgent.toLowerCase(); //判斷是否用IE瀏覽
            if (sAgent.indexOf("msie") != -1) {
                IsIE = true;
            } //IE6.0-7

            if (a == "Y") {
                if (IsIE) {
                    document.getElementById('day_show').style.display = 'inline';
                } else {
                    document.getElementById('day_show').style.display = 'table-row';
                }
            } else {
                document.getElementById('day_show').style.display = 'none';
            }
        }

    </script>
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

</style>

<body>
    <div class="container">
        <main id="content">
            <h1>管理者登入</h1>
            
            <form id="form1" name="form1" method="post" action="<?php echo $loginFormAction; ?>">
                <?php if (isset($_GET['error']))  { ?>
                    <div class="alert alert-danger" role="alert">
                        <h2 class="smalltitle">帳密錯誤! 請重新輸入!</h2>
                    </div>
                <?php } ?>
                
                <div class="form-group">
                    <h2><label for="username">帳號</label></h2>
                    <input type="text" name="username" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <h2><label for="password">密碼</label></h2>
                    <input type="password" name="password" class="form-control" id="password">
                    <button type="submit" name="Submit" class="btn btn-dark">登入</button>
                </div>
            </form>
        </main>
    </div>
    <!--container-->

    <?php include "footer.php"?>
</body>

</html>
