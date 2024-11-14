<?php require_once('Connections/conn_LAF.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}
  $MM_redirect = "login.php";
  if (!isset($_SESSION['LAF_user'])) {header("Location: " . $MM_redirect);}
?>
<?php
//使用者資料
$colname_laf_user = "-1";
if (isset($_SESSION['LAF_user'])) {
  $colname_laf_user = (get_magic_quotes_gpc()) ? $_SESSION['LAF_user'] : addslashes($_SESSION['LAF_user']);
}
mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_user = sprintf("SELECT * FROM `CSRC_user` WHERE `user` = '%s'", $colname_laf_user);
$laf_user = mysqli_query($conn_LAF,$query_laf_user) or die(mysqli_connect_error());
$row_laf_user = mysqli_fetch_assoc($laf_user);

//校安資料(依關鍵字)
if($_GET['search']){$where = "where `missing_name` LIKE '%".$_GET['search']."%' AND `temp`='N'";}
else if($_GET['name']){$where = "where `name` LIKE '%".$_GET['name']."%' AND `temp`='N'";}
else if($_GET['number']){$where = "where `number` = ".$_GET['number']." AND `temp`='N'";}
else{$where ="where `temp`='-'";}
//echo $where;
$maxRows_laf_data = 20;
$pageNum_laf_data = 0;
if (isset($_GET['pageNum_laf_data'])) {
  $pageNum_laf_data = $_GET['pageNum_laf_data'];
}
$startRow_laf_data = $pageNum_laf_data * $maxRows_laf_data;

mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_data = "SELECT * FROM laf_data $where ORDER BY `time` DESC, `time2` DESC";
$query_limit_laf_data = sprintf("%s LIMIT %d, %d", $query_laf_data, $startRow_laf_data, $maxRows_laf_data);
$laf_data = mysqli_query($conn_LAF,$query_limit_laf_data) or die(mysqli_connect_error());
$row_laf_data = mysqli_fetch_assoc($laf_data);

if (isset($_GET['totalRows_laf_data'])) {
  $totalRows_laf_data = $_GET['totalRows_laf_data'];
} else {
  $all_laf_data = mysqli_query($conn_LAF, $query_laf_data);
  $totalRows_laf_data = mysqli_num_rows($all_laf_data);
}
$totalPages_laf_data = ceil($totalRows_laf_data/$maxRows_laf_data)-1;

$queryString_laf_data = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_laf_data") == false && 
        stristr($param, "totalRows_laf_data") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_laf_data = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_laf_data = sprintf("&totalRows_laf_data=%d%s", $totalRows_laf_data, $queryString_laf_data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/LAF.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>國立中央大學 失物招領資訊網</title>
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
<script>
        // 檢查 GET 參數是否存在，如果不存在，就加上預設值
        if (!window.location.search.includes('search=')) {
            window.location.search += '&search=';
        }

        if (!window.location.search.includes('number=')) {
            window.location.search += '&number=';
        }

        if (!window.location.search.includes('name=')) {
            window.location.search += '&name=';
        }
    </script>
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
                        <?php if (isset($_SESSION['LAF_user'])){?>
                        <a href="add.php">填寫</a>　 
                        <a href="list.php">查詢</a>　 
                        <a href="search.php">搜尋</a>　 
                        <a href="statistics.php">學院-類別統計</a>　 
                        <a href="statistics2.php">月份-類別統計</a>　 
                        <a href="statistics3.php">月份-地點統計</a>　 
                        <a href="statistics4.php">結果-類別統計</a>　 
                        <a href="report.php">月報表</a>　 
                        <a href="logout.php">使用者登出</a>
                        <?php }else{?>
                        <a href="login.php">管理專區</a>
                        <?php }?>
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
					  <h2>失物招領事件搜尋</h2>
					  <div align="justify">
              <form action="?number=<?php echo urlencode($_GET['number']);?>" method="get" name="form1" target="_self" id="form1">
              <div align="center">編號　
                <input name="number" type="text" id="number" />
                  <input type="submit" name="Submit" value="查詢" />
              </div>
            </form>
              <form action="?name=<?php echo urlencode($_GET['name']);?>" method="get" name="form1" target="_self" id="form1">
              <div align="center">拾得人　
                <input name="name" type="text" id="name" />
                  <input type="submit" name="Submit" value="查詢" />
              </div>
            </form>
		        <form action="?search=<?php echo urlencode($_GET['search']);?>" method="get" name="form1" target="_self" id="form1">
              <div align="center">品名　
                <input name="search" type="text" id="search" />
                  <input type="submit" name="Submit" value="查詢" />
              </div>
		        </form>

                <?php if ($totalRows_laf_data > 0) { // Show if recordset not empty ?>
                <p>&nbsp;</p>
                  <table width="800" border="0">
                        <tr>
                          <td width="125" bgcolor="#FF9999"><div align="center">尚未結案</div></td>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="125" bgcolor="#104E8B"><div align="center"><span class="style3">拾得日期</span></div></td>
                          <td width="100" bgcolor="#104E8B"><div align="center"><span class="style3">拾得物類別</span></div></td>
                          <td width="215" bgcolor="#104E8B"><div align="left"><span class="style3">拾得物品名</span></div></td>
						  <td width="60" bgcolor="#104E8B"><div align="center"><span class="style3">數量</span></div></td>
						  <td width="200" bgcolor="#104E8B"><div align="left"><span class="style3">拾得地點</span></div></td>
                          <td width="100">&nbsp;</td>
                        </tr>
					   <?php do { ?>
                        <tr valign="top" <?php if($row_laf_data['state']==''){echo 'bgcolor="#FF9999"';}?>>
                          <td width="125"><div align="center"><?php echo $row_laf_data['time'].' '.$row_laf_data['time2'];?></div></td>
                          <td width="100"><div align="center"><?php echo $row_laf_data['class'];?></div></td>
                          <td width="215"><div align="left"><?php echo $row_laf_data['missing_name'];?></div></td>
						  <td width="60"><div align="center"><?php echo $row_laf_data['missing_number'].' '.$row_laf_data['missing_unit'];?></div></td>
						  <td width="200"><div align="left"><?php echo $row_laf_data['missing_place'].'-'.$row_laf_data['missing_place2'];?></div></td>
                          <td width="100">
                          <div align="center" class="link">
						  <?php if($row_laf_user['department']=="生輔組"){?>
                          <a href="show.php?no=<?php echo $row_laf_data['no'];?>">詳</a>
                          　<a href="edit.php?no=<?php echo $row_laf_data['no'];?>">編</a>
						  <?php if(($_SESSION['LAF_authority']=='1')||($_SESSION['LAF_user']=='K005487')){?>
                          　<a href="javascript:if (confirm('您確定要將 <?php echo '【'.$row_laf_data['missing_name'].'　'.$row_laf_data['missing_number'].' '.$row_laf_data['missing_unit'].'】';?> 從 失物招領事件登記簿 移除嗎？')) location.href='delete.php?no=<?php echo $row_laf_data['no']; ?>'">刪</a>
						  <?php }else{ echo "&nbsp;";}?>
						  <?php }else{echo "&nbsp;";}?>
                          </div>
                          </td>
                        </tr>
						<?php } while ($row_laf_data = mysqli_fetch_assoc($laf_data)); ?>
                      </table>
              <?php } // Show if recordset not empty ?>
              <table border="0" width="50%" align="center">
                <tr>
                  <td width="23%" align="center"><?php if ($pageNum_laf_data > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, 0, $queryString_laf_data); ?>"><img src="First.gif" border=0></a>
                      <?php } // Show if not first page ?>
                  </td>
                  <td width="31%" align="center"><?php if ($pageNum_laf_data > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, max(0, $pageNum_laf_data - 1), $queryString_laf_data); ?>"><img src="Previous.gif" border=0></a>
                      <?php } // Show if not first page ?>
                  </td>
                  <td width="23%" align="center"><?php if ($pageNum_laf_data < $totalPages_laf_data) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, min($totalPages_laf_data, $pageNum_laf_data + 1), $queryString_laf_data); ?>"><img src="Next.gif" border=0></a>
                      <?php } // Show if not last page ?>
                  </td>
                  <td width="23%" align="center"><?php if ($pageNum_laf_data < $totalPages_laf_data) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, $totalPages_laf_data, $queryString_laf_data); ?>"><img src="Last.gif" border=0></a>
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
	<p align="center">中央大學軍訓室 (03)-422-7151 #57212 , 57999</p>
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
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($laf_data);
?>