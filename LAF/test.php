<?php require_once('Connections/conn_LAF.php'); ?>
<?php require_once('../conn_military.php');  ?>
<?php
  include('../call_css.php');
?>

<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}
  $MM_redirect = "login.php";
  if (!isset($_SESSION['LAF_user'])) {header("Location: " . $MM_redirect);}
?>

<?php

//if(isset($_GET['show'])){

//$_SESSION['start'] = $_GET['start'];
//$_SESSION['end'] = $_GET['end'];

//$start = $_GET['start'];
//$end = $_GET['end'];

?>

<?php
//使用者資料
$colname_laf_user = "-1";
if (isset($_SESSION['LAF_user'])) {
  $colname_laf_user = (get_magic_quotes_gpc()) ? $_SESSION['LAF_user'] : addslashes($_SESSION['LAF_user']);
}
mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_user = sprintf("SELECT * FROM `CSRC_user` WHERE `user` = '%s'", $colname_laf_user);
$laf_user = mysqli_query($conn_LAF,$query_laf_user) or die(mysql_error());
$row_laf_user = mysqli_fetch_assoc($laf_user);



$class_type = empty($_GET['class_type']) ? "" : $_GET['class_type'];
switch($class_type){
  case 1:	$class='有價票券';  break;
  case 2:	$class='3C電子';  break;
  case 3:	$class='身分證件';  break;
  case 4:	$class='運動物品';  break;
  case 5:	$class='眼鏡服裝';  break;
  case 6:	$class='文具書籍';  break;
  case 7:	$class='保溫瓶';  break;
  case 8:	$class='手錶';  break;
  case 9:	$class='鑰匙';  break;
  case 10:	$class='雨傘';  break;
  case 99:	$class='其它';  break;
  default:	$class='全部';  break;
}

if(isset($_GET['class_type'])){ $class_sql= "`class`='".$class."' AND "; }else{ $class_sql=''; }

//事件列表
$currentPage = $_SERVER["PHP_SELF"];
$maxRows_laf_data = 100;
$pageNum_laf_data = 0;

if (isset($_GET['pageNum_laf_data'])) {
  $pageNum_laf_data = $_GET['pageNum_laf_data'];
}
$startRow_laf_data = $pageNum_laf_data * $maxRows_laf_data;

$yymm = $_GET['yymm'];


mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_data = sprintf("SELECT number,time,time2,college,department,grade,student_id,name,tel,class,state,state2 FROM `laf_data` WHERE time >= '2021-11-01' AND time <= '2021-11-30' ORDER BY time");
$query_limit_laf_data = sprintf("%s LIMIT %d, %d", $query_laf_data, $startRow_laf_data, $maxRows_laf_data);
$laf_data = mysqli_query($conn_LAF,$query_limit_laf_data) or die(mysqli_connect_error());
$row_laf_data = mysqli_fetch_assoc($laf_data);
$totalRows_laf_data = mysqli_num_rows($laf_data);

if (isset($_GET['totalRows_laf_data'])) {
  $totalRows_laf_data = $_GET['totalRows_laf_data'];
 } else {
  $all_laf_data = mysqli_query($conn_LAF,$query_laf_data);
  $totalRows_laf_data = mysqli_num_rows($all_laf_data);
 }
 $totalPages_laf_data = ceil($totalRows_laf_data/$maxRows_laf_data)-1;
?>
<?php

    //今天日期
    $today = intval(date("U",mktime(0,0,0,date('m'),date('d'),date('Y'))/86400));

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
    $military_bulletin = mysqli_query($conn_military,$query_limit_military_bulletin) or die(mysqli_connect_error());
    $row_military_bulletin = mysqli_fetch_assoc($military_bulletin);
    $totalRows_military_bulletin = mysqli_num_rows($military_bulletin);

    if (isset($_GET['totalRows_military_bulletin'])) {
        $totalRows_military_bulletin = $_GET['totalRows_military_bulletin'];
    } else {
        $all_military_bulletin = mysqli_query($conn_military,$query_military_bulletin);
        $totalRows_military_bulletin = mysqli_num_rows($all_military_bulletin);
    }
    $totalPages_military_bulletin = ceil($totalRows_military_bulletin/$maxRows_military_bulletin)-1;

    //最新消息(置頂)

    if (isset($_GET['class'])) { $class_select2 = "WHERE `class` ='".$_GET['class']."' AND `day_end` > '$today'"; }else{ $class_select2 = "WHERE `day_end` > '$today'";}

    $query_military_bulletin_top = sprintf("SELECT * FROM `military_bulletin` WHERE `class` = '遺失物協尋' ORDER BY time DESC");
    $military_bulletin_top = mysqli_query($conn_military,$query_military_bulletin_top) or die(mysqli_error());
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
.style3 {color: #FFFFFF; font-weight: bold; font-size:15px;}
.style4 {
	color: #990000;
	font-weight: bold;
	font-size:15px;
}
.style5 {font-size: 15px}
-->
</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/lightbox-2.6.min.js"></script>
<link href="css/lightbox.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
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
    	
  </div>
    <!-- end #header -->
    <!-- begin #mainContent -->
<div id="mainContent">
        
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
					  <?php if (isset($_SESSION['LAF_user'])){?>
					  <div align="right">| 
			            <a href="index.php" Onclick="window.open ('member_changepw.php','NAME','status=no,toolbar=no,location=no,menubar=no,width=500,height=220')">更改個人密碼</a> |
                      </div>
					  <?php } ?>
					  <h2><img src="images/<?php if(isset($_GET['class_type'])){echo $_GET['class_type'].'.png';}else{echo '0.png';}?>" width="100" height="100" />　失物招領事件列表　</h2>


            <div class="container tab-pane active">
                    <div class="col-md-10">
                        
                  
                    </div>
                </div>


                	<form id="form1" method="GET" action="./test.php">
                	<input type="text" name="start" placeholder="輸入年月(2021-10)">
                	<input type="text" name="end" placeholder="輸入年月(2021-10)">
                	<input type="submit" name="">
                	</form>

					  <button id="btnExport" onclick="exportReportToExcel(this)">EXPORT REPORT</button>
					  <script type="text/javascript">
						function exportReportToExcel() {
						  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
						  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
						    name: `export.xlsx`, // fileName you could use any name
						    sheet: {
						      name: 'Sheet 1' // sheetName
						    }
						  });
						}
						</script>
                      <p><b>§ <?php echo $class;?> 事件列表 (共 <?php echo $totalRows_laf_data;?> 件)</b></p>
                      <table width="1000" border="0" id="masterdata">
                        <tr>
                          <td width="300" bgcolor="#104E8B"><div align="center"><span class="style3">拾得日期</span></div></td>
                          <td width="700" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人單位</span></div></td>
                          <td width="200" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人年級</span></div></td>
						  <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人學號</span></div></td>
						  <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人姓名</span></div></td>
						  <td width="200" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人電話</span></div></td>
						  <td width="200" bgcolor="#104E8B"><div align="center"><span class="style3">拾得物類別</span></div></td>
						  <td width="200" bgcolor="#104E8B"><div align="center"><span class="style3">處理結果</span></div></td>
						  <td width="200" bgcolor="#104E8B"><div align="center"><span class="style3">未領取後續處理</span></div></td>
                          <td width="100">&nbsp;</td>
                        </tr>
                      <?php if($totalRows_laf_data>0){?>
					   <?php do { ?>
                        <tr valign="top">
                          <td width="300"><div align="center" class="style5"><?php echo $row_laf_data['time'],$row_laf_data['time2'];?></div></td>
                          <td width="700" class="style5"><div align="center"><?php echo $row_laf_data['college'],$row_laf_data['department'];?></div></td>
                          <td width="200" class="style5"><div align="center"><?php echo $row_laf_data['number'];?></div></td>
						  <td width="150" class="style5"><div align="center"><?php echo $row_laf_data['student_id'];?></div></td>
						  <td width="200" class="style5"><div align="center"><?php echo $row_laf_data['name'];?></div></td>
						  <td width="200" class="style5"><div align="center"><?php echo $row_laf_data['tel'];?></div></td>
						  <td width="200" class="style5"><div align="center"><?php echo $row_laf_data['class'];?></div></td>
						  <td width="200" class="style5"><div align="center"><?php echo $row_laf_data['state'];?></div></td>
						  <td width="200" class="style5"><div align="center"><?php echo $row_laf_data['state2'];?></div></td>
                          <td width="100" class="style5">
                                            </td>
                        </tr>
						<?php } while ($row_laf_data = mysqli_fetch_assoc($laf_data)); ?>
                       <?php }else{?>
                        <tr>
                          <td colspan="6"><div align="center">&nbsp;</div></td>
                        </tr>
                        <tr>
                          <td colspan="6"><div align="center">目前無資料!</div></td>
                        </tr>
                       <?php }?>



                      </table>
                    <p>&nbsp;</p>
          <table border="0" width="70%" align="center">
            <tr>
              <td width="23%" align="center"><?php if ($pageNum_laf_data > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, 0, $queryString_laf_data); ?><?php if(isset($_GET['class_type'])){echo "&class_type=".$_GET['class_type'];}?>">第一頁</a>
                  <?php } // Show if not first page ?>
              </td>
              <td width="31%" align="center"><?php if ($pageNum_laf_data > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, max(0, $pageNum_laf_data - 1), $queryString_laf_data); ?><?php if(isset($_GET['class_type'])){echo "&class_type=".$_GET['class_type'];}?>">上一頁</a>
                  <?php } // Show if not first page ?>
              </td>
              <td width="23%" align="center"><?php if ($pageNum_laf_data < $totalPages_laf_data) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, min($totalPages_laf_data, $pageNum_laf_data + 1), $queryString_laf_data); ?><?php if(isset($_GET['class_type'])){echo "&class_type=".$_GET['class_type'];}?>">下一頁</a>
                  <?php } // Show if not last page ?>
              </td>
              <td width="23%" align="center"><?php if ($pageNum_laf_data < $totalPages_laf_data) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_laf_data=%d%s", $currentPage, $totalPages_laf_data, $queryString_laf_data); ?><?php if(isset($_GET['class_type'])){echo "&class_type=".$_GET['class_type'];}?>">最末頁</a>
                  <?php } // Show if not last page ?>
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
<!-- InstanceEnd --></html>