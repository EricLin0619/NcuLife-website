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

    $colname_csrc_user = "-1";
    if (isset($_SESSION['CSRC_user'])) {
      $colname_csrc_user = (get_magic_quotes_gpc()) ? $_SESSION['CSRC_user'] : addslashes($_SESSION['CSRC_user']);
    }
    mysqli_select_db($conn_CSRC,$database_conn_CSRC);
    $query_csrc_user = sprintf("SELECT * FROM `csrc_user` WHERE `user` = '%s'", $colname_csrc_user);
    $csrc_user = mysqli_query($conn_CSRC,$query_csrc_user) or die(mysqli_connect_error());
    $row_csrc_user = mysqli_fetch_assoc($csrc_user);

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

      if($_POST['class2']=="車禍"){
         $car=$_POST['car'];
         $reason=$_POST['reason'];
         if($_POST['injury'] != NULL){$injury=implode('、',$_POST['injury']);}
         //新增
         $activities=$_POST['activities'];
         $other_car=$_POST['other_car'];
         $helmet=$_POST['helmet'];
         $car_age=$_POST['car_age'];
         if($_POST['weather'] != NULL){$weather=implode('、',$_POST['weather']);}
      }else{
         $car='';
         $reason='';
         $injury='';
         //新增
         $activities='';
         $other_car='';
         $helmet='';
         $car_age='';
         $weather='';
      }

      if(($_POST['class2']=="車禍")||($_POST['class2']=="運動受傷")||($_POST['class2']=="意外傷害")){$deliver=$_POST['deliver'];}else{$deliver='';}

      if(($_POST['class2']=="運動受傷")||($_POST['class2']=="意外傷害")){if($_POST['part'] !=NULL){$part=implode('、',$_POST['part']);}}else{$part='';}

      if($_POST['class2']=="運動受傷"){if($_POST['sub_class'] !=NULL){$sub_class=implode('、',$_POST['sub_class']);}}
      else if($_POST['class2']=="意外傷害"){if($_POST['sub_class2'] !=NULL){$sub_class=implode('、',$_POST['sub_class2']);}}
      else{$sub_class='';}


      move_uploaded_file($_FILES['img1']['tmp_name'],  iconv("UTF-8", "big5", 'security_img/'.$_FILES['img1']['name']));
      move_uploaded_file($_FILES['img2']['tmp_name'],  iconv("UTF-8", "big5", 'security_img/'.$_FILES['img2']['name']));
      move_uploaded_file($_FILES['img3']['tmp_name'],  iconv("UTF-8", "big5", 'security_img/'.$_FILES['img3']['name']));
      move_uploaded_file($_FILES['img4']['tmp_name'],  iconv("UTF-8", "big5", 'security_img/'.$_FILES['img4']['name']));

      $insertSQL = sprintf("INSERT INTO csrc_data (`date`, `time`, `time2`, `college`, `department`, `grade`, `student_id`, `name`, `sex`, `class`, `class2`, `place`, `place2`, `other`, `car`, `reason`, `injury`, `deliver`, `sub_class`, `part`, `what`, `how`, `user`, `user_dep`, `username`, `secret`, `temp`, `activities`, `other_car`, `helmet`, `car_age`, `weather`, `img1`, `img2`, `img3`, `img4`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                           GetSQLValueString(date('Y-m-d H:i:s'), "date"),
                           GetSQLValueString($_POST['time'], "date"),
                           GetSQLValueString($_POST['time2'], "date"),
                           GetSQLValueString($_POST['college'], "text"),
                           GetSQLValueString($_POST['department'], "text"),
                           GetSQLValueString($_POST['grade'], "text"),
                           GetSQLValueString($_POST['student_id'], "text"),
                           GetSQLValueString($_POST['name'], "text"),
                           GetSQLValueString($_POST['sex'], "text"),
                           GetSQLValueString($_POST['class'], "text"),
                           GetSQLValueString($_POST['class2'], "text"),
                           GetSQLValueString($_POST['place'], "text"),
                           GetSQLValueString($_POST['place2'], "text"),
                           GetSQLValueString($_POST['other'], "text"),
                           GetSQLValueString($car, "text"),
                           GetSQLValueString($reason, "text"),
                           GetSQLValueString($injury, "text"),
                           GetSQLValueString($deliver, "text"),
                           GetSQLValueString($sub_class, "text"),
                           GetSQLValueString($part, "text"),
                           GetSQLValueString($_POST['what'], "text"),
                           GetSQLValueString($_POST['how'], "text"),
                           GetSQLValueString($_SESSION['CSRC_user'], "text"),
                           GetSQLValueString($row_csrc_user['department'], "text"),
                           GetSQLValueString($row_csrc_user['name'], "text"),
                           GetSQLValueString($_POST['secret'], "text"),
                           GetSQLValueString($_POST['temp'], "text"),
                           GetSQLValueString($activities, "text"),
                           GetSQLValueString($other_car, "text"),
                           GetSQLValueString($helmet, "text"),
                           GetSQLValueString($car_age, "text"),
                           GetSQLValueString($weather, "text"),
                           GetSQLValueString($_FILES['img1']['name'], "text"),
                           GetSQLValueString($_FILES['img2']['name'], "text"),
                           GetSQLValueString($_FILES['img3']['name'], "text"),
                           GetSQLValueString($_FILES['img4']['name'], "text"));

      mysqli_select_db($conn_CSRC,$database_conn_CSRC);
      $Result1 = mysqli_query($conn_CSRC,$insertSQL) or die(mysqli_connect_error());

      $insertGoTo = "index.php";

    if(($_POST['temp']=='N')&&($_POST['send']=='Y')){

      //寄信
    header("Content-type: text/html; charset=utf-8"); 
    ini_set('SMTP','smtp.cc.ncu.edu.tw');  //NCU網路 
    ini_set('sendmail_from','ncu7212@cc.ncu.edu.tw');
    mb_internal_encoding("utf-8");

    $to = 'ncu7212@cc.ncu.edu.tw';

    function encodeMIMEString ($enc, $string)
    {
       return "=?$enc?B?".base64_encode($string)."?=";
    } 
    $subject = encodeMIMEString ("UTF-8", "校安狀況：".$_POST['class'].' - '.$_POST['class2']);

    if($_POST['secret']=='Y'){$new_college='*****';}else{$new_college=$_POST['college'];}
    if($_POST['secret']=='Y'){$new_department='*****';}else{$new_department=$_POST['department'];}
    if($_POST['secret']=='Y'){$new_grade='***';}else{$new_grade=$_POST['grade'];}
    if($_POST['secret']=='Y'){$new_student_id='*********';}else{$new_student_id=$_POST['student_id'];}
    if($_POST['secret']=='Y'){$new_name=mb_substr($_POST['name'], 0, 1,"UTF-8");for($i=1;$i<mb_strlen($_POST['name'], "UTF-8");$i++){$new_name.='Ｏ';}}else{$new_name=$_POST['name'];}

    $message = "
    <table width=\"750\" align=\"center\" border=\"0\" bordercolor=\"#000000\" style='font-family:標楷體;border-top:solid 2.0pt;border-left:solid 2.0pt;border-bottom:solid 2.0pt;border-right:solid 2.0pt;'>
      <tr>
        <td colspan=\"10\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'><p style='font-size:22pt' align=\"center\"><strong>國立中央大學校園安全校安狀況處理紀錄表</strong></p>
        <div align='center'>□通報教育部校安中心 序號：　　　　　　□列管持續處理　　　　　　　　日期：".$_POST['time']."</div>&nbsp;</td>
      </tr>
      <tr>
        <td width=\"50\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;' align=\"center\"><p align=\"center\">時間</p></td>
        <td width=\"75\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;' align=\"center\"><p align=\"center\">".$_POST['time2']."</p></td>
        <td width=\"50\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;' align=\"center\"><p align=\"center\">地點</p></td>
        <td width=\"125\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;' align=\"center\"><p align=\"center\">".$_POST['place'].' - '.$_POST['place2']."</p></td>
        <td width=\"80\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;' align=\"center\"><p align=\"center\">處理人員</p></td>
        <td width=\"70\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;' align=\"center\"><p align=\"center\">".$row_csrc_user['name']."</p></td>
      </tr>
      <tr>
        <td align=\"center\" valign=\"middle\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><strong>基<br />
        本<br />
        資<br />
        料</strong></td>
        <td colspan=\"5\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'>
        <br />
        系級：".$new_college.' - '.$new_department.'　'.$new_grade."<br /><br />
        學號：".$new_student_id."　　姓名：".$new_name."<br /><br />
        電話：________________　　緊急連絡人電話：________________<br /><br />
        陪伴同學：________________　　電話：________________<br />　
        </td>
      </tr>
      <tr>
        <td align=\"center\" valign=\"middle\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><strong>類<br />
        別</strong></td>
        <td colspan=\"5\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'>".$_POST['class'].' - '.$_POST['class2']."</td>
      </tr>
      <tr>
        <td align=\"center\" valign=\"middle\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:solid 1.0pt;'><strong>摘<br />
        要</strong></td>
        <td colspan=\"5\" style='border-top:none;border-left:none;border-bottom:solid 1.0pt;border-right:none;'>".str_replace($_POST['name'],$new_name,$_POST['what'])."</td>
      </tr>
      <tr>
        <td align=\"center\" valign=\"middle\" style='border-top:none;border-left:none;border-bottom:none;border-right:solid 1.0pt;'><strong>處<br />
        理<br />
        情<br />
        形</strong></td>
        <td colspan=\"5\" style='border-top:none;border-left:none;border-bottom:none;border-right:none;'>".nl2br(str_replace($_POST['name'],$new_name,$_POST['how']))."</td>
      </tr>
    </table>";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

    // More headers
    $headers .= 'From: NCU CSRC<ncu7212@cc.ncu.edu.tw>' . "\r\n";
    mail($to, $subject, $message, $headers);
    }

      header(sprintf("Location: %s", $insertGoTo));
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
    <script src="../SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
    <script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
    <script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
    <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

    <script LANGUAGE="javascript">
        var second = 0;

        function countSecond() {
            second = second + 1
            second2 = 900 - second
            document.getElementById("timecount").innerHTML = second2
            setTimeout("countSecond( )", 1000)
        }

        function Buildkey(num) {
            var ctr = 0;
            document.form1.class2.selectedIndex = 0;
            /*
            定義二階選單內容
            if(num=="第一階下拉選單的值") {	d
              ocument.form1.class2.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");
            	ctr=ctr+1;
            }
            */
            /*意外事件*/
            if (num == "意外事件") {
                document.form1.class2.options[ctr] = new Option("請選擇細項...", "");
                ctr = ctr + 1;
            }
            if (num == "意外事件") {
                document.form1.class2.options[ctr] = new Option("車禍", "車禍");
                ctr = ctr + 1;
            }
            if (num == "意外事件") {
                document.form1.class2.options[ctr] = new Option("詐騙", "詐騙");
                ctr = ctr + 1;
            }
            if (num == "意外事件") {
                document.form1.class2.options[ctr] = new Option("運動受傷", "運動受傷");
                ctr = ctr + 1;
            }
            if (num == "意外事件") {
                document.form1.class2.options[ctr] = new Option("意外傷害", "意外傷害");
                ctr = ctr + 1;
            }
            if (num == "意外事件") {
                document.form1.class2.options[ctr] = new Option("意外死亡", "意外死亡");
                ctr = ctr + 1;
            }
            if (num == "意外事件") {
                document.form1.class2.options[ctr] = new Option("火災", "火災");
                ctr = ctr + 1;
            }
            if (num == "意外事件") {
                document.form1.class2.options[ctr] = new Option("其他", "其他");
                ctr = ctr + 1;
            }
            /*一般事件*/
            if (num == "一般事件") {
                document.form1.class2.options[ctr] = new Option("請選擇細項...", "");
                ctr = ctr + 1;
            }
            if (num == "一般事件") {
                document.form1.class2.options[ctr] = new Option("生病", "生病");
                ctr = ctr + 1;
            }
            if (num == "一般事件") {
                document.form1.class2.options[ctr] = new Option("送醫", "送醫");
                ctr = ctr + 1;
            }
            if (num == "一般事件") {
                document.form1.class2.options[ctr] = new Option("協尋", "協尋");
                ctr = ctr + 1;
            }
            if (num == "一般事件") {
                document.form1.class2.options[ctr] = new Option("其他", "其他");
                ctr = ctr + 1;
            }
            /*財務事件*/
            if (num == "財務事件") {
                document.form1.class2.options[ctr] = new Option("請選擇細項...", "");
                ctr = ctr + 1;
            }
            if (num == "財務事件") {
                document.form1.class2.options[ctr] = new Option("物品尋獲", "物品尋獲");
                ctr = ctr + 1;
            }
            if (num == "財務事件") {
                document.form1.class2.options[ctr] = new Option("遺失", "遺失");
                ctr = ctr + 1;
            }
            if (num == "財務事件") {
                document.form1.class2.options[ctr] = new Option("竊盜", "竊盜");
                ctr = ctr + 1;
            }
            if (num == "財務事件") {
                document.form1.class2.options[ctr] = new Option("設備故障", "設備故障");
                ctr = ctr + 1;
            }
            if (num == "財務事件") {
                document.form1.class2.options[ctr] = new Option("其他", "其他");
                ctr = ctr + 1;
            }
            /*糾紛事件*/
            if (num == "糾紛事件") {
                document.form1.class2.options[ctr] = new Option("請選擇細項...", "");
                ctr = ctr + 1;
            }
            if (num == "糾紛事件") {
                document.form1.class2.options[ctr] = new Option("校外糾紛", "校外糾紛");
                ctr = ctr + 1;
            }
            if (num == "糾紛事件") {
                document.form1.class2.options[ctr] = new Option("校內糾紛", "校內糾紛");
                ctr = ctr + 1;
            }
            if (num == "糾紛事件") {
                document.form1.class2.options[ctr] = new Option("賃居糾紛", "賃居糾紛");
                ctr = ctr + 1;
            }
            if (num == "糾紛事件") {
                document.form1.class2.options[ctr] = new Option("其他", "其他");
                ctr = ctr + 1;
            }
            /*職業災害*/
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("請選擇細項...", "");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("墜落、滾落", "墜落、滾落");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("跌倒", "跌倒");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("衝撞", "衝撞");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("物體飛落", "物體飛落");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("物體倒塌、崩塌", "物體倒塌、崩塌");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("被撞", "被撞");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("被夾", "被夾");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("被捲", "被捲");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("被切、割、擦傷", "被切、割、擦傷");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("踩踏", "踩踏");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("溺水", "溺水");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("與高溫、低溫物體之接觸", "與高溫、低溫物體之接觸");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("與有害物之接觸", "與有害物之接觸");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("感電", "感電");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("爆炸", "爆炸");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("物體破裂", "物體破裂");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("火災", "火災");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("不當動作", "不當動作");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("鐵公路交通事故", "鐵公路交通事故");
                ctr = ctr + 1;
            }
            if (num == "職業災害") {
                document.form1.class2.options[ctr] = new Option("其他交通事故", "其他交通事故");
                ctr = ctr + 1;
            }
            /*毒化災事件*/
            if (num == "毒化災事件") {
                document.form1.class2.options[ctr] = new Option("請選擇細項...", "");
                ctr = ctr + 1;
            }
            if (num == "毒化災事件") {
                document.form1.class2.options[ctr] = new Option("化學品洩漏", "化學品洩漏");
                ctr = ctr + 1;
            }
            if (num == "毒化災事件") {
                document.form1.class2.options[ctr] = new Option("化學品火災、爆炸", "化學品火災、爆炸");
                ctr = ctr + 1;
            }
            /*輻射事件*/
            if (num == "輻射事件") {
                document.form1.class2.options[ctr] = new Option("請選擇細項...", "");
                ctr = ctr + 1;
            }
            if (num == "輻射事件") {
                document.form1.class2.options[ctr] = new Option("人員輻射誤照射", "人員輻射誤照射");
                ctr = ctr + 1;
            }
            if (num == "輻射事件") {
                document.form1.class2.options[ctr] = new Option("放射性物質洩漏", "放射性物質洩漏");
                ctr = ctr + 1;
            }
            if (num == "輻射事件") {
                document.form1.class2.options[ctr] = new Option("放射性物質遺失", "放射性物質遺失");
                ctr = ctr + 1;
            }
            /*環保事件*/
            if (num == "環保事件") {
                document.form1.class2.options[ctr] = new Option("請選擇細項...", "");
                ctr = ctr + 1;
            }
            if (num == "環保事件") {
                document.form1.class2.options[ctr] = new Option("廢水異常排放", "廢水異常排放");
                ctr = ctr + 1;
            }
            if (num == "環保事件") {
                document.form1.class2.options[ctr] = new Option("廢氣異常排放", "廢氣異常排放");
                ctr = ctr + 1;
            }
            if (num == "環保事件") {
                document.form1.class2.options[ctr] = new Option("廢棄物異常丟棄", "廢棄物異常丟棄");
                ctr = ctr + 1;
            }
            if (num == "環保事件") {
                document.form1.class2.options[ctr] = new Option("噪音量異常", "噪音量異常");
                ctr = ctr + 1;
            }
            /*其他*/
            if (num == "其他事件") {
                document.form1.class2.options[ctr] = new Option("請選擇細項...", "");
                ctr = ctr + 1;
            }
            if (num == "其他事件") {
                document.form1.class2.options[ctr] = new Option("情緒不穩", "情緒不穩");
                ctr = ctr + 1;
            }
            if (num == "其他事件") {
                document.form1.class2.options[ctr] = new Option("自我傷害", "自我傷害");
                ctr = ctr + 1;
            }
            if (num == "其他事件") {
                document.form1.class2.options[ctr] = new Option("疑似性平", "疑似性平");
                ctr = ctr + 1;
            }
            if (num == "其他事件") {
                document.form1.class2.options[ctr] = new Option("其他", "其他");
                ctr = ctr + 1;
            }

            document.form1.class2.length = ctr;
            document.form1.class2.options[0].selected = true;
        }

        function Buildkey2(num) {
            var ctr = 0;
            document.form1.department.selectedIndex = 0;
            /*
            定義二階選單內容
            if(num=="第一階下拉選單的值") {	d
              ocument.form1.department.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");
            	ctr=ctr+1;
            }
            */
           if (num == "承攬商") {
                document.form1.department.options[ctr] = new Option("此項目免填", "");
                ctr = ctr + 1;
            }
            /*文學院*/
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("請選擇系所...", "");
                ctr = ctr + 1;
            }
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("中國文學系", "中國文學系");
                ctr = ctr + 1;
            }
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("英美語文學系", "英美語文學系");
                ctr = ctr + 1;
            }
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("法國語文學系", "法國語文學系");
                ctr = ctr + 1;
            }
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("文學院學士班", "文學院學士班");
                ctr = ctr + 1;
            }
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("哲學研究所", "哲學研究所");
                ctr = ctr + 1;
            }
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("藝術學研究所", "藝術學研究所");
                ctr = ctr + 1;
            }
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("歷史研究所", "歷史研究所");
                ctr = ctr + 1;
            }
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("學習與教學研究所", "學習與教學研究所");
                ctr = ctr + 1;
            }
            if (num == "文學院") {
                document.form1.department.options[ctr] = new Option("亞際文化研究國際碩士學位學程(台聯大)", "亞際文化研究國際碩士學位學程(台聯大)");
                ctr = ctr + 1;
            }
            /*理學院*/
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("請選擇系所...", "");
                ctr = ctr + 1;
            }
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("理學院學士班", "理學院學士班");
                ctr = ctr + 1;
            }
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("物理學系", "物理學系");
                ctr = ctr + 1;
            }
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("數學系計算與資料科學組", "數學系計算與資料科學組");
                ctr = ctr + 1;
            }
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("數學系數學科學組", "數學系數學科學組");
                ctr = ctr + 1;
            }
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("化學學系", "化學學系");
                ctr = ctr + 1;
            }
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("統計研究所", "統計研究所");
                ctr = ctr + 1;
            }
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("光電科學與工程學系", "光電科學與工程學系");
                ctr = ctr + 1;
            }
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("天文研究所", "天文研究所");
                ctr = ctr + 1;
            }
            if (num == "理學院") {
                document.form1.department.options[ctr] = new Option("光電博士學位學程(台聯大)", "光電博士學位學程(台聯大)");
                ctr = ctr + 1;
            }
            /*工學院*/
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("請選擇系所...", "");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("化學工程與材料工程學系", "化學工程與材料工程學系");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("土木工程學系", "土木工程學系");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("機械工程學系", "機械工程學系");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("能源工程研究所", "能源工程研究所");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("環境工程研究所", "環境工程研究所");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("營建管理研究所", "營建管理研究所");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("材料科學與工程研究所", "材料科學與工程研究所");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("工學院學士班", "工學院學士班");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("國際永續發展碩士在職專班", "國際永續發展碩士在職專班");
                ctr = ctr + 1;
            }
            if (num == "工學院") {
                document.form1.department.options[ctr] = new Option("應用材料科學國際研究生碩士學位學程", "應用材料科學國際研究生碩士學位學程");
                ctr = ctr + 1;
            }
            /*管理學院*/
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("請選擇系所...", "");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("企業管理學系", "企業管理學系");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("資訊管理學系", "資訊管理學系");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("財務金融學系", "財務金融學系");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("經濟學系", "經濟學系");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("會計研究所", "會計研究所");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("產業經濟研究所", "產業經濟研究所");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("人力資源管理研究所", "人力資源管理研究所");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("工業管理研究所", "工業管理研究所");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("管理學院高階主管企管碩士班(EMBA)", "管理學院高階主管企管碩士班(EMBA)");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("管理學院電算中心", "管理學院電算中心");
                ctr = ctr + 1;
            }
            if (num == "管理學院") {
                document.form1.department.options[ctr] = new Option("企業資源規劃(ERP)中心", "企業資源規劃(ERP)中心");
                ctr = ctr + 1;
            }
            /*資電學院*/
            if (num == "資電學院") {
                document.form1.department.options[ctr] = new Option("請選擇系所...", "");
                ctr = ctr + 1;
            }
            if (num == "資電學院") {
                document.form1.department.options[ctr] = new Option("電機工程學系", "電機工程學系");
                ctr = ctr + 1;
            }
            if (num == "資電學院") {
                document.form1.department.options[ctr] = new Option("資訊工程學系", "資訊工程學系");
                ctr = ctr + 1;
            }
            if (num == "資電學院") {
                document.form1.department.options[ctr] = new Option("通訊工程學系", "通訊工程學系");
                ctr = ctr + 1;
            }
            if (num == "資電學院") {
                document.form1.department.options[ctr] = new Option("資訊電機學院學士班", "資訊電機學院學士班");
                ctr = ctr + 1;
            }
            if (num == "資電學院") {
                document.form1.department.options[ctr] = new Option("網路學習科技研究所", "網路學習科技研究所");
                ctr = ctr + 1;
            }
            /*地科學院*/
            if (num == "地科學院") {
                document.form1.department.options[ctr] = new Option("請選擇系所...", "");
                ctr = ctr + 1;
            }
            if (num == "地科學院") {
                document.form1.department.options[ctr] = new Option("地球科學學系", "地球科學學系");
                ctr = ctr + 1;
            }
            if (num == "地科學院") {
                document.form1.department.options[ctr] = new Option("大氣科學學系", "大氣科學學系");
                ctr = ctr + 1;
            }
            if (num == "地科學院") {
                document.form1.department.options[ctr] = new Option("地球科學學院學士班", "地球科學學院學士班");
                ctr = ctr + 1;
            }
            if (num == "地科學院") {
                document.form1.department.options[ctr] = new Option("太空科學與工程學系", "太空科學與工程學系");
                ctr = ctr + 1;
            }
            if (num == "地科學院") {
                document.form1.department.options[ctr] = new Option("太空科學研究所", "太空科學研究所");
                ctr = ctr + 1;
            }
            if (num == "地科學院") {
                document.form1.department.options[ctr] = new Option("應用地質研究所", "應用地質研究所");
                ctr = ctr + 1;
            }
            if (num == "地科學院") {
                document.form1.department.options[ctr] = new Option("水文與海洋科學研究所", "水文與海洋科學研究所");
                ctr = ctr + 1;
            }
            if (num == "地科學院") {
                document.form1.department.options[ctr] = new Option("地球系統科學國際研究生博士學位學程", "地球系統科學國際研究生博士學位學程");
                ctr = ctr + 1;
            }
            /*客家學院*/
            if (num == "客家學院") {
                document.form1.department.options[ctr] = new Option("請選擇系所...", "");
                ctr = ctr + 1;
            }
            if (num == "客家學院") {
                document.form1.department.options[ctr] = new Option("客家語文暨社會科學學系", "客家語文暨社會科學學系");
                ctr = ctr + 1;
            }
            if (num == "客家學院") {
                document.form1.department.options[ctr] = new Option("法律與政府研究所", "法律與政府研究所");
                ctr = ctr + 1;
            }
            /*生醫理工學院*/
            if (num == "生醫理工學院") {
                document.form1.department.options[ctr] = new Option("請選擇系所...", "");
                ctr = ctr + 1;
            }
            if (num == "生醫理工學院") {
                document.form1.department.options[ctr] = new Option("生命科學系", "生命科學系");
                ctr = ctr + 1;
            }
            if (num == "生醫理工學院") {
                document.form1.department.options[ctr] = new Option("認知神經科學研究所", "認知神經科學研究所");
                ctr = ctr + 1;
            }
            if (num == "生醫理工學院") {
                document.form1.department.options[ctr] = new Option("生醫科學與工程學系", "生醫科學與工程學系");
                ctr = ctr + 1;
            }
            if (num == "生醫理工學院") {
                document.form1.department.options[ctr] = new Option("系統生物與生物資訊研究所", "系統生物與生物資訊研究所");
                ctr = ctr + 1;
            }
            if (num == "生醫理工學院") {
                document.form1.department.options[ctr] = new Option("生物醫學工程研究所", "生物醫學工程研究所");
                ctr = ctr + 1;
            }
            if (num == "生醫理工學院") {
                document.form1.department.options[ctr] = new Option("跨領域轉譯醫學研究所", "跨領域轉譯醫學研究所");
                ctr = ctr + 1;
            }
            if (num == "生醫理工學院") {
                document.form1.department.options[ctr] = new Option("跨領域神經科學博士學位學程(台聯大)", "跨領域神經科學博士學位學程(台聯大)");
                ctr = ctr + 1;
            }
            /*其他*/
            if (num == "其他") {
                document.form1.department.options[ctr] = new Option("其他", "其他");
                ctr = ctr + 1;
            }

            document.form1.department.length = ctr;
            document.form1.department.options[0].selected = true;
        }

        function Buildkey3(num) {
            var ctr = 0;
            document.form1.place.selectedIndex = 0;
            /*
            定義二階選單內容
            if(num=="第一階下拉選單的值") {	d
              ocument.form1.place.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");
            	ctr=ctr+1;
            }
            */
            /*校內 校外 其他*/
            if ((num == "車禍") || (num == "運動受傷") || (num == "意外傷害") || (num == "意外死亡") || (num == "火災") || (num == "生病") || (num == "送醫") || (num == "物品尋獲") || (num == "遺失") || (num == "竊盜") || (num == "情緒不穩") || (num == "自我傷害") || (num == "疑似性平")) {
                document.form1.place.options[ctr] = new Option("請選擇...", "");
                ctr = ctr + 1;
                document.form1.place.options[ctr] = new Option("校內", "校內");
                ctr = ctr + 1;
                document.form1.place.options[ctr] = new Option("校外", "校外");
                ctr = ctr + 1;
                document.form1.place.options[ctr] = new Option("其他", "其他");
                ctr = ctr + 1;
            }
            /*校內*/
            if ((num == "墜落、滾落") || (num == "跌倒") || (num == "衝撞") || (num == "物體飛落") || (num == "物體倒塌、崩塌") || (num == "被撞") || (num == "被夾") || (num == "被捲") || (num == "被切、割、擦傷") || (num == "踩踏") || (num == "溺水") || (num == "與高溫、低溫物體之接觸") || (num == "與有害物之接觸") || (num == "感電") || (num == "爆炸") || (num == "物體破裂") || (num == "火災") || (num == "不當動作") || (num == "鐵公路交通事故") || (num == "其他交通事故") || (num == "設備故障") || (num == "化學品洩漏") || (num == "化學品火災、爆炸") || (num == "人員輻射誤照射") || (num == "放射性物質洩漏") || (num == "放射性物質遺失") || (num == "廢水異常排放") || (num == "廢氣異常排放") || (num == "廢棄物異常丟棄") || (num == "噪音量異常")) {
                document.form1.place.options[ctr] = new Option("請選擇...", "");
                  ctr = ctr + 1;
                document.form1.place.options[ctr] = new Option("校內", "校內");
                  ctr = ctr + 1;
            }
            /*免填*/
            if ((num == "詐騙") || (num == "協尋") || (num == "校外糾紛") || (num == "校內糾紛") || (num == "賃居糾紛") || (num == "其他")) {
                document.form1.place.options[ctr] = new Option("此項目免填", "");
                ctr = ctr + 1;
            }

            document.form1.place.length = ctr;
            document.form1.place.options[0].selected = true;
        }

        function Buildkey4(num) {
            var ctr = 0;
            document.form1.place2.selectedIndex = 0;
            /*
            定義二階選單內容
            if(num=="第一階下拉選單的值") {	d
              ocument.form1.place2.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");
            	ctr=ctr+1;
            }
            */
            /*職業災害*/
            if ((document.getElementById('class2').value == "墜落、滾落") || (document.getElementById('class2').value == "跌倒") || (document.getElementById('class2').value == "衝撞") || (document.getElementById('class2').value == "物體飛落") || (document.getElementById('class2').value == "物體倒塌、崩塌") || (document.getElementById('class2').value == "被撞") || (document.getElementById('class2').value == "被夾") || (document.getElementById('class2').value == "被捲") || (document.getElementById('class2').value == "被切、割、擦傷") || (document.getElementById('class2').value == "踩踏") || (document.getElementById('class2').value == "溺水") || (document.getElementById('class2').value == "與高溫、低溫物體之接觸") || (document.getElementById('class2').value == "與有害物之接觸") || (document.getElementById('class2').value == "感電") || (document.getElementById('class2').value == "爆炸") || (document.getElementById('class2').value == "物體破裂") || (document.getElementById('class2').value == "火災") || (document.getElementById('class2').value == "不當動作") || (document.getElementById('class2').value == "鐵公路交通事故") || (document.getElementById('class2').value == "其他交通事故")) {
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                      ctr = ctr + 1;
                    document.form1.place2.options[ctr] = new Option("宿舍", "宿舍");
                      ctr = ctr + 1;
                    document.form1.place2.options[ctr] = new Option("館舍", "館舍");
                      ctr = ctr + 1;
                    document.form1.place2.options[ctr] = new Option("系所", "系所");
                      ctr = ctr + 1;
                    document.form1.place2.options[ctr] = new Option("實驗室", "實驗室");
                      ctr = ctr + 1;
                    document.form1.place2.options[ctr] = new Option("環校道路", "環校道路");
                      ctr = ctr + 1;
                    document.form1.place2.options[ctr] = new Option("百花川", "百花川");
                      ctr = ctr + 1;
                    document.form1.place2.options[ctr] = new Option("圓環", "圓環");
                      ctr = ctr + 1;
                    document.form1.place2.options[ctr] = new Option("其他", "其他");
                      ctr = ctr + 1;
                }
              }
            /*毒化災事件*/
            if ((document.getElementById('class2').value == "化學品洩漏") || (document.getElementById('class2').value == "化學品火災、爆炸")) {
              if (num == "校內") {
                document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("系所", "系所");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("研究中心", "研究中心");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("實驗室", "實驗室");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("其他", "其他");
                  ctr = ctr + 1;
              }
            }
            /*輻射事件*/
            if ((document.getElementById('class2').value == "人員輻射誤照射") || (document.getElementById('class2').value == "放射性物質洩漏") || (document.getElementById('class2').value == "放射性物質遺失")) {
              if (num == "校內") {
                document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("系所", "系所");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("研究中心", "研究中心");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("實驗室", "實驗室");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("其他", "其他");
                  ctr = ctr + 1;
              }
            }
            /*環保事件*/
            if ( (document.getElementById('class2').value == "廢水異常排放") || (document.getElementById('class2').value == "廢氣異常排放") || (document.getElementById('class2').value == "廢棄物異常丟棄") || (document.getElementById('class2').value == "噪音量異常")) {
              if (num == "校內") {
                document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("環校道路", "環校道路");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("百花川", "百花川");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("圓環", "圓環");
                  ctr = ctr + 1;
                document.form1.place2.options[ctr] = new Option("其他", "其他");
                  ctr = ctr + 1;
              }            }
            /*車禍*/
            if (document.getElementById('class2').value == "車禍") {
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("百花川", "百花川");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("圓環", "圓環");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("行政大樓前", "行政大樓前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("校長宿舍前", "校長宿舍前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("國鼎圖書館前", "國鼎圖書館前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("小木屋前", "小木屋前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("科二館前", "科二館前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("中大湖前", "中大湖前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("游泳池前", "游泳池前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("側門(北村出口)", "側門(北村出口)");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("環工所前", "環工所前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("機械館前", "機械館前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("松苑餐廳前", "松苑餐廳前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("國際處前", "國際處前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("女1-4舍下坡", "女1-4舍下坡");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("科一館前", "科一館前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("遊藝館前", "遊藝館前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("大講堂前", "大講堂前");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("其他", "其他");
                    ctr = ctr + 1;
                }

                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("宵夜街", "宵夜街");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("五興路", "五興路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("中央路", "中央路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("中大路", "中大路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("中正路", "中正路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("民族路", "民族路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("志廣路", "志廣路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("三民路", "三民路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("環南路", "環南路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("環西路", "環西路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("環北路", "環北路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("中豐路", "中豐路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("省道", "省道");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("高速公路", "高速公路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("其他(校外)", "其他(校外)");
                    ctr = ctr + 1;
                }

                if (num == "其他") {
                    document.form1.place2.options[ctr] = new Option("其他鄉鎮", "其他鄉鎮");
                    ctr = ctr + 1;
                }
            }

            /*運動受傷*/
            if (document.getElementById('class2').value == "運動受傷") {
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("棒壘球場", "棒壘球場");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("室外籃球場", "室外籃球場");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("羽球館", "羽球館");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("室外排球場", "室外排球場");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("依仁堂", "依仁堂");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("游泳池", "游泳池");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("溜冰場", "溜冰場");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("網球場", "網球場");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("操場", "操場");
                    ctr = ctr + 1;
                }

                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("校外", "校外");
                    ctr = ctr + 1;
                }

                if (num == "其他") {
                    document.form1.place2.options[ctr] = new Option("其他", "其他");
                    ctr = ctr + 1;
                }
            }

            /*意外傷害*/
            if (document.getElementById('class2').value == "意外傷害") {
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("校內草坪", "校內草坪");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("學生宿舍", "學生宿舍");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("圖書館", "圖書館");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("餐廳", "餐廳");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("辦公室", "辦公室");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("一般教室", "一般教室");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("實驗教室", "實驗教室");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("樓梯", "樓梯");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("中大湖", "中大湖");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("停車場", "停車場");
                    ctr = ctr + 1;
                }

                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("校外", "校外");
                    ctr = ctr + 1;
                }

                if (num == "其他") {
                    document.form1.place2.options[ctr] = new Option("其他", "其他");
                    ctr = ctr + 1;
                }
            }

            /*意外死亡*/
            if (document.getElementById('class2').value == "意外死亡") {
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("宿舍", "宿舍");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("系館", "系館");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("實驗室", "實驗室");
                    ctr = ctr + 1;
                }

                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("家中", "家中");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("海邊", "海邊");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("山上", "山上");
                    ctr = ctr + 1;
                }

                if (num == "其他") {
                    document.form1.place2.options[ctr] = new Option("其他", "其他");
                    ctr = ctr + 1;
                }
            }

            /*火災*/
            if (document.getElementById('class2').value == "火災") {
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("宿舍", "宿舍");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("系館", "系館");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("實驗室", "實驗室");
                    ctr = ctr + 1;
                }

                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("賃居處", "賃居處");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("教師宿舍", "教師宿舍");
                    ctr = ctr + 1;
                }

                if (num == "其他") {
                    document.form1.place2.options[ctr] = new Option("其他", "其他");
                    ctr = ctr + 1;
                }
            }

            /*生病*/
            /*送醫*/
            /*情緒不穩*/
            /*自我傷害*/ /*疑似性平*/
            if ((document.getElementById('class2').value == "生病") || (document.getElementById('class2').value == "送醫") || (document.getElementById('class2').value == "情緒不穩") || (document.getElementById('class2').value == "自我傷害") || (document.getElementById('class2').value == "疑似性平")) {
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("宿舍", "宿舍");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("系館", "系館");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("實驗室", "實驗室");
                    ctr = ctr + 1;
                }

                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("家中", "家中");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("賃居處", "賃居處");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("教師宿舍", "教師宿舍");
                    ctr = ctr + 1;
                }

                if (num == "其他") {
                    document.form1.place2.options[ctr] = new Option("其他", "其他");
                    ctr = ctr + 1;
                }
            }

            /*物品尋獲*/
            /*遺失*/
            /*竊盜*/
            if ((document.getElementById('class2').value == "物品尋獲") || (document.getElementById('class2').value == "遺失") || (document.getElementById('class2').value == "竊盜")) {
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("宿舍", "宿舍");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("系館", "系館");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("依仁堂", "依仁堂");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("棒球場", "棒球場");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("籃球場", "籃球場");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("實驗室", "實驗室");
                    ctr = ctr + 1;
                }

                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("消夜街", "消夜街");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("中央路", "中央路");
                    ctr = ctr + 1;
                }
                if (num == "校外") {
                    document.form1.place2.options[ctr] = new Option("警察通知", "警察通知");
                    ctr = ctr + 1;
                }

                if (num == "其他") {
                    document.form1.place2.options[ctr] = new Option("其他", "其他");
                    ctr = ctr + 1;
                }
            }

            /*設備故障*/
            if (document.getElementById('class2').value == "設備故障") {
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("請選擇細項...", "");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("宿舍", "宿舍");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("系館", "系館");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("實驗室", "實驗室");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("行政大樓", "行政大樓");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("圖書館", "圖書館");
                    ctr = ctr + 1;
                }
                if (num == "校內") {
                    document.form1.place2.options[ctr] = new Option("其他", "其他");
                    ctr = ctr + 1;
                }
            }

            document.form1.place2.length = ctr;
            document.form1.place2.options[0].selected = true;
        }

        function show(a) {
            var IsIE = false;
            var sAgent = navigator.userAgent.toLowerCase(); //判斷是否用IE瀏覽
            if (sAgent.indexOf("msie") != -1) {
                IsIE = true;
            } //IE6.0-7
            if (sAgent.indexOf("msie 10.0") != -1) {
                IsIE = false;
            } //IE10.0
            if (document.getElementById('college').value == "承攬商") {
              if (IsIE) {
                document.getElementById('sub_16').style.display = 'inline';
                document.getElementById('sub_17').style.display = 'inline';
                document.getElementById('sub_18').style.display = 'inline';
              }
              else {
                document.getElementById('sub_16').style.display = 'table-row';
                document.getElementById('sub_17').style.display = 'table-row';
                document.getElementById('sub_18').style.display = 'table-row';
              }
            }
            if ((document.getElementById('class').value == "職業災害") || (document.getElementById('class').value == "毒化災事件") || document.getElementById('class').value == "輻射事件") {
              if (IsIE) {
                document.getElementById('sub_01').style.display = 'none';
                document.getElementById('sub_02').style.display = 'none';
                document.getElementById('sub_03').style.display = 'none';
                document.getElementById('sub_04').style.display = 'none';
                document.getElementById('sub_05').style.display = 'none';
                document.getElementById('sub_06').style.display = 'none';
                document.getElementById('sub_07').style.display = 'none';
                document.getElementById('sub_08').style.display = 'none';
                document.getElementById('sub_09').style.display = 'none';
                document.getElementById('sub_10').style.display = 'none';
                document.getElementById('sub_11').style.display = 'none';
                document.getElementById('sub_12').style.display = 'none';
                document.getElementById('sub_13').style.display = 'inline';
                document.getElementById('sub_14').style.display = 'inline';
                document.getElementById('sub_15').style.display = 'inline';
              }
              else {
                document.getElementById('sub_01').style.display = 'none';
                document.getElementById('sub_02').style.display = 'none';
                document.getElementById('sub_03').style.display = 'none';
                document.getElementById('sub_04').style.display = 'none';
                document.getElementById('sub_05').style.display = 'none';
                document.getElementById('sub_06').style.display = 'none';
                document.getElementById('sub_07').style.display = 'none';
                document.getElementById('sub_08').style.display = 'none';
                document.getElementById('sub_09').style.display = 'none';
                document.getElementById('sub_10').style.display = 'none';
                document.getElementById('sub_11').style.display = 'none';
                document.getElementById('sub_12').style.display = 'none';
                document.getElementById('sub_13').style.display = 'table-row';
                document.getElementById('sub_14').style.display = 'table-row';
                document.getElementById('sub_15').style.display = 'table-row';
              }
            }
            if (document.getElementById('class').value == "環保事件") {
              if (IsIE) {
                document.getElementById('sub_01').style.display = 'none';
                document.getElementById('sub_02').style.display = 'none';
                document.getElementById('sub_03').style.display = 'none';
                document.getElementById('sub_04').style.display = 'none';
                document.getElementById('sub_05').style.display = 'none';
                document.getElementById('sub_06').style.display = 'none';
                document.getElementById('sub_07').style.display = 'none';
                document.getElementById('sub_08').style.display = 'none';
                document.getElementById('sub_09').style.display = 'none';
                document.getElementById('sub_10').style.display = 'none';
                document.getElementById('sub_11').style.display = 'none';
                document.getElementById('sub_12').style.display = 'none';
                document.getElementById('sub_13').style.display = 'inline';
                document.getElementById('sub_14').style.display = 'none';
                document.getElementById('sub_15').style.display = 'none';
              }
              else {
                document.getElementById('sub_01').style.display = 'none';
                document.getElementById('sub_02').style.display = 'none';
                document.getElementById('sub_03').style.display = 'none';
                document.getElementById('sub_04').style.display = 'none';
                document.getElementById('sub_05').style.display = 'none';
                document.getElementById('sub_06').style.display = 'none';
                document.getElementById('sub_07').style.display = 'none';
                document.getElementById('sub_08').style.display = 'none';
                document.getElementById('sub_09').style.display = 'none';
                document.getElementById('sub_10').style.display = 'none';
                document.getElementById('sub_11').style.display = 'none';
                document.getElementById('sub_12').style.display = 'none';
                document.getElementById('sub_13').style.display = 'table-row';
                document.getElementById('sub_14').style.display = 'none';
                document.getElementById('sub_15').style.display = 'none';
              }
            }

            if (a == "車禍") {
                if (IsIE) {
                    document.getElementById('sub_01').style.display = 'inline';
                    document.getElementById('sub_02').style.display = 'inline';
                    document.getElementById('sub_03').style.display = 'inline';
                    document.getElementById('sub_04').style.display = 'inline';
                    document.getElementById('sub_05').style.display = 'none';
                    document.getElementById('sub_06').style.display = 'none';
                    document.getElementById('sub_07').style.display = 'none';
                    document.getElementById('sub_08').style.display = 'inline';
                    document.getElementById('sub_09').style.display = 'inline';
                    document.getElementById('sub_10').style.display = 'inline';
                    document.getElementById('sub_11').style.display = 'inline';
                    document.getElementById('sub_12').style.display = 'inline';
                } else {
                    document.getElementById('sub_01').style.display = 'table-row';
                    document.getElementById('sub_02').style.display = 'table-row';
                    document.getElementById('sub_03').style.display = 'table-row';
                    document.getElementById('sub_04').style.display = 'table-row';
                    document.getElementById('sub_05').style.display = 'none';
                    document.getElementById('sub_06').style.display = 'none';
                    document.getElementById('sub_07').style.display = 'none';
                    document.getElementById('sub_08').style.display = 'table-row';
                    document.getElementById('sub_09').style.display = 'table-row';
                    document.getElementById('sub_10').style.display = 'table-row';
                    document.getElementById('sub_11').style.display = 'table-row';
                    document.getElementById('sub_12').style.display = 'table-row';
                }
            } else if (a == "運動受傷") {
                if (IsIE) {
                    document.getElementById('sub_01').style.display = 'none';
                    document.getElementById('sub_02').style.display = 'none';
                    document.getElementById('sub_03').style.display = 'none';
                    document.getElementById('sub_04').style.display = 'inline';
                    document.getElementById('sub_05').style.display = 'inline';
                    document.getElementById('sub_06').style.display = 'none';
                    document.getElementById('sub_07').style.display = 'inline';
                    document.getElementById('sub_08').style.display = 'none';
                    document.getElementById('sub_09').style.display = 'none';
                    document.getElementById('sub_10').style.display = 'none';
                    document.getElementById('sub_11').style.display = 'none';
                    document.getElementById('sub_12').style.display = 'none';
                } else {
                    document.getElementById('sub_01').style.display = 'none';
                    document.getElementById('sub_02').style.display = 'none';
                    document.getElementById('sub_03').style.display = 'none';
                    document.getElementById('sub_04').style.display = 'table-row';
                    document.getElementById('sub_05').style.display = 'table-row';
                    document.getElementById('sub_06').style.display = 'none';
                    document.getElementById('sub_07').style.display = 'table-row';
                    document.getElementById('sub_08').style.display = 'none';
                    document.getElementById('sub_09').style.display = 'none';
                    document.getElementById('sub_10').style.display = 'none';
                    document.getElementById('sub_11').style.display = 'none';
                    document.getElementById('sub_12').style.display = 'none';
                }
            } else if (a == "意外傷害") {
                if (IsIE) {
                    document.getElementById('sub_01').style.display = 'none';
                    document.getElementById('sub_02').style.display = 'none';
                    document.getElementById('sub_03').style.display = 'none';
                    document.getElementById('sub_04').style.display = 'inline';
                    document.getElementById('sub_05').style.display = 'none';
                    document.getElementById('sub_06').style.display = 'inline';
                    document.getElementById('sub_07').style.display = 'inline';
                    document.getElementById('sub_08').style.display = 'none';
                    document.getElementById('sub_09').style.display = 'none';
                    document.getElementById('sub_10').style.display = 'none';
                    document.getElementById('sub_11').style.display = 'none';
                    document.getElementById('sub_12').style.display = 'none';
                } else {
                    document.getElementById('sub_01').style.display = 'none';
                    document.getElementById('sub_02').style.display = 'none';
                    document.getElementById('sub_03').style.display = 'none';
                    document.getElementById('sub_04').style.display = 'table-row';
                    document.getElementById('sub_05').style.display = 'none';
                    document.getElementById('sub_06').style.display = 'table-row';
                    document.getElementById('sub_07').style.display = 'table-row';
                    document.getElementById('sub_08').style.display = 'none';
                    document.getElementById('sub_09').style.display = 'none';
                    document.getElementById('sub_10').style.display = 'none';
                    document.getElementById('sub_11').style.display = 'none';
                    document.getElementById('sub_12').style.display = 'none';
                }
            } else {
                document.getElementById('sub_01').style.display = 'none';
                document.getElementById('sub_02').style.display = 'none';
                document.getElementById('sub_03').style.display = 'none';
                document.getElementById('sub_04').style.display = 'none';
                document.getElementById('sub_05').style.display = 'none';
                document.getElementById('sub_06').style.display = 'none';
                document.getElementById('sub_07').style.display = 'none';
                document.getElementById('sub_08').style.display = 'none';
                document.getElementById('sub_09').style.display = 'none';
                document.getElementById('sub_10').style.display = 'none';
                document.getElementById('sub_11').style.display = 'none';
                document.getElementById('sub_12').style.display = 'none';
            }
        }

        function check_other() {
            if (document.getElementById('place2').value=='其他') {
                document.getElementById('other').style.display = 'inline';
            }
        }
        //車禍校內其他
        function check_place2_is_other(){
            if(document.getElementById('place2').value=='其他'){
                document.getElementById('place_other').style.display = 'inline';
            }
            else{
                document.getElementById('place_other').style.display = 'none';
//                document.getElementById('place_other').disabled = true;
            }
        }

    </script>
    <script src="../JSCal2/js/jscal2.js"></script>
    <script src="../JSCal2/js/lang/cn.js"></script>
    <link rel="stylesheet" type="text/css" href="../JSCal2/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../JSCal2/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../JSCal2/css/gold/gold.css" />
    <link href="../SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
    <link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
    <link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
    <link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
                                            <?php if (isset($_SESSION['CSRC_user'])){?><p>
                                                <a href="index.php">校安狀況列表</a>　
                                                <a href="add.php">填寫校安狀況</a>　
                                                <a href="list.php">校安狀況查詢</a>　
                                                <a href="search.php">校安狀況搜尋</a>　
                                                <a href="statistics_new.php">校安狀況統計</a>　
                                                <a href="statistics_plot.php">校安狀況繪圖</a>　
                                                <?php if (isset($_SESSION['CSRC_user'])){?>
                                                <a href="logout.php">使用者登出</a>　
                                                <?php }?>
                                            </p>
                                            <?php }?>
                                            <?php if (isset($_SESSION['CSRC_user'])&&($_SESSION['CSRC_dapartment']=="生輔組")){?><p>
                                                <a href="worksheet.php">工作日誌列表</a>　
                                                <a href="worksheet_add.php">填寫工作日誌</a>　
                                                <a href="worksheet_list.php">工作日誌查詢</a>　
                                                <a href="worksheet_search.php">工作日誌搜尋</a>　
                                                <?php if ($_SESSION['CSRC_authority']=='1'){?>
                                                <a href="member.php">人員權限管理</a>　
                                                <?php }?>
                                            </p>
                                            <?php }?>
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
                                            <script>
                                                countSecond()

                                            </script>
                                            <script>
                                                setTimeout("document.form1.submit()", 900000)

                                            </script>
                                            <h2>填寫校安狀況管制登記簿</h2>
                                            <form action="" method="post" name="form1" id="form1" enctype="multipart/form-data">
                                                <table width="750" border="0" align="center">
                                                    <tr>
                                                        <td width="150" valign="top">
                                                            <div align="right"><strong>案發日期：</strong></div>
                                                        </td>
                                                        <td width="600"><button id="time_tri">點選日期</button>
                                                            <span id="sprytextfield1">
                                                                <input name="time" id="time" size="15" />
                                                                <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                                                            <script type="text/javascript">
                                                                Calendar.setup({
                                                                    inputField: "time",
                                                                    trigger: "time_tri",
                                                                    onSelect: function() {
                                                                        this.hide()
                                                                    },
                                                                    dateFormat: "%Y-%m-%d",
                                                                    selectionType: Calendar.SEL_SINGLE,
                                                                    fdow: 0
                                                                });

                                                            </script>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>案發時間：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                            <label for="time2"></label>
                                                            <span id="sprytextfield2">
                                                                <input size="15" id="time2" name="time2" />
                                                                <span class="textfieldRequiredMsg">此項目不可空白。</span><span class="textfieldInvalidFormatMsg">格式錯誤。</span></span>(時間格式：13:00)</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>學院：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect1">
                                                                <select name="college" size="1" id="college" onchange="Buildkey2(this.options[this.options.selectedIndex].value); show(this.options[this.options.selectedIndex].value);">
                                                                    <option value="">單位名稱...</option>
                                                                    <option value="文學院">文學院</option>
                                                                    <option value="理學院">理學院</option>
                                                                    <option value="工學院">工學院</option>
                                                                    <option value="管理學院">管理學院</option>
                                                                    <option value="資電學院">資電學院</option>
                                                                    <option value="地科學院">地科學院</option>
                                                                    <option value="客家學院">客家學院</option>
                                                                    <option value="生醫理工學院">生醫理工學院</option>
                                                                    <option value="承攬商">承攬商</option>
                                                                    <option value="其他">其他</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>系所：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect2">
                                                                <select name="department" size="1" id="department">
                                                                    <option value="">請選擇系所..</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>級別：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect3">
                                                                <select name="grade" id="grade">
                                                                    <option value="" selected="selected">請選擇</option>
                                                                    <option value="大一">大一</option>
                                                                    <option value="大二">大二</option>
                                                                    <option value="大三">大三</option>
                                                                    <option value="大四">大四</option>
                                                                    <option value="碩士班">碩士班</option>
                                                                    <option value="博士班">博士班</option>
                                                                    <option value="其他">其他</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span></td>
                                                    </tr>
                                                     <tr id="sub_16" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>承攬案件名稱：</strong></div>
                                                        </td>
                                                        <td><span id="sprytextfield3">
                                                            <input name="" type="text" id="" />
                                                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_17" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>承攬單位名稱：</strong></div>
                                                        </td>
                                                        <td><span id="sprytextfield3">
                                                            <input name="" type="text" id="" />
                                                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_18" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>承攬人員名稱：</strong></div>
                                                        </td>
                                                        <td><span id="sprytextfield3">
                                                            <input name="" type="text" id="" />
                                                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>學號：</strong></div>
                                                        </td>
                                                        <td><span id="sprytextfield3">
                                                                <input name="student_id" type="text" id="student_id" />
                                                                <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>姓名/承攬商名稱：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                            <span id="sprytextfield4">
                                                                <input name="name" type="text" id="name" />
                                                                <span class="textfieldRequiredMsg">此項目不可空白。</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>性別：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                            <span id="spryselect4">
                                                                <select name="sex" id="sex">
                                                                    <option value="" selected="selected">請選擇</option>
                                                                    <option value="男">男</option>
                                                                    <option value="女">女</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" valign="top">
                                                            <div align="right"><strong>案件類別：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect5">
                                                                <select name="class" size="1" id="class" onchange="Buildkey(this.options[this.options.selectedIndex].value); show(this.options[this.options.selectedIndex].value); Buildkey3(this.options[this.options.selectedIndex].value); Buildkey4(this.options[this.options.selectedIndex].value);">
                                                                    <option value="" selected="selected">請選擇類別...</option>
                                                                    <option value="意外事件">意外事件</option>
                                                                    <option value="一般事件">一般事件</option>
                                                                    <option value="財務事件">財務事件</option>
                                                                    <option value="糾紛事件">糾紛事件</option>
                                                                    <option value="職業災害">職業災害</option>
                                                                    <option value="毒化災事件">毒化災事件</option>
                                                                    <option value="輻射事件">輻射事件</option>
                                                                    <option value="環保事件">環保事件</option>
                                                                    <option value="其他事件">其他事件</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span><span id="spryselect6">
                                                                <select name="class2" size="1" id="class2" onchange="show(this.options[this.options.selectedIndex].value); Buildkey3(this.options[this.options.selectedIndex].value); Buildkey4(this.options[this.options.selectedIndex].value);">
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" valign="top">
                                                            <div align="right"><strong>案發地點：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect7">
                                                                <select name="place" id="place" onchange="Buildkey4(this.options[this.options.selectedIndex].value);">
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span>
                                                            <span id="spryselect8">
                                                                <select name="place2" id="place2" onchange="check_other();">
                                                                </select>
                                                                
                                                                <span class="selectRequiredMsg">請選取項目。</span></span>
                                                            <input id="other" name="other" type="text" style="display:none;"></td>
                                                        
                                                    </tr>
                                                    <tr id="sub_04" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>送醫情形：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect11">
                                                                <select name="deliver" id="deliver">
                                                                    <option value="" selected="selected">請選擇</option>
                                                                    <option value="計程車送醫">計程車送醫</option>
                                                                    <option value="救護車送醫">救護車送醫</option>
                                                                    <option value="自行就醫">自行就醫</option>
                                                                    <option value="無需就醫">無需就醫</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_01" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>車種：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect9">
                                                                <select name="car" id="car">
                                                                    <option value="" selected="selected">請選擇</option>
                                                                    <option value="腳踏車(公有)">腳踏車(公有)</option>
                                                                    <option value="腳踏車(私人)">腳踏車(私人)</option>
                                                                    <option value="機車">機車</option>
                                                                    <option value="汽車">汽車</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span></td>
                                                    </tr>
                                                    <tr id="sub_02" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>車禍原因：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect10">
                                                                <select name="reason" id="reason">
                                                                    <option value="" selected="selected">請選擇</option>
                                                                    <option value="擦撞">擦撞</option>
                                                                    <option value="自行摔倒">自行摔倒</option>
                                                                    <option value="機件故障">機件故障</option>
                                                                    <option value="光線不足">光線不足</option>
                                                                    <option value="路況不佳">路況不佳</option>
                                                                    <option value="未遵守交通規則">未遵守交通規則</option>
                                                                    <option value="車速過快">車速過快</option>
                                                                    <option value="其他">其他</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span></td>
                                                    </tr>
                                                    <tr id="sub_03" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>損傷情形：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                            <span id="sprycheckbox1">
                                                                <input type="checkbox" id="injury[]" name="injury[]" value="身體輕傷" />
                                                                身體輕傷
                                                                <input type="checkbox" id="injury[]" name="injury[]" value="身體重傷" />
                                                                身體重傷
                                                                <input type="checkbox" id="injury[]" name="injury[]" value="車輛損傷" />
                                                                車輛損傷<br /><span class="checkboxMinSelectionsMsg">未選取。</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_05" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong><br />種類：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="sprycheckbox2"><br />
                                                                <input type="checkbox" id="sub_class[]" name="sub_class[]" value="擦傷" />
                                                                擦傷　　
                                                                <input type="checkbox" id="sub_class[]" name="sub_class[]" value="挫撞傷" />
                                                                挫撞傷　
                                                                <input type="checkbox" id="sub_class[]" name="sub_class[]" value="裂割傷" />
                                                                裂割傷　
                                                                <input type="checkbox" id="sub_class[]" name="sub_class[]" value="扭傷" />
                                                                扭傷　　
                                                                <input type="checkbox" id="sub_class[]" name="sub_class[]" value="脫臼" />
                                                                脫臼　　
                                                                <input type="checkbox" id="sub_class[]" name="sub_class[]" value="骨折" />
                                                                骨折　　<br />
                                                                <span class="checkboxMinSelectionsMsg">未選取。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_06" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong><br />
                                                                    種類：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="sprycheckbox3"><br />
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="動物咬傷" />
                                                                動物咬傷
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="蛇蟲叮咬" />
                                                                蛇蟲叮咬
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="燙傷" />
                                                                燙傷　　
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="灼傷" />
                                                                灼傷　　
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="擦傷" />
                                                                擦傷　　
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="挫撞傷" />
                                                                挫撞傷　<br />
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="裂割傷" />
                                                                裂割傷　
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="扭傷" />
                                                                扭傷　　
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="脫臼" />
                                                                脫臼　　
                                                                <input type="checkbox" id="sub_class2[]" name="sub_class2[]" value="骨折" />
                                                                骨折　　<br /><span class="checkboxMinSelectionsMsg">未選取。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_07" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong><br />
                                                                    部位：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="sprycheckbox4"> <br />
                                                                <input type="checkbox" id="part[]" name="part[]" value="頭部" />
                                                                頭部　　
                                                                <input type="checkbox" id="part[]" name="part[]" value="顏面" />
                                                                顏面　　
                                                                <input type="checkbox" id="part[]" name="part[]" value="頸部" />
                                                                頸部　　
                                                                <input type="checkbox" id="part[]" name="part[]" value="胸部" />
                                                                胸部　　
                                                                <input type="checkbox" id="part[]" name="part[]" value="腹部" />
                                                                腹部　　
                                                                <input type="checkbox" id="part[]" name="part[]" value="背部" />
                                                                背部　　<br />
                                                                <input type="checkbox" id="part[]" name="part[]" value="臀部" />
                                                                臀部　　
                                                                <input type="checkbox" id="part[]" name="part[]" value="左上肢" />
                                                                左上肢　
                                                                <input type="checkbox" id="part[]" name="part[]" value="右上肢" />
                                                                右上肢　
                                                                <input type="checkbox" id="part[]" name="part[]" value="左下肢" />
                                                                左下肢　
                                                                <input type="checkbox" id="part[]" name="part[]" value="右下肢" />
                                                                右下肢　<br /><span class="checkboxMinSelectionsMsg">未選取。</span></span>
                                                        </td>
                                                    </tr>
                                                    <!-- 車禍案件新增項目 -->
                                                    <tr id="sub_08" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>從事活動：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect12">
                                                                <select name="activities" id="activities">
                                                                    <option value="" selected="selected">請選擇</option>
                                                                    <option value="上學途中">上學途中</option>
                                                                    <option value="離校途中">離校途中</option>
                                                                    <option value="校外教學">校外教學</option>
                                                                    <option value="假期當中">假期當中</option>
                                                                    <option value="系學會活動">系學會活動</option>
                                                                    <option value="其他">其他</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_09" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>天候：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                            <span id="sprycheckbox5">
                                                                <input type="checkbox" id="weather[]" name="weather[]" value="雨天" />
                                                                雨天
                                                                <input type="checkbox" id="weather[]" name="weather[]" value="晴天" />
                                                                晴天
                                                                <input type="checkbox" id="weather[]" name="weather[]" value="陰天" />
                                                                陰天<br /><span class="checkboxMinSelectionsMsg">未選取。</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_10" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>對方車種：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect13">
                                                                <select name="other_car" id="other_car">
                                                                    <option value="" selected="selected">請選擇</option>
                                                                    <option value="汽車">汽車</option>
                                                                    <option value="機車">機車</option>
                                                                    <option value="自行車">自行車</option>
                                                                    <option value="電動腳踏車">電動腳踏車</option>
                                                                    <option value="大眾運輸">大眾運輸</option>
                                                                    <option value="步行">步行</option>
                                                                    <option value="其它">其它</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_11" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>安全帽款：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect14">
                                                                <select name="helmet" id="helmet">
                                                                    <option value="" selected="selected">請選擇</option>
                                                                    <option value="未戴">未戴</option>
                                                                    <option value="全罩式">全罩式</option>
                                                                    <option value="四分之三罩式">四分之三罩式</option>
                                                                    <option value="半罩式西瓜皮式">半罩式西瓜皮式</option>
                                                                    <option value="其它">其它</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_12" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>車齡：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="spryselect15">
                                                                <select name="car_age" id="car_age">
                                                                    <option value="" selected="selected">請選擇</option>
                                                                    <option value="1年以內">1年以內</option>
                                                                    <option value="1-3年">1-3年</option>
                                                                    <option value="4-6年">4-6年</option>
                                                                    <option value="7-10年">7-10年</option>
                                                                    <option value="10-15年">10-15年</option>
                                                                    <option value="16年以上">16年以上</option>
                                                                </select>
                                                                <span class="selectRequiredMsg">請選取項目。</span></span>
                                                        </td>
                                                    </tr>
                                                     <tr id="sub_13" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>是否具承攬關係：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                          <span id="sprycheckbox6">
                                                            <input type="checkbox" id="relate[]" name="relate[]" value="是" />
                                                            是
                                                            <input type="checkbox" id="relate[]" name="relate[]" value="否" />
                                                            否<br /><span class="checkboxMinSelectionsMsg">未選取。</span>
                                                          </span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_14" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>損傷情形：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                          <span id="sprycheckbox7">
                                                            <input type="checkbox" id="injury[]" name="injury[]" value="無人受傷" />
                                                            無人受傷
                                                            <input type="checkbox" id="injury[]" name="injury[]" value="輕傷" />
                                                            輕傷
                                                            <input type="checkbox" id="injury[]" name="injury[]" value="重傷" />
                                                            重傷
                                                            <input type="checkbox" id="injury[]" name="injury[]" value="死亡" />
                                                            死亡<br /><span class="checkboxMinSelectionsMsg">未選取。</span>
                                                          </span>
                                                        </td>
                                                    </tr>
                                                    <tr id="sub_15" style="display:none">
                                                        <td valign="top">
                                                            <div align="right"><strong>送醫情形：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                          <span id="spryselect11">
                                                            <select name="deliver" id="deliver">
                                                                <option value="" selected="selected">請選擇</option>
                                                                <option value="計程車送醫">計程車送醫</option>
                                                                <option value="救護車送醫">救護車送醫</option>
                                                                <option value="自行就醫">自行就醫</option>
                                                                <option value="無需就醫">無需就醫</option>
                                                            </select>
                                                          <span class="selectRequiredMsg">請選取項目。</span></span>
                                                        </td>
                                                    </tr>
                                                    <!--  -->
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>案由(何事)：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="sprytextfield5">
                                                                <input name="what" type="text" id="what" size="70" /><br />
                                                                <span class="textfieldRequiredMsg">此項目不可空白。</span></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" valign="top">
                                                            <div align="right"><strong>處理情形(如何)：</strong></div>
                                                        </td>
                                                        <td width="600"><span id="sprytextarea1">
                                                                <textarea name="how" cols="60" rows="10" id="how"></textarea><br />
                                                                <span class="textareaRequiredMsg">此項目不可空白。</span></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" valign="top">
                                                            <div align="right"><strong>圖片一：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                          <input accept="image/*" type="file" id="img1" name="img1"><br />
                                                          <img id="preview1" height="150px" src="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" valign="top">
                                                            <div align="right"><strong>圖片二：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                          <input accept="image/*" type="file" id="img2" name="img2"><br />
                                                          <img id="preview2" height="150px" src="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" valign="top">
                                                            <div align="right"><strong>圖片三：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                          <input accept="image/*" type="file" id="img3" name="img3"><br />
                                                          <img id="preview3" height="150px" src="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" valign="top">
                                                            <div align="right"><strong>圖片四：</strong></div>
                                                        </td>
                                                        <td width="600">
                                                          <input accept="image/*" type="file" id="img4" name="img4"><br />
                                                          <img id="preview4" height="150px" src="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" valign="top">
                                                            <div align="right"><strong>登記人：</strong></div>
                                                        </td>
                                                        <td width="600"><?php echo $row_csrc_user['department'].'-'.$row_csrc_user['name'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>個資加密：</strong></div>
                                                        </td>
                                                        <td><input name="secret" type="radio" id="secret" value="Y" />
                                                            是
                                                            <input name="secret" type="radio" id="secret" value="N" checked="checked" />
                                                            否</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>是否寄信：</strong></div>
                                                        </td>
                                                        <td><input name="send" type="radio" id="send" value="Y" />
                                                            是
                                                            <input name="send" type="radio" id="send" value="N" checked="checked" />
                                                            否</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div align="right"><strong>是否暫存：</strong></div>
                                                        </td>
                                                        <td width="600"><input name="temp" type="radio" id="temp" value="Y" checked="checked" />
                                                            是
                                                            <input name="temp" type="radio" id="temp" value="N" />
                                                            否</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td width="600">
                                                            <div align="center">
                                                                <input name="Submit" type="Submit" value="送出"/>
                                                            </div>
                                                        </td>
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
                  img1.onchange = evt => {
                    const [file] = img1.files
                    if (file) {
                      preview1.src = URL.createObjectURL(file)
                    }
                  }
                  img2.onchange = evt => {
                    const [file] = img2.files
                    if (file) {
                      preview2.src = URL.createObjectURL(file)
                    }
                  }
                  img3.onchange = evt => {
                    const [file] = img3.files
                    if (file) {
                      preview3.src = URL.createObjectURL(file)
                    }
                  }
                  img4.onchange = evt => {
                    const [file] = img4.files
                    if (file) {
                      preview4.src = URL.createObjectURL(file)
                    }
                  }
                function check_form() {
                    if (form1.temp[1].checked) {
                        var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
                        var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "time");
                        var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
                        var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
                        var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
                        var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
                        var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
                        var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");
                        var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5");
                        var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6");
                        if ((document.getElementById('class').value == '職業災害') || (document.getElementById('class').value == '毒化災事件') || (document.getElementById('class').value == '輻射事件')) {
                          var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox6", {
                              isRequired: true,
                              minSelections: 1
                          });
                          var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox7", {
                              isRequired: true,
                              minSelections: 1
                          });
                          var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("spryselect11", {
                              isRequired: true,
                              minSelections: 1
                          });
                        }
                        if (document.getElementById('class').value == '環保事件') {
                          var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox6", {
                              isRequired: true,
                              minSelections: 1
                          });
                        }

                        if ((document.getElementById('class2').value != '詐騙') && (document.getElementById('class2').value != '協尋') &&
                            (document.getElementById('class2').value != '校外糾紛') && (document.getElementById('class2').value != '校內糾紛') &&
                            (document.getElementById('class2').value != '賃居糾紛') && (document.getElementById('class2').value != '其他')) {
                            var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7");
                            var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8");
                        } else {
                            var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7", {
                                isRequired: false
                            });
                            var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8", {
                                isRequired: false
                            });
                        }

                        if (document.getElementById('class2').value == '車禍') {
                            var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9", {
                                isRequired: true
                            });
                            var spryselect10 = new Spry.Widget.ValidationSelect("spryselect10", {
                                isRequired: true
                            });
                            var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1", {
                                isRequired: false,
                                minSelections: 1
                            });
                            var spryselect11 = new Spry.Widget.ValidationSelect("spryselect11", {
                                isRequired: true
                            });
                            var sprycheckbox2 = new Spry.Widget.ValidationCheckbox("sprycheckbox2", {
                                isRequired: false,
                                minSelections: 0
                            });
                            var sprycheckbox3 = new Spry.Widget.ValidationCheckbox("sprycheckbox3", {
                                isRequired: false,
                                minSelections: 0
                            });
                            var sprycheckbox4 = new Spry.Widget.ValidationCheckbox("sprycheckbox4", {
                                isRequired: false,
                                minSelections: 0
                            });
                            //新增
                            var spryselect12 = new Spry.Widget.ValidationSelect("spryselect12", {
                                isRequired: true
                            });
                            var spryselect13 = new Spry.Widget.ValidationSelect("spryselect13", {
                                isRequired: true
                            });
                            var spryselect14 = new Spry.Widget.ValidationSelect("spryselect14", {
                                isRequired: true
                            });
                            var spryselect15 = new Spry.Widget.ValidationSelect("spryselect15", {
                                isRequired: true
                            });
                            var sprycheckbox5 = new Spry.Widget.ValidationCheckbox("sprycheckbox5", {
                                isRequired: false,
                                minSelections: 1
                            });
                        } else if (document.getElementById('class2').value == '運動受傷') {
                            var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9", {
                                isRequired: false
                            });
                            var spryselect10 = new Spry.Widget.ValidationSelect("spryselect10", {
                                isRequired: false
                            });
                            var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1", {
                                isRequired: false,
                                minSelections: 0
                            });
                            var spryselect11 = new Spry.Widget.ValidationSelect("spryselect11", {
                                isRequired: true
                            });
                            var sprycheckbox2 = new Spry.Widget.ValidationCheckbox("sprycheckbox2", {
                                isRequired: false,
                                minSelections: 1
                            });
                            var sprycheckbox3 = new Spry.Widget.ValidationCheckbox("sprycheckbox3", {
                                isRequired: false,
                                minSelections: 0
                            });
                            var sprycheckbox4 = new Spry.Widget.ValidationCheckbox("sprycheckbox4", {
                                isRequired: false,
                                minSelections: 1
                            });
                            //新增
                            var spryselect12 = new Spry.Widget.ValidationSelect("spryselect12", {
                                isRequired: false
                            });
                            var spryselect13 = new Spry.Widget.ValidationSelect("spryselect13", {
                                isRequired: false
                            });
                            var spryselect14 = new Spry.Widget.ValidationSelect("spryselect14", {
                                isRequired: false
                            });
                            var spryselect15 = new Spry.Widget.ValidationSelect("spryselect15", {
                                isRequired: false
                            });
                            var sprycheckbox5 = new Spry.Widget.ValidationCheckbox("sprycheckbox5", {
                                isRequired: false,
                                minSelections: 0
                            });
                        } else if (document.getElementById('class2').value == '意外傷害') {
                            var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9", {
                                isRequired: false
                            });
                            var spryselect10 = new Spry.Widget.ValidationSelect("spryselect10", {
                                isRequired: false
                            });
                            var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1", {
                                isRequired: false,
                                minSelections: 0
                            });
                            var spryselect11 = new Spry.Widget.ValidationSelect("spryselect11", {
                                isRequired: true
                            });
                            var sprycheckbox2 = new Spry.Widget.ValidationCheckbox("sprycheckbox2", {
                                isRequired: false,
                                minSelections: 0
                            });
                            var sprycheckbox3 = new Spry.Widget.ValidationCheckbox("sprycheckbox3", {
                                isRequired: false,
                                minSelections: 1
                            });
                            var sprycheckbox4 = new Spry.Widget.ValidationCheckbox("sprycheckbox4", {
                                isRequired: false,
                                minSelections: 1
                            });
                            //新增
                            var spryselect12 = new Spry.Widget.ValidationSelect("spryselect12", {
                                isRequired: false
                            });
                            var spryselect13 = new Spry.Widget.ValidationSelect("spryselect13", {
                                isRequired: false
                            });
                            var spryselect14 = new Spry.Widget.ValidationSelect("spryselect14", {
                                isRequired: false
                            });
                            var spryselect15 = new Spry.Widget.ValidationSelect("spryselect15", {
                                isRequired: false
                            });
                            var sprycheckbox5 = new Spry.Widget.ValidationCheckbox("sprycheckbox5", {
                                isRequired: false,
                                minSelections: 0
                            });
                        } else {
                            var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9", {
                                isRequired: false
                            });
                            var spryselect10 = new Spry.Widget.ValidationSelect("spryselect10", {
                                isRequired: false
                            });
                            var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1", {
                                isRequired: false,
                                minSelections: 0
                            });
                            var spryselect11 = new Spry.Widget.ValidationSelect("spryselect11", {
                                isRequired: false
                            });
                            var sprycheckbox2 = new Spry.Widget.ValidationCheckbox("sprycheckbox2", {
                                isRequired: false,
                                minSelections: 0
                            });
                            var sprycheckbox3 = new Spry.Widget.ValidationCheckbox("sprycheckbox3", {
                                isRequired: false,
                                minSelections: 0
                            });
                            var sprycheckbox4 = new Spry.Widget.ValidationCheckbox("sprycheckbox4", {
                                isRequired: false,
                                minSelections: 0
                            });
                            //新增
                            var spryselect12 = new Spry.Widget.ValidationSelect("spryselect12", {
                                isRequired: false
                            });
                            var spryselect13 = new Spry.Widget.ValidationSelect("spryselect13", {
                                isRequired: false
                            });
                            var spryselect14 = new Spry.Widget.ValidationSelect("spryselect14", {
                                isRequired: false
                            });
                            var spryselect15 = new Spry.Widget.ValidationSelect("spryselect15", {
                                isRequired: false
                            });
                            var sprycheckbox5 = new Spry.Widget.ValidationCheckbox("sprycheckbox5", {
                                isRequired: false,
                                minSelections: 0
                            });
                        }

                        var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
                        var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
                    }
                }
                //

                -->
            </script>
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
<?php
mysql_free_result($csrc_user);
?>
