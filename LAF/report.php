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



  
$currentPage = $_SERVER["PHP_SELF"];
$maxRows_laf_data = 1000;
$pageNum_laf_data = 0;

if (isset($_GET['pageNum_laf_data'])) {
  $pageNum_laf_data = $_GET['pageNum_laf_data'];
}
$startRow_laf_data = $pageNum_laf_data * $maxRows_laf_data;

mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_data = sprintf("SELECT * FROM `laf_data` WHERE time BETWEEN '$start' AND '$end' ORDER BY time");
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


// Check if the 'class' variable is set in the URL parameters
  if (isset($_GET['class'])) {
    $class = $_GET['class']; // Assign the value from the URL parameter
  } else {
    // If 'class' is not set, set it to an empty string or a default value
    $class = '';
  }

  
}
?>

<?php

?>

?>

<style type="text/css">
  .style3 {color: #FFFFFF; font-weight: bold; font-size:15px;}
</style>

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
                      <h2>失物招領統計系統 (月份-類別)</h2>
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



                    
                         <button id="btnExport" onclick="exportReportToExcel(this)">EXPORT REPORT</button>
            <script type="text/javascript">
            function exportReportToExcel() {
              let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
              TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
                name: `遺失物報表<?php echo $start ?> - <?php echo $end ?>.xlsx`, // fileName you could use any name
                sheet: {
                  name: 'Sheet 1' // sheetName
                }
              });
            }
            </script>
                      <p><b>§ <?php echo $class;?> 事件列表 (共 <?php echo $totalRows_laf_data;?> 件)</b></p>
                      <table width="1000" border="0" id="masterdata">
                        <tr>
                          <td width="700" bgcolor="#104E8B"><div align="center"><span class="style3">編號</span></div></td>
                          <td width="700" bgcolor="#104E8B"><div align="center"><span class="style3">拾得日期</span></div></td>
                          <td width="2000" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人單位</span></div></td>
                          <td width="800" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人年級</span></div></td>
                          <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人學號</span></div></td>
                          <td width="800" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人姓名</span></div></td>
                          <td width="200" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人電話</span></div></td>
                          <td width="800" bgcolor="#104E8B"><div align="center"><span class="style3">拾得物品名</span></div></td>
                          <td width="800" bgcolor="#104E8B"><div align="center"><span class="style3">拾得人拋棄</span></div></td>
                          <td width="800" bgcolor="#104E8B"><div align="center"><span class="style3">處理結果</span></div></td>
                          <td width="700" bgcolor="#104E8B"><div align="center"><span class="style3">未領取後續處理</span></div></td>
                          <td width="100">&nbsp;</td>
                        </tr>
                      <?php if($totalRows_laf_data>0){?>
             <?php do { ?>
                        <tr valign="top">
                          <td width="700"><div align="center" class="style5"><?php echo $row_laf_data['number'];?></div></td>
                          <td width="700"><div align="center" class="style5"><?php echo $row_laf_data['time'];?><br><?php echo $row_laf_data['time2'];?></div></td>
                          <td width="2000" class="style5"><div align="center"><?php echo $row_laf_data['college'],$row_laf_data['department'];?></div></td>
                          <td width="800" class="style5"><div align="center"><?php echo $row_laf_data['grade'];?></div></td>
              <td width="300" class="style5"><div align="center"><?php echo $row_laf_data['student_id'];?></div></td>
              <td width="800" class="style5"><div align="center"><?php echo $row_laf_data['name'];?></div></td>
              <td width="200" class="style5"><div align="center"><?php echo $row_laf_data['tel'];?></div></td>
              <td width="800" class="style5"><div align="center"><?php echo $row_laf_data['missing_name'];?></div></td>
              <td width="800" class="style5"><div align="center"><?php echo $row_laf_data['containing'];?></div></td>
              <td width="800" class="style5"><div align="center"><?php echo $row_laf_data['state'];?></div></td>
              <td width="700" class="style5"><div align="center"><?php echo $row_laf_data['state2'];?></div></td>
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
