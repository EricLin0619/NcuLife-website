<?php require_once('Connections/conn_CSRC.php'); ?>
<?php
header("Content-Type: text/html; charset=utf-8");

if (strstr($_SERVER['HTTP_REFERER'], '?')) {
  $http_ref = explode('?', $_SERVER['HTTP_REFERER']);
} else {
  $http_ref[0] = $_SERVER['HTTP_REFERER'];
}

//擋權限 對外才能連進
//if (($http_ref[0]!=$URL_home."show.php")){ 
//  header("Location: ". $MM_restrictGoTo); 
//  exit;
//}

$colname_csrc_data = "-1";
if (isset($_GET['no'])) {
  $colname_csrc_data = (get_magic_quotes_gpc()) ? $_GET['no'] : addslashes($_GET['no']);
}

mysqli_select_db($conn_CSRC, $database_conn_CSRC);
mysqli_query($conn_CSRC, "SET NAMES 'utf8'");
$query_csrc_data = sprintf("SELECT * FROM csrc_data WHERE `no` = '%s'", $colname_csrc_data);
$csrc_data = mysqli_query($conn_CSRC, $query_csrc_data) or die(mysqli_connect_error());
$row_csrc_data = mysqli_fetch_assoc($csrc_data);
$totalRows_csrc_data = mysqli_num_rows($csrc_data);

$file_type = "msword";
$file_ending = "doc";
header("Content-Type: application/$file_type; charset='utf-8'");
header("Content-Disposition: attachment; filename=" . iconv("utf-8", "big5", "國立中央大學生輔組校安狀況處理紀錄表") . ".$file_ending");
header("Pragma: no-cache");
header("Expires: 0");

if ($row_csrc_data['secret'] == 'Y') {
  $new_college = '*****';
} else {
  $new_college = $row_csrc_data['college'];
}
if ($row_csrc_data['secret'] == 'Y') {
  $new_department = '*****';
} else {
  $new_department = $row_csrc_data['department'];
}
if ($row_csrc_data['secret'] == 'Y') {
  $new_grade = '***';
} else {
  $new_grade = $row_csrc_data['grade'];
}
if ($row_csrc_data['secret'] == 'Y') {
  $new_student_id = '*********';
} else {
  $new_student_id = $row_csrc_data['student_id'];
}
if ($row_csrc_data['secret'] == 'Y') {
  $new_name = mb_substr($row_csrc_data['name'], 0, 1, "UTF-8");
  for ($i = 1; $i < mb_strlen($row_csrc_data['name'], "UTF-8"); $i++) {
    $new_name .= 'Ｏ';
  }
} else {
  $new_name = $row_csrc_data['name'];
}

echo ("
<table width=\"750\" align=\"center\" border=\"0\" bordercolor=\"#000000\" style='font-family:標楷體;border-top:solid 2.0pt;border-left:solid 2.0pt;border-bottom:solid 2.0pt;border-right:solid 2.0pt;'>
  <tr>
    <td colspan=\"10\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'><p style='font-size:22pt' align=\"center\"><strong>國立中央大學生活輔導組校安狀況處理紀錄表</strong></p>
	<div align='center'>□通報教育部校安中心 序號：　　　　　　□列管持續處理</div><p align=\"right\">日期：" . $row_csrc_data['time'] . "&nbsp;&nbsp;</p></td>
  </tr>
  <tr>
	<td width=\"75\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><p align=\"center\">時間</p></td>
    <td width=\"75\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><p align=\"center\">" . $row_csrc_data['time2'] . "</p></td>
	<td width=\"75\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><p align=\"center\">地點</p></td>
	<td width=\"75\" colspan=\"4\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><p align=\"center\">" . $row_csrc_data['place'] . ' - ' . $row_csrc_data['place2'] . "</p></td>
	<td width=\"80\" colspan=\"2\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><p align=\"center\">處理人員</p></td>
	<td width=\"70\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'><p align=\"center\">" . $row_csrc_data['username'] . "</p></td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"middle\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><strong>基<br />
    本<br />
    資<br />
    料</strong></td>
    <td colspan=\"9\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'>
	<br />
	系級：" . $new_college . ' - ' . $new_department . '　' . $new_grade . "<br /><br />
	學號：" . $new_student_id . "　　姓名：" . $new_name . "<br /><br />
	電話：________________　　緊急連絡人電話：________________<br /><br />
    陪伴同學：________________　　電話：________________<br />　
	</td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"middle\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><strong>類<br />
    別</strong></td>
    <td colspan=\"9\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'>" . $row_csrc_data['class'] . ' - ' . $row_csrc_data['class2'] . "</td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"middle\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><strong>摘<br />
    要</strong></td>
    <td colspan=\"9\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'>" . str_replace($row_csrc_data['name'], $new_name, $row_csrc_data['what']) . "</td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"middle\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><strong>處<br />
    理<br />
    情<br />
    形</strong></td>
    <td colspan=\"9\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'>" . nl2br(str_replace($row_csrc_data['name'], $new_name, $row_csrc_data['how'])) . "</td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"middle\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><strong>案<br />
    件<br />
    追<br />
    蹤</strong></td>
    <td colspan=\"9\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'>" . nl2br(str_replace($row_csrc_data['name'], $new_name, $row_csrc_data['remark'])) . "</td>
  </tr>
  <tr>
    <td colspan=\"4\" width=\"280\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><p align=\"center\"><strong>承辦單位<br />(擬辦)</strong></p></td>
    <td colspan=\"3\" width=\"280\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><p align=\"center\"><strong>會辦單位<br />(核轉)</strong></p></td>
    <td colspan=\"3\" width=\"240\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'><p align=\"center\"><strong>學務長<br />(意見或批示)</strong></p></td>
  </tr>
  <tr>
    <td colspan=\"4\" width=\"280\" style='border-top:none;border-left:none;border-bottom:none;border-right:solid 1.0pt;'><p align=\"left\">值勤人員：<br /><br /><br /><br />系輔導人：<br /><br /><br /><br />生輔組組長：<br /><br /><br /><br />&nbsp;</p></td>
    <td colspan=\"3\" width=\"280\" style='border-top:none;border-left:none;border-bottom:none;border-right:solid 1.0pt;'><p align=\"center\">&nbsp;</p></td>
    <td colspan=\"3\" width=\"240\" style='border-top:none;border-left:none;border-bottom:none;border-right:none;'><p align=\"center\">&nbsp;</p></td>
  </tr>
</table>");

mysqli_free_result($csrc_data);
return (true);
?>
