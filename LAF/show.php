<?php require_once('Connections/conn_LAF.php'); ?>
<?php //限制存取頁面

if (!isset($_SESSION)) {
  session_start();
}

$MM_restrictGoTo = "index.php"; //拒絕存取後，要請往的頁面

//非允許的使用者

if(strstr($_SERVER['HTTP_REFERER'],'?')){$http_ref = explode('?',$_SERVER['HTTP_REFERER']);}
else{$http_ref[0]=$_SERVER['HTTP_REFERER'];}

if (($http_ref[0]!=$URL_home."index.php")&&($http_ref[0]!=$URL_home."search.php")&&($http_ref[0]!=$URL_home."list.php")&&($http_ref[0]!=$URL_home."remark.php")){ 
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

date_default_timezone_set("Asia/Taipei");

  $MM_redirect = "login.php";
  if (!isset($_SESSION['LAF_user'])) {header("Location: " . $MM_redirect);}
?>
<?php

$colname_laf_user = "-1";
if (isset($_SESSION['LAF_user'])) {
  $colname_laf_user = (get_magic_quotes_gpc()) ? $_SESSION['LAF_user'] : addslashes($_SESSION['LAF_user']);
}
mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_user = sprintf("SELECT * FROM `CSRC_user` WHERE `user` = '%s'", $colname_laf_user);
$laf_user = mysqli_query($conn_LAF,$query_laf_user) or die(mysqli_connect_error());
$row_laf_user = mysqli_fetch_assoc($laf_user);

mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_data = sprintf("SELECT * FROM `laf_data` WHERE `no`='".$_GET['no']."'");
$laf_data = mysqli_query($conn_LAF,$query_laf_data) or die(mysqli_connect_error());
$row_laf_data = mysqli_fetch_assoc($laf_data);
$totalRows_laf_data = mysqli_num_rows($laf_data);

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
<script LANGUAGE="javascript">
function show(a)
{
  var IsIE = false;
  var sAgent = navigator.userAgent.toLowerCase();//判斷是否用IE瀏覽
  if(sAgent.indexOf("msie")!=-1){IsIE = true;} //IE6.0-7
  if(sAgent.indexOf("msie 10.0")!=-1){IsIE = false;} //IE10.0
  
 if(a=="車禍"){
  if(IsIE){
  document.getElementById('sub_01').style.display='inline';
  document.getElementById('sub_02').style.display='inline';
  document.getElementById('sub_03').style.display='inline';
  document.getElementById('sub_04').style.display='inline';
  document.getElementById('sub_05').style.display='none';
  document.getElementById('sub_06').style.display='none';
  document.getElementById('sub_07').style.display='none';
  }
  else{
  document.getElementById('sub_01').style.display='table-row';
  document.getElementById('sub_02').style.display='table-row';
  document.getElementById('sub_03').style.display='table-row';
  document.getElementById('sub_04').style.display='table-row';
  document.getElementById('sub_05').style.display='none';
  document.getElementById('sub_06').style.display='none';
  document.getElementById('sub_07').style.display='none';
  }
 }
 else if(a=="運動受傷"){
  if(IsIE){
  document.getElementById('sub_01').style.display='none';
  document.getElementById('sub_02').style.display='none';
  document.getElementById('sub_03').style.display='none';
  document.getElementById('sub_04').style.display='inline';
  document.getElementById('sub_05').style.display='inline';
  document.getElementById('sub_06').style.display='none';
  document.getElementById('sub_07').style.display='inline';
  }
  else{
  document.getElementById('sub_01').style.display='none';
  document.getElementById('sub_02').style.display='none';
  document.getElementById('sub_03').style.display='none';
  document.getElementById('sub_04').style.display='table-row';
  document.getElementById('sub_05').style.display='table-row';
  document.getElementById('sub_06').style.display='none';
  document.getElementById('sub_07').style.display='table-row';
  }
 }
 else if(a=="意外傷害"){
  if(IsIE){
  document.getElementById('sub_01').style.display='none';
  document.getElementById('sub_02').style.display='none';
  document.getElementById('sub_03').style.display='none';
  document.getElementById('sub_04').style.display='inline';
  document.getElementById('sub_05').style.display='none';
  document.getElementById('sub_06').style.display='inline';
  document.getElementById('sub_07').style.display='inline';
  }
  else{
  document.getElementById('sub_01').style.display='none';
  document.getElementById('sub_02').style.display='none';
  document.getElementById('sub_03').style.display='none';
  document.getElementById('sub_04').style.display='table-row';
  document.getElementById('sub_05').style.display='none';
  document.getElementById('sub_06').style.display='table-row';
  document.getElementById('sub_07').style.display='table-row';
  }
 }
 else{
  document.getElementById('sub_01').style.display='none';
  document.getElementById('sub_02').style.display='none';
  document.getElementById('sub_03').style.display='none';
  document.getElementById('sub_04').style.display='none';
  document.getElementById('sub_05').style.display='none';
  document.getElementById('sub_06').style.display='none';
  document.getElementById('sub_07').style.display='none';
  }
}

//圖片按比例縮放
var flag=false;
function JeffImage(ImgD,iwidth,iheight){
//參數(圖片,允許的寬度,允許的高度)
var image=new Image();
image.src=ImgD.src;
if(image.width>0 && image.height>0){
flag=true;
if(image.width/image.height>= iwidth/iheight){
if(image.width>iwidth){
ImgD.width=iwidth;
ImgD.height=(image.height*iwidth)/image.width;
}else{
ImgD.width=image.width;
ImgD.height=image.height;
}
ImgD.alt=image.width+"×"+image.height;
}
else{
if(image.height>iheight){
ImgD.height=iheight;
ImgD.width=(image.width*iheight)/image.height;
}else{
ImgD.width=image.width;
ImgD.height=image.height;
}
ImgD.alt=image.width+"×"+image.height;
}
}
}

</script>
<script src="JSCal2/js/jscal2.js"></script>
<script src="JSCal2/js/lang/cn.js"></script>
<link rel="stylesheet" type="text/css" href="JSCal2/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="JSCal2/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="JSCal2/css/gold/gold.css" />
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
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
                      <h2>失物招領事件詳情</h2>
                        <table width="710" border="0" align="center">
                          <tr>
                            <td valign="top"><div align="right"><strong>編號：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['number'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得日期：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['time'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得時間：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['time2'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人學院：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['college'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人系所：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['department'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人級別：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['grade'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人學號：</strong></div></td>
                            <td><?php echo $row_laf_data['student_id'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人姓名：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['name'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人手機/分機：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['tel'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物類別：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['class'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物品名：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['missing_name'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物數量：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['missing_number'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物單位：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['missing_unit'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得地點分類：</strong></div></td>
                            <td width="550">
                            <?php echo $row_laf_data['missing_place'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得地點：</strong></div></td>
                            <td width="550">
                            <?php echo $row_laf_data['missing_place2'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物照片：</strong></div></td>
                            <td width="550">
							    <?php
                                if ($row_laf_data['attachment']==''){ echo ""; }
								else {echo "<br/>"."<img src=\"".$row_laf_data['attachment']."\" width=\"300\" height=\"250\" onload=\"javascript:JeffImage(this,600,400);\" />"; }
								?>
                             </td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人拋棄：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['containing'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>所有人識別資料：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['missing_state'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人學院：</div></td>
                            <td><?php echo $row_laf_data['college2'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人系所：</div></td>
                            <td><?php echo $row_laf_data['department2'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人級別：</div></td>
                            <td><?php echo $row_laf_data['grade2'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人學號：</div></td>
                            <td><?php echo $row_laf_data['student_id2'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人姓名：</div></td>
                            <td><?php echo $row_laf_data['name2'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人手機/分機：</div></td>
                            <td><?php echo $row_laf_data['tel2'];?></td>
                          </tr>
                          <tr>
                            <td valign="top" class="style1"><div align="right"><strong>處理日期：</strong></div></td>
                            <td><?php echo $row_laf_data['time3'];?></td>
                          </tr>
                          <tr>
                            <td valign="top" class="style1"><div align="right"><strong>處理時間：</strong></div></td>
                            <td><?php echo $row_laf_data['time4'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1"><strong>處理結果：</strong></div></td>
                            <td><?php echo $row_laf_data['state'];?></td>
                          </tr>
                          <?php if ($row_laf_data['state2']!=''){?>
                          <tr>
                            <td valign="top"><div align="right" class="style1"><strong>未領取後續處理：</strong></div></td>
                            <td><?php echo $row_laf_data['state2'];?></td>
                          </tr>
                          <?php }?>
                          <?php if ($row_laf_data['state_number']!=''){?>
                          <tr>
                            <td valign="top"><div align="right" class="style1"><strong>相關文號：</strong></div></td>
                            <td><?php echo $row_laf_data['state_number'];?></td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>登記人：</strong></div></td>
                            <td width="550"><?php echo $row_laf_data['user_dep'].'-'.$row_laf_data['username'];?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>事件追蹤：</strong></div></td>
                            <td width="550"><?php echo nl2br($row_laf_data['remark']);?></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div align="center"></div></td>
                          </tr>
                      </table>
					  <form id="form1" name="form1" method="post" action="toDoc.php?no=<?php echo $row_laf_data['no']?>">
					  <label>
					  <div align="center">
					  <input type="submit" name="Submit" value="下載　國立中央大學校安中心失物招領事件登記表" />
					  </div>
					  </label>
					  </form>
                        <p>&nbsp;</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <script type="text/javascript">window.onload = show('<?php echo $row_laf_data['class2'];?>');</script>
    <!-- InstanceEndEditable -->
        </div>
    <!-- end #mainContent -->
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <!-- begin #footer -->
    <div id="footer">
	<p align="center">中央大學生輔組 (03)-422-7151 #57212 , 57999</p>
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
mysqli_free_result($laf_user);
mysqli_free_result($laf_data);
?>