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

//$start="2012-08-01";
$start = $_SESSION['start'];
//$end="2012-08-31";
$end = $_SESSION['end'];

mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_data = "Select * from csrc_data WHERE time>='$start' AND time<='$end' AND temp='N' ORDER BY time DESC";
$csrc_data = mysqli_query($conn_CSRC,$query_csrc_data) or die(mysqli_connect_error());
$row_csrc_data = mysqli_fetch_assoc($csrc_data);
$totalRows_csrc_data = mysqli_num_rows($csrc_data);

$college_list = array("其他","文學院","理學院","工學院","管理學院","資電學院","地科學院","客家學院","生醫理工學院");
$college_num = count($college_list);
$csrc_data_result = array_fill(0, $college_num+2, array_fill(0, 54, 0));

do {
    foreach ($college_list as $college_index => $college_value) {
      if ($row_csrc_data['college'] == $college_value) {

        $csrc_data_result[$college_index][0]++; //學院總計
        if (($row_csrc_data['class2'] == '車禍') && (($row_csrc_data['car'] == '腳踏車') || ($row_csrc_data['car'] == '腳踏車(公有)') || ($row_csrc_data['car'] == '腳踏車(私人)')) && ($row_csrc_data['reason'] == '自行摔倒')) {
          $csrc_data_result2[$college_index]++;
        } //腳踏車自摔統計
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
?>