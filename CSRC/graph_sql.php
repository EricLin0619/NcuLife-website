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
//$class2="車禍";
$class2= $_SESSION['class2'];

mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_data = "Select * from `csrc_data` WHERE `time`>='$start' AND `time`<='$end' AND `class2`='$class2' AND `temp`='N' ORDER BY `time` DESC";
$csrc_data = mysqli_query($conn_CSRC,$query_csrc_data) or die(mysqli_connect_error());
$row_csrc_data = mysqli_fetch_assoc($csrc_data);
$totalRows_csrc_data = mysqli_num_rows($csrc_data);

$csrc_list_array['0'] = array("校內","校外","其他"); //place
$csrc_list_array['1'] = array("其他","文學院","理學院","工學院","管理學院","資電學院","地科學院","客家學院","生醫理工學院"); //college
$csrc_list_array['2'] = array("男","女"); //sex
$csrc_list_array['3'] = array("大一","大二","大三","大四","碩士班","博士班","其他"); //grade
$csrc_list_array['4'] = array("百花川","圓環","行政大樓前","校長宿舍前","國鼎圖書館前","小木屋前","科二館前","中大湖前","游泳池前","側門(北村出口)","環工所前","機械館前","松苑餐廳前","國際處前","女1-4舍下坡","科一館前","遊藝館前","大講堂前","其他"); //place2(校內)(車禍)
$csrc_list_array['5'] = array("宵夜街","五興路","中央路","中大路","中正路","民族路","志廣路","三民路","環南路","環西路","環北路","中豐路","省道","高速公路"); //place2(校外)(車禍)
$csrc_list2 = array("宵\n夜\n街","五\n興\n路","中\n央\n路","中\n大\n路","中\n正\n路","民\n族\n路","志\n廣\n路","三\n民\n路","環\n南\n路","環\n西\n路","環\n北\n路","中\n豐\n路","省\n道","高\n速\n公\n路"); //place2(校外)(車禍)
$csrc_list_array['6'] = array("腳踏車(公有)","腳踏車(私人)","機車","汽車"); //car
$csrc_list_array['7'] = array("擦撞","自行摔倒","機件故障","光線不足","路況不佳","未遵守交通規則","車速過快","其他"); //reason
$csrc_list3 = array("擦撞","自行摔倒","機件故障","光線不足","路況不佳","未遵守\n交通規則","車速過快","其他"); //reason
$csrc_list_array['8'] = array("身體輕傷","身體重傷","車輛損傷"); //injury
$csrc_list_array['9'] = array("計程車送醫","救護車送醫","自行就醫","無需就醫"); //deliver
$csrc_list_array['10'] = array("棒壘球場","室外籃球場","羽球館","室外排球場","依仁堂","游泳池","溜冰場","網球場","操場"); //place2(校內)(運動傷害)
$csrc_list_array['11'] = array("擦傷","挫撞傷","裂割傷","扭傷","脫臼","骨折"); //sub_class(運動傷害)
$csrc_list_array['12'] = array("頭部","顏面","頸部","胸部","腹部","背部","臀部","左上肢","右上肢","左下肢","右下肢"); //part
$csrc_list_array['13'] = array("校內草坪","學生宿舍","圖書館","餐廳","辦公室","一般教室","實驗教室","樓梯","中大湖","停車場"); //place2(校內)(意外傷害)
$csrc_list_array['14'] = array("動物咬傷","蛇蟲叮咬","燙傷","灼傷","擦傷","挫撞傷","裂割傷","扭傷","脫臼","骨折"); //sub_class(意外傷害)

// 1219更新:新增從事活動
$csrc_list_array['15'] = array("上學途中", "離校途中", "校外教學", "假期當中", "系學會活動", "其他");
$csrc_list_array['16'] = array("雨天", "晴天", "陰天");
$csrc_list_array['17'] = array("汽車", "機車", "自行車", "電動腳踏車", "大眾運輸", "步行", "其它");
$csrc_list_array['18'] = array("未戴", "全罩式", "四分之三罩式", "半罩式西瓜皮式", "其它");
$csrc_list_array['19'] = array("1年以內", "1-3年", "4-6年", "7-10年", "10-15年", "16年以上");
// 1219(above)

//$csrc_select = 'sex';
$csrc_select = $_SESSION['csrc_select'];
$csrc_data_select = $_SESSION['csrc_data_select'];
$csrc_list = $csrc_list_array[$csrc_data_select];

$csrc_list_count = count($csrc_list);
$csrc_data_result = array_fill(0, $csrc_list_count, 0);

  do {
  	foreach ($csrc_list as $csrc_index => $csrc_value) {
  	  if(($csrc_data_select=='6')||($csrc_data_select=='8')||($csrc_data_select=='11')||($csrc_data_select=='12')||($csrc_data_select=='14')){

  	     if(strstr($row_csrc_data[$csrc_select], $csrc_value)){ $csrc_data_result[$csrc_index]++; }
         
  	  }else{
  	     if($row_csrc_data[$csrc_select]==$csrc_value){ $csrc_data_result[$csrc_index]++; }
  	  }	
  	}
  } while ($row_csrc_data = mysqli_fetch_assoc($csrc_data));

  $max = 0;
  for($m=0;$m<$csrc_list_count;$m++) { $max = max($max, $csrc_data_result[$m]); }
  while($max % 5 !=0){$max++;}  
  $max1 = $max / 5;
  $max2 = $max1 / 2;

?>