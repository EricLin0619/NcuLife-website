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
            <!-- 引入 Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body {
                    background-color: #f8f9fa;
                    padding: 20px;
                }
                
                .content-wrapper {
                    background: white;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    padding: 20px;
                    margin-top: 20px;
                }

                .page-title {
                    color: #2c3e50;
                    margin-bottom: 1.5rem;
                    padding-bottom: 1rem;
                    border-bottom: 2px solid #e9ecef;
                }

                figure {
                    margin: 0;
                    text-align: center;
                }

                figcaption {
                    margin-top: 10px;
                    color: #6c757d;
                    font-style: italic;
                }

                img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 4px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }

                .document-viewer {
                    background: #f8f9fa;
                    padding: 20px;
                    border-radius: 4px;
                }

                .document-viewer h2 {
                    color: #495057;
                    font-size: 1.5rem;
                    margin-bottom: 1rem;
                }

                iframe {
                    border-radius: 4px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    background: white;
                }

                .back-button {
                    margin-bottom: 1rem;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <main>
                    <h1 class="page-title">檔案檢視：<?php echo htmlspecialchars($file_name); ?></h1>
                    
                    <div class="content-wrapper">
                        <?php if (strpos($mime_type, 'image/') === 0): ?>
                            <figure>
                                <img src="<?php echo htmlspecialchars($file_path); ?>" 
                                     alt="<?php echo htmlspecialchars($file_name); ?>">
                                <figcaption><?php echo htmlspecialchars($file_name); ?></figcaption>
                            </figure>
                        <?php else: ?>
                            <section class="document-viewer">
                                <h2>文件內容</h2>
                                <iframe src="<?php echo htmlspecialchars($file_path); ?>"
                                        style="width: 100%; height: 80vh;"
                                        title="<?php echo htmlspecialchars($file_name); ?>">
                                </iframe>
                            </section>
                        <?php endif; ?>
                    </div>
                </main>
            </div>

            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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