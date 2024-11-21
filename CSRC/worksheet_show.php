<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面

if (!isset($_SESSION)) {
  session_start();
}

date_default_timezone_set("Asia/Taipei");

  $MM_redirect = "login.php";
  if (!isset($_SESSION['CSRC_user'])) {header("Location: " . $MM_redirect);}
  if (isset($_SESSION['CSRC_user'])&&($_SESSION['CSRC_dapartment']!="生輔組")) {header("Location: " . $MM_redirect);}
  
$MM_restrictGoTo = "worksheet.php"; //拒絕存取後，要請往的頁面

//非允許的使用者

if(strstr($_SERVER['HTTP_REFERER'],'?')){$http_ref = explode('?',$_SERVER['HTTP_REFERER']);}
else{$http_ref[0]=$_SERVER['HTTP_REFERER'];}

if ((!(isset($_POST["MM_update"])))&&($http_ref[0]!=$URL_home."worksheet.php")&&($http_ref[0]!=$URL_home."worksheet_search.php")&&($http_ref[0]!=$URL_home."worksheet_list.php")){
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php

$weeklist = array('日', '一', '二', '三', '四', '五', '六');

$colname_csrc_user = "-1";
if (isset($_SESSION['CSRC_user'])) {
  $colname_csrc_user = (get_magic_quotes_gpc()) ? $_SESSION['CSRC_user'] : addslashes($_SESSION['CSRC_user']);
}
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_user = sprintf("SELECT * FROM `csrc_user` WHERE `user` = '%s'", $colname_csrc_user);
$csrc_user = mysqli_query($conn_CSRC,$query_csrc_user) or die(mysqli_connect_error());
$row_csrc_user = mysqli_fetch_assoc($csrc_user);

mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_data = sprintf("SELECT * FROM `csrc_worksheet` WHERE `no`='".$_GET['no']."'");
$csrc_data = mysqli_query($conn_CSRC,$query_csrc_data) or die(mysqli_connect_error());
$row_csrc_data = mysqli_fetch_assoc($csrc_data);
$totalRows_csrc_data = mysqli_num_rows($csrc_data);

//校安資料(依日期)
$day_select=explode('-',$row_csrc_data['day']);

// $week=date("w",mktime(0,0,0,$day_week[1],$day_week[2],$day_week[0]));
$where = "where time LIKE '%".$day_select[0].'-'.sprintf('%02d',$day_select[1]).'-'.sprintf('%02d',$day_select[2])."%'";
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_worksheet = "SELECT * FROM `csrc_data` $where AND temp!='Y' ORDER BY `time` DESC, `time2` DESC";
$csrc_worksheet = mysqli_query($conn_CSRC,$query_csrc_worksheet) or die(mysqli_connect_error());
$row_csrc_worksheet = mysqli_fetch_assoc($csrc_worksheet);
$totalRows_csrc_worksheet = mysqli_num_rows($csrc_worksheet);

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  
  $director_2 = ($_POST['director_1'] == "自行填寫") ?  $_POST['director_2'] : "";

  $updateSQL = sprintf("UPDATE `csrc_worksheet` SET `director_1`=%s, `director_2`=%s, `director`=%s, `director_user`=%s, `director_time`=%s WHERE `no`=%s",
					   GetSQLValueString($_POST['director_1'], "text"),
					   GetSQLValueString($director_2, "text"),
					   GetSQLValueString($row_csrc_user['name'], "text"),
					   GetSQLValueString($row_csrc_user['user'], "text"),
					   GetSQLValueString(date('Y-m-d H:i:s'), "date"),
					   GetSQLValueString($_POST['no'], "text"));

  mysqli_select_db($conn_CSRC,$database_conn_CSRC);
  $Result1 = mysqli_query($conn_CSRC,$updateSQL) or die(mysqli_connect_error());

  $updateGoTo = "worksheet.php";  
  //if (isset($_SERVER['QUERY_STRING'])) {
  //  $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
  //  $insertGoTo .= $_SERVER['QUERY_STRING'];
  //}
  
  header(sprintf("Location: %s", $updateGoTo));
}
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
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<script LANGUAGE="javascript">

function show(a)
{
var str1 = "_1";
var str2 = "_show";
var str3 = a.concat(str1);
var str4 = a.concat(str2);

var choose = document.getElementById(str3).value; 

if(choose=="自行填寫"){ document.getElementById(str4).style.display='block'; }
else{ document.getElementById(str4).style.display='none'; }
}

</script>
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style3 {color: #FFFFFF; font-weight: bold; }
.style4 {
	color: #990000;
	font-weight: bold;
}
.style5 {
	color: #528A52;
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
    <div id="header">
    	<div class="headerBackground">&nbsp;</div>
        <div id="navcontainer">
            <ul id="navlist">
				<li><a href="http://military.ncu.edu.tw/index.php">首頁</a></li>
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
                      <h2>校安工作日誌詳情</h2>
                        <table width="750" border="0" align="center">
                          <tr>
                            <td colspan="2" valign="top"><strong class="style5">時間：</strong><?php echo $row_csrc_data['day'].' 星期'.$weeklist[$row_csrc_data['week']];?></td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><strong class="style5">天氣：</strong><?php echo $row_csrc_data['weather'];?></td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><strong class="style5">值勤官：</strong><?php echo $row_csrc_data['duty'];?></td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><strong class="style5">夜間值勤官：</strong><?php echo $row_csrc_data['NightDuty'];?></td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><strong class="style5">副值人員：</strong><?php echo $row_csrc_data['vice_duty'];?></td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top">
                            <div align="left">
                              <p class="style5"><strong>一、人事</strong></p>
                              
                              <p class="style5"><strong>(一)員額：</strong></p>
                              <p><?php echo nl2br($row_csrc_data['Q1_1']);?></p>

                              <p class="style5"><strong>(二)人事工作：</strong></p>
                              <p><?php echo ($row_csrc_data['Q1_2_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q1_2_2']) : $row_csrc_data['Q1_2_1']; ?></p>
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style5"><strong>二、教育</strong></p>
                              
                              <p class="style5"><strong>(一)表列課程、教官、授課概況及學生課後意見：</strong></p>
                              <p><?php echo ($row_csrc_data['Q2_1_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q2_1_2']) : $row_csrc_data['Q2_1_1']; ?></p>
                              
                              <p class="style5"><strong>(二)教育工作：</strong></p>
                              <p><?php echo ($row_csrc_data['Q2_2_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q2_2_2']) : $row_csrc_data['Q2_2_1']; ?></p>
                              
                              <p><strong class="style5">(三)審核「役期折抵」案：</strong></p>
                              <p><?php echo $row_csrc_data['Q2_3'];?></p>
                            </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style5"><strong>三、督(輔)導</strong></p>
                              <p><?php echo ($row_csrc_data['Q3_1_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q3_1_2']) : $row_csrc_data['Q3_1_1']; ?></p>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style5"><strong>四、「教育部校園安全暨災害防救通報處理中心」電子布告欄公布事項</strong></p>
                              <p><?php echo ($row_csrc_data['Q4_1_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q4_1_2']) : $row_csrc_data['Q4_1_1']; ?></p>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style5"><strong>五、值勤狀況及處置</strong></p>
                              <p><?php echo ($row_csrc_data['Q5_1_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q5_1_2']) : $row_csrc_data['Q5_1_1']; ?></p>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style5"><strong>六、校安狀況處置 (共 <?php echo $totalRows_csrc_worksheet;?> 件)</strong></p>
                              <p>
                              <?php if ($totalRows_csrc_worksheet > 0) { // Show if recordset not empty ?>
                  <table width="700" border="0">
                        <tr>
                          <td width="150" bgcolor="#104E8B"><div align="center" class="style3">案發時間</div></td>
                          <td width="200" bgcolor="#104E8B" class="style3">案件類別</td>
                          <td width="75" bgcolor="#104E8B"><div align="center" class="style3">級別</div></td>
						  <td width="100" bgcolor="#104E8B"><div align="center" class="style3">學號</div></td>
						  <td width="125" bgcolor="#104E8B" class="style3">姓名</td>
                          <td width="50">&nbsp;</td>
                        </tr>
					   <?php do { ?>
                        <tr valign="top">
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet['time'].' '.$row_csrc_worksheet['time2'];?></div></td>
                          <td width="200"><?php echo $row_csrc_worksheet['class'].' - '.$row_csrc_worksheet['class2'];?></td>
                          <td width="75"><div align="center"><?php if($row_csrc_worksheet['secret']=='Y'){echo '*****';}else{echo $row_csrc_worksheet['grade'];}?></div></td>
						  <td width="100"><div align="center"><?php if($row_csrc_worksheet['secret']=='Y'){echo '*********';}else{echo $row_csrc_worksheet['student_id'];}?></div></td>
						  <td width="125"><?php if($row_csrc_worksheet['secret']=='Y'){echo mb_substr($row_csrc_worksheet['name'], 0, 1,"UTF-8");for($i=1;$i<mb_strlen($row_csrc_worksheet['name'], "UTF-8");$i++){echo 'Ｏ';}}else{echo $row_csrc_worksheet['name'];}?></td>
                          <td width="50"><div align="center" class="link"><a href="show.php?no=<?php echo $row_csrc_worksheet['no'];?>" target="_blank">詳</a></div></td>
                        </tr>
						<?php } while ($row_csrc_worksheet = mysqli_fetch_assoc($csrc_worksheet)); ?>
                      </table>
                  <?php } // Show if recordset not empty ?>
                <?php if ($totalRows_csrc_worksheet == 0) { // Show if recordset empty ?>
                  <p>本日無狀況</p>
				<?php } // Show if recordset empty ?>
                              </p>
                            </div>
                            </td>
                          </tr>
                   <!--        <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style5"><strong>七、學生宿舍服務中心狀況回報</strong></p>
                              
                              <p class="style5"><strong>東區：</strong></p>
                              <p><?php echo ($row_csrc_data['Q7_1_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q7_1_2']) : $row_csrc_data['Q7_1_1']; ?></p>
                              <p class="style5"><strong>南區：</strong></p>
                              <p><?php echo ($row_csrc_data['Q7_2_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q7_2_2']) : $row_csrc_data['Q7_2_1']; ?></p>
                              <p class="style5"><strong>西區：</strong></p>
                              <p><?php echo ($row_csrc_data['Q7_3_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q7_3_2']) : $row_csrc_data['Q7_3_1']; ?></p>
                              <p class="style5"><strong>北區：</strong></p>
                              <p><?php echo ($row_csrc_data['Q7_4_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q7_4_2']) : $row_csrc_data['Q7_4_1']; ?></p>
                              </div>
                            </td>
                          </tr> -->
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style5"><strong>七、其他</strong></p>
                              <p><?php echo ($row_csrc_data['Q8_1_1'] == "自行填寫") ?  nl2br($row_csrc_data['Q8_1_2']) : $row_csrc_data['Q8_1_1']; ?></p>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style4"><strong>擬辦</strong></p>
                              <p>
                                <?php
                                  if ($row_csrc_data['undertaker_0'] == "自行填寫") { echo nl2br($row_csrc_data['undertaker_2']); }
								  else if ($row_csrc_data['undertaker_0'] == "通知續處"){
								    $show_text="所列案件已通知 ";
								    if ($row_csrc_data['undertaker_1'] == "Y") { $show_text.="業管單位：".$row_csrc_data['undertaker_1_1']; }
									if (($row_csrc_data['undertaker_1'] == "Y")&&($row_csrc_data['undertaker_1_2'] != "")) { $show_text.="、".$row_csrc_data['undertaker_1_2']; }
									else if (($row_csrc_data['undertaker_1'] != "Y")&&($row_csrc_data['undertaker_1_2'] != "")) { $show_text.=$row_csrc_data['undertaker_1_2']; }
									$show_text.=" 知悉掌握及賡續處理。";
								  echo $show_text;
								  }else{ echo $row_csrc_data['undertaker_0']; }
								  if ($row_csrc_data['temp'] != "Y") { echo '<br /><br />'.$row_csrc_data['duty'].'　'.$row_csrc_data['undertaker_time']; }
							   ?>
                              </p>                   
                              </div>
                             </td>
                          </tr>
                          <?php if ($row_csrc_data['director_time']!=""){ ?>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style4"><strong>核示</strong></p>
                              <p><?php echo ($row_csrc_data['director_1'] == "自行填寫") ?  nl2br($row_csrc_data['director_2']) : $row_csrc_data['director_1']; ?></p>
                              <p><?php echo $row_csrc_data['director'].'　'.$row_csrc_data['director_time']; ?>
                              </div>
                            </td>
                          </tr>
                          <?php }?>
                        </table>
                        <?php if (($_SESSION['CSRC_authority2']=="1")&&($row_csrc_data['director_time']=="")&&($row_csrc_data['temp']!="Y")){ ?>
                        <form action="" method="post" name="form1" id="form1">
                        <table width="750" border="0" align="center">
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p class="style4"><strong>核示</strong></p>
                              
                              <p>　<span id="spryselect_director">
                                <select name="director_1" id="director_1" onchange="show('director')">
                                  <option selected="selected">請選擇</option>
                                  <option value="閱">閱</option>
                                  <option value="如擬">如擬</option>
                                  <option value="請持續掌握列入交接">請持續掌握列入交接</option>
                                  <option value="通知相關單位掌握處理">通知相關單位掌握處理</option>
                                  <option value="通知輔導教官賡續處理">通知輔導教官賡續處理</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="director_show" align="center" style="display:none">
                              <span id="sprytextarea_director">
                              <textarea name="director_2" cols="85" rows="10" id="director_2"></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              </div>                            </td>
                          </tr>
                          <tr>
                            <td width="150">&nbsp;</td>
                            <td width="600">
                              <div align="left">
                                <input name="no" type="hidden" id="no" value="<?php echo $row_csrc_data['no'];?>" />
                                <input name="Submit" type="Submit" value="送出" onclick="check_form()" />
                              </div></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_update" value="form1" />
                      </form>
                      <?php }?>
                      <p>&nbsp;</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<script type="text/javascript">
<!--

function check_form() {	  
	  var spryselect_Q5_1 = new Spry.Widget.ValidationSelect("spryselect_director"); 
	  if(document.getElementById('director_1').value=='自行填寫') { var sprytextarea_director = new Spry.Widget.ValidationTextarea("sprytextarea_director"); }
	  else{ var sprytextarea_director = new Spry.Widget.ValidationTextarea("sprytextarea_director", {isRequired:false}); }
}

//-->
</script>
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
mysqli_free_result($csrc_user);

mysqli_free_result($csrc_data);

// mysqli_free_result($csrc_situation);
?>