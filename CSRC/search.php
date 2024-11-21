<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}
  $MM_redirect = "login.php";
  if (!isset($_SESSION['CSRC_user'])) {header("Location: " . $MM_redirect);}
?>
<?php
//定義
$currentPage = $_SERVER["PHP_SELF"];
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
if(isset($_GET['search'])){$where = "where (`student_id` LIKE '%".$_GET['search']."%' OR `name` LIKE '%".$_GET['search']."%' OR `class` LIKE '%".$_GET['search']."%' OR `class2` LIKE '%".$_GET['search']."%' OR `how` LIKE '%".$_GET['search']."%' OR `what` LIKE '%".$_GET['search']."%' OR `remark` LIKE '%".$_GET['search']."%') AND `temp`='N'";}
else{$where ="where `temp`='-'";}
$maxRows_csrc_data = 20;
$pageNum_csrc_data = 0;
if (isset($_GET['pageNum_csrc_data'])) {
  $pageNum_csrc_data = $_GET['pageNum_csrc_data'];
}


$startRow_csrc_data = $pageNum_csrc_data * $maxRows_csrc_data;

mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_data = "SELECT * FROM csrc_data $where ORDER BY `time` DESC, `time2` DESC";
$query_limit_csrc_data = sprintf("%s LIMIT %d, %d", $query_csrc_data, $startRow_csrc_data, $maxRows_csrc_data);
$csrc_data = mysqli_query($conn_CSRC,$query_limit_csrc_data) or die(mysqli_connect_error());
$row_csrc_data = mysqli_fetch_assoc($csrc_data);

if (isset($_GET['totalRows_csrc_data'])) {
  $totalRows_csrc_data = $_GET['totalRows_csrc_data'];
} else {
  $all_csrc_data = mysqli_query($conn_CSRC,$query_csrc_data);
  $totalRows_csrc_data = mysqli_num_rows($all_csrc_data);
}
$totalPages_csrc_data = ceil($totalRows_csrc_data/$maxRows_csrc_data)-1;

$queryString_csrc_data = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_csrc_data") == false && 
        stristr($param, "totalRows_csrc_data") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_csrc_data = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_csrc_data = sprintf("&totalRows_csrc_data=%d%s", $totalRows_csrc_data, $queryString_csrc_data);
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
					  <h2>校安狀況搜尋</h2>
					  <div align="justify">
            <form action="?search=<?php echo urlencode(isset($_GET['search']) ? $_GET['search'] : ''); ?>" method="get" name="form1" target="_self" id="form1">
                <div align="center">
                    關鍵字查詢　
                    <input name="search" type="text" id="search" />
                    <input type="submit" name="Submit" value="查詢" />
                </div>
            </form>
                <?php if (isset($_GET['search'])) { // Show if recordset not empty ?>
                <p>搜尋關鍵字：<b><?php echo $_GET['search'];?></b> ， 共 <b><?php echo $totalRows_csrc_data;?></b> 筆</p>
                <?php }?>
				<?php if ($totalRows_csrc_data > 0) { // Show if recordset not empty ?>
                  <table width="800" border="0">
                        <tr>
                          <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">案發時間</span></div></td>
                          <td width="200" bgcolor="#104E8B"><span class="style3">案件類別</span></td>
                          <td width="75" bgcolor="#104E8B"><div align="center"><span class="style3">級別</span></div></td>
						  <td width="100" bgcolor="#104E8B"><div align="center"><span class="style3">學號</span></div></td>
						  <td width="125" bgcolor="#104E8B"><span class="style3">姓名</span></td>
                          <td width="150">&nbsp;</td>
                        </tr>
					   <?php do { ?>
                        <tr valign="top">
                          <td width="150"><div align="center"><?php echo $row_csrc_data['time'].' '.$row_csrc_data['time2'];?></div></td>
                          <td width="200"><?php echo $row_csrc_data['class'].' - '.$row_csrc_data['class2'];?></td>
                          <td width="75"><div align="center"><?php if($row_csrc_data['secret']=='Y'){echo '*****';}else{echo $row_csrc_data['grade'];}?></div></td>
						  <td width="100"><div align="center"><?php if($row_csrc_data['secret']=='Y'){echo '*********';}else{echo $row_csrc_data['student_id'];}?></div></td>
						  <td width="125"><?php if($row_csrc_data['secret']=='Y'){echo mb_substr($row_csrc_data['name'], 0, 1,"UTF-8");for($i=1;$i<mb_strlen($row_csrc_data['name'], "UTF-8");$i++){echo 'Ｏ';}}else{echo $row_csrc_data['name'];}?></td>
                          <td width="150"><?php if(($row_csrc_user['department']=="生輔組")||($row_csrc_user['department']=="學務處")||($row_csrc_user['department']=="秘書室")||($row_csrc_user['department']==$row_csrc_data['user_dep'])){?><div align="center" class="link"><a href="show.php?no=<?php echo $row_csrc_data['no'];?>">詳</a>　<a href="remark.php?no=<?php echo $row_csrc_data['no'];?>">追</a>
						  <?php if($_SESSION['CSRC_authority']=='1'){?>
                          　<a href="edit.php?no=<?php echo $row_csrc_data['no'];?>">編</a>　<a href="javascript:if (confirm('您確定要將 <?php echo '【'.$row_csrc_data['grade'].'　'.$row_csrc_data['student_id'].'　'.$row_csrc_data['name'].'】';?> 從 校安狀況管制登記簿 移除嗎？')) location.href='delete.php?no=<?php echo $row_csrc_data['no']; ?>'">刪</a>
                          <?php }else{ echo "&nbsp;";}?></div><?php }else{echo "&nbsp;";}?></td>
                        </tr>
						<?php } while ($row_csrc_data = mysqli_fetch_assoc($csrc_data)); ?>
                      </table>
              <?php } // Show if recordset not empty ?>
              <table border="0" width="50%" align="center">
                <tr>
                  <td width="23%" align="center"><?php if ($pageNum_csrc_data > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_csrc_data=%d%s", $currentPage, 0, $queryString_csrc_data); ?>"><img src="First.gif" border=0></a>
                      <?php } // Show if not first page ?>
                  </td>
                  <td width="31%" align="center"><?php if ($pageNum_csrc_data > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_csrc_data=%d%s", $currentPage, max(0, $pageNum_csrc_data - 1), $queryString_csrc_data); ?>"><img src="Previous.gif" border=0></a>
                      <?php } // Show if not first page ?>
                  </td>
                  <td width="23%" align="center"><?php if ($pageNum_csrc_data < $totalPages_csrc_data) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_csrc_data=%d%s", $currentPage, min($totalPages_csrc_data, $pageNum_csrc_data + 1), $queryString_csrc_data); ?>"><img src="Next.gif" border=0></a>
                      <?php } // Show if not last page ?>
                  </td>
                  <td width="23%" align="center"><?php if ($pageNum_csrc_data < $totalPages_csrc_data) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_csrc_data=%d%s", $currentPage, $totalPages_csrc_data, $queryString_csrc_data); ?>"><img src="Last.gif" border=0></a>
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
	中央大學校安中心 (03)-422-7151 #57212 , 57999 校安專線 03-280-5666
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
    mysqli_free_result($csrc_data);
?>