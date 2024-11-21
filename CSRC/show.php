<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面

if (!isset($_SESSION)) {
  session_start();
}

//$MM_restrictGoTo = "index.php"; //拒絕存取後，要請往的頁面
//
////非允許的使用者
//
//if(strstr($_SERVER['HTTP_REFERER'],'?')){$http_ref = explode('?',$_SERVER['HTTP_REFERER']);}
//else{$http_ref[0]=$_SERVER['HTTP_REFERER'];}
//
//if (($http_ref[0]!=$URL_home."index.php")&&($http_ref[0]!=$URL_home."search.php")&&($http_ref[0]!=$URL_home."list.php")&&($http_ref[0]!=$URL_home."remark.php")&&($http_ref[0]!=$URL_home."worksheet_show.php")){ 
//  header("Location: ". $MM_restrictGoTo); 
//  exit;
//}

date_default_timezone_set("Asia/Taipei");

  $MM_redirect = "login.php";
  if (!isset($_SESSION['CSRC_user'])) {header("Location: " . $MM_redirect);}
?>
<?php

$colname_csrc_user = "-1";
if (isset($_SESSION['CSRC_user'])) {
  $colname_csrc_user = (get_magic_quotes_gpc()) ? $_SESSION['CSRC_user'] : addslashes($_SESSION['CSRC_user']);
}
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_user = sprintf("SELECT * FROM `csrc_user` WHERE `user` = '%s'", $colname_csrc_user);
$csrc_user = mysqli_query($conn_CSRC,$query_csrc_user) or die(mysqli_connect_error());
$row_csrc_user = mysqli_fetch_assoc($csrc_user);

mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_data = sprintf("SELECT * FROM `csrc_data` WHERE `no`='".$_GET['no']."'");
$csrc_data = mysqli_query($conn_CSRC,$query_csrc_data) or die(mysqli_connect_error());
$row_csrc_data = mysqli_fetch_assoc($csrc_data);
$totalRows_csrc_data = mysqli_num_rows($csrc_data);

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

</script>
<script src="../JSCal2/js/jscal2.js"></script>
<script src="../JSCal2/js/lang/cn.js"></script>
<link rel="stylesheet" type="text/css" href="../JSCal2/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="../JSCal2/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="../JSCal2/css/gold/gold.css" />
<!-- InstanceEndEditable -->
</head>
<!--This template was created by www.flash-templates-today.com
Flash-Templates-Today.com - Gives a possibility to obtain a ready free flash template, free css template and other kind of website template!-->
<body>
<!-- begin #container -->
<div id="container">
    <!-- begin #header -->
    <div id="header">
    	<div class="headerBackground">&nbsp;</div>
        <div id="navcontainer">
            <ul id="navlist">
				<li><a href="https://military.ncu.edu.tw/index.php">首頁</a></li>
                <li><a href="SecurityCenter.php">校安中心</a></li>               
                <li><a href="disaster.php">災害防救</a></li>
                <li><a href="activity.php">活動集錦</a></li>
				<li><a href="fraud.php">防詐騙宣導</a></li>
				<li><a href="index.php" id="current">校安統計系統</a></li>
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
                        <?php if (isset($_SESSION['CSRC_user'])){?><p>
						  <a href="index.php">校安狀況列表</a>　
                          <a href="add.php">填寫校安狀況</a>　
						  <a href="list.php">校安狀況查詢</a>　
						  <a href="search.php">校安狀況搜尋</a>　
						  <a href="statistics.php">校安狀況統計</a>　
						  <a href="statistics_plot.php">校安狀況繪圖</a>　
						<?php if (isset($_SESSION['CSRC_user'])){?>
						  <a href="logout.php">使用者登出</a>　
						<?php }?>
						</p>
                        <?php }?>
                        <?php if (isset($_SESSION['CSRC_user'])&&($_SESSION['CSRC_dapartment']=="軍訓室")){?><p>
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
                      <h2>校安狀況詳情</h2>
                        <table width="700" border="0" align="center">
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>案發日期：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['time'];?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>案發時間：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['time2'];?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>學院：</strong></div></td>
                            <td width="550"><?php if($row_csrc_data['secret']=='Y'){echo '*****';}else{echo $row_csrc_data['college'];}?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>系所：</strong></div></td>
                            <td width="550"><?php if($row_csrc_data['secret']=='Y'){echo '*****';}else{echo $row_csrc_data['department'];}?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>級別：</strong></div></td>
                            <td width="550"><?php if($row_csrc_data['secret']=='Y'){echo '***';}else{echo $row_csrc_data['grade'];}?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>學號：</strong></div></td>
                            <td><?php if($row_csrc_data['secret']=='Y'){echo '*********';}else{echo $row_csrc_data['student_id'];}?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>姓名：</strong></div></td>
                            <td width="550"><?php if($row_csrc_data['secret']=='Y'){$new_name=mb_substr($row_csrc_data['name'], 0, 1,"UTF-8");for($i=1;$i<mb_strlen($row_csrc_data['name'], "UTF-8");$i++){$new_name.='Ｏ';}}else{$new_name=$row_csrc_data['name'];}echo $new_name;?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>性別：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['sex'];?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>案件類別：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['class'].'-'.$row_csrc_data['class2'];?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>案發地點：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['place'].'-'.$row_csrc_data['place2'].$row_csrc_data['other'];?></td>
                          </tr>
                          <tr id="sub_01" style="display:none">
                            <td width="150" valign="top"><div align="right"><strong>車種：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['car'];?></td>
                          </tr>
                          <tr id="sub_02" style="display:none">
                            <td width="150" valign="top"><div align="right"><strong>車禍原因：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['reason'];?></td>
                          </tr>
                          <tr id="sub_03" style="display:none">
                            <td width="150" valign="top"><div align="right"><strong>損傷情形：</strong></div></td>
                            <td width="550">
                            <?php echo $row_csrc_data['injury'];?></td>
                          </tr>
                          <tr id="sub_04" style="display:none">
                            <td width="150" valign="top"><div align="right"><strong>送醫情形：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['deliver'];?></td>
                          </tr>
                          <tr id="sub_05" style="display:none">
                            <td width="150" valign="top"><div align="right"><strong>種類：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['sub_class'];?></td>
                          </tr>
                          <tr id="sub_06" style="display:none">
                            <td width="150" valign="top"><div align="right"><strong>種類：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['sub_class'];?></td>
                          </tr>
                          <tr id="sub_07" style="display:none">
                            <td width="150" valign="top"><div align="right"><strong>部位：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['part'];?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>案由(何事)：</strong></div></td>
                            <td width="550" valign="top"><?php echo str_replace($row_csrc_data['name'],$new_name,$row_csrc_data['what']);?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>處理情形(如何)：</strong></div></td>
                            <td width="550" valign="top"><?php echo nl2br(str_replace($row_csrc_data['name'],$new_name,$row_csrc_data['how']));?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>登記人：</strong></div></td>
                            <td width="550"><?php echo $row_csrc_data['user_dep'].'-'.$row_csrc_data['username'];?></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>案件追蹤：</strong></div></td>
                            <td width="550"><?php echo nl2br(str_replace($row_csrc_data['name'],$new_name,$row_csrc_data['remark']));?></td>
                          </tr>
                          <?php 
                          if($row_csrc_data['img1'] != NULL)
                          {
                            echo '<tr>
                            <td width="150" valign="top"><div align="right"><strong>圖片一：</strong></div></td>
                            <td width="550"><img src="./security_img/'.$row_csrc_data["img1"].'" height="150px" alt="img1" /></td>
                          </tr>';
                          }
                           ?>
                          <?php 
                          if($row_csrc_data['img2'] != NULL)
                          {
                            echo '<tr>
                            <td width="150" valign="top"><div align="right"><strong>圖片二：</strong></div></td>
                            <td width="550"><img src="./security_img/'.$row_csrc_data["img2"].'" height="150px" alt="img2" /></td>
                          </tr>';
                          }
                          if($row_csrc_data['img3'] != NULL)
                          {
                            echo '<tr>
                            <td width="150" valign="top"><div align="right"><strong>圖片三：</strong></div></td>
                            <td width="550"><img src="./security_img/'.$row_csrc_data["img3"].'" height="150px" alt="img3" /></td>
                          </tr>';
                          }
                          if($row_csrc_data['img4'] != NULL)
                          {
                            echo '<tr>
                            <td width="150" valign="top"><div align="right"><strong>圖片四：</strong></div></td>
                            <td width="550"><img src="./security_img/'.$row_csrc_data["img4"].'" height="150px" alt="img4" /></td>
                          </tr>';
                          }
                           ?>
                          <tr>
                            <td colspan="2"><div align="center"></div></td>
                          </tr>
                      </table>
					  <form id="form1" name="form1" method="post" action="toDoc.php?no=<?php echo $row_csrc_data['no']?>">
					  <label>
					  <div align="center">
					  <input type="submit" name="Submit" value="下載　校安狀況處理紀錄表" />
					  </div>
					  </label>
					  </form>
            <form id="form2" name="form2" method="post" action="toDoc_new.php?no=<?php echo $row_csrc_data['no']?>" >
					  <label>
					  <div align="center">
					  <input type="submit" name="Submit" value="下載 校安狀況處理紀錄表(含圖片)" />
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
	  <script type="text/javascript">window.onload = show('<?php echo $row_csrc_data['class2'];?>');</script>
    <!-- InstanceEndEditable -->
        </div>
    <!-- end #mainContent -->
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <!-- begin #footer -->
    <div id="footer">
	<p>
	中央大學軍訓室 (03)-422-7151 #57212 , 57999 校安專線 03-280-5666
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
mysqli_free_result($csrc_user);
mysqli_free_result($csrc_data);
?>