<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}

date_default_timezone_set("Asia/Taipei");

$MM_redirect = "login.php";
if (!isset($_SESSION['CSRC_user'])) {
  header("Location: " . $MM_redirect);
}
?>
<?php

if (isset($_GET['show'])) {

  $_SESSION['start'] = $_GET['start'];
  $_SESSION['end'] = $_GET['end'];

  $start = $_GET['start'];
  $end = $_GET['end'];

  mysqli_select_db($conn_CSRC, $database_conn_CSRC);
  $query_csrc_data = "Select * from csrc_data WHERE time>='$start' AND time<='$end' AND temp='N' ORDER BY time DESC ";
  // 過濾掉駐警隊的紀錄
  // $query_csrc_data = "Select * from csrc_data WHERE time>='$start' AND time<='$end' AND temp='N' AND user_dep = '生輔組' ORDER BY time DESC ";
  $csrc_data = mysqli_query($conn_CSRC, $query_csrc_data) or die(mysqli_connect_error());
  $row_csrc_data = mysqli_fetch_assoc($csrc_data);
  $totalRows_csrc_data = mysqli_num_rows($csrc_data);

  $college_list = array("其他", "文學院", "理學院", "工學院", "管理學院", "資電學院", "地科學院", "客家學院", "生醫理工學院");
  $college_num = count($college_list);
  $csrc_data_result = array_fill(0, $college_num + 2, array_fill(0, 54, 0));
  $csrc_data_result2 = array_fill(0, $college_num + 1, 0);

  do {
    // user forget select college -> assign "其他"
    if ($row_csrc_data['college'] == NULL){
      $row_csrc_data['college'] ="其他";
    }
    foreach ($college_list as $college_index => $college_value) {
      if ($row_csrc_data['college'] == $college_value) {

        $csrc_data_result[$college_index][0]++; //學院總計
        if (($row_csrc_data['class2'] == '車禍') && (($row_csrc_data['car'] == '腳踏車') || ($row_csrc_data['car'] == '腳踏車(公有)') || ($row_csrc_data['car'] == '腳踏車(私人)'))) {
          $csrc_data_result2[$college_index]++;
        } //腳踏車統計
        switch ($row_csrc_data['class']) {
          case '意外事件':
            switch ($row_csrc_data['class2']) {
              case '車禍':
                $csrc_data_result[$college_index][1]++;
                break;
              case '詐騙':
                $csrc_data_result[$college_index][2]++;
                break;
              case '運動受傷':
                $csrc_data_result[$college_index][3]++;
                break;
              case '意外傷害':
                $csrc_data_result[$college_index][4]++;
                break;
              case '意外死亡':
                $csrc_data_result[$college_index][5]++;
                break;
              case '火災':
                $csrc_data_result[$college_index][6]++;
                break;
              default:
                $csrc_data_result[$college_index][7]++;
                break;
            }
            break;
          case '一般事件':
            switch ($row_csrc_data['class2']) {
              case '生病':
                $csrc_data_result[$college_index][8]++;
                break;
              case '送醫':
                $csrc_data_result[$college_index][9]++;
                break;
              case '協尋':
                $csrc_data_result[$college_index][10]++;
                break;
              default:
                $csrc_data_result[$college_index][11]++;
                break;
            }
            break;
          case '財務事件':
            switch ($row_csrc_data['class2']) {
              case '物品尋獲':
                $csrc_data_result[$college_index][12]++;
                break;
              case '遺失':
                $csrc_data_result[$college_index][13]++;
                break;
              case '竊盜':
                $csrc_data_result[$college_index][14]++;
                break;
              case '設備故障':
                $csrc_data_result[$college_index][15]++;
                break;
              default:
                $csrc_data_result[$college_index][16]++;
                break;
            }
            break;
          case '糾紛事件':
            switch ($row_csrc_data['class2']) {
              case '校外糾紛':
                $csrc_data_result[$college_index][17]++;
                break;
              case '校內糾紛':
                $csrc_data_result[$college_index][18]++;
                break;
              case '賃居糾紛':
                $csrc_data_result[$college_index][19]++;
                break;
              default:
                $csrc_data_result[$college_index][20]++;
                break;
            }
            break;
          case '職業災害':
            switch ($row_csrc_data['class2']) {
              case '墜落、滾落':
                $csrc_data_result[$college_index][21]++;
                break;
              case '跌倒':
                $csrc_data_result[$college_index][22]++;
                break;
              case '衝撞':
                $csrc_data_result[$college_index][23]++;
                break;
              case '物體飛落':
                $csrc_data_result[$college_index][24]++;
                break;
              case '物體倒塌、崩塌':
                $csrc_data_result[$college_index][25]++;
                break;
              case '被撞':
                $csrc_data_result[$college_index][26]++;
                break;
              case '被夾':
                $csrc_data_result[$college_index][27]++;
                break;
              case '被捲':
                $csrc_data_result[$college_index][28]++;
                break;
              case '被切、割、擦傷':
                $csrc_data_result[$college_index][29]++;
                break;
              case '踩踏':
                $csrc_data_result[$college_index][30]++;
                break;
              case '溺水':
                $csrc_data_result[$college_index][31]++;
                break;
              case '與高溫、低溫物體之接觸':
                $csrc_data_result[$college_index][32]++;
                break;
              case '與有害物之接觸':
                $csrc_data_result[$college_index][33]++;
                break;
              case '感電':
                $csrc_data_result[$college_index][34]++;
                break;
              case '爆炸':
                $csrc_data_result[$college_index][35]++;
                break;
              case '物體破裂':
                $csrc_data_result[$college_index][36]++;
                break;
              case '火災':
                $csrc_data_result[$college_index][37]++;
                break;
              case '不當動作':
                $csrc_data_result[$college_index][38]++;
                break;
              case '鐵公路交通事故':
                $csrc_data_result[$college_index][39]++;
                break;
              case '其他交通事故':
                $csrc_data_result[$college_index][40]++;
                break;
            }
            break;
          case '毒化災事件':
            switch ($row_csrc_data['class2']) {
              case '化學品洩漏':
                $csrc_data_result[$college_index][41]++;
                break;
              case '化學品火災、爆炸':
                $csrc_data_result[$college_index][42]++;
                break;
            }
            break;
          case '輻射事件':
            switch ($row_csrc_data['class2']) {
              case '人員輻射誤照射':
                $csrc_data_result[$college_index][43]++;
                break;
              case '放射性物質洩漏':
                $csrc_data_result[$college_index][44]++;
                break;
              case '放射性物質遺失':
                $csrc_data_result[$college_index][45]++;
                break;
            }
            break;
          case '環保事件':
            switch ($row_csrc_data['class2']) {
              case '廢水異常排放':
                $csrc_data_result[$college_index][46]++;
                break;
              case '廢氣異常排放':
                $csrc_data_result[$college_index][47]++;
                break;
              case '廢棄物異常丟棄':
                $csrc_data_result[$college_index][48]++;
                break;
              case '噪音量異常':
                $csrc_data_result[$college_index][49]++;
                break;
            }
            break;
          case '其他事件':
            switch ($row_csrc_data['class2']) {
              case '情緒不穩':
                $csrc_data_result[$college_index][50]++;
                break;
              case '自我傷害':
                $csrc_data_result[$college_index][51]++;
                break;
              case '疑似性平':
                $csrc_data_result[$college_index][52]++;
                break;
              default:
                $csrc_data_result[$college_index][53]++;
                break;
            }
            break;
        }
      }
    }
  } while ($row_csrc_data = mysqli_fetch_assoc($csrc_data));

  //事件總計
  for ($j = 0; $j <= 53; $j++) {
    for ($i = 0; $i < $college_num; $i++) {
      $csrc_data_result[9][$j] = $csrc_data_result[9][$j] + $csrc_data_result[$i][$j];
    }
  }
  for ($i = 1; $i <= 7; $i++) {
    $csrc_data_result[10][1] = $csrc_data_result[10][1] + $csrc_data_result[9][$i];
  }
  for ($i = 8; $i <= 11; $i++) {
    $csrc_data_result[10][2] = $csrc_data_result[10][2] + $csrc_data_result[9][$i];
  }
  for ($i = 12; $i <= 16; $i++) {
    $csrc_data_result[10][3] = $csrc_data_result[10][3] + $csrc_data_result[9][$i];
  }
  for ($i = 17; $i <= 20; $i++) {
    $csrc_data_result[10][4] = $csrc_data_result[10][4] + $csrc_data_result[9][$i];
  }
  for ($i = 21; $i <= 40; $i++) {
    $csrc_data_result[10][5] = $csrc_data_result[10][5] + $csrc_data_result[9][$i];
  }
  for ($i = 41; $i <= 42; $i++) {
    $csrc_data_result[10][6] = $csrc_data_result[10][6] + $csrc_data_result[9][$i];
  }
  for ($i = 43; $i <= 45; $i++) {
    $csrc_data_result[10][7] = $csrc_data_result[10][7] + $csrc_data_result[9][$i];
  }
  for ($i = 46; $i <= 49; $i++) {
    $csrc_data_result[10][8] = $csrc_data_result[10][8] + $csrc_data_result[9][$i];
  }
  for ($i = 50; $i <= 53; $i++) {
    $csrc_data_result[10][9] = $csrc_data_result[10][9] + $csrc_data_result[9][$i];
  }
  for ($i = 1; $i <= 9; $i++) {
    $csrc_data_result[10][0] = $csrc_data_result[10][0] + $csrc_data_result[10][$i];
  }

  $csrc_data_result2[9] = $csrc_data_result2[0] + $csrc_data_result2[1] + $csrc_data_result2[2] + $csrc_data_result2[3] + $csrc_data_result2[4] + $csrc_data_result2[5] + $csrc_data_result2[6] + $csrc_data_result2[7] + $csrc_data_result2[8];

  $max = 0;
  for ($m = 1; $m <= 53; $m++) {
    $max = max($max, $csrc_data_result[9][$m]);
  }
  while ($max % 5 != 0) {
    $max++;
  }
  $max1 = $max / 5;
  $max2 = $max1 / 2;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- InstanceBegin template="/Templates/CSRC.dwt" codeOutsideHTMLIsLocked="false" -->

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
<![endif]-->
  <!--[if IE]>
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
                      <?php if (isset($_SESSION['CSRC_user'])) { ?><p>
                          <a href="index.php">校安狀況列表</a>　
                          <a href="add.php">填寫校安狀況</a>　
                          <a href="list.php">校安狀況查詢</a>　
                          <a href="search.php">校安狀況搜尋</a>　
                          <a href="statistics_new.php">校安狀況統計</a>　
                          <a href="statistics_plot.php">校安狀況繪圖</a>　
                          <?php if (isset($_SESSION['CSRC_user'])) { ?>
                            <a href="logout.php">使用者登出</a>　
                          <?php } ?>
                        </p>
                      <?php } ?>
                      <?php if (isset($_SESSION['CSRC_user']) && ($_SESSION['CSRC_dapartment'] == "生輔組")) { ?><p>
                          <a href="worksheet.php">工作日誌列表</a>　
                          <a href="worksheet_add.php">填寫工作日誌</a>　
                          <a href="worksheet_list.php">工作日誌查詢</a>　
                          <a href="worksheet_search.php">工作日誌搜尋</a>　
                          <?php if ($_SESSION['CSRC_authority'] == '1') { ?>
                            <a href="member.php">人員權限管理</a>　
                          <?php } ?>
                        </p>
                      <?php } ?>
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
                      <h2>校安事件統計系統</h2>
                      <form id="form1" method="GET" action="">
                        <p><strong>§ 統計系統時間設定</strong></p>
                        <p>開始日期：
                          <button id="start_tri">選擇日期</button>
                          <input size="10" id="start" name="start" />
                          <script type="text/javascript">
                            Calendar.setup({
                              inputField: "start",
                              trigger: "start_tri",
                              onSelect: function() {
                                this.hide()
                              },
                              showTime: false,
                              dateFormat: "%Y-%m-%d",
                              selectionType: Calendar.SEL_SINGLE,
                              fdow: 0
                            });
                          </script>
                        </p>
                        <p>結束日期：
                          <button id="end_tri">選擇日期</button>
                          <input size="10" id="end" name="end" />
                          <script type="text/javascript">
                            Calendar.setup({
                              inputField: "end",
                              trigger: "end_tri",
                              onSelect: function() {
                                this.hide()
                              },
                              showTime: false,
                              dateFormat: "%Y-%m-%d",
                              selectionType: Calendar.SEL_SINGLE,
                              fdow: 0
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
                      <?php if ((isset($_GET['show'])) && ($_GET['show'] == 1)) { // Show According To Variable's Condition 
                      ?>
                        <p>&nbsp; </p>
                        <table width="800" border="1" align="center">

                          <tr valign="middle">
                            <td colspan="13">
                              <div align="center">
                                <p>校安中心　校安事件統計 ( <?php echo $start; ?> ~ <?php echo $end; ?> )
                              </div>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <div align="center">項　　目</div>
                            </td>
                            <td width="60">
                              <div align="center">其他</div>
                            </td>
                            <td width="60">
                              <div align="center">文學院</div>
                            </td>
                            <td width="60">
                              <div align="center">理學院</div>
                            </td>
                            <td width="60">
                              <div align="center">工學院</div>
                            </td>
                            <td width="70">
                              <div align="center">管理學院</div>
                            </td>
                            <td width="70">
                              <div align="center">資電學院</div>
                            </td>
                            <td width="70">
                              <div align="center">地科學院</div>
                            </td>
                            <td width="70">
                              <div align="center">客家學院</div>
                            </td>
                            <td width="70">
                              <div align="center">生醫理工<br />
                                學院</div>
                            </td>
                            <td width="60">
                              <div align="center">小計</div>
                            </td>
                            <td width="60">
                              <div align="center">總計</div>
                            </td>
                          </tr>
                          <tr>
                            <td width="20" rowspan="7" align="center">意
                              <br />
                              外
                              <br />
                              事
                              <br />
                              件
                            </td>
                            <td width="70">
                              <div align="center">車禍</div>
                            </td>
                            <td width="60">
                              <div align="center" <?php if ($csrc_data_result[0][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[0][1]; ?><?php echo ' (' . $csrc_data_result2[0] . ')'; ?></div>
                            </td>
                            <td width="60">
                              <div align="center" <?php if ($csrc_data_result[1][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[1][1]; ?><?php echo ' (' . $csrc_data_result2[1] . ')'; ?></div>
                            </td>
                            <td width="60">
                              <div align="center" <?php if ($csrc_data_result[2][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[2][1]; ?><?php echo ' (' . $csrc_data_result2[2] . ')'; ?></div>
                            </td>
                            <td width="60">
                              <div align="center" <?php if ($csrc_data_result[3][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[3][1]; ?><?php echo ' (' . $csrc_data_result2[3] . ')'; ?></div>
                            </td>
                            <td width="70">
                              <div align="center" <?php if ($csrc_data_result[4][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[4][1]; ?><?php echo ' (' . $csrc_data_result2[4] . ')'; ?></div>
                            </td>
                            <td width="70">
                              <div align="center" <?php if ($csrc_data_result[5][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[5][1]; ?><?php echo ' (' . $csrc_data_result2[5] . ')'; ?></div>
                            </td>
                            <td width="70">
                              <div align="center" <?php if ($csrc_data_result[6][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[6][1]; ?><?php echo ' (' . $csrc_data_result2[6] . ')'; ?></div>
                            </td>
                            <td width="70">
                              <div align="center" <?php if ($csrc_data_result[7][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[7][1]; ?><?php echo ' (' . $csrc_data_result2[7] . ')'; ?></div>
                            </td>
                            <td width="70">
                              <div align="center" <?php if ($csrc_data_result[8][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[8][1]; ?><?php echo ' (' . $csrc_data_result2[8] . ')'; ?></div>
                            </td>
                            <td width="60">
                              <div align="center" <?php if ($csrc_data_result[9][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[9][1]; ?><?php echo ' (' . $csrc_data_result2[9] . ')'; ?></div>
                            </td>
                            <td width="60" rowspan="7">
                              <div align="center" <?php if ($csrc_data_result[10][1] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][1]; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">詐騙</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][2];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">運動受傷</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][3];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">意外傷害</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][4];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">意外死亡</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][5];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">火災</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][6];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">其他</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][7];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="20" rowspan="4" align="center">一<br />
                              般<br />
                              事<br />
                              件<br /></td>
                            <td width="70">
                              <div align="center">生病</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][8];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                            <td width="60" rowspan="4">
                              <div align="center" <?php if ($csrc_data_result[10][2] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][2]; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">送醫</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][9];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">協尋</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][10];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">其他</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][11];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="20" rowspan="5" align="center">財<br />
                              務<br />
                              事<br />
                              件<br /></td>
                            <td width="70">
                              <div align="center">物品尋獲</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][12];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                            <td width="60" rowspan="5">
                              <div align="center" <?php if ($csrc_data_result[10][3] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][3]; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">遺失</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][13];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">竊盜</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][14];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">設備故障</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][15];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">其他</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][16];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="20" rowspan="4" align="center">糾<br />
                              紛<br />
                              事<br />
                              件<br /> </td>
                            <td width="70">
                              <div align="center">校外糾紛</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][17];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                            <td width="60" rowspan="4">
                              <div align="center" <?php if ($csrc_data_result[10][4] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][4]; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">校內糾紛</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][18];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">賃居糾紛</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][19];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">其他</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][20];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="20" rowspan="20" align="center">職<br />
                              業<br />
                              災<br />
                              害<br /> </td>
                            <td width="70">
                              <div align="center">墜落、滾落</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][21];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                            <td width="60" rowspan="20">
                              <div align="center" <?php if ($csrc_data_result[10][5] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][5]; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">跌倒</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][22];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">衝撞</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][23];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">物體飛落</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][24];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">物體倒塌、崩塌</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][25];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">被撞</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][26];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">被夾</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][27];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">被捲</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][28];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">被切、割、擦傷</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][29];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">踩踏</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][30];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">溺水</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][31];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">與高溫、低溫物體之接觸</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][32];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">與有害物之接觸</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][33];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">感電</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][34];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">爆炸</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][35];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">物體破裂</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][30];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">火災</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][37];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">不當動作</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][38];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">鐵公路交通事故</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][39];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">其他交通事故</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][40];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="20" rowspan="2" align="center">毒<br />
                              化<br />
                              災<br />
                              事<br /> 
                              件<br/></td>
                            <td width="70">
                              <div align="center">化學品洩漏</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][41];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                            <td width="60" rowspan="2">
                              <div align="center" <?php if ($csrc_data_result[10][6] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][6]; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">化學品火災、爆炸</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][42];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="20" rowspan="3" align="center">輻<br />
                              射<br />
                              事<br />
                              件<br /> </td>
                            <td width="70">
                              <div align="center">人員輻射誤照射</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][43];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                            <td width="60" rowspan="3">
                              <div align="center" <?php if ($csrc_data_result[10][7] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][7]; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">放射性物質洩漏</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][44];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">放射性物質遺失</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][45];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="20" rowspan="4" align="center">環<br />
                              保<br />
                              事<br />
                              件<br /> </td>
                            <td width="70">
                              <div align="center">廢水異常排放</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][46];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                            <td width="60" rowspan="4">
                              <div align="center" <?php if ($csrc_data_result[10][7] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][7]; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">廢氣異常排放</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][47];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">廢棄物異常丟棄</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][48];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">噪音量異常</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][49];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="20" rowspan="4" align="center">其<br />
                              他<br />
                              事<br />
                              件<br /> </td>
                            <td width="70">
                              <div align="center">情緒不穩</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][50];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                            <td width="60" rowspan="4">
                              <div align="center" <?php if ($csrc_data_result[10][9] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][9]; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">自我傷害</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][51];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">疑似性平</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][52];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td width="70">
                              <div align="center">其他</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][53];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                          </tr>
                          <tr>
                            <td colspan="2" align="center">
                              <div align="center">總計</div>
                            </td>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                              $render_data = $csrc_data_result[$i][0];
                              if ($render_data > 0) {
                                echo "<td width='60'><div align='center' style='color:#FF0000'>$render_data</div></td>";
                              } else {
                                echo "<td width='60'><div align='center'>$render_data</div></td>";
                              }
                            }
                            ?>
                            <td width="60">
                              <div align="center" <?php if ($csrc_data_result[10][0] > 0) {
                                                    echo " style=\"color:#FF0000\"";
                                                  } ?>><?php echo $csrc_data_result[10][0]; ?></div>
                            </td>
                          </tr>
                        </table>
                        <p>&nbsp;</p>
                        <p><strong>§ 校安事件統計圖-事件總計</strong></p>
                        <p align="center"><img src="statistics_graph_bar_new.php" border=0></p>
                        <p align="center"><img src="statistics_graph_pie_new.php" border=0></p>
                        <p><strong>§ 校安事件統計圖-學院總計</strong></p>
                        <p align="center"><img src="statistics_graph_bar2.php" border=0></p>
                        <p align="center"><img src="statistics_graph_pie2.php" border=0></p>
                      <?php } // Show According To Variable's Condition 
                      ?>
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
<!-- InstanceEnd -->

</html>