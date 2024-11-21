<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}
  $MM_redirect = "login.php";
  if (!isset($_SESSION['CSRC_user'])) {header("Location: " . $MM_redirect);}
  if (isset($_SESSION['CSRC_user'])&&($_SESSION['CSRC_dapartment']!="生輔組")) {header("Location: " . $MM_redirect);}
?>

<?php

    $weeklist = array('日', '一', '二', '三', '四', '五', '六');

    //使用者資料
    $colname_csrc_user = "-1";
    if (isset($_SESSION['CSRC_user'])) {
      $colname_csrc_user = (get_magic_quotes_gpc()) ? $_SESSION['CSRC_user'] : addslashes($_SESSION['CSRC_user']);
    }
    mysqli_select_db($conn_CSRC,$database_conn_CSRC);
    $query_csrc_user = sprintf("SELECT * FROM `csrc_user` WHERE `user` = '%s'", $colname_csrc_user);
    $csrc_user = mysqli_query($conn_CSRC,$query_csrc_user) or die(mysqli_connect_error());
    $row_csrc_user = mysqli_fetch_assoc($csrc_user);

    //待批閱
    mysqli_select_db($conn_CSRC,$database_conn_CSRC);
    $query_csrc_worksheet_director = sprintf("SELECT * FROM `csrc_worksheet` WHERE `director` is NULL AND `temp`!='Y' ORDER BY day ASC, undertaker_time ASC");
    $csrc_worksheet_director = mysqli_query($conn_CSRC,$query_csrc_worksheet_director) or die(mysqli_connect_error());
    $row_csrc_worksheet_director = mysqli_fetch_assoc($csrc_worksheet_director);
    $totalRows_csrc_worksheet_director = mysqli_num_rows($csrc_worksheet_director);

    //暫存檔
    mysqli_select_db($conn_CSRC,$database_conn_CSRC);
    $query_csrc_worksheet_temp = sprintf("SELECT * FROM `csrc_worksheet` WHERE (`user`='".$_SESSION['CSRC_user']."' OR `NightUser`='".$_SESSION['CSRC_user']."') AND `temp`='Y' ORDER BY day DESC, undertaker_time DESC");
    $csrc_worksheet_temp = mysqli_query($conn_CSRC,$query_csrc_worksheet_temp) or die(mysqli_connect_error());
    $row_csrc_worksheet_temp = mysqli_fetch_assoc($csrc_worksheet_temp);
    $totalRows_csrc_worksheet_temp = mysqli_num_rows($csrc_worksheet_temp);

    //最新20件
    mysqli_select_db($conn_CSRC,$database_conn_CSRC);
    $query_csrc_worksheet = sprintf("SELECT * FROM `csrc_worksheet` WHERE `temp`='N' ORDER BY day DESC, undertaker_time DESC LIMIT 0,20");
    $csrc_worksheet = mysqli_query($conn_CSRC,$query_csrc_worksheet) or die(mysqli_connect_error());
    $row_csrc_worksheet = mysqli_fetch_assoc($csrc_worksheet);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CSRC.dwt" codeOutsideHTMLIsLocked="false" -->
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
    <![endif]--><!--[if IE]>
    <style type="text/css"> 
    /* place css fixes for all versions of IE in this conditional comment */
    #mainContent { zoom: 1; }
    /* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
    </style>
    <![endif]-->
    <!-- InstanceBeginEditable name="head" -->
    <style type="text/css">
    
    .style3 {color: #FFFFFF; font-weight: bold; }
    .style4 {
        color: #990000;
        font-weight: bold;
    }
    .style5 {
        color: #006600;
        font-weight: bold;
    }
    
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
					  <div align="right">| 
			            <a href="index.php" Onclick="window.open ('member_changepw.php','NAME','status=no,toolbar=no,location=no,menubar=no,width=500,height=220')">更改個人密碼</a> |
                      </div>
					  <h2>最新校安工作日誌</h2>
                      <?php if(($_SESSION['CSRC_authority2']==1)&&($totalRows_csrc_worksheet_director>0)){?>
                      <p class="style5"> § 待批閱</p>
                      <table width="650" border="0" align="center">
                        <tr>
                          <td width="180" bgcolor="#006600"><div align="center"><span class="style3">日誌時間</span></div></td>
                          <td width="150" bgcolor="#006600"><div align="center"><span class="style3">值勤官</span></div></td>
                          <td width="150" bgcolor="#006600"><div align="center"><span class="style3">夜間值勤官</span></div></td>
						  <td width="100" bgcolor="#006600"><div align="center"><span class="style3">狀態</span></div></td>
                          <td width="100">&nbsp;</td>
                        </tr>
					   <?php do { ?>
                        <tr valign="top">
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet_director['day'].' '.$weeklist[$row_csrc_worksheet_director['week']];?></div></td>
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet_director['duty'];?></div></td>
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet_director['NightDuty'];?></div></td>
						  <td width="100"><div align="center"><?php echo ($row_csrc_worksheet_director['director_time'] !="") ?  "已批示" : "尚未批示";?></div></td>
                          <td width="100"><div align="center" class="link"><a href="worksheet_show.php?no=<?php echo $row_csrc_worksheet_director['no'];?>">詳</a>
                          <a href="javascript:if (confirm('您確定要將 <?php echo '【'.$row_csrc_worksheet_director['day'].'　'.$row_csrc_worksheet_director['duty'].'】';?> 移除嗎？')) location.href='worksheet_delete.php?no=<?php echo $row_csrc_worksheet_director['no']; ?>'">刪</a>
                          </div></td>
                        </tr>
						<?php } while ($row_csrc_worksheet_director = mysqli_fetch_assoc($csrc_worksheet_director)); ?>
                      </table>
					  <?php }?>
					  <?php if($totalRows_csrc_worksheet_temp>0){?>
                      <p class="style4"> § 暫存檔</p>
                      <table width="650" border="0" align="center">
                        <tr>
                          <td width="180" bgcolor="#990000"><div align="center"><span class="style3">日誌時間</span></div></td>
                          <td width="150" bgcolor="#990000"><div align="center"><span class="style3">值勤官</span></div></td>
                          <td width="150" bgcolor="#990000"><div align="center"><span class="style3">夜間值勤官</span></div></td>
						  <td width="100" bgcolor="#990000"><div align="center"><span class="style3">狀態</span></div></td>
                          <td width="100">&nbsp;</td>
                        </tr>
					   <?php do { ?>
                        <tr valign="top">
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet_temp['day'].' '.$weeklist[$row_csrc_worksheet_temp['week']];?></div></td>
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet_temp['duty'];?></div></td>
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet_temp['NightDuty'];?></div></td>
						  <td width="100"><div align="center"><?php echo ($row_csrc_worksheet_temp['director_time'] !="") ?  "已批示" : "尚未批示";?></div></td>
                          <td width="100"><div align="center" class="link"><a href="worksheet_edit.php?no=<?php echo $row_csrc_worksheet_temp['no'];?>">編</a>　<a href="worksheet_show.php?no=<?php echo $row_csrc_worksheet_temp['no'];?>">詳</a>　<a href="javascript:if (confirm('您確定要將 <?php echo '【'.$row_csrc_worksheet_temp['day'].'　'.$row_csrc_worksheet_temp['duty'].'】';?> 的 暫存檔 移除嗎？')) location.href='worksheet_delete.php?no=<?php echo $row_csrc_worksheet_temp['no']; ?>'">刪</a></div></td>
                        </tr>
						<?php } while ($row_csrc_worksheet_temp = mysqli_fetch_assoc($csrc_worksheet_temp)); ?>
                      </table>
					  <?php }?>
                      <p><b>§ 最新20件日誌列表</b></p>
                      <table width="650" border="0" align="center">
                        <tr>
                          <td width="180" bgcolor="#104E8B"><div align="center"><span class="style3">日誌時間</span></div></td>
                          <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">值勤官</span></div></td>
                          <td width="150" bgcolor="#104E8B"><div align="center"><span class="style3">夜間值勤官</span></div></td>
						  <td width="100" bgcolor="#104E8B"><div align="center"><span class="style3">狀態</span></div></td>
                          <td width="100">&nbsp;</td>
                        </tr>
					   <?php do { ?>
                        <tr valign="top">
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet['day'].' '.$weeklist[$row_csrc_worksheet['week']];?></div></td>
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet['duty'];?></div></td>
                          <td width="150"><div align="center"><?php echo $row_csrc_worksheet['NightDuty'];?></div></td>
						  <td width="100"><div align="center"><?php echo ($row_csrc_worksheet['director_time'] !="") ?  "已批示" : "尚未批示";?></div></td>
                          <td width="100"><div align="center" class="link"><a href="worksheet_show.php?no=<?php echo $row_csrc_worksheet['no'];?>">詳</a></div></td>
                        </tr>
						<?php } while ($row_csrc_worksheet = mysqli_fetch_assoc($csrc_worksheet)); ?>
                      </table>
					<p>&nbsp;</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- InstanceEndEditable -->
        </div>
    <!-- end #mainContent -->
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <!-- begin #footer -->
    <div id="footer">
	<p>
	中央大學生輔組 (03)-422-7151 #57212 , 57999 校安專線 03-280-5666
	</p>
	<pre>
        Copyright © 2012 Web Design by <a title="Free Flash Templates" href="http://www.flash-templates-today.com" class="footerLink">Free Flash Templates</a> System made by <strong>Tu</strong>
	</pre>
    </div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($csrc_worksheet_temp);
mysqli_free_result($csrc_worksheet);
?>