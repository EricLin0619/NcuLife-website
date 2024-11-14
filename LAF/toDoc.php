<?php require_once('Connections/conn_LAF.php'); ?>
<?php
header("Content-Type: text/html; charset=utf-8");

if(strstr($_SERVER['HTTP_REFERER'],'?')){$http_ref = explode('?',$_SERVER['HTTP_REFERER']);}
else{$http_ref[0]=$_SERVER['HTTP_REFERER'];}

if (($http_ref[0]!=$URL_home."show.php")){ 
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

$colname_laf_data = "-1";
if (isset($_GET['no'])) {
  $colname_laf_data = (get_magic_quotes_gpc()) ? $_GET['no'] : addslashes($_GET['no']);
}

mysqli_select_db($conn_LAF,$database_conn_LAF);
mysqli_query($conn_LAF,"SET NAMES 'utf8'");
$query_laf_data = sprintf("SELECT * FROM laf_data WHERE `no` = '%s'" , $colname_laf_data);
$laf_data = mysqli_query($conn_LAF,$query_laf_data) or die(mysqli_connect_error());
$row_laf_data = mysqli_fetch_assoc($laf_data);
$totalRows_laf_data = mysqli_num_rows($laf_data);

$file_type = "msword";
$file_ending = "htm"; 
header("Content-Type: application/$file_type; charset='utf-8'");
header("Content-Disposition: attachment; filename=".iconv("utf-8","big5","國立中央大學校安中心失物招領事件登記表-".str_pad($row_laf_data['no'],6,"0",STR_PAD_LEFT)).".$file_ending");
header("Pragma: no-cache");
header("Expires: 0");

//無資料隱藏
if($row_laf_data['state2']!=''){
$state2 = "
  <tr>
    <td width=\"150\"><div align=\"right\">未領取後續處理：</div></td>
    <td width=\"600\">".$row_laf_data['state2']."</td>
  </tr> ";}
else{$state2 ='';}

if($row_laf_data['state_number']!=''){
$state_number = "
  <tr>
    <td width=\"150\"><div align=\"right\">相關文號：</div></td>
    <td width=\"600\">".$row_laf_data['state_number']."</td>
  </tr> ";}
else{$state_number ='';}

//圖片轉碼
  $file = $row_laf_data['attachment'];
  if($fp = fopen($file,"rb", 0)){
    $gambar = fread($fp,filesize($file));
	fclose($fp);
	$base64 = chunk_split(base64_encode($gambar));
	//轉換結果
	$encode = '<img src="data:image/jpg;base64,'.$base64.'" >';
  }     

  // 接收進來的 base64 DtatURI String
  /*
  $img = $encode;

  // 轉檔 & 存檔
  $img = str_replace('data:image/jpg;base64,', '', $img);
  $img = str_replace(' ', '+', $img);
  $data = base64_decode($img);
  $file = 'attachment/' . uniqid() . '.jpg';
  $success = file_put_contents($file, $data);
  $output = ($success) ? '<img src="'. $file .'" alt="Canvas Image" />' : '<p>Unable to save the file.</p>';
  */

echo ("
<table width=\"750\" border=\"1\" align=\"center\">
  <tr>
    <td colspan=\"2\"><div align=\"center\"><FONT SIZE=\"5\"><strong>國立中央大學 軍訓室 失物招領事件登記表</strong></font></div></td>
  </tr>
  <tr>
    <td colspan=\"2\"><div align=\"left\"><strong>事件編號：".str_pad($row_laf_data['no'],6,"0",STR_PAD_LEFT)."</strong></div></td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得日期：</div></td>
    <td width=\"600\">".$row_laf_data['time'].' '.$row_laf_data['time2']."</td>
  </tr>
  <tr>
    <td colspan=\"2\"><strong>● 拾得人資料</strong></td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得人單位：</div></td>
    <td width=\"600\">".$row_laf_data['college'].' '.$row_laf_data['department']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得人級別：</div></td>
    <td width=\"600\">".$row_laf_data['grade']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得人學號：</div></td>
    <td width=\"600\">".$row_laf_data['student_id']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得人姓名：</div></td>
    <td width=\"600\">".$row_laf_data['name']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得人手機/分機：</div></td>
    <td width=\"600\">".$row_laf_data['tel']."</td>
  </tr>
  <tr>
    <td colspan=\"2\"><strong>● 拾得物資料</strong></td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得物類別：</div></td>
    <td width=\"600\">".$row_laf_data['class']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得物品名：</div></td>
    <td width=\"600\">".$row_laf_data['missing_name']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得物數量：</div></td>
    <td width=\"600\">".$row_laf_data['missing_number'].' '.$row_laf_data['missing_unit']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">拾得地點：</div></td>
    <td width=\"600\">".$row_laf_data['missing_place'].' '.$row_laf_data['missing_place2']."</td>
  </tr>
  <tr>
    <td width=\"150\" valign=\"top\" ><div align=\"right\">拾得物照片：</div></td>
    <td width=\"600\" align=\"center\" >".$encode."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">所有人識別資料：</div></td>
    <td width=\"600\">".$row_laf_data['missing_state']."</td>
  </tr>
  <tr>
    <td colspan=\"2\"><strong>● 所有人資料</strong></td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">所有人單位：</div></td>
    <td width=\"600\">".$row_laf_data['college2'].' '.$row_laf_data['department2']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">所有人級別：</div></td>
    <td width=\"600\">".$row_laf_data['grade2']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">所有人學號：</div></td>
    <td width=\"600\">".$row_laf_data['student_id2']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">所有人姓名：</div></td>
    <td width=\"600\">".$row_laf_data['name2']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">所有人手機/分機：</div></td>
    <td width=\"600\">".$row_laf_data['tel2']."</td>
  </tr>
  <tr>
    <td colspan=\"2\"><strong>● 處理結果</strong></td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">處理日期：</div></td>
    <td width=\"600\">".$row_laf_data['time3'].' '.$row_laf_data['time4']."</td>
  </tr>
  <tr>
    <td width=\"150\"><div align=\"right\">處理結果：</div></td>
    <td width=\"600\">".$row_laf_data['state']."</td>
  </tr>"
  .$state2.$state_number.
  "
  </table>
  <table width=\"750\" border=\"1\" align=\"center\">
  <tr>
    <td width=\"150\"><div align=\"right\">拾得人簽名：</div></td>
    <td width=\"225\"><p>&nbsp;</p><p>&nbsp;</p></td>
	<td width=\"150\"><div align=\"right\">領取人簽名：</div></td>
    <td width=\"225\"><p>&nbsp;</p><p>&nbsp;</p></td>
  </tr>
</table>");

mysqli_free_result($laf_data);
return (true);
?>
