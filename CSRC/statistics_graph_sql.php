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
$csrc_data_result = array_fill(0, $college_num+2, array_fill(0, 20, 0));

  do {
      foreach ($college_list as $college_index => $college_value) {
	    if($row_csrc_data['college']==$college_value){
		   $csrc_data_result[$college_index][0]++; //學院總計
	          switch($row_csrc_data['class2']){
			    case '車禍':		$csrc_data_result[$college_index][1]++; break;
			    case '詐騙':		$csrc_data_result[$college_index][2]++; break;
			    case '運動受傷':	$csrc_data_result[$college_index][3]++; break;
			    case '意外傷害':	$csrc_data_result[$college_index][4]++; break;
			    case '意外死亡':	$csrc_data_result[$college_index][5]++; break;
			    case '火災':		$csrc_data_result[$college_index][6]++; break;
			    case '生病':		$csrc_data_result[$college_index][7]++; break;
			    case '送醫':		$csrc_data_result[$college_index][8]++; break;
			    case '協尋':		$csrc_data_result[$college_index][9]++; break;
			    case '物品尋獲':	$csrc_data_result[$college_index][10]++; break;
			    case '遺失':		$csrc_data_result[$college_index][11]++; break;
			    case '竊盜':		$csrc_data_result[$college_index][12]++; break;
			    case '設備故障':	$csrc_data_result[$college_index][13]++; break;
			    case '校外糾紛':	$csrc_data_result[$college_index][14]++; break;
			    case '校內糾紛':	$csrc_data_result[$college_index][15]++; break;
			    case '賃居糾紛':	$csrc_data_result[$college_index][16]++; break;
				case '情緒不穩':	$csrc_data_result[$college_index][17]++; break;
				case '自我傷害':	$csrc_data_result[$college_index][18]++; break;
				case '疑似性平':	$csrc_data_result[$college_index][19]++; break;
			    default:		$csrc_data_result[$college_index][20]++; break;}
	      }
        }		 
  } while ($row_csrc_data = mysqli_fetch_assoc($csrc_data));
  
  //事件總計
  for($j=1;$j<=20;$j++){
    for($i=0;$i<$college_num;$i++){$csrc_data_result[9][$j]=$csrc_data_result[9][$j]+$csrc_data_result[$i][$j];}
  }
  $csrc_data_result[10][1]=$csrc_data_result[9][1]+$csrc_data_result[9][2]+$csrc_data_result[9][3]+$csrc_data_result[9][4]+$csrc_data_result[9][5]+$csrc_data_result[9][6];
  $csrc_data_result[10][2]=$csrc_data_result[9][7]+$csrc_data_result[9][8]+$csrc_data_result[9][9];
  $csrc_data_result[10][3]=$csrc_data_result[9][10]+$csrc_data_result[9][11]+$csrc_data_result[9][12]+$csrc_data_result[9][13];
  $csrc_data_result[10][4]=$csrc_data_result[9][14]+$csrc_data_result[9][15]+$csrc_data_result[9][16];
  $csrc_data_result[10][5]=$csrc_data_result[9][17]+$csrc_data_result[9][18]+$csrc_data_result[9][19]+$csrc_data_result[9][20];
  $csrc_data_result[10][0]=$csrc_data_result[10][1]+$csrc_data_result[10][2]+$csrc_data_result[10][3]+$csrc_data_result[10][4]+$csrc_data_result[10][5];
?>