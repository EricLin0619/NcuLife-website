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

if ((!(isset($_POST["MM_update"])))&&($http_ref[0]!=$URL_home."worksheet.php")){ 
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
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
$query_csrc_user_list = sprintf("SELECT * FROM `csrc_user` WHERE `department` = '生輔組' AND `user`!='tuyohao'");
$csrc_user_list = mysqli_query($conn_CSRC,$query_csrc_user_list) or die(mysqli_connect_error());
$name_list = $user_list = NULL;
while ($row_csrc_user_list = mysqli_fetch_assoc($csrc_user_list))
	{
	$name_list[ count($name_list) ] = $row_csrc_user_list['name'];
	$user_list[ count($user_list) ] = $row_csrc_user_list['user'];
	}

mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_data = sprintf("SELECT * FROM `csrc_worksheet` WHERE `no`='".$_GET['no']."'");
$csrc_data = mysqli_query($conn_CSRC,$query_csrc_data) or die(mysqli_connect_error());
$row_csrc_data = mysqli_fetch_assoc($csrc_data);
$totalRows_csrc_data = mysqli_num_rows($csrc_data);

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
  
  $day_week=explode('-',$_POST['day']);
  $week=date("w",mktime(0,0,0,$day_week[1],$day_week[2],$day_week[0]));
  $Q1_2_2 = ($_POST['Q1_2_1'] == "自行填寫") ?  $_POST['Q1_2_2'] : "";
  $Q2_1_2 = ($_POST['Q2_1_1'] == "自行填寫") ?  $_POST['Q2_1_2'] : "";
  $Q2_2_2 = ($_POST['Q2_2_1'] == "自行填寫") ?  $_POST['Q2_2_2'] : "";
  $Q3_1_2 = ($_POST['Q3_1_1'] == "自行填寫") ?  $_POST['Q3_1_2'] : "";
  $Q4_1_2 = ($_POST['Q4_1_1'] == "自行填寫") ?  $_POST['Q4_1_2'] : "";
  $Q5_1_2 = ($_POST['Q5_1_1'] == "自行填寫") ?  $_POST['Q5_1_2'] : "";
  $Q7_1_2 = ($_POST['Q7_1_1'] == "自行填寫") ?  $_POST['Q7_1_2'] : "";
  $Q7_2_2 = ($_POST['Q7_2_1'] == "自行填寫") ?  $_POST['Q7_2_2'] : "";
  $Q7_3_2 = ($_POST['Q7_3_1'] == "自行填寫") ?  $_POST['Q7_3_2'] : "";
  $Q7_4_2 = ($_POST['Q7_4_1'] == "自行填寫") ?  $_POST['Q7_4_2'] : "";
  $Q8_1_2 = ($_POST['Q8_1_1'] == "自行填寫") ?  $_POST['Q8_1_2'] : "";
  $undertaker_1_2=implode('、',$_POST['undertaker_1_2']);
  if($_POST['undertaker_0']=="自行填寫"){ $undertaker_1=""; $undertaker_1_1=""; $undertaker_1_2=""; $undertaker_2=$_POST['undertaker_2']; }
  else if($_POST['undertaker_0']=="通知續處"){
   if($_POST['undertaker_1']=="Y"){ $undertaker_1=$_POST['undertaker_1']; $undertaker_1_1=$_POST['undertaker_1_1']; $undertaker_1_2=implode('、',$_POST['undertaker_1_2']); $undertaker_2=""; }
   else{ $undertaker_1=""; $undertaker_1_1=""; $undertaker_1_2=implode('、',$_POST['undertaker_1_2']); $undertaker_2=""; }
  }else{ $undertaker_1=""; $undertaker_1_1=""; $undertaker_1_2=""; $undertaker_2=""; }

  $updateSQL = sprintf("UPDATE `csrc_worksheet` SET `day`=%s, `week`=%s, `weather`=%s, `duty`=%s, `user`=%s, `NightDuty`=%s, `NightUser`=%s, `vice_duty`=%s, `Q1_1`=%s, `Q1_2_1`=%s, `Q1_2_2`=%s, `Q2_1_1`=%s, `Q2_1_2`=%s, `Q2_2_1`=%s, `Q2_2_2`=%s, `Q2_3`=%s, `Q3_1_1`=%s, `Q3_1_2`=%s, `Q4_1_1`=%s, `Q4_1_2`=%s, `Q5_1_1`=%s, `Q5_1_2`=%s, `Q7_1_1`=%s, `Q7_1_2`=%s, `Q7_2_1`=%s, `Q7_2_2`=%s, `Q7_3_1`=%s, `Q7_3_2`=%s, `Q7_4_1`=%s, `Q7_4_2`=%s, `Q8_1_1`=%s, `Q8_1_2`=%s, `undertaker_0`=%s, `undertaker_1`=%s, `undertaker_1_1`=%s, `undertaker_1_2`=%s, `undertaker_2`=%s, `undertaker_time`=%s, `temp`=%s WHERE `no`=%s",
                       GetSQLValueString($_POST['day'], "date"),
                       GetSQLValueString($week, "date"),
					   GetSQLValueString($_POST['weather'], "date"),
					   GetSQLValueString($name_list[ $_POST['DayDuty'] ], "text"),
					   GetSQLValueString($user_list[ $_POST['DayDuty'] ], "text"),
					   GetSQLValueString($name_list[ $_POST['NightDuty'] ], "text"),
					   GetSQLValueString($user_list[ $_POST['NightDuty'] ], "text"),
					   GetSQLValueString($_POST['vice_duty'], "text"),
					   GetSQLValueString($_POST['Q1_1'], "text"),
					   GetSQLValueString($_POST['Q1_2_1'], "text"),
					   GetSQLValueString($Q1_2_2, "text"),
					   GetSQLValueString($_POST['Q2_1_1'], "text"),
                       GetSQLValueString($Q2_1_2, "text"),
					   GetSQLValueString($_POST['Q2_2_1'], "text"),
                       GetSQLValueString($Q2_2_2, "text"),
					   GetSQLValueString($_POST['Q2_3'], "text"),
					   GetSQLValueString($_POST['Q3_1_1'], "text"),
                       GetSQLValueString($Q3_1_2, "text"),
					   GetSQLValueString($_POST['Q4_1_1'], "text"),
                       GetSQLValueString($Q4_1_2, "text"),
					   GetSQLValueString($_POST['Q5_1_1'], "text"),
					   GetSQLValueString($Q5_1_2, "text"),
					   GetSQLValueString($_POST['Q7_1_1'], "text"),
					   GetSQLValueString($Q7_1_2, "text"),
					   GetSQLValueString($_POST['Q7_2_1'], "text"),
					   GetSQLValueString($Q7_2_2, "text"),
					   GetSQLValueString($_POST['Q7_3_1'], "text"),
					   GetSQLValueString($Q7_3_2, "text"),
					   GetSQLValueString($_POST['Q7_4_1'], "text"),
					   GetSQLValueString($Q7_4_2, "text"),
					   GetSQLValueString($_POST['Q8_1_1'], "text"),
					   GetSQLValueString($Q8_1_2, "text"),
					   GetSQLValueString($_POST['undertaker_0'], "text"),
					   GetSQLValueString($undertaker_1, "text"),
					   GetSQLValueString($undertaker_1_1, "text"),
					   GetSQLValueString($undertaker_1_2, "text"),
					   GetSQLValueString($undertaker_2, "text"),
					   GetSQLValueString(date('Y-m-d H:i:s'), "date"),
					   GetSQLValueString($_POST['temp'], "text"),
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
var second = 0;
function countSecond( )
{　second = second + 1
   second2 = 900 - second
   document.getElementById("timecount").innerHTML = second2
　 setTimeout("countSecond( )", 1000)
}

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

function show2(a)
{
var str1 = "_0";
var str2 = "_show_1";
var str3 = "_show_2";
var str4 = a.concat(str1);
var str5 = a.concat(str2);
var str6 = a.concat(str3);

var choose = document.getElementById(str4).value; 

if(choose=="通知續處"){ document.getElementById(str5).style.display='block'; document.getElementById(str6).style.display='none'; }
else if(choose=="自行填寫"){ document.getElementById(str5).style.display='none'; document.getElementById(str6).style.display='block'; }
else{ document.getElementById(str5).style.display='none'; document.getElementById(str6).style.display='none'; }
}

</script>
<script src="JSCal2/js/jscal2.js"></script>
<script src="JSCal2/js/lang/cn.js"></script>
<link rel="stylesheet" type="text/css" href="JSCal2/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="JSCal2/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="JSCal2/css/gold/gold.css" />
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
<div id="container" style="background-color:#f0f0f0;">
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
<div id="mainContent"  style="background-color:#f0f0f0;">
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
                    <form name="second">
                    <p align="left">
                    系統將在 <label id="timecount" class="style1">900</label> 秒後自動存檔!
                    </p>
					</form>
                    <script>countSecond()</script>
					<script>setTimeout("document.form1.submit()",900000)</script>
                      <h2>填寫校安工作日誌</h2>
                      <form action="" method="post" name="form1" id="form1">
                        <table width="750" border="0" align="center">
                          <tr>
                            <td colspan="2" valign="top"><strong>時間：</strong>
                              <button id="day_tri">點選日期</button>
                              <span id="sprytextfield_day">
                              <input name="day" id="day" value="<?php echo $row_csrc_data['day'];?>" size="15" />
                              <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                              <script type="text/javascript">
                      Calendar.setup({
                      inputField : "day",
                      trigger    : "day_tri",
                      onSelect   : function() { this.hide() },
                      dateFormat : "%Y-%m-%d",
                      selectionType : Calendar.SEL_SINGLE,
                      fdow:0
                      });
                              </script></td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><strong>天氣：</strong><span id="sprytextfield_weather"><input name="weather" type="text" id="weather"  value="<?php echo $row_csrc_data['weather'];?>" /><span class="textfieldRequiredMsg">此項目不可空白。</span></span></td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><strong>值勤官：</strong>
                             <span id="spryselect_DayDuty">
                               <select name="DayDuty" size="1" id="DayDuty">
                                <option selected="selected" value="">請選擇..</option>
                                <?php for($i = 0 ; $i < count($name_list) ; $i++){ ?>
                                <option value="<?php echo $i; ?>"<?php if($name_list[$i]==$row_csrc_data['duty']) echo "selected";?>><?php echo $name_list[$i];?></option>
								<?php } ?>
                             </select>
                             <span class="selectRequiredMsg">請選取項目。</span></span></p>
							 </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><strong>夜間值勤官：</strong>
                             <span id="spryselect_NightDuty">
                               <select name="NightDuty" size="1" id="NightDuty">
                                <option selected="selected" value="">請選擇..</option>
                                <?php for($i = 0 ; $i < count($name_list) ; $i++){ ?>
                                <option value="<?php echo $i;?>"<?php if($name_list[$i]==$row_csrc_data['NightDuty']) echo "selected";?>><?php echo $name_list[$i]; ?></option>
								<?php } ?>
                             </select>
                             <span class="selectRequiredMsg">請選取項目。</span></span></p>
							              </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><strong>副值人員：</strong>
                             <span id="spryselect_vice_duty">
                               <select name="vice_duty" size="1" id="vice_duty">
                                <option selected="selected" value="">請選擇..</option>
                                <?php for($i = 0 ; $i < count($name_list) ; $i++){ ?>
                                <option value="<?php echo $name_list[$i];?>"<?php if($name_list[$i]==$row_csrc_data['vice_duty']) echo "selected";?>><?php echo $name_list[$i]; ?></option>
								<?php } ?>
                               </select>
                             <span class="selectRequiredMsg">請選取項目。</span></span></p>                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top">
                            <div align="left">
                              <p><strong>一、人事</strong></p>
                              
                              <p>　<strong>(一)員額：</strong></p>
                              <p align="center">
                              <span id="sprytextarea_Q1_1">
                                <textarea name="Q1_1" cols="85" rows="10" id="Q1_1"><?php echo $row_csrc_data['Q1_1'];?></textarea>
<br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>

                              <p>　<strong>(二)人事工作：</strong>
                              <span id="spryselect_Q1_2">
                                <select name="Q1_2_1" id="Q1_2_1" onchange="show('Q1_2')">
                                <?php
                                  if ($row_csrc_data['Q1_2_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q1_2_1']."\">".$row_csrc_data['Q1_2_1']."</option>"; }
							    ?>
                                  <option value="無">無</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q1_2_show" align="center" <?php if($row_csrc_data['Q1_2_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q1_2">
                              <textarea name="Q1_2_2" cols="85" rows="10" id="Q1_2_2"><?php echo $row_csrc_data['Q1_2_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                            </div>                           </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p><strong>二、教育</strong></p>
                              
                              <p>　<strong>(一)表列課程、教官、授課概況及學生課後意見：</strong>
                              <span id="spryselect_Q2_1">
                              <select name="Q2_1_1" id="Q2_1_1" onchange="show('Q2_1')">
                              <?php
                                  if ($row_csrc_data['Q2_1_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q2_1_1']."\">".$row_csrc_data['Q2_1_1']."</option>"; }
							   ?>
                                <option value="無課程">無課程</option>
                                <option value="按表授課">按表授課</option>
                                <option value="自行填寫">自行填寫</option>
                              </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q2_1_show" align="center" <?php if($row_csrc_data['Q2_1_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q2_1">
                              <textarea name="Q2_1_2" cols="85" rows="10" id="Q2_1_2"><?php echo $row_csrc_data['Q2_1_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              
                              <p>　<strong>(二)教育工作：</strong>
                              <span id="spryselect_Q2_2">
                                <select name="Q2_2_1" id="Q2_2_1" onchange="show('Q2_2')">
                                <?php
                                  if ($row_csrc_data['Q2_2_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q2_2_1']."\">".$row_csrc_data['Q2_2_1']."</option>"; }
							    ?>
                                  <option value="無">無</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q2_2_show" align="center" <?php if($row_csrc_data['Q2_2_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q2_2">
                              <textarea name="Q2_2_2" cols="85" rows="10" id="Q2_2_2"><?php echo $row_csrc_data['Q2_2_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              
                              <p>　<strong>(三)審核「役期折抵」案：</strong><span id="sprytextfield_Q2_3">
                              <input name="Q2_3" type="text" id="Q2_3" value="<?php echo $row_csrc_data['Q2_3'];?>"/>
                              <span class="textfieldRequiredMsg">此項目不可空白。</span></span></p>
                              
                              <p>&nbsp;</p>
                            </div>                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p><strong>三、督(輔)導</strong></p>
                              
                              <p>　<span id="spryselect_Q3_1">
                                <select name="Q3_1_1" id="Q3_1_1" onchange="show('Q3_1')">
                                <?php
                                  if ($row_csrc_data['Q3_1_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q3_1_1']."\">".$row_csrc_data['Q3_1_1']."</option>"; }
							    ?>
                                  <option value="無">無</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q3_1_show" align="center" <?php if($row_csrc_data['Q3_1_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q3_1">
                              <textarea name="Q3_1_2" cols="85" rows="10" id="Q3_1_2"><?php echo $row_csrc_data['Q3_1_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              </div>                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p><strong>四、「教育部校園安全暨災害防救通報處理中心」電子布告欄公布事項</strong></p>
                              
                              <p>　<span id="spryselect_Q4_1">
                                <select name="Q4_1_1" id="Q4_1_1" onchange="show('Q4_1')">
                                  <?php
                                  if ($row_csrc_data['Q4_1_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q4_1_1']."\">".$row_csrc_data['Q4_1_1']."</option>"; }
							      ?>
                                  <option value="無">無</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q4_1_show" align="center" <?php if($row_csrc_data['Q4_1_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q4_1">
                              <textarea name="Q4_1_2" cols="85" rows="10" id="Q4_1_2"><?php echo $row_csrc_data['Q4_1_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              </div>                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p><strong>五、值勤狀況及處置</strong></p>
                              
                              <p>　<span id="spryselect_Q5_1">
                                <select name="Q5_1_1" id="Q5_1_1" onchange="show('Q5_1')">
                                  <?php
                                  if ($row_csrc_data['Q5_1_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q5_1_1']."\">".$row_csrc_data['Q5_1_1']."</option>"; }
							      ?>
                                  <option value="無">無</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q5_1_show" align="center" <?php if($row_csrc_data['Q5_1_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q5_1">
                              <textarea name="Q5_1_2" cols="85" rows="10" id="Q5_1_2"><?php echo $row_csrc_data['Q5_1_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              </div>                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p><strong>六、校安狀況處置</strong></p>
                              <p>　　<em>(系統將自行帶出)</em></p>
                            </div>                            </td>
                          </tr>
                          <!-- <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p><strong>七、學生宿舍服務中心狀況回報</strong></p>
                              
                              <p>　<strong>東區：</strong><span id="spryselect_Q7_1">
                                <select name="Q7_1_1" id="Q7_1_1" onchange="show('Q7_1')">
                                  <?php
                                  if ($row_csrc_data['Q7_1_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q7_1_1']."\">".$row_csrc_data['Q7_1_1']."</option>"; }
							      ?>
                                  <option value="無狀況">無狀況</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q7_1_show" align="center" <?php if($row_csrc_data['Q7_1_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q7_1">
                              <textarea name="Q7_1_2" cols="85" rows="10" id="Q7_1_2"><?php echo $row_csrc_data['Q7_1_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              
                              <p>　<strong>南區：</strong><span id="spryselect_Q7_2">
                                <select name="Q7_2_1" id="Q7_2_1" onchange="show('Q7_2')">
                                  <?php
                                  if ($row_csrc_data['Q7_2_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q7_2_1']."\">".$row_csrc_data['Q7_2_1']."</option>"; }
							      ?>
                                  <option value="無狀況">無狀況</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q7_2_show" align="center" <?php if($row_csrc_data['Q7_2_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q7_2">
                              <textarea name="Q7_2_2" cols="85" rows="10" id="Q7_2_2"><?php echo $row_csrc_data['Q7_2_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              
                              <p>　<strong>西區：</strong><span id="spryselect_Q7_3">
                                <select name="Q7_3_1" id="Q7_3_1" onchange="show('Q7_3')">
                                  <?php
                                  if ($row_csrc_data['Q7_3_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q7_3_1']."\">".$row_csrc_data['Q7_3_1']."</option>"; }
							      ?>
                                  <option value="無狀況">無狀況</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q7_3_show" align="center" <?php if($row_csrc_data['Q7_3_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q7_3">
                              <textarea name="Q7_3_2" cols="85" rows="10" id="Q7_3_2"><?php echo $row_csrc_data['Q7_3_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>

                              <p>　<strong>北區：</strong><span id="spryselect_Q7_4">
                                <select name="Q7_4_1" id="Q7_4_1" onchange="show('Q7_4')">
                                  <?php
                                  if ($row_csrc_data['Q7_4_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q7_4_1']."\">".$row_csrc_data['Q7_4_1']."</option>"; }
							      ?>
                                  <option value="無狀況">無狀況</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q7_4_show" align="center" <?php if($row_csrc_data['Q7_4_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q7_4">
                              <textarea name="Q7_4_2" cols="85" rows="10" id="Q7_4_2"><?php echo $row_csrc_data['Q7_4_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              </div>                            </td>
                          </tr> -->
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p><strong>七、其他</strong></p>
                              
                              <p>　<span id="spryselect_Q8_1">
                                <select name="Q8_1_1" id="Q8_1_1" onchange="show('Q8_1')">
                                  <?php
                                  if ($row_csrc_data['Q8_1_1']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['Q8_1_1']."\">".$row_csrc_data['Q8_1_1']."</option>"; }
							      ?>
                                  <option value="無">無</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="Q8_1_show" align="center" <?php if($row_csrc_data['Q8_1_1']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_Q8_1">
                              <textarea name="Q8_1_2" cols="85" rows="10" id="Q8_1_2"><?php echo $row_csrc_data['Q8_1_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              </div>                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div align="left">
                              <p><strong>擬辦</strong></p>
                              
                              <p>　<span id="spryselect_undertaker">
                                <select name="undertaker_0" id="undertaker_0" onchange="show2('undertaker')">
                                  <?php
                                  if ($row_csrc_data['undertaker_0']==''){ echo "<option value=\"\">請選擇...</option>"; }
								  else {echo "<option value=\"".$row_csrc_data['undertaker_0']."\">".$row_csrc_data['undertaker_0']."</option>"; }
							      ?>
                                  <option value="呈閱">呈閱</option>
                                  <option value="通知續處">通知續處</option>
                                  <option value="自行填寫">自行填寫</option>
                                </select>
                              <span class="selectRequiredMsg">請選取項目。</span></span></p>
                              <p id="undertaker_show_1" <?php if($row_csrc_data['undertaker_0']=='通知續處'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              　<strong>所列案件已通知</strong><strong><br /><br />
                              　</strong><span id="sprycheckbox_undertaker">
                              <input type="checkbox" id="undertaker_1" name="undertaker_1" value="Y" <?php if(strstr($row_csrc_data['undertaker_1'], "Y")){echo 'checked=checked';}?> />
                              業管單位
                              <span id="sprytextfield_undertaker_1">
                              <input name="undertaker_1_1" type="text" id="undertaker_1_1" value="<?php echo $row_csrc_data['undertaker_1_1'];?>" />
                              <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="系所" <?php if(strstr($row_csrc_data['undertaker_1_2'], "系所")){echo 'checked=checked';}?> />
                              系所
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="導師" <?php if(strstr($row_csrc_data['undertaker_1_2'], "導師")){echo 'checked=checked';}?> />
                              導師
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="輔導教官" <?php if(strstr($row_csrc_data['undertaker_1_2'], "輔導教官")){echo 'checked=checked';}?> />
                              輔導教官
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="諮商中心輔導老師" <?php if(strstr($row_csrc_data['undertaker_1_2'], "諮商中心輔導老師")){echo 'checked=checked';}?> />
                              諮商中心輔導老師<br />　
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="生輔組" <?php if(strstr($row_csrc_data['undertaker_1_2'], "生輔組")){echo 'checked=checked';}?> />
                              生輔組
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="衛保組" <?php if(strstr($row_csrc_data['undertaker_1_2'], "衛保組")){echo 'checked=checked';}?> />
                              衛保組
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="國際處" <?php if(strstr($row_csrc_data['undertaker_1_2'], "國際處")){echo 'checked=checked';}?> />
                              國際處
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="環安中心" <?php if(strstr($row_csrc_data['undertaker_1_2'], "環安中心")){echo 'checked=checked';}?> />
                              環安中心
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="性平會" <?php if(strstr($row_csrc_data['undertaker_1_2'], "性平會")){echo 'checked=checked';}?> />
                              性平會
                              <input type="checkbox" id="undertaker_1_2[]" name="undertaker_1_2[]" value="駐警隊" <?php if(strstr($row_csrc_data['undertaker_1_2'], "駐警隊")){echo 'checked=checked';}?> />
                              駐警隊
                              <span class="checkboxMinSelectionsMsg">未選取。</span></span>
                              <br /><br />
                              　<strong>知悉掌握及賡續處理。                              </strong></p>
                              <p id="undertaker_show_2" align="center" <?php if($row_csrc_data['undertaker_0']=='自行填寫'){$display='block';}else{$display='none';}?> style="display:<?php echo $display;?>">
                              <span id="sprytextarea_undertaker">
                              <textarea name="undertaker_2" cols="85" rows="10" id="undertaker_2"><?php echo $row_csrc_data['undertaker_2'];?></textarea>
                              <br /><span class="textareaRequiredMsg">此項目不可空白。</span></span></p>
                              </p>
                              </div>                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><strong>是否暫存：</strong>
                              <input name="temp" type="radio" id="temp" value="Y" <?php if (!(strcmp($row_csrc_data['temp'],"Y"))) {echo "checked=\"checked\"";}?> />
                              是
                                <input name="temp" type="radio" id="temp" value="N" <?php if (!(strcmp($row_csrc_data['temp'],"N"))) {echo "checked=\"checked\"";}?> />
                            否</td>
                          </tr>
                          <tr>
                            <td width="150">&nbsp;</td>
                            <td width="600"><div align="center">
                              <input name="no" type="hidden" id="no" value="<?php echo $row_csrc_data['no'];?>" />
                              <input name="Submit" type="Submit" value="送出" onclick="check_form()" />
                            </div></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_update" value="form1" />
                      </form>
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
  if(form1.temp[1].checked){
      var sprytextfield_day = new Spry.Widget.ValidationTextField("sprytextfield_day");
	  var sprytextfield_weather = new Spry.Widget.ValidationTextField("sprytextfield_weather");

	  var spryselect_DayDuty = new Spry.Widget.ValidationSelect("spryselect_DayDuty");
	  var spryselect_NightDuty = new Spry.Widget.ValidationSelect("spryselect_NightDuty");
      var spryselect_vice_duty = new Spry.Widget.ValidationSelect("spryselect_vice_duty");
      var sprytextarea_Q1_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q1_1");
	  
	  var spryselect_Q1_2 = new Spry.Widget.ValidationSelect("spryselect_Q1_2");
	  if(document.getElementById('Q1_2_1').value=='自行填寫') { var sprytextarea_Q1_2 = new Spry.Widget.ValidationTextarea("sprytextarea_Q1_2"); }
	  else{ var sprytextarea_Q1_2 = new Spry.Widget.ValidationTextarea("sprytextarea_Q1_2", {isRequired:false}); }
	  
	  var spryselect_Q2_1 = new Spry.Widget.ValidationSelect("spryselect_Q2_1");
	  if(document.getElementById('Q2_1_1').value=='自行填寫') { var sprytextarea_Q2_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q2_1"); }
	  else{ var sprytextarea_Q2_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q2_1", {isRequired:false}); }
	  var spryselect_Q2_2 = new Spry.Widget.ValidationSelect("spryselect_Q2_2");
	  if(document.getElementById('Q2_2_1').value=='自行填寫') { var sprytextarea_Q2_2 = new Spry.Widget.ValidationTextarea("sprytextarea_Q2_2"); }
	  else{ var sprytextarea_Q2_2 = new Spry.Widget.ValidationTextarea("sprytextarea_Q2_2", {isRequired:false}); }
	  var sprytextfield_Q2_3 = new Spry.Widget.ValidationTextField("sprytextfield_Q2_3");
	  
	  var spryselect_Q3_1 = new Spry.Widget.ValidationSelect("spryselect_Q3_1");
	  if(document.getElementById('Q3_1_1').value=='自行填寫') { var sprytextarea_Q3_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q3_1"); }
	  else{ var sprytextarea_Q3_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q3_1", {isRequired:false}); }
	  
	  var spryselect_Q4_1 = new Spry.Widget.ValidationSelect("spryselect_Q4_1");
	  if(document.getElementById('Q4_1_1').value=='自行填寫') { var sprytextarea_Q4_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q4_1"); }
	  else{ var sprytextarea_Q4_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q4_1", {isRequired:false}); }
	  
	  var spryselect_Q5_1 = new Spry.Widget.ValidationSelect("spryselect_Q5_1"); 
	  if(document.getElementById('Q5_1_1').value=='自行填寫') { var sprytextarea_Q5_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q5_1"); }
	  else{ var sprytextarea_Q5_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q5_1", {isRequired:false}); }
	  
	  var spryselect_Q7_1 = new Spry.Widget.ValidationSelect("spryselect_Q7_1");
	  if(document.getElementById('Q7_1_1').value=='自行填寫') { var sprytextarea_Q7_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q7_1"); }
	  else{ var sprytextarea_Q7_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q7_1", {isRequired:false}); }
	  var spryselect_Q7_2 = new Spry.Widget.ValidationSelect("spryselect_Q7_2");
	  if(document.getElementById('Q7_2_1').value=='自行填寫') { var sprytextarea_Q7_2 = new Spry.Widget.ValidationTextarea("sprytextarea_Q7_2"); }
	  else{ var sprytextarea_Q7_2 = new Spry.Widget.ValidationTextarea("sprytextarea_Q7_2", {isRequired:false}); }
	  var spryselect_Q7_3 = new Spry.Widget.ValidationSelect("spryselect_Q7_3");
	  if(document.getElementById('Q7_3_1').value=='自行填寫') { var sprytextarea_Q7_3 = new Spry.Widget.ValidationTextarea("sprytextarea_Q7_3"); }
	  else{ var sprytextarea_Q7_3 = new Spry.Widget.ValidationTextarea("sprytextarea_Q7_3", {isRequired:false}); }
	  var spryselect_Q7_4 = new Spry.Widget.ValidationSelect("spryselect_Q7_4");
	  if(document.getElementById('Q7_4_1').value=='自行填寫') { var sprytextarea_Q7_4 = new Spry.Widget.ValidationTextarea("sprytextarea_Q7_4"); }
	  else{ var sprytextarea_Q7_4 = new Spry.Widget.ValidationTextarea("sprytextarea_Q7_4", {isRequired:false}); }
	  
	  var spryselect_Q8_1 = new Spry.Widget.ValidationSelect("spryselect_Q8_1"); 
	  if(document.getElementById('Q8_1_1').value=='自行填寫') { var sprytextarea_Q8_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q8_1"); }
	  else{ var sprytextarea_Q8_1 = new Spry.Widget.ValidationTextarea("sprytextarea_Q8_1", {isRequired:false}); }
	  
	  var spryselect_undertaker = new Spry.Widget.ValidationSelect("spryselect_undertaker");
	  if(document.getElementById('undertaker_0').value=='通知續處') {  
		if(document.getElementById('undertaker_1').checked==true) { var sprytextfield_undertaker_1 = new Spry.Widget.ValidationTextField("sprytextfield_undertaker_1"); }
	    else{ var sprycheckbox_undertaker = new Spry.Widget.ValidationCheckbox("sprycheckbox_undertaker", {isRequired:false, minSelections:1}); var sprytextfield_undertaker_1 = new Spry.Widget.ValidationTextField("sprytextfield_undertaker_1", "none", {isRequired:false}); }
	  }
	  else if(document.getElementById('undertaker_0').value=='自行填寫') { var sprytextarea_undertaker = new Spry.Widget.ValidationTextarea("sprytextarea_undertaker"); var sprytextfield_undertaker_1 = new Spry.Widget.ValidationTextField("sprytextfield_undertaker_1", "none", {isRequired:false}); }
	  else{ var sprytextarea_undertaker = new Spry.Widget.ValidationTextarea("sprytextarea_undertaker", {isRequired:false}); var sprytextfield_undertaker_1 = new Spry.Widget.ValidationTextField("sprytextfield_undertaker_1", "none", {isRequired:false}); }

  }
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

mysqli_free_result($csrc_user_list);

mysqli_free_result($csrc_data);
?>