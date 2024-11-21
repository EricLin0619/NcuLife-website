<?php
// 設置包含路徑
$phpWordBasePath = dirname(dirname(__DIR__)) . '/lib/PHPWord-0.18.3/src/PhpWord/';

// 包含必要的文件
require_once $phpWordBasePath . 'PhpWord.php';
require_once $phpWordBasePath . 'Shared/Html.php';

// 使用命名空間
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
require_once('Connections/conn_CSRC.php');
header("Content-Type: text/html; charset=utf-8");

if (strstr($_SERVER['HTTP_REFERER'], '?')) {
  $http_ref = explode('?', $_SERVER['HTTP_REFERER']);
} else {
  $http_ref[0] = $_SERVER['HTTP_REFERER'];
}

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

$phpWord = new PhpWord();
$file_type = "msword";
$file_ending = "docx";
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

$section = $phpWord->addSection();



$doc_time =$row_csrc_data['time'];
$doc_time2 = $row_csrc_data['time2'];
$doc_place = $row_csrc_data['place'] . ' - ' . $row_csrc_data['place2'];
$doc_user = $row_csrc_data['username'];
$doc_class =  $row_csrc_data['class'] . ' - ' . $row_csrc_data['class2'];
$doc_summary = str_replace($row_csrc_data['name'], $new_name, $row_csrc_data['what']);
$doc_process = nl2br(str_replace($row_csrc_data['name'], $new_name, $row_csrc_data['how']));
$doc_trace = nl2br(str_replace($row_csrc_data['name'], $new_name, $row_csrc_data['remark']));
$doc_img_tag="";

for($i=1;$i<5;$i++){
  $img_key = "img$i";
  if ($row_csrc_data[$img_key]!= NULL){
    $doc_img_tag = $doc_img_tag.'('.$i.')'.'<img src="./security_img/'.$row_csrc_data[$img_key].'" width="80"/>';
  }
}
$htmlTemplate=<<<EOS
<table width="750" align="center"  style='font-family:標楷體;border:1pt soild black;border-collapse: collapse;font-size:12pt;'>
<tr>
  <td colspan="10" style='border-bottom:solid 1.0pt black;'><p style='font-size:22pt' align="center"><strong>國立中央大學生活輔導組校安狀況處理紀錄表</strong></p>
  <div align='center'>□通報教育部校安中心 序號：　　　　　　□列管持續處理</div><p align="right">日期：$doc_time &nbsp;&nbsp;</p></td>
</tr>
<tr>
  <td width="10%" ><p align="center">時間</p></td>
  <td width="10%" ><p align="center">$doc_time2</p></td>
  <td width="10%" ><p align="center">地點</p></td>
  <td width="40%" colspan="4" ><p align="center">$doc_place</p></td>
  <td width="15%" colspan="2" ><p align="center">處理人員</p></td>
  <td width="20%" ><p align="center"> $doc_user</p></td>
</tr>
<tr>
  <td align="center" valign="middle" >
  <strong>基<br />
  本<br />
  資<br />
  料</strong>
  </td>
  <td colspan="9" ><br />系級：$new_college - $new_department $new_grade<br /><br />學號：$new_student_id 　　姓名： $new_name<br /><br />電話：________________　　緊急連絡人電話：________________<br /><br />陪伴同學：________________　　電話：________________<br />　
  </td>
</tr>
<tr>
  <td align="center" valign="middle" >
  <strong>類<br />
  別</strong>
  </td>
  <td colspan="9" >$doc_class</td>
</tr>
<tr>
  <td align="center" valign="middle">
  <strong>摘<br />
  要</strong>
  </td>
  <td colspan="9" >$doc_summary</td>
</tr>
<tr>
  <td align="center" valign="middle" >
  <strong>處<br />
  理<br />
  情<br />
  形</strong>
  </td>
  <td colspan="9" >$doc_process</td>
</tr>
<tr>
  <td align="center" valign="middle" >
  <strong>案<br />
  件<br />
  追<br />
  蹤</strong></td>
  <td colspan="9" >$doc_trace</td>
</tr>
<tr>
  <td align="center" valign="middle" >
  <strong>圖<br />
  片</strong></td>
  <td colspan="9" >$doc_img_tag</td>
</tr>
<tr>
  <td colspan="4" width="280" ><p align="center"><strong>承辦單位<br />(擬辦)</strong></p></td>
  <td colspan="3" width="280" ><p align="center"><strong>會辦單位<br />(核轉)</strong></p></td>
  <td colspan="3" width="240" ><p align="center"><strong>學務長<br />(意見或批示)</strong></p></td>
</tr>
<tr>
  <td colspan="4" width="280" ><p align="left">值勤人員：<br /><br /><br /><br />系輔導人：<br /><br /><br /><br />生輔組組長：<br /><br /><br /><br />&nbsp;</p></td>
  <td colspan="3" width="280" ><p align="center">&nbsp;</p></td>
  <td colspan="3" width="240" ><p align="center">&nbsp;</p></td>
</tr>
</table>
EOS;
Html::addHtml($section, $htmlTemplate);
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("php://output");
mysqli_free_result($csrc_data);
return (true);

# By Jeff Lin 2022/10/27
?>
