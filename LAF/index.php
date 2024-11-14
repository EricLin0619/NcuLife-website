<?php require_once('Connections/conn_LAF.php'); ?>
<?php require_once('../conn_military.php');  ?>
<?php
include('../call_css.php');
?>

<!-- 限制存取頁面 -->
<?php 
if (!isset($_SESSION)) {
  session_start();
}
//$MM_redirect = "login.php";
//if (!isset($_SESSION['LAF_user'])) {header("Location: " . $MM_redirect);}
?>

<!-- 使用者資料 -->
<?php
$colname_laf_user = "-1";
if (isset($_SESSION['LAF_user'])) {
  $colname_laf_user = (get_magic_quotes_gpc()) ? $_SESSION['LAF_user'] : addslashes($_SESSION['LAF_user']);
}
mysqli_select_db($conn_LAF, $database_conn_LAF);
$query_laf_user = sprintf("SELECT * FROM `CSRC_user` WHERE `user` = '%s'", $colname_laf_user);
$laf_user = mysqli_query($conn_LAF, $query_laf_user) or die(mysql_error());
$row_laf_user = mysqli_fetch_assoc($laf_user);

//暫存檔
mysqli_select_db($conn_LAF, $database_conn_LAF);
$s_laf_user = empty($_SESSION['LAF_user']) ? "" : $_SESSION['LAF_user'];
$query_laf_data_temp = sprintf("SELECT * FROM `laf_data` WHERE `user`='" . $s_laf_user . "' AND `temp`='Y' ORDER BY time DESC, time2 DESC, date DESC ");
$laf_data_temp = mysqli_query($conn_LAF, $query_laf_data_temp) or die(mysqli_connect_error());
$row_laf_data_temp = mysqli_fetch_assoc($laf_data_temp);
$totalRows_laf_data_temp = mysqli_num_rows($laf_data_temp);

$class_type = empty($_GET['class_type']) ? "" : $_GET['class_type'];
switch ($class_type) {
  case 1:
    $class = '有價票券';
    break;
  case 2:
    $class = '3C電子';
    break;
  case 3:
    $class = '身分證件';
    break;
  case 4:
    $class = '運動物品';
    break;
  case 5:
    $class = '眼鏡服裝';
    break;
  case 6:
    $class = '文具書籍';
    break;
  case 7:
    $class = '保溫瓶';
    break;
  case 8:
    $class = '手錶';
    break;
  case 9:
    $class = '鑰匙';
    break;
  case 10:
    $class = '雨傘';
    break;
  case 99:
    $class = '其它';
    break;
  default:
    $class = '全部';
    break;
}

if (isset($_GET['class_type'])) {
  $class_sql = "`class`='" . $class . "' AND ";
} else {
  $class_sql = '';
}

//事件列表
$currentPage = $_SERVER["PHP_SELF"];
$maxRows_laf_data = 20;
$pageNum_laf_data = 0;

if (isset($_GET['pageNum_laf_data'])) {
  $pageNum_laf_data = $_GET['pageNum_laf_data'];
}
$startRow_laf_data = $pageNum_laf_data * $maxRows_laf_data;

mysqli_select_db($conn_LAF, $database_conn_LAF);
$query_laf_data = sprintf("SELECT * FROM `laf_data` WHERE $class_sql `temp`='N' AND `state` is NULL ORDER BY time DESC, time2 DESC, date DESC");
$query_limit_laf_data = sprintf("%s LIMIT %d, %d", $query_laf_data, $startRow_laf_data, $maxRows_laf_data);
$laf_data = mysqli_query($conn_LAF, $query_limit_laf_data) or die(mysqli_connect_error());
$row_laf_data = mysqli_fetch_assoc($laf_data);
$totalRows_laf_data = mysqli_num_rows($laf_data);

if (isset($_GET['totalRows_laf_data'])) {
  $totalRows_laf_data = $_GET['totalRows_laf_data'];
} else {
  $all_laf_data = mysqli_query($conn_LAF, $query_laf_data);
  $totalRows_laf_data = mysqli_num_rows($all_laf_data);
}
$totalPages_laf_data = ceil($totalRows_laf_data / $maxRows_laf_data) - 1;
?>
<?php

//今天日期
$today = intval(date("U", mktime(0, 0, 0, date('m'), date('d'), date('Y')) / 86400));

//最新消息
$currentPage = $_SERVER["PHP_SELF"];
$maxRows_military_bulletin = 5;
$pageNum_military_bulletin = 0;

if (isset($_GET['pageNum_military_bulletin'])) {
  $pageNum_military_bulletin = $_GET['pageNum_military_bulletin'];
}
$startRow_military_bulletin = $pageNum_military_bulletin * $maxRows_military_bulletin;

mysqli_select_db($conn_military, $database_conn_military);
$query_military_bulletin = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '遺失物協尋' ORDER BY time DESC");
$query_limit_military_bulletin = sprintf("%s LIMIT %d, %d", $query_military_bulletin, $startRow_military_bulletin, $maxRows_military_bulletin);
$military_bulletin = mysqli_query($conn_military, $query_limit_military_bulletin) or die(mysqli_connect_error());
$row_military_bulletin = mysqli_fetch_assoc($military_bulletin);
$totalRows_military_bulletin = mysqli_num_rows($military_bulletin);

if (isset($_GET['totalRows_military_bulletin'])) {
  $totalRows_military_bulletin = $_GET['totalRows_military_bulletin'];
} else {
  $all_military_bulletin = mysqli_query($conn_military, $query_military_bulletin);
  $totalRows_military_bulletin = mysqli_num_rows($all_military_bulletin);
}
$totalPages_military_bulletin = ceil($totalRows_military_bulletin / $maxRows_military_bulletin) - 1;

//最新消息(置頂)
if (isset($_GET['class'])) {
  $class_select2 = "WHERE `class` ='" . $_GET['class'] . "' AND `day_end` > '$today'";
} else {
  $class_select2 = "WHERE `day_end` > '$today'";
}

$query_military_bulletin_top = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '遺失物協尋' ORDER BY time DESC");
$military_bulletin_top = mysqli_query($conn_military, $query_military_bulletin_top) or die(mysqli_error());
$row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top);
$totalRows_military_bulletin_top = mysqli_num_rows($military_bulletin_top);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/LAF.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- InstanceBeginEditable name="doctitle" -->
  <title>國立中央大學 失物招領資訊網</title>
  <!-- InstanceEndEditable -->
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
#sidebar1 { width: 220px; }
</style>
<![endif]--><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
#mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
  <!-- InstanceBeginEditable name="head" -->
  <style type="text/css">
    <!--
    .style3 {
      color: #FFFFFF;
      font-weight: bold;
      font-size: 15px;
    }

    .style4 {
      color: #990000;
      font-weight: bold;
      font-size: 15px;
    }

    .style5 {
      font-size: 15px
    }
    -->
  </style>
  <script src="js/jquery-1.10.2.min.js"></script>
  <script src="js/lightbox-2.6.min.js"></script>
  <link href="css/lightbox.css" rel="stylesheet" />
  <!-- InstanceEndEditable -->
</head>
<!--This template was created by www.flash-templates-today.com
Flash-Templates-Today.com - Gives a possibility to obtain a ready free flash template, free css template and other kind of website template!-->

<body>
  <!-- begin #container -->
  <p>&nbsp;</p>
  <div id="container">
    <!-- begin #header -->
    <div id="header">
      <div class="headerBackground">&nbsp;</div>
      <div id="navcontainer">
        <ul id="navlist">
          <li><a href="index.php">全部</a></li>
          <li><a href="index.php?class_type=1">有價票券</a></li>
          <li><a href="index.php?class_type=2">3C電子</a></li>
          <li><a href="index.php?class_type=3">身份證件</a></li>
          <li><a href="index.php?class_type=4">運動物品</a></li>
          <li><a href="index.php?class_type=5">眼鏡服裝</a></li>
          <li><a href="index.php?class_type=6">文具書籍</a></li>
          <li><a href="index.php?class_type=7">保溫瓶</a></li>
          <li><a href="index.php?class_type=8">手錶</a></li>
          <li><a href="index.php?class_type=9">鑰匙</a></li>
          <li><a href="index.php?class_type=10">雨傘</a></li>
          <li><a href="./documents/國立中央大學失物招領管理辦法.pdf">遺失物法規</a></li>
          <li><a href="index.php?class_type=99">其它</a></li>
        </ul>
      </div>
    </div>
    <!-- end #header -->
    <!-- begin #mainContent -->
    <div id="mainContent">
      <div class="t">
        <div class="b">
          <div class="l">
            <div class="r">
              <div class="bl">
                <div class="br">
                  <div class="tl">
                    <div class="tr">
                      <p>
                        <?php if (isset($_SESSION['LAF_user'])) { ?>
                          <a href="add.php">填寫</a>　
                          <a href="list.php">查詢</a>　
                          <a href="search.php">搜尋</a>　
                          <a href="statistics.php">學院-類別統計</a>　
                          <a href="statistics2.php">月份-類別統計</a>　
                          <a href="statistics3.php">月份-地點統計</a>　
                          <a href="statistics4.php">結果-類別統計</a>　
                          <a href="report.php">月報表</a>　
                          <a href="logout.php">使用者登出</a>
                        <?php } else { ?>
                          <a href="login.php">管理專區</a>
                        <?php } ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <p></p>
      <!-- InstanceBeginEditable name="EditRegion1" -->
      <div class="t">
        <div class="b">
          <div class="l">
            <div class="r">
              <div class="bl">
                <div class="br">
                  <div class="tl">
                    <div class="tr">
                      <?php if (isset($_SESSION['LAF_user'])) { ?>
                        <div align="right">|
                          <a href="index.php" Onclick="window.open ('member_changepw.php','NAME','status=no,toolbar=no,location=no,menubar=no,width=500,height=220')">更改個人密碼</a> |
                        </div>
                      <?php } ?>
                      <h2><img src="images/<?php if (isset($_GET['class_type'])) {
                                              echo $_GET['class_type'] . '.png';
                                            } else {
                                              echo '0.png';
                                            } ?>" width="100" height="100" />　失物招領事件列表　</h2>


                      <div class="container tab-pane active">
                        <div class="col-md-10">
                          <table class="table table-hover">
                            <thead>
                              <tr class="text-center">
                                <th class="col-md-3 col-xs-3 col-lg-2">公告日期</th>
                                <th class="col-md-3 col-xs-3 col-lg-2">公告類別</th>
                                <th class="col-md-6 col-xs-6 col-lg-8">公告標題</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if ($totalRows_military_bulletin_top > 0 && $pageNum_military_bulletin == 0) { ?>
                                <?php do { ?>
                                <?php } while ($row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top)); ?>
                              <?php } ?>
                              <?php do { ?>
                                <tr>
                                  <td><?php echo substr($row_military_bulletin['time'], 0, 10); ?></td>
                                  <td><?php echo $row_military_bulletin['class']; ?></td>
                                  <td><a href="../post_detail.php?no=<?php echo $row_military_bulletin['no']; ?>"><?php echo $row_military_bulletin['title']; ?></a></td>
                                </tr>
                              <?php } while ($row_military_bulletin = mysqli_fetch_assoc($military_bulletin)); ?>
                              <tr>
                                <td colspan="3" class="text-center"></td>
                              </tr>
                            </tbody>
                          </table>
                          <nav class="text-center hidden-xs hidden-sm">
                            <ul class="pagination">
                              <?php
                              $queryString_military_bulletin = "";
                              if (empty($_GET['class'])) {
                              ?>
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, 0, $queryString_military_bulletin); ?>"><span aria-hidden="true">第一頁</span></a></li>
                                <?php
                                for ($i = 1; $i <= $totalPages_military_bulletin; $i++) {
                                ?>
                                  <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $i - 1, $queryString_military_bulletin); ?>"><?php echo $i ?></a></li>
                                <?php
                                }
                                ?>
                                <li><a href="<?php printf("%s?pageNum_military_bulletin=%d%s", $currentPage, $totalPages_military_bulletin, $queryString_military_bulletin); ?>"><span aria-hidden="true">最末頁</span></a></li>
                              <?php
                              } else if (!empty($_GET['class'])) {
                                $c = $_GET['class'];
                              ?>
                                <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, 0, $queryString_military_bulletin); ?>"><span aria-hidden="true">第一頁</span></a></li>
                                <?php
                                for ($i = 0; $i <= $totalPages_military_bulletin; $i++) {
                                ?>
                                  <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, $i, $queryString_military_bulletin); ?>"><?php echo ($i + 1) ?></a></li>
                                <?php
                                }
                                ?>
                                <li><a href="<?php printf("%s?class=$c&pageNum_military_bulletin=%d%s", $currentPage, $totalPages_military_bulletin, $queryString_military_bulletin); ?>"><span aria-hidden="true">最末頁</span></a></li>
                              <?php
                              }
                              ?>
                            </ul>
                          </nav>
                        </div>
                      </div>





                      <?php if ($totalRows_laf_data_temp > 0) { ?>
                        <p class="style4"> § 暫存檔</p>
                        <table width="800" border="0">
                          <tr>
                            <td width="125" bgcolor="#990000">
                              <div align="center"><span class="style3">編號</span></div>
                            </td>
                            <td width="125" bgcolor="#990000">
                              <div align="center"><span class="style3">拾得日期</span></div>
                            </td>
                            <td width="100" bgcolor="#990000">
                              <div align="center"><span class="style3">拾得物類別</span></div>
                            </td>
                            <td width="215" bgcolor="#990000">
                              <div align="left"><span class="style3">拾得物品名</span></div>
                            </td>
                            <td width="60" bgcolor="#990000">
                              <div align="center"><span class="style3">數量</span></div>
                            </td>
                            <td width="200" bgcolor="#990000">
                              <div align="left"><span class="style3">拾得地點</span></div>
                            </td>
                            <td width="100">&nbsp;</td>
                          </tr>
                          <?php do { ?>
                            <tr valign="top">
                              <td width="125">
                                <div align="center" class="style5"><?php echo $row_laf_data_temp['number']; ?></div>
                              </td>
                              <td width="125">
                                <div align="center" class="style5"><?php echo $row_laf_data_temp['time'] . ' ' . $row_laf_data_temp['time2']; ?></div>
                              </td>
                              <td width="100" class="style5">
                                <div align="center"><?php echo $row_laf_data_temp['class']; ?></div>
                              </td>
                              <td width="215" class="style5">
                                <div align="left"><?php echo $row_laf_data_temp['missing_name']; ?></div>
                              </td>
                              <td width="60" class="style5">
                                <div align="center"><?php echo $row_laf_data_temp['missing_number'] . ' ' . $row_laf_data_temp['missing_unit']; ?></div>
                              </td>
                              <td width="200" class="style5">
                                <div align="left"><?php echo $row_laf_data_temp['missing_place'] . '-' . $row_laf_data_temp['missing_place2']; ?></div>
                              </td>
                              <td width="100" class="style5">
                                <div align="center" class="link"><a href="edit.php?no=<?php echo $row_laf_data_temp['no']; ?>">編</a>　<a href="javascript:if (confirm('您確定要將 <?php echo '【' . $row_laf_data_temp['grade'] . '　' . $row_laf_data_temp['student_id'] . '　' . $row_laf_data_temp['name'] . '】'; ?> 的 暫存檔 移除嗎？')) location.href='delete.php?no=<?php echo $row_laf_data_temp['no']; ?>'">刪</a></div>
                              </td>
                            </tr>
                          <?php } while ($row_laf_data_temp = mysqli_fetch_assoc($laf_data_temp)); ?>
                        </table>
                      <?php } ?>
                      <p><b>§ <?php echo $class; ?> 事件列表 (共 <?php echo $totalRows_laf_data; ?> 件)</b></p>
                      <table width="800" border="0">
                        <tr>
                          <td width="125" bgcolor="#104E8B">
                            <div align="center"><span class="style3">編號</span></div>
                          </td>
                          <td width="125" bgcolor="#104E8B">
                            <div align="center"><span class="style3">拾得日期</span></div>
                          </td>
                          <td width="100" bgcolor="#104E8B">
                            <div align="center"><span class="style3">拾得物類別</span></div>
                          </td>
                          <td width="150" bgcolor="#104E8B">
                            <div align="center"><span class="style3">拾得物品名</span></div>
                          </td>
                          <td width="60" bgcolor="#104E8B">
                            <div align="center"><span class="style3">數量</span></div>
                          </td>
                          <td width="300" bgcolor="#104E8B">
                            <div align="center"><span class="style3">拾得地點</span></div>
                          </td>
                          <td width="100">&nbsp;</td>
                        </tr>
                        <?php if ($totalRows_laf_data > 0) { ?>
                          <?php do { ?>
                            <tr valign="top">
                              <td width="125">
                                <div align="center" class="style5"><?php echo $row_laf_data['number']; ?></div>
                              </td>
                              <td width="125">
                                <div align="center" class="style5"><?php echo $row_laf_data['time'] . ' ' . $row_laf_data['time2']; ?></div>
                              </td>
                              <td width="100" class="style5">
                                <div align="center"><?php echo $row_laf_data['class']; ?></div>
                              </td>
                              <td width="150" class="style5">
                                <div align="center"><?php echo $row_laf_data['missing_name']; ?></div>
                              </td>
                              <td width="60" class="style5">
                                <div align="center"><?php echo $row_laf_data['missing_number'] . ' ' . $row_laf_data['missing_unit']; ?></div>
                              </td>
                              <td width="300" class="style5">
                                <div align="center"><?php echo $row_laf_data['missing_place'] . '-' . $row_laf_data['missing_place2']; ?></div>
                              </td>
                              <td width="100" class="style5">
                                <div align="center" class="link">
                                  <?php if ((!isset($_SESSION['LAF_user'])) && ($row_laf_data['attachment'] != '')) { ?>
                                    <a href="<?php echo $row_laf_data['attachment']; ?>" data-lightbox="<?php echo $row_laf_data['no']; ?>" title="<?php echo '　拾得日期： ' . $row_laf_data['time'] . ' ' . $row_laf_data['time2'] . "<br/>" . '　拾得地點： ' . $row_laf_data['missing_place'] . '-' . $row_laf_data['missing_place2'] . "<br/>" . '拾得物品名： ' . $row_laf_data['missing_name'] . ' ' . $row_laf_data['missing_number'] . ' ' . $row_laf_data['missing_unit']; ?>">照片</a>
                                  <?php } else { ?>
                                    <?php if ($row_laf_user['department'] == "生輔組") { ?>
                                      <a href="show.php?no=<?php echo $row_laf_data['no']; ?>">詳</a>
                                      　<a href="edit.php?no=<?php echo $row_laf_data['no']; ?>">編</a>
                                      <?php if (($_SESSION['LAF_authority'] == '1') || ($_SESSION['LAF_user'] == 'K005487')) { ?>
                                        　<a href="javascript:if (confirm('您確定要將 <?php echo '【' . $row_laf_data['missing_name'] . '　' . $row_laf_data['missing_number'] . ' ' . $row_laf_data['missing_unit'] . '】'; ?> 從 失物招領事件登記簿 移除嗎？')) location.href='delete.php?no=<?php echo $row_laf_data['no']; ?>'">刪</a>
                                      <?php } else {
                                        echo "&nbsp;";
                                      } ?>
                                    <?php } else {
                                      echo "&nbsp;";
                                    } ?>
                                  <?php } ?>
                                </div>
                              </td>
                            </tr>
                          <?php } while ($row_laf_data = mysqli_fetch_assoc($laf_data)); ?>
                        <?php } else { ?>
                          <tr>
                            <td colspan="6">
                              <div align="center">&nbsp;</div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="6">
                              <div align="center">目前無資料!</div>
                            </td>
                          </tr>
                        <?php } ?>
                      </table>
                      <p>&nbsp;</p>
                      <?php $queryString_laf_data = "";?>
                      <table border="0" width="70%" align="center">
                        <tr>
                          <td width="23%" align="center"><?php if ($pageNum_laf_data > 0) { // Show if not first page 
                                                          ?>
                              <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, 0, $queryString_laf_data); ?><?php if (isset($_GET['class_type'])) {
                                                                                                                              echo "&class_type=" . $_GET['class_type'];
                                                                                                                            } ?>">第一頁</a>
                            <?php } // Show if not first page 
                            ?>
                          </td>
                          <td width="31%" align="center"><?php if ($pageNum_laf_data > 0) { // Show if not first page 
                                                          ?>
                              <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, max(0, $pageNum_laf_data - 1), $queryString_laf_data); ?><?php if (isset($_GET['class_type'])) {
                                                                                                                                                          echo "&class_type=" . $_GET['class_type'];
                                                                                                                                                        } ?>">上一頁</a>
                            <?php } // Show if not first page 
                            ?>
                          </td>
                          <td width="23%" align="center"><?php if ($pageNum_laf_data < $totalPages_laf_data) { // Show if not last page 
                                                          ?>
                              <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, min($totalPages_laf_data, $pageNum_laf_data + 1), $queryString_laf_data); ?><?php if (isset($_GET['class_type'])) {
                                                                                                                                                                            echo "&class_type=" . $_GET['class_type'];
                                                                                                                                                                          } ?>">下一頁</a>
                            <?php } // Show if not last page 
                            ?>
                          </td>
                          <td width="23%" align="center"><?php if ($pageNum_laf_data < $totalPages_laf_data) { // Show if not last page 
                                                          ?>
                              <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, $totalPages_laf_data, $queryString_laf_data); ?><?php if (isset($_GET['class_type'])) {
                                                                                                                                                echo "&class_type=" . $_GET['class_type'];
                                                                                                                                              } ?>">最末頁</a>
                            <?php } // Show if not last page 
                            ?>
                          </td>
                        </tr>
                      </table>
                      <p>&nbsp;</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- InstanceEndEditable -->
    </div>
    <!-- end #mainContent -->
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <!-- begin #footer -->
    <div id="footer">
      <p align="center">中央大學生活輔導組 (03)-422-7151 #57212 , 57999</p>
      <div align="right">
        <pre>
        Copyright © 2013 Web Design by <a title="Free Flash Templates" href="http://www.flash-templates-today.com" class="footerLink">Free Flash Templates</a> System made by <strong>Tu　</strong>
    </pre>
      </div>
      <pre>&nbsp;	</pre>
    </div>
    <!-- end #footer -->
  </div>
  <!-- end #container -->
</body>
<!-- InstanceEnd -->

</html>
/* <?php
    // mysql_free_result($laf_data_temp);
    // mysql_free_result($laf_data);
    ?> */