<?php

// 檢查是否啟用了魔法引號轉義（magic quotes）
if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
    echo "Magic quotes 已經啟用";
} else {
    echo "Magic quotes 未啟用";
}

?>
