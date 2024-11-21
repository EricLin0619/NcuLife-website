<?php require_once('conn_military.php'); ?>
<?php require_once('const_variable.php'); ?>
<?php
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) { session_start(); }
?>
<?php
    $colname_military_bulletin = "-1";
    if (isset($_GET['no'])) {
          $colname_military_bulletin = (get_magic_quotes_gpc()) ? $_GET['no'] : addslashes($_GET['no']);
    }
    mysqli_select_db($conn_military,$database_conn_military);
    $query_military_bulletin = sprintf("SELECT * FROM military_bulletin WHERE no = '%s'", $colname_military_bulletin);
    $military_bulletin = mysqli_query($conn_military,$query_military_bulletin) or die(mysqli_connect_error());
    $row_military_bulletin = mysqli_fetch_assoc($military_bulletin);
    $totalRows_military_bulletin = mysqli_num_rows($military_bulletin);
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>公告詳情</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/homepage/logos.png" alt="Logo">
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
    <?php include "navbar.php"?>
    <div class="container">
        <?php include "header.php"?>
        <div id="content">
            <h2 class="title text-center"><strong>最新公告詳情</strong></h2>
            <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
                <table width="100%" class="table table-hover">
                    <?php if (isset($_SESSION['military_Username'])) {?>
                    <tr valign="baseline">
                        <td class="col-md-2">
                            <div><strong><span><p>發佈者：</p></span></strong></div>
                        </td>
                        <td>
                            <div><span><p><?php echo $row_military_bulletin['poster']; ?></p></span></div>
                        </td>
                    </tr>
                    <?php }?>
                    <tr>
                        <td class="col-md-2">
                            <div><strong><span><p>公告日期：</p></span></strong></div>
                        </td>
                        <td class="col-md-10">
                            <div><p><?php echo substr($row_military_bulletin['time'],0,10);?></p></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-2">
                            <div><strong><span><p>公告類別：</p></span></strong></div>
                        </td>
                        <td class="col-md-10">
                            <div><p><?php echo $row_military_bulletin['class']; ?></p></div>
                        </td>
                    </tr>
                    <?php if ($row_military_bulletin['class2'] =='Y'){ ?>
                    <tr id="day_show">
                        <td class="col-md-2">
                            <div><strong><span><p>公告相關日期：</p></span></strong></div>
                        </td>
                        <?php
                                        $week_get = explode('-',$row_military_bulletin['day']);
                                        $week = date("w",mktime(0,0,0,$week_get[1],$week_get[2],$week_get[0]));
                                        $week_get2 = explode('-',$row_military_bulletin['day2']);
                                        $week2 = date("w",mktime(0,0,0,$week_get2[1],$week_get2[2],$week_get2[0]));
                                      ?>
                        <td class="col-md-10">
                            <div><p>
                                <?php if($row_military_bulletin['day_count']==$row_military_bulletin['day_count2']){echo $row_military_bulletin['day'];?>
                                <?php
                                                switch($week)
                                                {
                                                  case 1:	echo '(一)'; break;
                                                  case 2:	echo '(二)'; break;
                                                  case 3:	echo '(三)'; break;
                                                  case 4:	echo '(四)'; break;
                                                  case 5:	echo '(五)'; break;
                                                  case 6:	echo '(六)'; break;
                                                  default:  echo '(日)';
                                                };
                                            ?>
                                <?php }else{echo $row_military_bulletin['day'];?>
                                <?php
                                                switch($week)
                                                {
                                                  case 1:	echo '(一)'; break;
                                                  case 2:	echo '(二)'; break;
                                                  case 3:	echo '(三)'; break;
                                                  case 4:	echo '(四)'; break;
                                                  case 5:	echo '(五)'; break;
                                                  case 6:	echo '(六)'; break;
                                                  default:  echo '(日)';
                                                };
                                            ?>
                                <?php echo ' ~ '.$row_military_bulletin['day2'];?>
                                <?php
                                                switch($week2)
                                                {
                                                  case 1:	echo '(一)'; break;
                                                  case 2:	echo '(二)'; break;
                                                  case 3:	echo '(三)'; break;
                                                  case 4:	echo '(四)'; break;
                                                  case 5:	echo '(五)'; break;
                                                  case 6:	echo '(六)'; break;
                                                  default:  echo '(日)';
                                                };
                                            ?>
                                <?php } ?>
                            </p></div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td class="col-md-2">
                            <div><strong><span><p>公告標題：</p></span></strong></div>
                        </td>
                        <td class="col-md-10">
                            <div><p><?php echo $row_military_bulletin['title']; ?></p></div>
                        </td>
                    </tr>
                    <?php
                                    for( $i=1, $j=1; $i <= Max_File_Num; $i++ ){ 
                                        if($row_military_bulletin['attachment' . $i] == '') continue;
                                ?>
                    <?php
                        $file_path = $row_military_bulletin['attachment' . $i];
                        $file_name = $row_military_bulletin['attachment' . $i . '_name'];
                        if (!$file_name) {
                            $file_name = basename($file_path);
                        }
                        
                        // 取得檔案副檔名
                        $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                        
                        // 定義可預覽的檔案類型
                        $preview_extensions = ['pdf', 'jpg', 'jpeg', 'png'];
                    ?>
                    <tr>
                        <td class="col-md-2">
                            <div><strong><span><p>附加檔案<?php echo $j;?>：</p></span></strong></div>
                        </td>
                        <td class="col-md-10">
                            <label><p>
                                <?php 
                                // 檢查副檔名是否在可預覽清單中
                                if (!in_array(strtolower($extension), $preview_extensions)): ?>
                                    <!-- 直接下載的檔案 -->
                                    <a href="<?php echo htmlspecialchars($file_path); ?>" 
                                       download="<?php echo htmlspecialchars($file_name); ?>"
                                       title="下載附件：<?php echo htmlspecialchars($file_name); ?>">
                                        <?php echo htmlspecialchars($file_name); ?>
                                    </a>
                                <?php else: ?>
                                    <!-- 使用 download.php 預覽的檔案 -->
                                    <a href="download.php?file=<?php echo urlencode($file_path); ?>&name=<?php echo urlencode($file_name); ?>" 
                                       target="_blank" 
                                       title="下載附件：<?php echo htmlspecialchars($file_name); ?>">
                                        <?php echo htmlspecialchars($file_name); ?>
                                    </a>
                                <?php endif; ?>
                            </p></label>
                        </td>
                    </tr>
                    <?php 
                                        $j++;
                                    } 
                                ?>
                    <tr>
                        <td class="col-md-2">
                            <div><strong><span><p>公告內容：</p></span></strong></div>
                        </td>
                        <td class="col-md-10">
                            <div>
                            <?php 
                                $content = $row_military_bulletin['content'];
                                
                                // 處理圖片連結
                                if (strpos($content, '<img') !== false) {
                                    $content = preg_replace_callback(
                                        '/<a[^>]*>[\s]*<img[^>]*>[\s]*<\/a>/',
                                        function($matches) use ($row_military_bulletin) {
                                            $link = $matches[0];
                                            
                                            // 從連結中提取圖片檔名
                                            preg_match('/[^\/\\\\]+\.(jpg|jpeg|png|gif)/', $link, $filename);
                                            $imgName = isset($filename[0]) ? $filename[0] : '';
                                            
                                            // 建立圖片和連結描述
                                            $imgDesc = $row_military_bulletin['title'] . ' 附圖';
                                            $linkDesc = '查看' . $row_military_bulletin['title'] . '的完整圖片';
                                            if ($imgName) {
                                                $imgDesc .= ' - ' . $imgName;
                                                $linkDesc .= '：' . $imgName;
                                            }
                                            
                                            // 處理 alt 和 title 屬性
                                            if (strpos($link, 'alt=') !== false) {
                                                $link = preg_replace('/alt="[^"]*"/', 'alt="' . htmlspecialchars($imgDesc) . '"', $link);
                                            } else {
                                                $link = str_replace('<img', '<img alt="' . htmlspecialchars($imgDesc) . '"', $link);
                                            }
                                            
                                            if (strpos($link, 'title=') !== false) {
                                                $link = preg_replace('/title="[^"]*"/', 'title="' . htmlspecialchars($linkDesc) . '"', $link);
                                            } else {
                                                $link = str_replace('<a', '<a title="' . htmlspecialchars($linkDesc) . '"', $link);
                                            }
                                            
                                            return $link;
                                        },
                                        $content
                                    );
                                }
                                
                                // 處理一般連結
                                  
        if (strpos($content, '<a') !== false) {
            $content = preg_replace_callback(
                '/<a[^>]*>(.*?)<\/a>/s',
                function($matches) use ($row_military_bulletin) {
                    $fullMatch = $matches[0];
                    $innerContent = $matches[1];
                    
                    // 檢查是否只包含圖片和空白
                    $textContent = strip_tags($innerContent);
                    $hasOnlyImages = (trim($textContent) === '' && strpos($innerContent, '<img') !== false);
                    
                    if ($hasOnlyImages) {
                        // 在圖片後添加一個點號，並設置為透明
                        $link = str_replace('</a>', '<span style="opacity: 0;">.</span></a>', $fullMatch);
                        
                        // 從連結中提取圖片檔名
                        preg_match('/[^\/\\\\]+\.(jpg|jpeg|png|gif)/', $link, $filename);
                        $imgName = isset($filename[0]) ? $filename[0] : '';
                        
                        // 建立連結描述
                        $linkDesc = '查看' . $row_military_bulletin['title'] . '的完整圖片';
                        if ($imgName) {
                            $linkDesc .= '：' . $imgName;
                        }
                        
                        // 確保有 title 屬性
                        if (strpos($link, 'title=') !== false) {
                            $link = preg_replace('/title="[^"]*"/', 'title="' . htmlspecialchars($linkDesc) . '"', $link);
                        } else {
                            $link = str_replace('<a', '<a title="' . htmlspecialchars($linkDesc) . '"', $link);
                        }
                        
                        // 處理所有圖片的 alt 屬性
                        $link = preg_replace_callback(
                            '/<img[^>]*>/',
                            function($imgMatches) use ($row_military_bulletin, $imgName) {
                                $img = $imgMatches[0];
                                $imgDesc = $row_military_bulletin['title'] . ' 附圖';
                                if ($imgName) {
                                    $imgDesc .= ' - ' . $imgName;
                                }
                                
                                if (strpos($img, 'alt=') !== false) {
                                    return preg_replace('/alt="[^"]*"/', 'alt="' . htmlspecialchars($imgDesc) . '"', $img);
                                } else {
                                    return str_replace('<img', '<img alt="' . htmlspecialchars($imgDesc) . '"', $img);
                                }
                            },
                            $link
                        );
                        
                        return $link;
                    }
                    
                    return $fullMatch;
                },
                $content
            );
        }
                                
                                // 處理框架元素
                                if (strpos($content, '<iframe') !== false) {
                                    $content = preg_replace_callback(
                                        '/<iframe[^>]*>.*?<\/iframe>/',
                                        function($matches) use ($row_military_bulletin) {
                                            $frame = $matches[0];
                                            
                                            // 確保有 title 屬性
                                            if (strpos($frame, 'title=') === false) {
                                                $frame = str_replace('<iframe', 
                                                    '<iframe title="' . htmlspecialchars($row_military_bulletin['title'] . ' 相關內容') . '"',
                                                    $frame
                                                );
                                            } elseif (preg_match('/title="[\s]*"/', $frame) || 
                                                     preg_match('/title=""/', $frame)) {
                                                // 如果 title 為空，替換為有意義的值
                                                $frame = preg_replace(
                                                    '/title="[^"]*"/',
                                                    'title="' . htmlspecialchars($row_military_bulletin['title'] . ' 相關內容') . '"',
                                                    $frame
                                                );
                                            }
                                            
                                            return $frame;
                                        },
                                        $content
                                    );
                                }
                                
                                echo $content;
                            ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="MM_insert" value="form1" />
            </form><br />
            <div style="text-align: center;">
                <?php if (isset($_SESSION['military_Username'])) {?>
                <a href="post_edit.php?no=<?php echo $row_military_bulletin['no']; ?>" 
                   title="編輯公告：<?php echo $row_military_bulletin['title']; ?>">編輯</a> | 
                <a href="javascript:if (confirm('您確定要將 <?php echo '【'.$row_military_bulletin['title'].'】';?> 的 公告 移除嗎？')) location.href='post_delete.php?no=<?php echo $row_military_bulletin['no']; ?>'"
                   title="刪除公告：<?php echo $row_military_bulletin['title']; ?>">刪除</a>
                <?php }?>
            </div>
            <br /><br /><br /><br /><br /><br />
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>
