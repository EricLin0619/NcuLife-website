<?php require_once('Connections/conn_LAF.php'); ?>
<?php //限制存取頁面

if (!isset($_SESSION)) {
  session_start();
}

header("Content-Type:text/html; charset=utf-8");

date_default_timezone_set("Asia/Taipei");

  $MM_redirect = "login.php";
  if (!isset($_SESSION['LAF_user'])) {header("Location: " . $MM_redirect);}
  
$MM_restrictGoTo = "index.php"; //拒絕存取後，要請往的頁面

//非允許的使用者

if(strstr($_SERVER['HTTP_REFERER'],'?')){$http_ref = explode('?',$_SERVER['HTTP_REFERER']);}
else{$http_ref[0]=$_SERVER['HTTP_REFERER'];}

if ((!(isset($_POST["MM_update"])))&&($http_ref[0]!=$URL_home."index.php")&&($http_ref[0]!=$URL_home."search.php")&&($http_ref[0]!=$URL_home."list.php")){ 
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

$url_to_go = explode('/',$_SERVER['HTTP_REFERER']);

?>
<?php

$colname_laf_user = "-1";
if (isset($_SESSION['LAF_user'])) {
  $colname_laf_user = (get_magic_quotes_gpc()) ? $_SESSION['LAF_user'] : addslashes($_SESSION['LAF_user']);
}
mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_user = sprintf("SELECT * FROM `CSRC_user` WHERE `user` = '%s'", $colname_laf_user);
$laf_user = mysqli_query($conn_LAF,$query_laf_user) or die(mysqli_connect_error());
$row_laf_user = mysqli_fetch_assoc($laf_user);

mysqli_select_db($conn_LAF,$database_conn_LAF);
$query_laf_data = sprintf("SELECT * FROM `laf_data` WHERE `no`='".$_GET['no']."'");
$laf_data = mysqli_query($conn_LAF,$query_laf_data) or die(mysqli_connect_error());
$row_laf_data = mysqli_fetch_assoc($laf_data);
$totalRows_laf_data = mysqli_num_rows($laf_data);

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

$ServerFilename = $_POST['attachment_old']; //預設寫入資料庫檔名為原始檔名

//上傳檔案處理
$upfile = "";   //預設路徑檔名為空字串
//檢查是否有檔案上傳
if (is_uploaded_file($_FILES['attachment']['tmp_name'])) 
{
  // Validate the uploaded file
  $image_info = getimagesize($_FILES['attachment']['tmp_name']);
  if ($image_info === false || $image_info[2] !== IMAGETYPE_JPEG) {
      die("Uploaded file is not a valid JPEG image.");
  }
  //刪除檔案 
  if (file_exists($ServerFilename)){ unlink($ServerFilename); }
  
  $upfile = "attachment/";
  $File_Extension = explode(".", $_FILES['attachment']['name']); 
  $File_Extension = $File_Extension[count($File_Extension)-1]; 
	$ServerFilename = $upfile.date('Ymd_His').'.'.$File_Extension;

  //檢查檔案大小
  if($_FILES['attachment']['size'] > 20971520) { die("檔案大小不能超過 20MB !!"); }
  
  //檢查檔案是否存在
  if (file_exists($ServerFilename)) { die("檔案已經存在"); }
 
  // 取得來源圖片長寬
  $src = imagecreatefromjpeg($_FILES['attachment']['tmp_name']);
  if (!$src) {
        die("Failed to create image from uploaded file.");
  }
  $src_w = imagesx($src);
  $src_h = imagesy($src);
  // Avoid division by zero
  if ($src_w == 0 || $src_h == 0) {
      die("Invalid image dimensions.");
  }

  // 假設要長寬不超過 500 400
  if($src_w > $src_h){
    $thumb_w = 500;
	$thumb_h = intval($src_h / $src_w * 500);
  }else{
    $thumb_h = 400;
	$thumb_w = intval($src_w / $src_h * 400);
  }
  
  // 建立縮圖
  $thumb = imagecreatetruecolor($thumb_w, $thumb_h);
  
  // 開始縮圖
  imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);
  
  // 儲存縮圖到指定 thumb 目錄
  imagejpeg($thumb, $ServerFilename, '100') or die("error displaying jpg");

  //複製檔案
  //if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $ServerFilename)) { die("無法將上傳的檔案移動至指定的目錄，請檢查目錄的路徑和權限!!"); }
  //else { chmod($upfile,0777); } //改變上傳檔案的權限為777	  
}

  if($row_laf_data['temp']=='N'){
    $date = $row_laf_data['date'];
	$remark = $row_laf_data['remark'].$row_laf_user['department'].'-'.$row_laf_user['name'].' [修改] @ '.date('Y-m-d H:i:s')."\n"."\n";  
  }
  else{
    $date = date('Y-m-d H:i:s');
	$remark = $row_laf_data['remark'];
  }

  $updateSQL = sprintf("UPDATE `laf_data` SET `number`=%s, `date`=%s, `time`=%s, `time2`=%s, `college`=%s, `department`=%s, `grade`=%s, `student_id`=%s, `name`=%s, `tel`=%s, `class`=%s, `missing_name`=%s, `missing_number`=%s, `missing_unit`=%s, `missing_place`=%s, `missing_place2`=%s, `attachment`=%s, `containing`=%s, `missing_state`=%s, `college2`=%s, `department2`=%s, `grade2`=%s, `student_id2`=%s, `name2`=%s, `tel2`=%s, `time3`=%s, `time4`=%s, `state`=%s, `state2`=%s, `state_number`=%s, `user`=%s, `user_dep`=%s, `username`=%s, `remark`=%s, `temp`=%s WHERE `no`=%s",
                       GetSQLValueString($_POST['number'], "text"),
                       GetSQLValueString($date, "text"),
                       GetSQLValueString($_POST['time'], "date"),
					   GetSQLValueString($_POST['time2'], "date"),
					   GetSQLValueString($_POST['college'], "text"),
					   GetSQLValueString($_POST['department'], "text"),
					   GetSQLValueString($_POST['grade'], "text"),
					   GetSQLValueString($_POST['student_id'], "text"),
					   GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['class'], "text"),
					   GetSQLValueString($_POST['missing_name'], "text"),
					   GetSQLValueString($_POST['missing_number'], "text"),
					   GetSQLValueString($_POST['missing_unit'], "text"),
                       GetSQLValueString($_POST['missing_place'], "text"),
					   GetSQLValueString($_POST['missing_place2'], "text"),
					   GetSQLValueString($ServerFilename, "text"),
					   GetSQLValueString($_POST['containing'], "text"),
					   GetSQLValueString($_POST['missing_state'], "text"),
					   GetSQLValueString($_POST['college2'], "text"),
					   GetSQLValueString($_POST['department2'], "text"),
					   GetSQLValueString($_POST['grade2'], "text"),
					   GetSQLValueString($_POST['student_id2'], "text"),
					   GetSQLValueString($_POST['name2'], "text"),
					   GetSQLValueString($_POST['tel2'], "text"),
					   GetSQLValueString($_POST['time3'], "date"),
					   GetSQLValueString($_POST['time4'], "date"),
					   GetSQLValueString($_POST['state'], "date"),
					   GetSQLValueString($_POST['state2'], "date"),
					   GetSQLValueString($_POST['state_number'], "date"),
					   GetSQLValueString($row_laf_data['user'], "text"),
					   GetSQLValueString($row_laf_data['user_dep'], "text"),
					   GetSQLValueString($row_laf_data['username'], "text"),
					   GetSQLValueString($remark, "text"),
					   GetSQLValueString($_POST['temp'], "text"),
					   GetSQLValueString($_POST['no'], "int"));

  mysqli_select_db($conn_LAF,$database_conn_LAF);
  $Result1 = mysqli_query($conn_LAF,$updateSQL) or die(mysqli_connect_error());
  
  $updateGoTo = $_POST['url_to_go'];
  //if (isset($_SERVER['QUERY_STRING'])) {
  //  $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
  //  $updateGoTo .= $_SERVER['QUERY_STRING'];
  //}
  header("Location:". $updateGoTo);
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
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<script LANGUAGE="javascript">

var second = 0;
function countSecond( )
{　second = second + 1
   second2 = 900 - second
   document.getElementById("timecount").innerHTML = second2
　 setTimeout("countSecond( )", 1000)
}
function deletePhoto($photoId) {
    global $conn_LAF, $database_conn_LAF;
    
    // 首先獲取照片信息
    mysqli_select_db($conn_LAF, $database_conn_LAF);
    $query = sprintf("SELECT attachment FROM `laf_data` WHERE `no` = %d", $photoId);
    $result = mysqli_query($conn_LAF, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        $filePath = $row['attachment'];
        
        // 刪除文件
        if (file_exists($filePath) && unlink($filePath)) {
            // 從數據庫中刪除記錄
            $deleteQuery = sprintf("DELETE FROM `laf_data` WHERE `no` = %d", $photoId);
            mysqli_query($conn_LAF, $deleteQuery);
            return true;
        }
    }
    
    return false;
}
function Buildkey(num) {
	var ctr=0;
	document.form1.department.selectedIndex=0;
	/*
	定義二階選單內容
	if(num=="第一階下拉選單的值") {	d
	  ocument.form1.department.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");
		ctr=ctr+1;
	}
	*/
	/*文學院*/
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("中國文學系","中國文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("英美語文學系","英美語文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("法國語文學系","法國語文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("哲學研究所","哲學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("藝術學研究所","藝術學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("歷史研究所","歷史研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("學習與教學研究所","學習與教學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("亞際文化研究國際碩士學位學程(台聯大)","亞際文化研究國際碩士學位學程(台聯大)");	ctr=ctr+1;	}
	/*理學院*/
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("理學院學士班","理學院學士班");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("物理學系","物理學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("數學系","數學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("化學學系","化學學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("統計研究所","統計研究所");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("光電科學與工程學系","光電科學與工程學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("天文研究所","天文研究所");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("光電博士學位學程(台聯大)","光電博士學位學程(台聯大)");	ctr=ctr+1;	}
	/*工學院*/
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("化學工程與材料工程學系","化學工程與材料工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("土木工程學系","土木工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("機械工程學系","機械工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("能源工程研究所","能源工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("環境工程研究所","環境工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("營建管理研究所","營建管理研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("材料科學與工程研究所","材料科學與工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("國際永續發展碩士在職專班","國際永續發展碩士在職專班");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("應用材料科學國際研究生碩士學位學程","應用材料科學國際研究生碩士學位學程");	ctr=ctr+1;	}
	/*管理學院*/
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("企業管理學系","企業管理學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("資訊管理學系","資訊管理學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("財務金融學系","財務金融學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("經濟學系","經濟學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("會計研究所","會計研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("產業經濟研究所","產業經濟研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("人力資源管理研究所","人力資源管理研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("工業管理研究所","工業管理研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("管理學院高階主管企管碩士班(EMBA)","管理學院高階主管企管碩士班(EMBA)");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("管理學院電算中心","管理學院電算中心");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("企業資源規劃(ERP)中心","企業資源規劃(ERP)中心");	ctr=ctr+1;	}
	/*資電學院*/
	if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("電機工程學系","電機工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("資訊工程學系","資訊工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("通訊工程學系","通訊工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("網路學習科技研究所","網路學習科技研究所");	ctr=ctr+1;	}
	/*地科學院*/
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("地球科學學系","地球科學學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("大氣科學學系","大氣科學學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("太空科學研究所","太空科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("應用地質研究所","應用地質研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("水文與海洋科學研究所","水文與海洋科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("地球系統科學國際研究生博士學位學程","地球系統科學國際研究生博士學位學程");	ctr=ctr+1;	}
	/*客家學院*/
	if(num=="客家學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="客家學院") {	document.form1.department.options[ctr]=new Option("客家語文暨社會科學學系","客家語文暨社會科學學系");	ctr=ctr+1;	}
	if(num=="客家學院") {	document.form1.department.options[ctr]=new Option("法律與政府研究所","法律與政府研究所");	ctr=ctr+1;	}
	/*生醫理工學院*/
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("生命科學系","生命科學系");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("認知神經科學研究所","認知神經科學研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("系統生物與生物資訊研究所","系統生物與生物資訊研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("生物醫學工程研究所","生物醫學工程研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("跨領域轉譯醫學研究所","跨領域轉譯醫學研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("跨領域神經科學博士學位學程(台聯大)","跨領域神經科學博士學位學程(台聯大)");	ctr=ctr+1;	}
	/*其他*/
	if(num=="其他") {	document.form1.department.options[ctr]=new Option("其他","其他");	ctr=ctr+1;	}

	document.form1.department.length=ctr;
	document.form1.department.options[0].selected=true;
}

function Buildkey2(num) {
	var ctr=0;
	document.form1.department2.selectedIndex=0;
	/*
	定義二階選單內容
	if(num=="第一階下拉選單的值") {	d
	  ocument.form1.department2.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");
		ctr=ctr+1;
	}
	*/
	/*文學院*/
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("中國文學系","中國文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("英美語文學系","英美語文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("法國語文學系","法國語文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("哲學研究所","哲學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("藝術學研究所","藝術學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("歷史研究所","歷史研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("學習與教學研究所","學習與教學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("亞際文化研究國際碩士學位學程(台聯大)","亞際文化研究國際碩士學位學程(台聯大)");	ctr=ctr+1;	}
	/*理學院*/
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("理學院學士班","理學院學士班");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("物理學系","物理學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("數學系","數學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("化學學系","化學學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("統計研究所","統計研究所");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("光電科學與工程學系","光電科學與工程學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("天文研究所","天文研究所");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("光電博士學位學程(台聯大)","光電博士學位學程(台聯大)");	ctr=ctr+1;	}
	/*工學院*/
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("化學工程與材料工程學系","化學工程與材料工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("土木工程學系","土木工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("機械工程學系","機械工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("能源工程研究所","能源工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("環境工程研究所","環境工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("營建管理研究所","營建管理研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("材料科學與工程研究所","材料科學與工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("國際永續發展碩士在職專班","國際永續發展碩士在職專班");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("應用材料科學國際研究生碩士學位學程","應用材料科學國際研究生碩士學位學程");	ctr=ctr+1;	}
	/*管理學院*/
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("企業管理學系","企業管理學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("資訊管理學系","資訊管理學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("財務金融學系","財務金融學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("經濟學系","經濟學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("會計研究所","會計研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("產業經濟研究所","產業經濟研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("人力資源管理研究所","人力資源管理研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("工業管理研究所","工業管理研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("管理學院高階主管企管碩士班(EMBA)","管理學院高階主管企管碩士班(EMBA)");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("管理學院電算中心","管理學院電算中心");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("企業資源規劃(ERP)中心","企業資源規劃(ERP)中心");	ctr=ctr+1;	}
	/*資電學院*/
	if(num=="資電學院") {	document.form1.department2.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department2.options[ctr]=new Option("電機工程學系","電機工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department2.options[ctr]=new Option("資訊工程學系","資訊工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department2.options[ctr]=new Option("通訊工程學系","通訊工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department2.options[ctr]=new Option("網路學習科技研究所","網路學習科技研究所");	ctr=ctr+1;	}
	/*地科學院*/
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("地球科學學系","地球科學學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("大氣科學學系","大氣科學學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("太空科學研究所","太空科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("應用地質研究所","應用地質研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("水文與海洋科學研究所","水文與海洋科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("地球系統科學國際研究生博士學位學程","地球系統科學國際研究生博士學位學程");	ctr=ctr+1;	}
	/*客家學院*/
	if(num=="客家學院") {	document.form1.department2.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="客家學院") {	document.form1.department2.options[ctr]=new Option("客家語文暨社會科學學系","客家語文暨社會科學學系");	ctr=ctr+1;	}
	if(num=="客家學院") {	document.form1.department2.options[ctr]=new Option("法律與政府研究所","法律與政府研究所");	ctr=ctr+1;	}
	/*生醫理工學院*/
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("生命科學系","生命科學系");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("認知神經科學研究所","認知神經科學研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("系統生物與生物資訊研究所","系統生物與生物資訊研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("生物醫學工程研究所","生物醫學工程研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("跨領域轉譯醫學研究所","跨領域轉譯醫學研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("跨領域神經科學博士學位學程(台聯大)","跨領域神經科學博士學位學程(台聯大)");	ctr=ctr+1;	}
	/*其他*/
	if(num=="其他") {	document.form1.department2.options[ctr]=new Option("其他","其他");	ctr=ctr+1;	}

	document.form1.department2.length=ctr;
	document.form1.department2.options[0].selected=true;
}

//目前設定檢查
function Buildkey_old(num) {
	var ctr=0;
	document.form1.department.selectedIndex=0;
	/*
	定義二階選單內容
	if(num=="第一階下拉選單的值") {	d
	  ocument.form1.department.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");
		ctr=ctr+1;
	}
	*/
	/*文學院*/
	if(num=="文學院") {	if(document.form1.department.value!=''){document.form1.department.options[ctr]=new Option(document.form1.department.value,document.form1.department.value);}
	                    else{document.form1.department.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("中國文學系","中國文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("英美語文學系","英美語文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("法國語文學系","法國語文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("哲學研究所","哲學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("藝術學研究所","藝術學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("歷史研究所","歷史研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("學習與教學研究所","學習與教學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department.options[ctr]=new Option("亞際文化研究國際碩士學位學程(台聯大)","亞際文化研究國際碩士學位學程(台聯大)");	ctr=ctr+1;	}
	/*理學院*/
	if(num=="理學院") {	if(document.form1.department.value!=''){document.form1.department.options[ctr]=new Option(document.form1.department.value,document.form1.department.value);}
	                    else{document.form1.department.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("理學院學士班","理學院學士班");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("物理學系","物理學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("數學系","數學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("化學學系","化學學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("統計研究所","統計研究所");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("光電科學與工程學系","光電科學與工程學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("天文研究所","天文研究所");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department.options[ctr]=new Option("光電博士學位學程(台聯大)","光電博士學位學程(台聯大)");	ctr=ctr+1;	}
	/*工學院*/
	if(num=="工學院") {	if(document.form1.department.value!=''){document.form1.department.options[ctr]=new Option(document.form1.department.value,document.form1.department.value);}
	                    else{document.form1.department.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("化學工程與材料工程學系","化學工程與材料工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("土木工程學系","土木工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("機械工程學系","機械工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("能源工程研究所","能源工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("環境工程研究所","環境工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("營建管理研究所","營建管理研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("材料科學與工程研究所","材料科學與工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("國際永續發展碩士在職專班","國際永續發展碩士在職專班");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department.options[ctr]=new Option("應用材料科學國際研究生碩士學位學程","應用材料科學國際研究生碩士學位學程");	ctr=ctr+1;	}
	/*管理學院*/
	if(num=="管理學院") {	if(document.form1.department.value!=''){document.form1.department.options[ctr]=new Option(document.form1.department.value,document.form1.department.value);}
	                    else{document.form1.department.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("企業管理學系","企業管理學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("資訊管理學系","資訊管理學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("財務金融學系","財務金融學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("經濟學系","經濟學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("會計研究所","會計研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("產業經濟研究所","產業經濟研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("人力資源管理研究所","人力資源管理研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("工業管理研究所","工業管理研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("管理學院高階主管企管碩士班(EMBA)","管理學院高階主管企管碩士班(EMBA)");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("管理學院電算中心","管理學院電算中心");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department.options[ctr]=new Option("企業資源規劃(ERP)中心","企業資源規劃(ERP)中心");	ctr=ctr+1;	}
	/*資電學院*/
	if(num=="資電學院") {	if(document.form1.department.value!=''){document.form1.department.options[ctr]=new Option(document.form1.department.value,document.form1.department.value);}
	                    else{document.form1.department.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("電機工程學系","電機工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("資訊工程學系","資訊工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("通訊工程學系","通訊工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("網路學習科技研究所","網路學習科技研究所");	ctr=ctr+1;	}
	/*地科學院*/
	if(num=="地科學院") {	if(document.form1.department.value!=''){document.form1.department.options[ctr]=new Option(document.form1.department.value,document.form1.department.value);}
	                    else{document.form1.department.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("地球科學學系","地球科學學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("大氣科學學系","大氣科學學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("太空科學研究所","太空科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("應用地質研究所","應用地質研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("水文與海洋科學研究所","水文與海洋科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("地球系統科學國際研究生博士學位學程","地球系統科學國際研究生博士學位學程");	ctr=ctr+1;	}
	/*客家學院*/
	if(num=="客家學院") {	if(document.form1.department.value!=''){document.form1.department.options[ctr]=new Option(document.form1.department.value,document.form1.department.value);}
	                    else{document.form1.department.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="客家學院") {	document.form1.department.options[ctr]=new Option("客家語文暨社會科學學系","客家語文暨社會科學學系");	ctr=ctr+1;	}
	if(num=="客家學院") {	document.form1.department.options[ctr]=new Option("法律與政府研究所","法律與政府研究所");	ctr=ctr+1;	}
	/*生醫理工學院*/
	if(num=="生醫理工學院") {	if(document.form1.department.value!=''){document.form1.department.options[ctr]=new Option(document.form1.department.value,document.form1.department.value);}
	                    else{document.form1.department.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("生命科學系","生命科學系");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("認知神經科學研究所","認知神經科學研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("系統生物與生物資訊研究所","系統生物與生物資訊研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("生物醫學工程研究所","生物醫學工程研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("跨領域轉譯醫學研究所","跨領域轉譯醫學研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department.options[ctr]=new Option("跨領域神經科學博士學位學程(台聯大)","跨領域神經科學博士學位學程(台聯大)");	ctr=ctr+1;	}
	/*其他*/
	if(num=="其他") {	document.form1.department.options[ctr]=new Option("其他","其他");	ctr=ctr+1;	}

	document.form1.department.length=ctr;
	document.form1.department.options[0].selected=true;
}

function Buildkey_old2(num) {
	var ctr=0;
	document.form1.department2.selectedIndex=0;
	/*
	定義二階選單內容
	if(num=="第一階下拉選單的值") {	d
	  ocument.form1.department2.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");
		ctr=ctr+1;
	}
	*/
	/*文學院*/
	if(num=="文學院") {	if(document.form1.department2.value!=''){document.form1.department2.options[ctr]=new Option(document.form1.department2.value,document.form1.department2.value);}
	                    else{document.form1.department2.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("中國文學系","中國文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("英美語文學系","英美語文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("法國語文學系","法國語文學系");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("哲學研究所","哲學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("藝術學研究所","藝術學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("歷史研究所","歷史研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("學習與教學研究所","學習與教學研究所");	ctr=ctr+1;	}
	if(num=="文學院") {	document.form1.department2.options[ctr]=new Option("亞際文化研究國際碩士學位學程(台聯大)","亞際文化研究國際碩士學位學程(台聯大)");	ctr=ctr+1;	}
	/*理學院*/
	if(num=="理學院") {	if(document.form1.department2.value!=''){document.form1.department2.options[ctr]=new Option(document.form1.department2.value,document.form1.department2.value);}
	                    else{document.form1.department2.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("理學院學士班","理學院學士班");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("物理學系","物理學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("數學系","數學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("化學學系","化學學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("統計研究所","統計研究所");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("光電科學與工程學系","光電科學與工程學系");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("天文研究所","天文研究所");	ctr=ctr+1;	}
	if(num=="理學院") {	document.form1.department2.options[ctr]=new Option("光電博士學位學程(台聯大)","光電博士學位學程(台聯大)");	ctr=ctr+1;	}
	/*工學院*/
	if(num=="工學院") {	if(document.form1.department2.value!=''){document.form1.department2.options[ctr]=new Option(document.form1.department2.value,document.form1.department2.value);}
	                    else{document.form1.department2.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("化學工程與材料工程學系","化學工程與材料工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("土木工程學系","土木工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("機械工程學系","機械工程學系");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("能源工程研究所","能源工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("環境工程研究所","環境工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("營建管理研究所","營建管理研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("材料科學與工程研究所","材料科學與工程研究所");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("國際永續發展碩士在職專班","國際永續發展碩士在職專班");	ctr=ctr+1;	}
	if(num=="工學院") {	document.form1.department2.options[ctr]=new Option("應用材料科學國際研究生碩士學位學程","應用材料科學國際研究生碩士學位學程");	ctr=ctr+1;	}
	/*管理學院*/
	if(num=="管理學院") {	if(document.form1.department2.value!=''){document.form1.department2.options[ctr]=new Option(document.form1.department2.value,document.form1.department2.value);}
	                    else{document.form1.department2.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("企業管理學系","企業管理學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("資訊管理學系","資訊管理學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("財務金融學系","財務金融學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("經濟學系","經濟學系");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("會計研究所","會計研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("產業經濟研究所","產業經濟研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("人力資源管理研究所","人力資源管理研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("工業管理研究所","工業管理研究所");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("管理學院高階主管企管碩士班(EMBA)","管理學院高階主管企管碩士班(EMBA)");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("管理學院電算中心","管理學院電算中心");	ctr=ctr+1;	}
	if(num=="管理學院") {	document.form1.department2.options[ctr]=new Option("企業資源規劃(ERP)中心","企業資源規劃(ERP)中心");	ctr=ctr+1;	}
	/*資電學院*/
	if(num=="資電學院") {	if(document.form1.department2.value!=''){document.form1.department2.options[ctr]=new Option(document.form1.department2.value,document.form1.department2.value);}
	                    else{document.form1.department2.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department2.options[ctr]=new Option("電機工程學系","電機工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department2.options[ctr]=new Option("資訊工程學系","資訊工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department2.options[ctr]=new Option("通訊工程學系","通訊工程學系");	ctr=ctr+1;	}
	if(num=="資電學院") {	document.form1.department2.options[ctr]=new Option("網路學習科技研究所","網路學習科技研究所");	ctr=ctr+1;	}
	/*地科學院*/
	if(num=="地科學院") {	if(document.form1.department2.value!=''){document.form1.department2.options[ctr]=new Option(document.form1.department2.value,document.form1.department2.value);}
	                    else{document.form1.department2.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("地球科學學系","地球科學學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("大氣科學學系","大氣科學學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("太空科學研究所","太空科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("應用地質研究所","應用地質研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("水文與海洋科學研究所","水文與海洋科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department2.options[ctr]=new Option("地球系統科學國際研究生博士學位學程","地球系統科學國際研究生博士學位學程");	ctr=ctr+1;	}
	/*客家學院*/
	if(num=="客家學院") {	if(document.form1.department2.value!=''){document.form1.department2.options[ctr]=new Option(document.form1.department2.value,document.form1.department2.value);}
	                    else{document.form1.department2.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="客家學院") {	document.form1.department2.options[ctr]=new Option("客家語文暨社會科學學系","客家語文暨社會科學學系");	ctr=ctr+1;	}
	if(num=="客家學院") {	document.form1.department2.options[ctr]=new Option("法律與政府研究所","法律與政府研究所");	ctr=ctr+1;	}
	/*生醫理工學院*/
	if(num=="生醫理工學院") {	if(document.form1.department2.value!=''){document.form1.department2.options[ctr]=new Option(document.form1.department2.value,document.form1.department2.value);}
	                    else{document.form1.department2.options[ctr]=new Option("請選擇系所...","");} ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("生命科學系","生命科學系");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("認知神經科學研究所","認知神經科學研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("系統生物與生物資訊研究所","系統生物與生物資訊研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("生物醫學工程研究所","生物醫學工程研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("跨領域轉譯醫學研究所","跨領域轉譯醫學研究所");	ctr=ctr+1;	}
	if(num=="生醫理工學院") {	document.form1.department2.options[ctr]=new Option("跨領域神經科學博士學位學程(台聯大)","跨領域神經科學博士學位學程(台聯大)");	ctr=ctr+1;	}
	/*其他*/
	if(num=="其他") {	document.form1.department2.options[ctr]=new Option("其他","其他");	ctr=ctr+1;	}

	document.form1.department2.length=ctr;
	document.form1.department2.options[0].selected=true;
}

//圖片按比例縮放
var flag=false;
function JeffImage(ImgD,iwidth,iheight){
//參數(圖片,允許的寬度,允許的高度)
var image=new Image();
image.src=ImgD.src;
if(image.width>0 && image.height>0){
flag=true;
if(image.width/image.height>= iwidth/iheight){
if(image.width>iwidth){
ImgD.width=iwidth;
ImgD.height=(image.height*iwidth)/image.width;
}else{
ImgD.width=image.width;
ImgD.height=image.height;
}
ImgD.alt=image.width+"×"+image.height;
}
else{
if(image.height>iheight){
ImgD.height=iheight;
ImgD.width=(image.width*iheight)/image.height;
}else{
ImgD.width=image.width;
ImgD.height=image.height;
}
ImgD.alt=image.width+"×"+image.height;
}
}
}

</script>
<script src="JSCal2/js/jscal2.js"></script>
<script src="JSCal2/js/lang/cn.js"></script>
<link rel="stylesheet" type="text/css" href="JSCal2/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="JSCal2/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="JSCal2/css/gold/gold.css" />

<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
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
					<form name="second">
                    <p align="left">
                    系統將在 <label id="timecount" class="style1">900</label> 秒後自動存檔!
                    </p>
					</form>
					<script>countSecond()</script>
					<script>setTimeout("document.form1.submit()",900000)</script>
                      <h2>修改拾得失物招領登記表</h2>
                      <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <table width="750" border="0" align="center">
                          <tr>
                            <td valign="top"><div align="right"><strong>編號：</strong></div></td>
                            <td width="600">
                              <input name="number" type="text" id="number" value="<?php echo $row_laf_data['number'];?>"/>
                            </td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>案發日期：</strong></div></td>
                            <td width="600"><button id="time_tri">點選日期</button>
                              <span id="sprytextfield1">
                              <input name="time" id="time" value="<?php echo $row_laf_data['time'];?>" size="15" />
                              <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                            <script type="text/javascript">
                      Calendar.setup({
                      inputField : "time",
                      trigger    : "time_tri",
                      onSelect   : function() { this.hide() },
                      dateFormat : "%Y-%m-%d",
                      selectionType : Calendar.SEL_SINGLE,
                      fdow:0
                      });
                      </script></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>案發時間：</strong></div></td>
                            <td width="600">
							<label for="time2"></label>
							<span id="sprytextfield2">
                            <input size="15" id="time2" name="time2" value="<?php echo $row_laf_data['time2'];?>"/>
                            <span class="textfieldRequiredMsg">此項目不可空白。</span><span class="textfieldInvalidFormatMsg">格式錯誤。</span></span>(時間格式：13:00)</td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>學院：</strong></div></td>
                            <td width="600"><span id="spryselect1">
                              <select name="college" size="1" id="college" onchange="Buildkey(this.options[this.options.selectedIndex].value);">
							<?php 
							if ($row_laf_data['college']==''){ echo "<option value=\"\">請選擇學院...</option>"; }
							else {echo "<option value=\"".$row_laf_data['college']."\">".$row_laf_data['college']."</option>"; }
							?>
                                <option value="文學院" >文學院</option>
                                <option value="理學院" >理學院</option>
                                <option value="工學院" >工學院</option>
                                <option value="管理學院" >管理學院</option>
                                <option value="資電學院" >資電學院</option>
                                <option value="地科學院" >地科學院</option>
                                <option value="客家學院" >客家學院</option>
                                <option value="生醫理工學院" >生醫理工學院</option>
                                <option value="其他" >其他</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>系所：</strong></div></td>
                            <td width="600"><span id="spryselect2">
                              <select name="department" size="1" id="department">
							<?php 
							if ($row_laf_data['department']==''){ echo "<option value=\"\">請選擇系所...</option>"; }
							else {echo "<option value=\"".$row_laf_data['department']."\">".$row_laf_data['department']."</option>"; }
							?>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>級別：</strong></div></td>
                            <td width="600"><span id="spryselect3">
                              <select name="grade" id="grade">
                            <?php 
							if ($row_laf_data['grade']==''){ echo "<option value=\"\">請選擇...</option>"; }
							else {echo "<option value=\"".$row_laf_data['grade']."\">".$row_laf_data['grade']."</option>"; }
							?>
                                <option value="大一">大一</option>
                                <option value="大二">大二</option>
                                <option value="大三">大三</option>
                                <option value="大四">大四</option>
                                <option value="碩士班">碩士班</option>
                                <option value="博士班">博士班</option>
                                <option value="教職員">教職員</option>
								<option value="其他">其他</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>學號：</strong></div></td>
                            <td><span id="sprytextfield3">
                              <input name="student_id" type="text" id="student_id" value="<?php echo $row_laf_data['student_id'];?>"/>
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>姓名：</strong></div></td>
                          <td width="600"><span id="sprytextfield4">
                            <input name="name" type="text" id="name" value="<?php echo $row_laf_data['name'];?>"/>
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人手機/分機：</strong></div></td>
                            <td width="600"><span id="sprytextfield5">
                             <input name="tel" type="text" id="tel" value="<?php echo $row_laf_data['tel'];?>" maxlength="30" />
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>拾得物類別：</strong></div></td>
                            <td width="600"><span id="spryselect4">
                              <select name="class" size="1" id="class" >
                                <?php
                                if ($row_laf_data['class']==''){ echo "<option value=\"\">請選擇類別...</option>"; }
								else {echo "<option value=\"".$row_laf_data['class']."\">".$row_laf_data['class']."</option>"; }
								?>
                                <option value="有價票券" >有價票券(信用卡、現金、禮券等)</option>
                                <option value="3C電子" >3C電子(筆電、相機、USB)</option>
                                <option value="身分證件" >身分證件(學生證、健保卡、身分證等)</option>
                                <option value="運動物品" >運動物品(運動器材、設備、用品)</option>
                                <option value="眼鏡服裝" >眼鏡服裝(眼鏡、衣物、鞋子)</option>
                                <option value="文具書籍" >文具書籍(文具、書籍、鉛筆盒等)</option>
                                <option value="保溫瓶" >保溫瓶</option>
                                <option value="手錶" >手錶</option>
								<option value="鑰匙" >鑰匙</option>
								<option value="雨傘" >雨傘</option>
                                <option value="其它" >其它</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物品名：</strong></div></td>
                            <td width="600"><span id="sprytextfield6">
                            <input name="missing_name" type="text" id="missing_name" value="<?php echo $row_laf_data['missing_name'];?>" maxlength="50" />
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物數量：</strong></div></td>
                            <td width="600"><span id="sprytextfield7">
                            <input name="missing_number" type="text" id="missing_number" value="<?php echo $row_laf_data['missing_number'];?>" size="5" maxlength="3" />
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物單位：</strong></div></td>
                            <td width="600"><span id="sprytextfield8">
                            <input name="missing_unit" type="text" id="missing_unit" value="<?php echo $row_laf_data['missing_unit'];?>" size="5" maxlength="5" />(例：張、個)
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>拾得地點分類：</strong></div></td>
                            <td width="600"><span id="spryselect5">
                              <select name="missing_place" size="1" id="missing_place" >
                                <?php
                                if ($row_laf_data['missing_place']==''){ echo "<option value=\"\">請選擇地點分類...</option>"; }
								else {echo "<option value=\"".$row_laf_data['missing_place']."\">".$row_laf_data['missing_place']."</option>"; }
								?>
                                <option value="系館" >系館</option>
                                <option value="依仁堂" >依仁堂</option>
                                <option value="圖書館" >圖書館</option>
                                <option value="國鼎圖書館" >國鼎圖書館</option>
                                <option value="大講堂" >大講堂</option>
                                <option value="行政大樓" >行政大樓</option>
                                <option value="黑盒子" >黑盒子</option>
                                <option value="宿舍" >宿舍</option>
                                <option value="中大郵局" >中大郵局</option>
                                <option value="餐廳" >餐廳</option>
                                <option value="宵夜街" >宵夜街</option>
                                <option value="操場" >操場</option>
                                <option value="籃球場" >籃球場</option>
                                <option value="排球場" >排球場</option>
                                <option value="網球場" >網球場</option>
                                <option value="壘球場" >壘球場</option>
                                <option value="游泳池" >游泳池</option>
                                <option value="百花川" >百花川</option>
                                <option value="中大湖" >中大湖</option>
                                <option value="環校道路" >環校道路</option>
                                <option value="中央路(後門)" >中央路(後門)</option>                               
                                <option value="其它" >其它</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得地點：</strong></div></td>
                            <td width="600"><span id="sprytextfield9">
                              <input name="missing_place2" type="text" id="missing_place2" value="<?php echo $row_laf_data['missing_place2'];?>" maxlength="50" />
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物照片：</strong></div></td>
                            <td>
                              <input name="attachment" type="file" id="attachment" />
                              <input name="attachment_old" type="hidden" id="attachment_old" value="<?php echo $row_laf_data['attachment'];?>" />
                              <?php
                                if ($row_laf_data['attachment']==''){ echo ""; }
								else {echo "<br/>"."<img src=\"".$row_laf_data['attachment']."\" width=\"300\" height=\"250\" onload=\"javascript:JeffImage(this,600,400);\" />"; }
								?>                            </td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>拾得人拋棄：</strong></div></td>
                            <td width="600"><span id="spryselect11">
                              <select name="containing" size="1" id="containing" >
                                <?php
                                if ($row_laf_data['containing']==''){ echo "<option value=\"\">請選擇...</option>"; }
								else {echo "<option value=\"".$row_laf_data['containing']."\">".$row_laf_data['containing']."</option>"; }
								?>
                                <option value="是" >是</option>
                                <option value="否" >否</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>所有人識別資料：</strong></div></td>
                            <td width="600"><span id="spryselect6">
                              <select name="missing_state" size="1" id="missing_state" >
                                <?php
                                if ($row_laf_data['missing_state']==''){ echo "<option value=\"\">請選擇...</option>"; }
								else {echo "<option value=\"".$row_laf_data['missing_state']."\">".$row_laf_data['missing_state']."</option>"; }
								?>
                                <option value="有" >有</option>
                                <option value="無" >無</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人學院：</div></td>
                            <td width="600"><span id="spryselect7">
                              <select name="college2" size="1" id="college2" onchange="Buildkey2(this.options[this.options.selectedIndex].value);">
                                <?php 
							if ($row_laf_data['college2']==''){ echo "<option value=\"\">請選擇學院...</option>"; }
							else {echo "<option value=\"".$row_laf_data['college2']."\">".$row_laf_data['college2']."</option>"; }
							?>
                                <option value="文學院" >文學院</option>
                                <option value="理學院" >理學院</option>
                                <option value="工學院" >工學院</option>
                                <option value="管理學院" >管理學院</option>
                                <option value="資電學院" >資電學院</option>
                                <option value="地科學院" >地科學院</option>
                                <option value="客家學院" >客家學院</option>
                                <option value="生醫理工學院" >生醫理工學院</option>
                                <option value="其他" >其他</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人系所：</div></td>
                            <td width="600"><span id="spryselect8">
                              <select name="department2" size="1" id="department2">
							<?php 
							if ($row_laf_data['department2']==''){ echo "<option value=\"\">請選擇系所...</option>"; }
							else {echo "<option value=\"".$row_laf_data['department2']."\">".$row_laf_data['department2']."</option>"; }
							?>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人級別：</div></td>
                            <td width="600"><span id="spryselect9">
                              <select name="grade2" id="grade2">
                            <?php 
							if ($row_laf_data['grade2']==''){ echo "<option value=\"\">請選擇...</option>"; }
							else {echo "<option value=\"".$row_laf_data['grade2']."\">".$row_laf_data['grade2']."</option>"; }
							?>
                                <option value="大一">大一</option>
                                <option value="大二">大二</option>
                                <option value="大三">大三</option>
                                <option value="大四">大四</option>
                                <option value="碩士班">碩士班</option>
                                <option value="博士班">博士班</option>
                                <option value="教職員">教職員</option>
								<option value="其他">其他</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人學號：</div></td>
                            <td><span id="sprytextfield9">
                              <input name="student_id2" type="text" id="student_id2" value="<?php echo $row_laf_data['student_id2'];?>"/>
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人姓名：</div></td>
                          <td width="600"><span id="sprytextfield10">
                            <input name="name2" type="text" id="name2" value="<?php echo $row_laf_data['name2'];?>"/>
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right" class="style1">所有人手機/分機：</div></td>
                            <td width="600"><span id="sprytextfield11">
                              <input name="tel2" type="text" id="tel2" value="<?php echo $row_laf_data['tel2'];?>" maxlength="30" />
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td width="150" valign="top" class="style1"><div align="right"><strong>處理日期：</strong></div></td>
                            <td width="600"><button id="time_tri2">點選日期</button>
                              <span id="sprytextfield12">
                              <input name="time3" id="time3" value="<?php echo $row_laf_data['time3'];?>" size="15" />
                              <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                            <script type="text/javascript">
                      Calendar.setup({
                      inputField : "time3",
                      trigger    : "time_tri2",
                      onSelect   : function() { this.hide() },
                      dateFormat : "%Y-%m-%d",
                      selectionType : Calendar.SEL_SINGLE,
                      fdow:0
                      });
                      </script></td>
                          </tr>
                          <tr>
                            <td valign="top" class="style1"><div align="right"><strong>處理時間：</strong></div></td>
                            <td width="600">
							<label for="time4"></label>
							<span id="sprytextfield13">
							<input size="15" id="time4" name="time4" value="<?php echo $row_laf_data['time4'];?>"/>
							<span class="textfieldRequiredMsg">此項目不可空白。</span><span class="textfieldInvalidFormatMsg">格式錯誤。</span></span>(時間格式：13:00)</td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right" class="style1"><strong>處理結果：</strong></div></td>
                            <td width="600"><span id="spryselect10">
                              <select name="state" size="1" id="state" >
                                <?php
                                if ($row_laf_data['state']==''){ echo "<option value=\"\">請選擇...</option>"; }
								else {echo "<option value=\"".$row_laf_data['state']."\">".$row_laf_data['state']."</option>"; }
								?>
                                <option value="所有人領回" >所有人領回</option>
                                <option value="交與拾得人" >交與拾得人</option>
                                <option value="拾得人失聯" >拾得人失聯</option>
                                <option value="拾得人拋棄所有權" >拾得人拋棄所有權</option>
                                <option value="交至警局處理" >交至警局處理</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right" class="style1"><strong>未領取後續處理：</strong></div></td>
                            <td width="600"><span id="spryselect11">
                              <select name="state2" size="1" id="state2" >
                                <?php
                                if ($row_laf_data['state2']==''){ echo "<option value=\"\">請選擇...</option>"; }
								else {echo "<option value=\"".$row_laf_data['state2']."\">".$row_laf_data['state2']."</option>"; }
								?>
                                <option value="繳校務基金" >繳校務基金</option>
                                <option value="轉贈弱勢團體" >轉贈弱勢團體</option>
                                <option value="統一銷毀" >統一銷毀</option>
                                <option value="義賣" >義賣</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span>(若有才需選擇)</td>
                          </tr>
                          <tr>
                            <td valign="top" class="style1"><div align="right"><strong>相關文號：</strong></div></td>
                            <td width="600">
							<label for="time4"></label>
							<span id="sprytextfield13">
							<input name="state_number" id="state_number" value="<?php echo $row_laf_data['state_number'];?>" maxlength="50"/>
							(若有才需填寫)</span></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>登記人：</strong></div></td>
                            <td width="600"><?php echo $row_laf_user['department'].'-'.$row_laf_user['name'];?></td>
                          </tr>
                          <tr <?php if($row_laf_data['temp']=='N'){echo "style=\"display:none\"";}?>>
                            <td valign="top"><div align="right"><strong>是否暫存：</strong></div></td>
                            <td width="600"><input name="temp" type="radio" id="temp" value="Y" <?php if (!(strcmp($row_laf_data['temp'],"Y"))) {echo "checked=\"checked\"";}?> />
                              是
                                <input name="temp" type="radio" id="temp" value="N" <?php if (!(strcmp($row_laf_data['temp'],"N"))) {echo "checked=\"checked\"";}?>/>
                            否</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td width="600"><div align="center">
                              <input name="no" type="hidden" id="no" value="<?php echo $row_laf_data['no'];?>" />
                              <input name="Submit" type="Submit" value="送出" onclick="check_form()" />
                            </div></td>
                          </tr>
                        </table>
						<input type="hidden" name="url_to_go" id="url_to_go" value="<?php echo $url_to_go[count($url_to_go)-1];?>" />
                        <input type="hidden" name="MM_update" value="form1" />
                      </form>
                      <p>&nbsp;</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<script type="text/javascript">
<!--
function check_form() {
  if(form1.temp[1].checked){
      var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
      var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "time");
      var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
      var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
      var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
      var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
	  var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
	  var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
	  var spryselect3 = new Spry.Widget.ValidationSelect("spryselect4");
	  var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
	  var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
	  var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
	  var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
      var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5");
	  var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6");
	  var spryselect11 = new Spry.Widget.ValidationSelect("spryselect11");

      /*
	  var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7");
      var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8");
      var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9");
      var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
	  var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
	  var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
	  var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
      var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "time");
	  var spryselect10 = new Spry.Widget.ValidationSelect("spryselect10");
	  var spryselect11 = new Spry.Widget.ValidationSelect("spryselect11");
	  */
  }
}

window.onload = Buildkey_old(document.getElementById('college').value);
window.onload = Buildkey_old2(document.getElementById('college2').value);

//-->
</script>
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
<?php
mysqli_free_result($laf_user);
mysqli_free_result($laf_data);
?>