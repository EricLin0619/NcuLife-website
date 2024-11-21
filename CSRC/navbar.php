<div id="header">
    <div class="headerBackground">&nbsp;</div>
    <div id="navcontainer">
        <ul id="navlist">
            <?php
            function isActive($scripts) {
                $currentScript = $_SERVER['SCRIPT_NAME'];
                return in_array($currentScript, $scripts) ? 'id="current"' : '';
            }

            $navItems = [
                '首頁' => ['https://military.ncu.edu.tw/index.php'],
                '校安中心' => ['/CSRC/SecurityCenter.php'],
                '活動集錦' => ['/CSRC/activity.php'],
                '緊急災害' => ['/CSRC/floorPlanIndex.php', '/CSRC/floorPlanLogin.php', '/CSRC/floorMap.php'],
                '校安管理系統' => [
                    '/CSRC/login.php', '/CSRC/index.php', '/CSRC/add.php', '/CSRC/list.php', 
                    '/CSRC/search.php', '/CSRC/statistics_new.php', '/CSRC/statistics.php', 
                    '/CSRC/statistics_plot.php', '/CSRC/worksheet.php', '/CSRC/worksheet_add.php', 
                    '/CSRC/worksheet_list.php', '/CSRC/worksheet_search.php', '/CSRC/member.php'
                ]
            ];

            foreach ($navItems as $name => $scripts) {
                $activeClass = isActive($scripts);
                $url = $scripts[0]; // Assumes the first item in array is the URL for the navbar
                echo "<li><a href='$url' $activeClass>$name</a></li>";
            }
            ?>
        </ul>
    </div>
</div>
