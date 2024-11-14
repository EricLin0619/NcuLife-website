<?php require_once('Connections/conn_LAF.php'); ?>
<?php //限制存取頁面

if (!isset($_SESSION)) {
  session_start();
}

header("Content-Type:text/html; charset=utf-8");

date_default_timezone_set("Asia/Taipei");

  $MM_redirect = "login.php";
  if (!isset($_SESSION['LAF_user'])) {header("Location: " . $MM_redirect);}
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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

  //上傳檔案處理
  $upfile = "";   //預設路徑檔名為空字串
  $ServerFilename = ""; //預設資料庫檔名為空字串

  //檢查是否有檔案上傳
  if (is_uploaded_file($_FILES['attachment']['tmp_name'])){

    //檢查檔案大小
    if($_FILES['attachment']['size'] > 20971520000){
      die("檔案大小不能超過 20MB !!");
    }
    
    //產生路徑和檔名
    $upfile = "attachment/";
    $File_Extension = explode(".", $_FILES['attachment']['name']); 
    $File_Extension = $File_Extension[count($File_Extension)-1]; 
    $ServerFilename = $upfile.date('Ymd_His').'.'.$File_Extension;
    
    //檢查檔案是否存在
    if (file_exists($ServerFilename)) {
      die("檔案已經存在");
    }

    // 檢查文件類型
    $allowed_types = ['image/jpeg']; // 只允許 JPEG 格式
    if (!in_array($_FILES['attachment']['type'], $allowed_types)) {
        die("只允許上傳 JPEG 圖像");
    }

    // 創建圖像資源
    $src = null;
    switch($_FILES['attachment']['type']) {
      case 'image/jpeg':
        $src = @imagecreatefromjpeg($_FILES['attachment']['tmp_name']);
        break;
      case 'image/png':
        $src = @imagecreatefrompng($_FILES['attachment']['tmp_name']);
        break;
      case 'image/gif':
        $src = @imagecreatefromgif($_FILES['attachment']['tmp_name']);
        break;
    }

    if (!$src) {
      die("無法創建圖像：可能是無效或損壞的圖像文件");
    }

    // 取得來源圖片長寬
    $src_w = imagesx($src);
    $src_h = imagesy($src);
    
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
    if (!$thumb) {
      die("無法創建縮圖");
    }

    // 開始縮圖
    if (!imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h)) {
      die("縮圖過程失敗");
    }

    // 儲存縮圖到指定 thumb 目錄
    if (!imagejpeg($thumb, $ServerFilename, 100)) {
      die("保存縮圖失敗");
    }

    // 釋放內存
    imagedestroy($src);
    imagedestroy($thumb);
  

  }
  $insertSQL = sprintf(
    "INSERT INTO laf_data (`number`, `date`, `time`, `time2`, `college`, `department`, `grade`, `student_id`, `name`, `tel`, `class`, `missing_name`, `missing_number`, `missing_unit`, `missing_place`, `missing_place2`, `attachment`, `containing`, `missing_state`, `user`, `user_dep`, `username`, `temp`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
      GetSQLValueString($_POST['number'], "text"),
      GetSQLValueString(date('Y-m-d H:i:s'), "date"),
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
      GetSQLValueString($_SESSION['LAF_user'], "text"),
      GetSQLValueString($row_laf_user['department'], "text"),
      GetSQLValueString($row_laf_user['name'], "text"),
      GetSQLValueString($_POST['temp'], "text")
    );


mysqli_select_db($conn_LAF, $database_conn_LAF);
$Result1 = mysqli_query($conn_LAF, $insertSQL);

if (!$Result1) {
    die("Error: " . mysqli_error($conn_LAF));
}

  // DEBUG CODE
  // 檢查 SQL 查詢是否成功執行
  // if ($Result1) {
  //     echo "資料成功寫入資料庫";
  // } else {
  //     echo "寫入資料庫時發生錯誤：" . mysqli_error($conn_LAF);
  // }

  $insertGoTo = "index.php";  
  //if (isset($_SERVER['QUERY_STRING'])) {
  //  $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
  //  $insertGoTo .= $_SERVER['QUERY_STRING'];
  //}  
  header(sprintf("Location: %s", $insertGoTo));
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
  if(num=="文學院") {	document.form1.department.options[ctr]=new Option("文學院學士班","文學院學士班");	ctr=ctr+1;	}
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
  if(num=="工學院") {	document.form1.department.options[ctr]=new Option("工學院學士班","工學院學士班");	ctr=ctr+1;	}
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
  if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("人工智慧國際碩士學位學程","人工智慧國際碩士學位學程");	ctr=ctr+1;	}
  if(num=="資電學院") {	document.form1.department.options[ctr]=new Option("資訊電機學院學士班","資訊電機學院學士班");	ctr=ctr+1;	}
	/*地科學院*/
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("地球科學學系","地球科學學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("大氣科學學系","大氣科學學系");	ctr=ctr+1;	}
  if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("太空科學與工程學系","太空科學與工程學系");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("太空科學研究所","太空科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("應用地質研究所","應用地質研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("水文與海洋科學研究所","水文與海洋科學研究所");	ctr=ctr+1;	}
	if(num=="地科學院") {	document.form1.department.options[ctr]=new Option("地球科學院學士班","地球科學院學士班");	ctr=ctr+1;	}
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
  /*永續與綠能科技研究學院*/
	if(num=="永續與綠能科技研究學院") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="永續與綠能科技研究學院") {	document.form1.department.options[ctr]=new Option("永續領導力碩/博士學位學程","永續領導力碩/博士學位學程");	ctr=ctr+1;	}
	if(num=="永續與綠能科技研究學院") {	document.form1.department.options[ctr]=new Option("永續去碳科技碩/博士學位學程","永續去碳科技碩/博士學位學程");	ctr=ctr+1;	}
	if(num=="永續與綠能科技研究學院") {	document.form1.department.options[ctr]=new Option("永續綠能科技碩/博士學位學程","永續綠能科技碩/博士學位學程");	ctr=ctr+1;	}  
  /*校屬研究中心*/
	if(num=="校屬研究中心") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="校屬研究中心") {	document.form1.department.options[ctr]=new Option("太空及遙測研究中心","太空及遙測研究中心");	ctr=ctr+1;	}
	if(num=="校屬研究中心") {	document.form1.department.options[ctr]=new Option("光電科學研究中心","光電科學研究中心");	ctr=ctr+1;	}
	if(num=="校屬研究中心") {	document.form1.department.options[ctr]=new Option("環境研究中心","環境研究中心");	ctr=ctr+1;	}  
  if(num=="校屬研究中心") {	document.form1.department.options[ctr]=new Option("台灣經濟發展研究中心","台灣經濟發展研究中心");	ctr=ctr+1;	}  
	if(num=="校屬研究中心") {	document.form1.department.options[ctr]=new Option("前瞻科技研究中心","前瞻科技研究中心");	ctr=ctr+1;	}  
   /*功能性校級研究中心*/
	if(num=="功能性校級研究中心") {	document.form1.department.options[ctr]=new Option("請選擇系所...","");	ctr=ctr+1;	}
	if(num=="功能性校級研究中心") {	document.form1.department.options[ctr]=new Option("太空科學與科技研究中心","太空科學與科技研究中心");	ctr=ctr+1;	}
	if(num=="功能性校級研究中心") {	document.form1.department.options[ctr]=new Option("地震災害鏈風險評估及管理研究中心","地震災害鏈風險評估及管理研究中心");	ctr=ctr+1;	}
	if(num=="功能性校級研究中心") {	document.form1.department.options[ctr]=new Option("高能與強場物理研究中心","高能與強場物理研究中心");	ctr=ctr+1;	}  
  if(num=="功能性校級研究中心") {	document.form1.department.options[ctr]=new Option("環境監測技術聯合中心","環境監測技術聯合中心");	ctr=ctr+1;	}  
	if(num=="功能性校級研究中心") {	document.form1.department.options[ctr]=new Option("認知智慧與精準健康照護研究中心","認知智慧與精準健康照護研究中心");	ctr=ctr+1;	}  

  /*其他*/
	if(num=="其他") {	document.form1.department.options[ctr]=new Option("其他","其他");	ctr=ctr+1;	}

	document.form1.department.length=ctr;
	document.form1.department.options[0].selected=true;
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
					<form name="second">
                    <p align="left">
                    系統將在 <label id="timecount" class="style1">900</label> 秒後自動存檔!
                    </p>
					</form>
					<script>countSecond()</script>
					<script>setTimeout("document.form1.submit()",900000)</script>
                      <h2>填寫拾得失物招領登記表</h2>
                      <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <table width="750" border="0" align="center">
                          <tr>
                            <td valign="top"><div align="right"><strong>編號：</strong></div></td>
                            <td width="600"><input name="number" type="text" id="number" maxlength="50" /></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>拾得日期：</strong></div></td>
                            <td width="600"><button id="time_tri">點選日期</button>
                              <span id="sprytextfield1">
                              <input name="time" id="time" size="15" />
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
                            <td valign="top"><div align="right"><strong>拾得時間：</strong></div></td>
                            <td width="600">
							<label for="time2"></label>
							<span id="sprytextfield2">
							<input size="15" id="time2" name="time2"/>
							<span class="textfieldRequiredMsg">此項目不可空白。</span><span class="textfieldInvalidFormatMsg">格式錯誤。</span></span>(時間格式：13:00)</td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人學院：</strong></div></td>
                            <td width="600"><span id="spryselect1">
                              <select name="college" size="1" id="college" onchange="Buildkey(this.options[this.options.selectedIndex].value);">
                                <option value="">請選擇學院...</option>
                                <option value="文學院" >文學院</option>
                                <option value="理學院" >理學院</option>
                                <option value="工學院" >工學院</option>
                                <option value="管理學院" >管理學院</option>
                                <option value="資電學院" >資電學院</option>
                                <option value="地科學院" >地科學院</option>
                                <option value="客家學院" >客家學院</option>
                                <option value="生醫理工學院" >生醫理工學院</option>
                                <option value="永續與綠能科技研究學院" >永續與綠能科技研究學院</option>
                                <option value="校屬研究中心" >校屬研究中心</option>
                                <option value="功能性校級研究中心" >功能性校級研究中心</option>                                
                                <option value="其他" >其他</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人系所：</strong></div></td>
                            <td width="600"><span id="spryselect2">
                              <select name="department" size="1" id="department">
                                <option value="">請選擇系所..</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人級別：</strong></div></td>
                            <td width="600"><span id="spryselect3">
                              <select name="grade" id="grade">
                                <option value="" selected="selected">請選擇</option>
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
                            <td valign="top"><div align="right"><strong>拾得人學號：</strong></div></td>
                            <td><span id="sprytextfield3">
                              <input name="student_id" type="text" id="student_id" maxlength="10"/>
                              <span class="textfieldRequiredMsg">此項目不可空白。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人姓名：</strong></div></td>
                          <td width="600"><span id="sprytextfield4">
                            <input name="name" type="text" id="name" maxlength="10" />
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得人手機/分機：</strong></div></td>
                            <td width="600"><span id="sprytextfield5">
                             <input name="tel" type="text" id="tel" maxlength="30" />
                             <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>拾得物類別：</strong></div></td>
                            <td width="600"><span id="spryselect4">
                              <select name="class" size="1" id="class" >
                                <option value="" selected="selected">請選擇類別...</option>
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
                              <input name="missing_name" type="text" id="missing_name" maxlength="50" />
                              <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物數量：</strong></div></td>
                            <td width="600"><span id="sprytextfield7">
                              <input name="missing_number" type="text" id="missing_number" size="5" maxlength="3" />
                              <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物單位：</strong></div></td>
                            <td width="600"><span id="sprytextfield8">
                              <input name="missing_unit" type="text" id="missing_unit" size="5" maxlength="5" />(例：張、個)
                              <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>拾得地點分類：</strong></div></td>
                            <td width="600"><span id="spryselect5">
                              <select name="missing_place" size="1" id="missing_place" >
                                <option value="" selected="selected">請選擇地點分類...</option>
                                <option value="系館" >系館</option>
                                <option value="依仁堂" >依仁堂</option>
                                <option value="(總)圖書館" >(總)圖書館</option>
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
                                <option value="百花川(步道)" >百花川(步道)</option>
                                <option value="中大湖" >中大湖</option>
                                <option value="環校道路" >環校道路</option>
                                <option value="中大路(前門)" >中大路(前門)</option>
                                <option value="中央路(後門)" >中央路(後門)</option>     
                                <option value="教研大樓" >教研大樓</option>
                                <option value="國民運動中心" >國民運動中心</option>
                                <option value="大禮堂" >大禮堂</option>
                                <option value="太極銅雕" >太極銅雕</option>
                                <option value="全家便利商店" >全家便利商店</option>
                                <option value="環校道路" >環校道路</option>
                                <option value="游藝館" >游藝館</option>
                                <option value="志道樓" >志道樓</option>
                                <option value="依仁堂" >依仁堂</option>                                
                          
                                <option value="其它" >其它</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得地點：</strong></div></td>
                            <td width="600"><span id="sprytextfield9">
                              <input name="missing_place2" type="text" id="missing_place2" maxlength="50" />
                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>                            </td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>拾得物照片：</strong></div></td>
                            <td><input name="attachment" type="file" id="attachment" /></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>拾得人拋棄：</strong></div></td>
                            <td width="600"><span id="spryselect7">
                              <select name="containing" size="1" id="containing" >
                                <option value="" selected="selected">請選擇...</option>
                                <option value="是" >是</option>
                                <option value="否" >否</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>所有人識別資料：</strong></div></td>
                            <td width="600"><span id="spryselect6">
                              <select name="missing_state" size="1" id="missing_state" >
                                <option value="" selected="selected">請選擇...</option>
                                <option value="有" >有</option>
                                <option value="無" >無</option>
                              </select>
                            <span class="selectRequiredMsg">請選取項目。</span></span></td>
                          </tr>
                          <tr>
                            <td width="150" valign="top"><div align="right"><strong>登記人：</strong></div></td>
                            <td width="600"><?php echo $row_laf_user['department'].'-'.$row_laf_user['name'];?></td>
                          </tr>
                          <tr>
                            <td valign="top"><div align="right"><strong>是否暫存：</strong></div></td>
                            <td width="600"><input name="temp" type="radio" id="temp" value="Y" checked="checked" />
                              是
                                <input name="temp" type="radio" id="temp" value="N" />
                            否</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td width="600"><div align="center">
                              <input name="Submit" type="Submit" value="送出" onclick="check_form()" />
                            </div></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="form1" />
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
  /* 判斷是否暫存 */
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
	  var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7");
  }
}
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
?>