<nav class="navbar navbar-expand-lg navbar-light bg-green">
    <a class="navbar-brand hidden-xs hidden-sm" href="https://www.ncu.edu.tw/" title="國立中央大學首頁">
        <img src="images/homepage/ncu.png" alt="國立中央大學校徽" style="width:15%;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li><a href="#U" title="右上方功能區塊" id="AU" accesskey="U" name="U">:::</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php" title="回到首頁">回頁首</a></li>
                <li class="nav-item"><a class="nav-link" href="https://www.ncu.edu.tw/" title="前往中央大學首頁">中大首頁</a></li>
                <li class="nav-item"><a class="nav-link" href="http://osa.ncu.edu.tw/index.php" title="前往學生事務處網站">學生事務處</a></li>
                <?php if(isset($_SESSION['military_Username'])){ ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php" title="登出管理系統"><span class="fa fa-sign-in" aria-hidden="true"> 管理者登出</span></a></li>
                <?php } else{ ?>
                    <li class="nav-item"><a class="nav-link" href="login.php" title="登入管理系統"><span class="fa fa-sign-out" aria-hidden="true"> 管理者登入</span></a></li>
                <?php } ?>
            </ul>
        </form>
    </div>
</nav>
<style>
    #AU {
        margin-right: 4px;
        border-radius: 6px;
    }
    #AU:focus{
        background-color: #e37222
    }
</style>