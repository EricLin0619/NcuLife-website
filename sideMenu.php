<style>
    .toggle_menu {
        position: fixed;
        top: 254px;
        z-index: 2;
    }

    .sideMenu {
        width: 180px;
        height: 100%;
        background-color: #EEAA7B;
        border-right: 3px solid #d1d1d1;
        display: flex;
        flex-direction: column;
        padding: 15px 0;
        box-shadow: 5px 0 5px rgba(23, 23, 54, .6);
        position: relative;
        transform: translateX(-100%);
        transition: 0.5s;
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    .sideMenu form {
        display: flex;
        margin: 0 10px 50px;
        border-radius: 100px;
        border: 1px solid #fff;
    }

    .sideMenu form input {
        width: 230px;
    }

    .sideMenu form button {
        width: 50px;
    }

    .sideMenu form input,
    .sideMenu form button {
        border: none;
        padding: 5px 10px;
        background-color: transparent;
        color: #fff;
    }

    .sideMenu form input:focus,
    .sideMenu form button:focus {
        outline: none;
    }

    .sideMenu label {
        position: absolute;
        width: 20px;
        height: 80px;
        background-color: #d1d1d1;
        color: #686666;
        right: -20px;
        top: 0;
        bottom: 0;
        margin: auto;
        line-height: 80px;
        text-align: center;
        border-radius: 0 5px 5px 0;
        box-shadow: 5px 0 5px rgba(23, 23, 54, .6);
    }

    #sideMenu--active:checked+.sideMenu {
        transform: translateX(0);
    }

    #sideMenu--active:checked+.sideMenu label .fas {
        transform: scaleX(-1);
    }

    #sideMenu--active {
        position: absolute;
        opacity: 0;
        z-index: -1;
    }

    /* 為螢幕閱讀器添加的輔助類別 */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0,0,0,0);
        border: 0;
    }
</style>
<div class="toggle_menu">
    <input type="checkbox" name="sideMenu" id="sideMenu--active" title="開關側邊選單">
    <div class="sideMenu">
        <h4 style="margin: 15px;"><span class="fa fa-link"> 快速連結</span></h4>
        <ul class="nav flex-column bg-orange2 nav-light" style="border-radius: 15px;">
            <li class="nav-item">
                <a class="nav-link" href="http://cis.ncu.edu.tw/iNCU/academic/register/checkStudentState" title="查詢兵役緩徵狀態">兵役緩徵查詢</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Q&A.php" title="查看常見問題與解答">常見Q&A</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://cis.ncu.edu.tw/Scholarship" title="前往獎助學金管理系統">獎助學金管理系統</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://portal.ncu.edu.tw/system/42" title="前往就學補助系統">就學補助系統</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="review.php" title="查看活動回顧">活動回顧</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="images/map.png" title="查看校園安全地圖">校園安全地圖</a>
            </li>
        </ul>
        <label for="sideMenu--active" title="點擊展開或收合側邊選單">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">開關側邊選單</span>
        </label>
    </div>
</div>