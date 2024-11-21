<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}

date_default_timezone_set("Asia/Taipei");

  $MM_redirect = "login.php";
  if (!isset($_SESSION['CSRC_user'])) {header("Location: " . $MM_redirect);}
?>
<?php

if(isset($_GET['Submit'])){

 $_SESSION['start'] = $_GET['start'];
 $_SESSION['end'] = $_GET['end'];
 $_SESSION['class2'] = $_GET['class2'];
 $csrc_data1 = explode('-',$_GET['csrc_select']);
 $_SESSION['csrc_select'] = $csrc_data1[0];
 $_SESSION['csrc_data_select'] = $csrc_data1[1];

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
<script LANGUAGE="javascript">
function Buildkey(num) {
	var ctr=0;
	document.form1.csrc_select.selectedIndex=0;
	/*
	定義二階選單內容
	if(num=="第一階下拉選單的值") {	
	  document.form1.csrc_select.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");
	  ctr=ctr+1;
	}
	*/
	/*車禍*/
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("單位","college-1");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("性別","sex-2");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("年級","grade-3");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("地點","place-0");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("校內地點","place2-4");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("校外地點","place2-5");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("車種","car-6");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("車禍原因","reason-7");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("損傷情形","injury-8");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("送醫情形","deliver-9");	ctr=ctr+1;	}
	// 1219更改:新增從事活動
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("從事活動","activities-15");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("天候","weather-16");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("對方車種","other_car-17");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("安全帽款式","helmet-18");	ctr=ctr+1;	}
	if(num=="車禍") {	document.form1.csrc_select.options[ctr]=new Option("車齡","car_age-19");	ctr=ctr+1;	}
	// 1219(above)

	/*運動受傷*/
	if(num=="運動受傷") {	document.form1.csrc_select.options[ctr]=new Option("單位","college-1");	ctr=ctr+1;	}
	if(num=="運動受傷") {	document.form1.csrc_select.options[ctr]=new Option("性別","sex-2");	ctr=ctr+1;	}
	if(num=="運動受傷") {	document.form1.csrc_select.options[ctr]=new Option("年級","grade-3");	ctr=ctr+1;	}
	if(num=="運動受傷") {	document.form1.csrc_select.options[ctr]=new Option("地點","place-0");	ctr=ctr+1;	}
	if(num=="運動受傷") {	document.form1.csrc_select.options[ctr]=new Option("校內地點","place2-10");	ctr=ctr+1;	}
	if(num=="運動受傷") {	document.form1.csrc_select.options[ctr]=new Option("種類","sub_class-11");	ctr=ctr+1;	}
	if(num=="運動受傷") {	document.form1.csrc_select.options[ctr]=new Option("部位","part-12");	ctr=ctr+1;	}
	if(num=="運動受傷") {	document.form1.csrc_select.options[ctr]=new Option("送醫情形","deliver-9");	ctr=ctr+1;	}
	/*意外傷害*/
	if(num=="意外傷害") {	document.form1.csrc_select.options[ctr]=new Option("單位","college-1");	ctr=ctr+1;	}
	if(num=="意外傷害") {	document.form1.csrc_select.options[ctr]=new Option("性別","sex-2");	ctr=ctr+1;	}
	if(num=="意外傷害") {	document.form1.csrc_select.options[ctr]=new Option("年級","grade-3");	ctr=ctr+1;	}
	if(num=="意外傷害") {	document.form1.csrc_select.options[ctr]=new Option("地點","place-0");	ctr=ctr+1;	}
	if(num=="意外傷害") {	document.form1.csrc_select.options[ctr]=new Option("校內地點","place2-13");	ctr=ctr+1;	}
	if(num=="意外傷害") {	document.form1.csrc_select.options[ctr]=new Option("種類","sub_class-14");	ctr=ctr+1;	}
	if(num=="意外傷害") {	document.form1.csrc_select.options[ctr]=new Option("部位","part-12");	ctr=ctr+1;	}
	if(num=="意外傷害") {	document.form1.csrc_select.options[ctr]=new Option("送醫情形","deliver-9");	ctr=ctr+1;	}

	document.form1.csrc_select.length=ctr;
	document.form1.csrc_select.options[0].selected=true;
}
</script>
<script src="JSCal2/js/jscal2.js"></script>
<script src="JSCal2/js/lang/cn.js"></script>
<link rel="stylesheet" type="text/css" href="JSCal2/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="JSCal2/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="JSCal2/css/gold/gold.css" />
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
                      <h2>校安事件統計繪圖系統</h2>
                      <p><strong>§ 繪圖系統時間設定</strong></p>
                      <form action="" method="get" enctype="multipart/form-data" name="form1" id="form1">
                        <p>開始日期：
                          <button id="start_tri">選擇日期</button>
                          <input name="start" id="start"  size="10" />
                          <script type="text/javascript">
 		      Calendar.setup({
 		      inputField : "start",
 		      trigger    : "start_tri",
 		      onSelect   : function() { this.hide() },
 		      showTime   : false,
 		      dateFormat : "%Y-%m-%d",
 		      selectionType : Calendar.SEL_SINGLE,
 		      fdow:0
 		      });
 		                    </script>
                        </p>
                        <p>結束日期：
                          <button id="end_tri">選擇日期</button>
                          <input name="end" id="end"  size="10" />
                            <script type="text/javascript">
 		      Calendar.setup({
 		      inputField : "end",
 		      trigger    : "end_tri",
 		      onSelect   : function() { this.hide() },
 		      showTime   : false,
 		      dateFormat : "%Y-%m-%d",
 		      selectionType : Calendar.SEL_SINGLE,
 		      fdow:0
 		      });
 		                </script>
                        </p>
                        <p>
                          事件類別：
                            <select name="class2" id="class2" onchange="Buildkey(this.options[this.options.selectedIndex].value);">
							  <option selected="selected">請選擇...</option>
                              <option value="車禍">車禍</option>
                              <option value="運動受傷">運動受傷</option>
                              <option value="意外傷害">意外傷害</option>
                              </select>
                        </p>
                        <p>
                          統計項目：
                          <select name="csrc_select" id="csrc_select">
                          </select>
                        </p>
                        <p>&nbsp;</p>
                        <p>
                          <label>
                          <input type="submit" name="Submit" value="繪圖" />
                          </label>
                        </p>
                      </form>
                      <p>&nbsp;</p>
					  <?php if(isset($_GET['Submit'])){?>
                        <p align="center"><img src="graph_bar.php" border=0></p>
						<p align="center"><img src="graph_pie.php" border=0></p>
					  <?php }?>
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
