<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}
  $MM_redirect = "login.php";
  if (!isset($_SESSION['CSRC_user'])) {header("Location: " . $MM_redirect);}
  if (isset($_SESSION['CSRC_user'])&&($_SESSION['CSRC_dapartment']!="生輔組")) {header("Location: " . $MM_redirect);}
?>
<?php

$weeklist = array('日', '一', '二', '三', '四', '五', '六');

//使用者資料
$colname_csrc_user = "-1";
if (isset($_SESSION['CSRC_user'])) {
  $colname_csrc_user = (get_magic_quotes_gpc()) ? $_SESSION['CSRC_user'] : addslashes($_SESSION['CSRC_user']);
}
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_user = sprintf("SELECT * FROM `csrc_user` WHERE `user` = '%s'", $colname_csrc_user);
$csrc_user = mysqli_query($conn_CSRC,$query_csrc_user) or die(mysqli_connect_error());
$row_csrc_user = mysqli_fetch_assoc($csrc_user);

//校安資料(依關鍵字)
if(isset($_GET['search'])){
  // $where = "WHERE (`Q1_1` LIKE '%".$_GET['search']."%' OR `Q1_2_2` LIKE '%".$_GET['search']."%' OR `Q2_1_2` LIKE '%".$_GET['search']."%' OR `Q2_2_2` LIKE '%".$_GET['search']."%' OR `Q3_1_2` LIKE '%".$_GET['search']."%' OR `Q4_1_2` LIKE '%".$_GET['search']."%' OR `Q5_1_2` LIKE '%".$_GET['search']."%' OR `Q7_1_2` LIKE '%".$_GET['search']."%' OR `Q7_2_2` LIKE '%".$_GET['search']."%' OR `Q7_3_2` LIKE '%".$_GET['search']."%' OR `Q7_4_2` LIKE '%".$_GET['search']."%' OR `undertaker_1_1` LIKE '%".$_GET['search']."%' OR `duty` LIKE '%".$_GET['search']."%' OR `undertaker_1_2` LIKE '%".$_GET['search']."%' OR `undertaker_2` LIKE '%".$_GET['search']."%') AND `temp`='N'" ;
  $where = "WHERE `duty` LIKE '%".$_GET['search']."%'";
}
else{
  $where ="where `temp`='-'";
}

$maxRows_csrc_worksheet = 20;
$pageNum_csrc_worksheet = 0;
if (isset($_GET['pageNum_csrc_worksheet'])) {
  $pageNum_csrc_worksheet = $_GET['pageNum_csrc_worksheet'];
}
$startRow_csrc_worksheet = $pageNum_csrc_worksheet * $maxRows_csrc_worksheet;

mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_worksheet = "SELECT * FROM csrc_worksheet $where ORDER BY `day` DESC, `undertaker_time` DESC";
$query_limit_csrc_worksheet = sprintf("%s LIMIT %d, %d", $query_csrc_worksheet, $startRow_csrc_worksheet, $maxRows_csrc_worksheet);
$csrc_worksheet = mysqli_query($conn_CSRC,$query_limit_csrc_worksheet) or die(mysqli_connect_error());
$row_csrc_worksheet = mysqli_fetch_assoc($csrc_worksheet);

if (isset($_GET['totalRows_csrc_worksheet'])) {
  $totalRows_csrc_worksheet = $_GET['totalRows_csrc_worksheet'];
} else {
  $all_csrc_worksheet = mysqli_query($conn_CSRC,$query_csrc_worksheet);
  $totalRows_csrc_worksheet = mysqli_num_rows($all_csrc_worksheet);
}
$totalPages_csrc_worksheet = ceil($totalRows_csrc_worksheet/$maxRows_csrc_worksheet)-1;

$queryString_csrc_worksheet = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_csrc_worksheet") == false && 
        stristr($param, "totalRows_csrc_worksheet") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_csrc_worksheet = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_csrc_worksheet = sprintf("&totalRows_csrc_worksheet=%d%s", $totalRows_csrc_worksheet, $queryString_csrc_worksheet);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CSRC.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>中央大學校園安全中心</title>
<!-- InstanceEndEditable -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
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
.style3 {color: #FFFFFF; font-weight: bold; }
.style4 {
	color: #990000;
	font-weight: bold;
}
-->
</style>
<!-- InstanceEndEditable -->
</head>
<!--This template was created by www.flash-templates-today.com
Flash-Templates-Today.com - Gives a possibility to obtain a ready free flash template, free css template and other kind of website template!-->
<body>
<!-- begin #container -->
<div id="container">
    <!-- begin #header -->
    <?php include('navbar.php'); ?>
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
                        <?php if (isset($_SESSION['CSRC_user'])){?><p>
						  <a href="index.php">校安狀況列表</a>　
                          <a href="add.php">填寫校安狀況</a>　
						  <a href="list.php">校安狀況查詢</a>　
						  <a href="search.php">校安狀況搜尋</a>　
						  <a href="statistics_new.php">校安狀況統計</a>　
						  <a href="statistics_plot.php">校安狀況繪圖</a>　
						<?php if (isset($_SESSION['CSRC_user'])){?>
						  <a href="logout.php">使用者登出</a>　
						<?php }?>
						</p>
                        <?php }?>
                        <?php if (isset($_SESSION['CSRC_user'])&&($_SESSION['CSRC_dapartment']=="生輔組")){?><p>
						  <a href="worksheet.php">工作日誌列表</a>　						  
                          <a href="worksheet_add.php">填寫工作日誌</a>　
						  <a href="worksheet_list.php">工作日誌查詢</a>　
						  <a href="worksheet_search.php">工作日誌搜尋</a>　
                        <?php if ($_SESSION['CSRC_authority']=='1'){?>
						  <a href="member.php">人員權限管理</a>　
						<?php }?>
						</p>
                        <?php }?>
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
					  <h2>校安工作日誌搜尋</h2>
					  <div align="justify">
		        <form action="?search=<?php echo urlencode($_GET['search']);?>" method="get" name="form1" target="_self" id="form1">
		          <div align="center">登入者查詢　
		            <input name="search" type="text" id="search" />
	                <input type="submit" name="Submit" value="查詢" />
		          </div>
		        </form>
                <?php if (isset($_GET['search'])) { // Show if recordset not empty ?>
                <p>搜尋關鍵字：<b><?php echo $_GET['search'];?></b> ， 共 <b><?php echo $totalRows_csrc_worksheet;?></b> 筆</p>
                <?php }?>
				<?php if ($totalRows_csrc_worksheet > 0) { // Show if recordset not empty ?>
                
                  <table width="650" border="0" align="center">
                        <tr>
                          <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">日誌時間</span></div></td>
                          <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">值勤官</span></div></td>
                          <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">夜間值勤官</span></div></td>
                          <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">副值人員</span></div></td>
						  <td width="100" bgcolor="#104E8B"><div align="center"><span class="style3">狀態</span></div></td>
                          <td width="100">&nbsp;</td>
                        </tr>
					   <?php do { ?>
                        <tr valign="top">
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet['day'].' '.$weeklist[$row_csrc_worksheet['week']];?></div></td>
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet['duty'];?></div></td>
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet['NightDuty'];?></div></td>
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet['vice_duty'];?></div></td>
						  <td width="100"><div align="center"><?php echo ($row_csrc_worksheet['director_time'] !="") ?  "已批示" : "尚未批示";?></div></td>
                          <td width="100"><div align="center" class="link"><a href="worksheet_show.php?no=<?php echo $row_csrc_worksheet['no'];?>">詳</a></div></td>
                        </tr>
						<?php } while ($row_csrc_worksheet = mysqli_fetch_assoc($csrc_worksheet)); ?>
                      </table>
              <?php } // Show if recordset not empty ?>
              <table border="0" width="50%" align="center">
                <tr>
                  <td width="23%" align="center"><?php if ($pageNum_csrc_worksheet > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_csrc_worksheet=%d%s", $currentPage, 0, $queryString_csrc_worksheet); ?>"><img src="First.gif" border=0></a>
                      <?php } // Show if not first page ?>
                  </td>
                  <td width="31%" align="center"><?php if ($pageNum_csrc_worksheet > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_csrc_worksheet=%d%s", $currentPage, max(0, $pageNum_csrc_worksheet - 1), $queryString_csrc_worksheet); ?>"><img src="Previous.gif" border=0></a>
                      <?php } // Show if not first page ?>
                  </td>
                  <td width="23%" align="center"><?php if ($pageNum_csrc_worksheet < $totalPages_csrc_worksheet) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_csrc_worksheet=%d%s", $currentPage, min($totalPages_csrc_worksheet, $pageNum_csrc_worksheet + 1), $queryString_csrc_worksheet); ?>"><img src="Next.gif" border=0></a>
                      <?php } // Show if not last page ?>
                  </td>
                  <td width="23%" align="center"><?php if ($pageNum_csrc_worksheet < $totalPages_csrc_worksheet) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_csrc_worksheet=%d%s", $currentPage, $totalPages_csrc_worksheet, $queryString_csrc_worksheet); ?>"><img src="Last.gif" border=0></a>
                      <?php } // Show if not last page ?>
                  </td>
                </tr>
              </table>
	        </div>
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
	<p>
	中央大學生輔組 (03)-422-7151 #57212 , 57999 校安專線 03-280-5666
	</p>
	<pre>
        Copyright © 2012 Web Design by <a title="Free Flash Templates" href="http://www.flash-templates-today.com" class="footerLink">Free Flash Templates</a> System made by <strong>Tu</strong>
	</pre>
    </div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($csrc_worksheet);
?>