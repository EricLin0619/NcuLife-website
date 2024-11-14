<?php require_once('Connections/conn_LAF.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}

date_default_timezone_set("Asia/Taipei");

  $MM_redirect = "login.php";
  if (!isset($_SESSION['LAF_user'])) {header("Location: " . $MM_redirect);}
?>
<?php

if(isset($_GET['show'])){

$_SESSION['start'] = $_GET['start'];
$_SESSION['end'] = $_GET['end'];

$start = $_GET['start'];
$end = $_GET['end'];

//拾得
mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_data = "Select * from laf_data WHERE time>='$start' AND time<='$end' AND temp='N' ORDER BY time DESC";
$laf_data = mysqli_query($conn_LAF,$query_laf_data) or die(mysqli_connect_error());
$row_laf_data = mysqli_fetch_assoc($laf_data);
$totalRows_laf_data = mysqli_num_rows($laf_data);

$college_list = array("其他","文學院","理學院","工學院","管理學院","資電學院","地科學院","客家學院","生醫理工學院");
$college_num = count($college_list);
$laf_data_result = array_fill(0, $college_num+1, array_fill(0, 11, 0));

  do {
      foreach ($college_list as $college_index => $college_value) {
	    if($row_laf_data['college']==$college_value){
		   
		   $laf_data_result[$college_index][0]++; //學院總計
		   
	          switch($row_laf_data['class']){
			    case '有價票券':	$laf_data_result[$college_index][1]++; break;
			    case '3C電子':	$laf_data_result[$college_index][2]++; break;
			    case '身分證件':	$laf_data_result[$college_index][3]++; break;
			    case '運動物品':	$laf_data_result[$college_index][4]++; break;
			    case '眼鏡服裝':	$laf_data_result[$college_index][5]++; break;
			    case '文具書籍':	$laf_data_result[$college_index][6]++; break;
			    case '手錶':		$laf_data_result[$college_index][7]++; break;
				case '鑰匙':		$laf_data_result[$college_index][8]++; break;
			    default:		$laf_data_result[$college_index][9]++; break;}
	      }
        }		 
  } while ($row_laf_data = mysqli_fetch_assoc($laf_data));
  
  //類別總計
  for($j=1;$j<=10;$j++){
    for($i=0;$i<$college_num;$i++){$laf_data_result[9][$j]=$laf_data_result[9][$j]+$laf_data_result[$i][$j];}
  }
  $laf_data_result[9][0] = $laf_data_result[0][0]+$laf_data_result[1][0]+$laf_data_result[2][0]+$laf_data_result[3][0]+$laf_data_result[4][0]+$laf_data_result[5][0]+$laf_data_result[6][0]+$laf_data_result[7][0]+$laf_data_result[8][0];
  
//領回
mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_data2 = "Select * from `laf_data` WHERE `state`='所有人領回' AND time3>='$start' AND time3<='$end' AND temp='N' ORDER BY time DESC";
$laf_data2 = mysqli_query($conn_LAF,$query_laf_data2) or die(mysqli_connnect_error());
$row_laf_data2 = mysqli_fetch_assoc($laf_data2);
$totalRows_laf_data2 = mysqli_num_rows($laf_data2);

$laf_data_result2 = array_fill(0, $college_num+1, array_fill(0, 11, 0));

  do {
      foreach ($college_list as $college_index => $college_value) {
	    if($row_laf_data2['college2']==$college_value){
		   
		   $laf_data_result2[$college_index][0]++; //學院總計
		   
	          switch($row_laf_data2['class']){
			    case '有價票券':	$laf_data_result2[$college_index][1]++; break;
			    case '3C電子':	$laf_data_result2[$college_index][2]++; break;
			    case '身分證件':	$laf_data_result2[$college_index][3]++; break;
			    case '運動物品':	$laf_data_result2[$college_index][4]++; break;
			    case '眼鏡服裝':	$laf_data_result2[$college_index][5]++; break;
			    case '文具書籍':	$laf_data_result2[$college_index][6]++; break;
			    case '手錶':		$laf_data_result2[$college_index][7]++; break;
			    default:		$laf_data_result2[$college_index][8]++; break;}
	      }
        }		 
  } while ($row_laf_data2 = mysqli_fetch_assoc($laf_data2));
  
  //類別總計
  for($j=1;$j<=10;$j++){
    for($i=0;$i<$college_num;$i++){$laf_data_result2[9][$j]=$laf_data_result2[9][$j]+$laf_data_result2[$i][$j];}
  }
  $laf_data_result2[9][0] = $laf_data_result2[0][0]+$laf_data_result2[1][0]+$laf_data_result2[2][0]+$laf_data_result2[3][0]+$laf_data_result2[4][0]+$laf_data_result2[5][0]+$laf_data_result2[6][0]+$laf_data_result2[7][0]+$laf_data_result2[8][0]; 
  
}
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
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.66
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(myV)||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('有以下錯誤發生:\t\t\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
//-->
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
                      <h2>失物招領統計系統 (學院-類別)</h2>
                      <form id="form1" method="GET" action="">
                        <p><strong>§ 統計系統時間設定</strong></p>
                        <p>開始日期：
                          <button id="start_tri">選擇日期</button>
                          <input size="10" id="start" name="start" />
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
                          <input size="10" id="end" name="end" />
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
                          　　　　　　　　　　
                            <input name="Submit" type="submit" onclick="YY_checkform('form1','start','#^\([0-9]{4}\)\\-\([0-9][0-9]\)\\-\([0-9][0-9]\)$#3#2#1','3','請填入開始時間，或格式不正確!','end','#^\([0-9]{4}\)\\-\([0-9][0-9]\)\\-\([0-9][0-9]\)$#3#2#1','3','請填入結束時間，或格式不正確!');return document.MM_returnValue" value="開始統計" />
                        </p>
                        <p>
                          <input name="show" type="hidden" id="show" value="1" />
                        </p>
                      </form>
                          <?php if ((isset($_GET['show'])) && ($_GET['show'] == 1))  { // Show According To Variable's Condition ?>
                        <p>&nbsp; </p>
                        <table width="780" border="1" align="center">

                        <tr valign="middle">
                          <td colspan="11"><div align="center">
                            <p>國立中央大學　失物招領統計 【拾得】 ( <?php echo $start;?> ~ <?php echo $end;?> )                          </div>
                          </p></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">類別 \ 學院</div></td>
                          <td width="60"><div align="center">其他</div></td>
                          <td width="70"><div align="center">文學院</div></td>
                          <td width="70"><div align="center">理學院</div></td>
                          <td width="70"><div align="center">工學院</div></td>
                          <td width="70"><div align="center">管理學院</div></td>
                          <td width="70"><div align="center">資電學院</div></td>
                          <td width="70"><div align="center">地科學院</div></td>
                          <td width="70"><div align="center">客家學院</div></td>
                          <td width="70"><div align="center">生醫理工<br />
                          學院</div></td>
                          <td width="60"><div align="center">合計</div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">有價票券</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][1];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][1];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">3C電子<br />
                          </div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][2];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][2];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">身分證件<br />
                          </div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][3];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][3];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">運動物品</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][4];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][4];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">眼鏡服裝</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][5];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][5];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">文具書籍</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][6];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][6];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">手錶</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][7];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][7];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">鑰匙</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][8];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][8];?></div></td>
                        </tr>
						<tr>
                          <td width="100"><div align="center">其它</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][9];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][9];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">總計</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[0][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[0][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[1][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[1][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[2][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[2][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[3][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[3][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[4][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[4][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[5][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[5][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[6][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[6][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[7][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[7][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result[8][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[8][0];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result[9][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result[9][0];?></div></td>
                        </tr>
                      </table>
					  <p>&nbsp;</p>
                      <table width="780" border="1" align="center">

                        <tr valign="middle">
                          <td colspan="11"><div align="center">
                            <p>國立中央大學　失物招領統計 【領回】 ( <?php echo $start;?> ~ <?php echo $end;?> )                          </div>
                          </p></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">類別 \ 學院</div></td>
                          <td width="60"><div align="center">其他</div></td>
                          <td width="70"><div align="center">文學院</div></td>
                          <td width="70"><div align="center">理學院</div></td>
                          <td width="70"><div align="center">工學院</div></td>
                          <td width="70"><div align="center">管理學院</div></td>
                          <td width="70"><div align="center">資電學院</div></td>
                          <td width="70"><div align="center">地科學院</div></td>
                          <td width="70"><div align="center">客家學院</div></td>
                          <td width="70"><div align="center">生醫理工<br />
                          學院</div></td>
                          <td width="60"><div align="center">合計</div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">有價票券</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][1];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][1];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][1]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][1];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">3C電子<br />
                          </div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][2];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][2];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][2]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][2];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">身分證件<br />
                          </div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][3];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][3];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][3]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][3];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">運動物品</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][4];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][4];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][4]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][4];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">眼鏡服裝</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][5];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][5];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][5]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][5];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">文具書籍</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][6];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][6];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][6]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][6];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">手錶</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][7];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][7];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][7]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][7];?></div></td>
                        </tr>
						<tr>
                          <td width="100"><div align="center">鑰匙</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][8];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][8];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][8]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][8];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">其它</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][9];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][9];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][9]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][9];?></div></td>
                        </tr>
                        <tr>
                          <td width="100"><div align="center">總計</div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[0][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[0][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[1][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[1][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[2][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[2][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[3][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[3][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[4][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[4][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[5][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[5][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[6][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[6][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[7][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[7][0];?></div></td>
                          <td width="70"><div align="center"<?php if($laf_data_result2[8][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[8][0];?></div></td>
                          <td width="60"><div align="center"<?php if($laf_data_result2[9][0]>0){echo " style=\"color:#FF0000\"";}?>><?php echo $laf_data_result2[9][0];?></div></td>
                        </tr>
                      </table>
                      <p>&nbsp;</p>
                      <!--
					  <p><strong>§ 失物招領統計圖-類別總計</strong></p>
                        <p align="center"><img src="statistics_graph_bar.php" border=0></p>
						<p align="center"><img src="statistics_graph_pie.php" border=0></p>
					  <p><strong>§ 失物招領統計圖-學院總計</strong></p>
						<p align="center"><img src="statistics_graph_bar2.php" border=0></p>
						<p align="center"><img src="statistics_graph_pie2.php" border=0></p>
                      -->
					  <?php } // Show According To Variable's Condition ?>
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
