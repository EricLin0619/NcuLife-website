<?php require_once('conn_military.php'); ?>
<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
 
 date_default_timezone_set("Asia/Taipei");

 $MM_redirect = "login.php";
 if (!isset($_SESSION['military_Username'])) {header("Location: " . $MM_redirect);}
?>
<?php
$colname_military_member = "-1";
if (isset($_SESSION['military_Username'])) {
  $colname_military_member = (get_magic_quotes_gpc()) ? $_SESSION['military_Username'] : addslashes($_SESSION['military_Username']);
}
mysqli_select_db($conn_military,$database_conn_military);
$query_military_member = sprintf("SELECT * FROM `CSRC_user` WHERE `user` = '%s'", $colname_military_member);
$military_member = mysqli_query($conn_military,$query_military_member) or die(mysqli_connect_error());
$row_military_member = mysqli_fetch_assoc($military_member);

mysqli_select_db($conn_military,$database_conn_military);
$query_military_bulletin = sprintf("SELECT * FROM `military_bulletin` WHERE `no`='".$_GET['no']."'");
$military_bulletin = mysqli_query($conn_military,$query_military_bulletin) or die(mysqli_connect_error());
$row_military_bulletin = mysqli_fetch_assoc($military_bulletin);

//上傳檔案處理

$upfile = "post_attachment/";   //預設路徑檔名
$ServerFilename1 = '';
$ServerFilename2 = '';
$ServerFilename3 = '';

//檢查是否有檔案上傳
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    if($_FILES['attachment1']['size'] > 0){
        
        if ($row_military_bulletin['attachment1'] !=''){ 
            unlink($row_military_bulletin['attachment1']); 
        };

        //檢查檔案大小   
        if($_FILES['attachment1']['size'] > 10485760) {
            die("檔案大小不能超過 10MB !!");
        }

        //產生路徑和檔名
        list($File_Name1, $File_Extension1) = explode(".", $_FILES['attachment1']['name']);
        $ServerFilename1 = $upfile . date('Ymd-His') . "-1." . $File_Extension1;
        //檢查檔案是否存在	
        if ($File_Extension1 != '' && file_exists($ServerFilename1)) {
            echo $ServerFilename1;
            die("檔案1已經存在");	 
        }	  
        //複製檔案
        if (!move_uploaded_file($_FILES['attachment1']['tmp_name'],$ServerFilename1)) {
            die("無法將上傳的檔案移動至指定的目錄，請檢查目錄的路徑和權限!!");
        } else { chmod($ServerFilename1,0777); }//改變上傳檔案的權限為777

    }
    else if($row_military_bulletin['attachment1'] != ''){
        if($_POST['deleteAttachment1'] == "Dlt"){
            unlink($row_military_bulletin['attachment1']); 
            $ServerFilename1 = '';
        }
        else{
            $ServerFilename1 = $row_military_bulletin['attachment1'];
        }
    }
    if($_FILES['attachment2']['size'] > 0){

        if ($row_military_bulletin['attachment2'] !=''){ 
            unlink($row_military_bulletin['attachment2']); 
        };

        //檢查檔案大小   
        if($_FILES['attachment2']['size'] > 10485760) {
            die("檔案大小不能超過 10MB !!");
        }

        //產生路徑和檔名
        list($File_Name2, $File_Extension2) = explode(".", $_FILES['attachment2']['name']);
        $ServerFilename2 = $upfile . date('Ymd-His') . "-2." . $File_Extension2;
        //檢查檔案是否存在	
        if ($File_Extension2 != '' && file_exists($ServerFilename2)) {
            echo $ServerFilename2;
            die("檔案2已經存在");	 
        }	  
        //複製檔案
        if (!move_uploaded_file($_FILES['attachment2']['tmp_name'],$ServerFilename2)) {
            die("無法將上傳的檔案移動至指定的目錄，請檢查目錄的路徑和權限!!");
        } else { chmod($ServerFilename2,0777); }//改變上傳檔案的權限為777

    }
    else if($row_military_bulletin['attachment2'] != ''){
        if($_POST['deleteAttachment2'] == "Dlt"){
            unlink($row_military_bulletin['attachment2']); 
            $ServerFilename2 = '';
        }
        else{
            $ServerFilename2 = $row_military_bulletin['attachment2'];
        }
    }
    if($_FILES['attachment3']['size'] > 0){
        if ($row_military_bulletin['attachment3'] !=''){ 
            unlink($row_military_bulletin['attachment3']); 
        };

        //檢查檔案大小   
        if($_FILES['attachment3']['size'] > 10485760) {
            die("檔案大小不能超過 10MB !!");
        }

        //產生路徑和檔名
        list($File_Name, $File_Extension3) = explode(".", $_FILES['attachment3']['name']);
        $ServerFilename3 = $upfile . date('Ymd-His') . "-3." . $File_Extension3;
        //檢查檔案是否存在	
        if ($File_Extension3 != '' && file_exists($ServerFilename3)) {
            echo $ServerFilename3;
            die("檔案3已經存在");	 
        }	  
        //複製檔案
        if (!move_uploaded_file($_FILES['attachment3']['tmp_name'],$ServerFilename3)) {
            die("無法將上傳的檔案移動至指定的目錄，請檢查目錄的路徑和權限!!");
        } else { chmod($ServerFilename3,0777); }//改變上傳檔案的權限為777

    }
    else if($row_military_bulletin['attachment3'] != ''){
        if($_POST['deleteAttachment3'] == "Dlt"){
            unlink($row_military_bulletin['attachment3']); 
            $ServerFilename3 = '';
        }
        else{
            $ServerFilename3 = $row_military_bulletin['attachment3'];
        }
    }

    //寫入資料庫
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
  if($_POST['day']!=''){$day_active = explode('-',$_POST['day']);}else{$day_active = 0;}
  if($day_active != 0){$day_count = intval(date("U",mktime(0,0,0,$day_active[1],$day_active[2],$day_active[0])/86400));}else{$day_count = 0;}
  if($_POST['day2']!=''){$day_active2 = explode('-',$_POST['day2']);}else{$day_active2 = 0;}
  if($day_active2 != 0){$day_count2 = intval(date("U",mktime(0,0,0,$day_active2[1],$day_active2[2],$day_active2[0])/86400));}else{$day_count2 = 0;}
  $temp_day_time = explode(' ', $_POST['time']);
  $day_time = explode('-', $temp_day_time[0]);
  $day_post = intval(date("U",mktime(0,0,0,$day_time[1],$day_time[2],$day_time[0])/86400)); 
  $day_end = $day_post + $_POST['top'];
  
  $post_name = ($row_military_member['name']!='') ? $row_military_member['name'] : "工讀生";

  $insertSQL = sprintf("UPDATE `military_bulletin` SET `time`=%s, `top`=%s, `day`=%s, `day2`=%s, `day_count`=%s, `day_count2`=%s, `day_post`=%s, `day_end`=%s, `class`=%s, `class2`=%s, `title`=%s, `content`=%s, `attachment1`=%s, `attachment2`=%s, `attachment3`=%s, `poster`=%s, `poster_real`=%s WHERE `no`=%s",
       GetSQLValueString($_POST['time'], "text"),
       GetSQLValueString($_POST['top'], "text"),
       GetSQLValueString($_POST['day'], "text"),
       GetSQLValueString($_POST['day2'], "text"),
       GetSQLValueString($day_count, "text"),
       GetSQLValueString($day_count2, "text"),
       GetSQLValueString($day_post, "text"),
       GetSQLValueString($day_end, "text"),
       GetSQLValueString($_POST['class'], "text"),
       GetSQLValueString($_POST['class2'], "text"),
       GetSQLValueString($_POST['title'], "text"),
       GetSQLValueString($_POST['post_content'], "text"),
       GetSQLValueString($ServerFilename1, "text"),
       GetSQLValueString($ServerFilename2, "text"),
       GetSQLValueString($ServerFilename3, "text"),
       GetSQLValueString($post_name, "text"),
       GetSQLValueString($_SESSION['military_Username'], "text"),
       GetSQLValueString($_POST['no'], "text"));

  mysqli_select_db($conn_military,$database_conn_military);
  $Result1 = mysqli_query($conn_military,$insertSQL) or die(mysqli_connect_error());

  $insertGoTo = "index.php";
  header(sprintf("Location: %s", $insertGoTo));

}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>國立中央大學生活輔導組</title>

    <!-- css -->
    <?php
        include('call_css.php');
     ?>
    <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            setInterval('AutoScroll("#scrollDiv_T")', 5000);

            $(".p_a").hover(function() {
                $(this).addClass("p_a_hover");
                $(this).find("a").addClass("a_hover");
            }, function() {
                $(this).removeClass("p_a_hover");
                $(this).find("a").removeClass("a_hover");
            });
        });

        function AutoScroll(obj) {
            $(obj).find("dl:first").animate({
                marginTop: "-50px"
            }, 1000, function() {
                $(this).css({
                    marginTop: "0px"
                }).find("dt:first").appendTo(this);
            });
        }

    </script>
    <script LANGUAGE="javascript">
        function show(a) {
            var IsIE = false;
            var sAgent = navigator.userAgent.toLowerCase(); //判斷是否用IE瀏覽
            if (sAgent.indexOf("msie") != -1) {
                IsIE = true;
            } //IE6.0-7

            if (a == "Y") {
                if (IsIE) {
                    document.getElementById('day_show').style.display = 'inline';
                } else {
                    document.getElementById('day_show').style.display = 'table-row';
                }
            } else {
                document.getElementById('day_show').style.display = 'none';
            }
        }

    </script>
    <script src="JSCal2/js/jscal2.js"></script>
    <!--calendar-->
    <script src="JSCal2/js/lang/cn.js"></script>
    <link rel="stylesheet" type="text/css" href="JSCal2/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="JSCal2/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="JSCal2/css/gold/gold.css" />
    <link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/homepage/logos.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    .bg-green {
        background-color: #07889B;
        color: black;
    }

    .bg-orange {
        background-color: #e37222;
        color: black;
    }

    .bg-orange2 {
        background-color: #EEAA7B;
        color: black;
    }

    .bg-green2 {
        background-color: #66B9BF;
        color: black;
    }

    .nav-link {
        color: black;
    }

    .navbar-light .navbar-nav .nav-link {
        color: black
    }

    .navbar-dark .navbar-nav .nav-link {
        color: black;
    }

    .navbar-inverse .navbar-brand {
        color: black;
    }

    .navbar-expand-sm {
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-pack: start;
        justify-content: space-around;
    }

    .row .content {
        vertical-align: bottom;
    }

    .page-link {
        color: black;
    }

    tr {
        border-bottom: 1pt solid #9f9f9f;
    }

    img {
        margin-top: 15px;
        margin-bottom: 15px;
        vertical-align: bottom;
    }

    .navbar-brand img {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    h2 {
        margin-top: 15px;
        margin-left: 15px;
    }

    a {
        color: black;
    }

    li {
        float: initial;
    }

    p {
        margin: 15px;
    }

    #header {
        font-size: 18px;
    }

    footer {
        text-align: center;
        font-size: 8px;
        left: 0;
        bottom: 0;
        width: 100%;
        color: black;
    }

    .photo {
        text-align: center;
    }

</style>
<body> 
    <?php include "navbar.php"?>
        <div class="container">
            <?php include "header.php"?>
            <p>&nbsp;<br /></p>

            <div class="content">
                 <h2 class="title text-center"><strong>編輯最新公告</strong>
                    <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
                    <!--中間-->
                    <div id="content">
          
                        <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
                            <table width="600" border="1" align="center" class="style2">
                                <tr valign="baseline">
                                    <td width="150" align="right" nowrap="nowrap">
                                        <div align="right"><strong><span class="style1">發佈者：</span></strong></div>
                                    </td>
                                    <td width="450"><span class="style1 style4"><?php echo ($row_military_member['name']!='') ? $row_military_member['name'] : "工讀生"; ?></span></td>
                                </tr>
                                <tr valign="baseline">
                                    <td align="right" valign="top" nowrap="nowrap">
                                        <div align="right"><strong><span class="style1">公告類別：</span></strong></div>
                                    </td>
                                    <td width="450">
                                        <select name="class" id="class">
                                            <option value="<?php echo $row_military_bulletin['class'];?>" selected="selected"><?php echo $row_military_bulletin['class'];?></option>
                                            <option value="交通安全">交通安全</option>
                                            <option value="軍訓通訊">軍訓通訊</option>
                                            <option value="防藥物濫用">防藥物濫用</option>
                                            <option value="遺失物協尋">遺失物協尋</option>
                                            <option value="品德法治教育">品德法治教育</option>
                                            <option value="智慧財產">智慧財產</option>
                                            <option value="獎助學金">獎助學金</option>
                                            <option value="學生兵役">學生兵役</option>
                                            <option value="就學貸款">就學貸款</option>
                                            <option value="學雜費減免">學雜費減免</option>
                                            <option value="急難救助">急難救助</option>
                                            <option value="弱勢助學">弱勢助學</option>
                                            <option value="學生請假">學生請假</option>
                                            <option value="學生獎逞">學生獎懲</option>
                                            <option value="其他">其他</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign="baseline">
                                    <td align="right" nowrap="nowrap">
                                        <div align="right"><strong><span class="style1">置頂天數：</span></strong></div>
                                    </td>
                                    <td width="450"><select name="top" id="top">
                                            <option value="<?php echo $row_military_bulletin['top'];?>" selected="selected"><?php echo $row_military_bulletin['top'];?></option>
                                            <option value="0">無需置頂</option>
                                            <option value="7">一週</option>
                                            <option value="14">二週</option>
                                            <option value="21">三週</option>
                                            <option value="28">一個月</option>
                                        </select></td>
                                </tr>
                                <tr valign="baseline">
                                    <td align="right" valign="top" nowrap="nowrap">
                                        <div align="right"><strong><span class="style1">公告相關日期：</span></strong></div>
                                    </td>
                                    <td width="450"><select name="class2" id="class2" onchange="show(this.options[this.options.selectedIndex].value)">
                                            <option value="<?php echo $row_military_bulletin['class2'];?>" selected="selected"><?php echo $row_military_bulletin['class2'];?></option>
                                            <option value="N">不需要</option>
                                            <option value="Y">需要</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign="baseline" id="day_show" <?php if ($row_military_bulletin['class2']!='Y'){echo "style=\"display:none\"";}?>>
                                    <td align="right" nowrap="nowrap">
                                        <div align="right" class="style1">&nbsp;</div>
                                    </td>
                                    <td width="450"><button id="day_tri">開始日期</button>
                                        <span id="sprytextfield2">
                                            <input name="day" id="day" value="<?php echo $row_military_bulletin['day'];?>" size="15" />
                                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                                        <script type="text/javascript">
                                            Calendar.setup({
                                                inputField: "day",
                                                trigger: "day_tri",
                                                onSelect: function() {
                                                    this.hide()
                                                },
                                                dateFormat: "%Y-%m-%d",
                                                selectionType: Calendar.SEL_SINGLE,
                                                fdow: 0
                                            });

                                        </script>
                                        <br /><button id="day2_tri">結束日期</button>
                                        <span id="sprytextfield3">
                                            <input name="day2" id="day2" value="<?php echo $row_military_bulletin['day2'];?>" size="15" />
                                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span>
                                        <script type="text/javascript">
                                            Calendar.setup({
                                                inputField: "day2",
                                                trigger: "day2_tri",
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
                                <tr valign="baseline">
                                    <td width="150" align="right" nowrap="nowrap">
                                        <div align="right"><strong><span class="style1">公告標題：</span></strong></div>
                                    </td>
                                    <td width="450">
                                        <span id="sprytextfield1">
                                            <input type="text" name="title" value="<?php echo $row_military_bulletin['title'];?>" size="32" />
                                            <span class="textfieldRequiredMsg">此項目不可空白。</span></span> </td>
                                </tr>

                                <tr valign="baseline">
                                    <td width="150" align="right" valign="top" nowrap="nowrap">
                                        <div align="right"><strong><span class="style1">公告內容：</span></strong></div>
                                    </td>
                                    <td width="450"><span class="style5" style="color:red"><b>(若有圖片，寬度建議不要超過600px)</b></span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="top">
                                        <div align="center">
                                            <span id="sprytextarea1">

                                                <textarea class="ckeditor" id="post_content" name="post_content" cols="65" rows="15"><?php echo $row_military_bulletin['content'];?></textarea>
                                                <span class="textareaRequiredMsg">此項目不可空白。</span></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" valign="top">
                                        <div align="right" class="style2"><span class="style1">附加檔案</span>： </div>
                                    </td>
                                    <td width="450" valign="top">
                                        <label>
                                            <input name="attachment1" type="file" id="attachment" />
                                        </label>
                                        <?php if ($row_military_bulletin['attachment1'] !=''){ ?>
                                        <a href="<?php echo $row_military_bulletin['attachment1']; ?>" target="_blank"><img src="images/disk.gif" width="23" height="22" border="0" /></a>
                                        <input type="checkbox" name="deleteAttachment1" value="Dlt">刪除此附件<br>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" valign="top">
                                        <div align="right" class="style2"><span class="style1">附加檔案</span>： </div>
                                    </td>
                                    <td width="450" valign="top">
                                        <label>
                                            <input name="attachment2" type="file" id="attachment" />
                                        </label>
                                        <?php if ($row_military_bulletin['attachment2'] !=''){ ?>
                                        <a href="<?php echo $row_military_bulletin['attachment2']; ?>" target="_blank"><img src="images/disk.gif" width="23" height="22" border="0" /></a>
                                        <input type="checkbox" name="deleteAttachment2" value="Dlt">刪除此附件<br>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" valign="top">
                                        <div align="right" class="style2"><span class="style1">附加檔案</span>： </div>
                                    </td>
                                    <td width="450" valign="top">
                                        <label>
                                            <input name="attachment3" type="file" id="attachment" />
                                        </label>
                                        <?php if ($row_military_bulletin['attachment3'] !=''){ ?>
                                        <a href="<?php echo $row_military_bulletin['attachment3']; ?>" target="_blank"><img src="images/disk.gif" width="23" height="22" border="0" /></a>
                                        <input type="checkbox" name="deleteAttachment3" value="Dlt">刪除此附件<br>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <div align="right"></div>

                                <tr valign="baseline">
                                    <td colspan="2" align="right" nowrap="nowrap">
                                        <div align="center"><br />
                                            <input name="submit" type="submit" value="發佈消息" onclick="check_form()" />
                                            <input name="no" type="hidden" id="no" value="<?php echo $row_military_bulletin['no'];?>" />
                                            <input name="time" type="hidden" id="time" value="<?php echo $row_military_bulletin['time'];?>" />
                                            <input name="attachname_old" type="hidden" id="attachname_old" value="<?php echo $row_military_bulletin['attachment'];?>" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <label></label>
                            <input type="hidden" name="MM_update" value="form1" />
                        </form>
                        <script type="text/javascript">
                            <!--
                            function check_form() {
                                var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
                                var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");

                                if (document.getElementById('class2').value == 'Y') {
                                    var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
                                    var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
                                }
                            }
                        </script>
                    </div>
                <!--中間-->
            </div>
            <!--content-->
        </div>
        <!--container-->
    </div>
    <!--wrap-->

    <?php include "footer.php"?>
</body>

</html>
<?php
mysqli_free_result($military_bulletin);

mysqli_free_result($military_bulletin_top);
?>
