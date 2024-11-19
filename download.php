<?php
require_once('conn_military.php');
require_once('const_variable.php');

if (!isset($_GET['file']) || empty($_GET['file'])) {
    header('Location: index.php');
    exit;
}

$file_path = $_GET['file'];
$file_name = isset($_GET['name']) ? $_GET['name'] : basename($file_path);

// 安全檢查：確保檔案在允許的目錄中
if (!strstr($file_path, 'post_attachment/')) {
    header('Location: index.php');
    exit;
}

$full_path = __DIR__ . '/' . $file_path;

if (file_exists($full_path)) {
    // 設定適當的 Content-Type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $full_path);
    finfo_close($finfo);

    // 如果是可以直接顯示的檔案類型（如 PDF），顯示在網頁中
    if (in_array($mime_type, ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'])) {
        ?>
        <!DOCTYPE html>
        <html lang="zh-TW">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($file_name); ?> - 檔案檢視</title>
        </head>
        <body>
            <?php if (strpos($mime_type, 'image/') === 0): ?>
                <img src="<?php echo htmlspecialchars($file_path); ?>" 
                     alt="<?php echo htmlspecialchars($file_name); ?>"
                     style="max-width: 100%; height: auto;">
            <?php else: ?>
                <iframe src="<?php echo htmlspecialchars($file_path); ?>"
                        style="width: 100%; height: 100vh; border: none;"
                        title="<?php echo htmlspecialchars($file_name); ?>">
                </iframe>
            <?php endif; ?>
        </body>
        </html>
        <?php
    } else {
        // 其他類型的檔案則觸發下載
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Content-Length: ' . filesize($full_path));
        readfile($full_path);
    }
    exit;
} 