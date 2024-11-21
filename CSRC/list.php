<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}
  $MM_redirect = "login.php";
  if (!isset($_SESSION['CSRC_user'])) {header("Location: " . $MM_redirect);}
?>
<?php
//使用者資料
$colname_csrc_user = "-1";
if (isset($_SESSION['CSRC_user'])) {
  $colname_csrc_user = (get_magic_quotes_gpc()) ? $_SESSION['CSRC_user'] : addslashes($_SESSION['CSRC_user']);
}
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_user = sprintf("SELECT * FROM `csrc_user` WHERE `user` = '%s'", $colname_csrc_user);
$csrc_user = mysqli_query($conn_CSRC,$query_csrc_user) or die(mysqli_connect_error());
$row_csrc_user = mysqli_fetch_assoc($csrc_user);

//校安資料(依日期)
if(isset($_GET['tyr'])){ $tyr_select = $_GET['tyr']; }else{ $tyr_select = date('Y');}
if(isset($_GET['tmo'])){ $tmo_select = $_GET['tmo']; }else{ $tmo_select = date('m');}
if(isset($_GET['tda'])){ $tda_select = $_GET['tda']; }else{ $tda_select = date('d');}
$where = "where time LIKE '%".$tyr_select.'-'.sprintf('%02d',$tmo_select).'-'.sprintf('%02d',$tda_select)."%'";
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_csrc_data = "SELECT * FROM csrc_data $where AND temp!='Y' ORDER BY `time` DESC, `time2` DESC";
$csrc_data = mysqli_query($conn_CSRC,$query_csrc_data) or die(mysqli_connect_error());
$row_csrc_data = mysqli_fetch_assoc($csrc_data);
$totalRows_csrc_data = mysqli_num_rows($csrc_data);
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
    <style type="text/css">
        <!--
        .style3 {
            color: #FFFFFF;
            font-weight: bold;
        }

        .style4 {
            color: #990000;
            font-weight: bold;
        }

        -->
    </style>
    <!-- InstanceEndEditable -->
<script language="javascript" type="text/javascript">
    function MM_jumpMenu(targ,selObj,restore) {
        console.log("MM_jumpMenu")
        var target = (selObj.options[selObj.selectedIndex].text.indexOf('Pop')==0)?"_blank":"_"+targ; 
        window.open(selObj.options[selObj.selectedIndex].value,target);
        if (restore) selObj.selectedIndex=0;
    }
</script>
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
                                            <?php if (isset($_SESSION['CSRC_user'])&&($_SESSION['CSRC_dapartment']=="軍訓室")){?><p>
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
                                            <div align="justify">
                                                <h2>校安狀況查詢(依案發日期)</h2>
                                                <?php
                                                    if(isset($_GET['tyr'])){$tyr=$_GET['tyr'];}
                                                    if(isset($_GET['tmo'])){$tmo=$_GET['tmo'];}
                                                    if(isset($_GET['tda'])){$tda=$_GET['tda'];}
                                                ?>
                                                <!---設定文字屬性--->
                                                <style type="text/css">
                                                    .monthyear {
                                                        font-family: Verdana, sans-serif;
                                                        font-size: 16px;
                                                        font-weight: bold;
                                                        color: #0000FF
                                                    }

                                                    .daynames {
                                                        font-family: Arial, Helvetica;
                                                        font-size: 16px;
                                                        font-weight: bold;
                                                        color: #000000
                                                    }

                                                    .dates {
                                                        font-family: Arial, Helvetica;
                                                        font-size: 16px;
                                                        font-weight: bold;
                                                        color: #FFFFFF
                                                    }

                                                </style>
                                                <div align="center" class="calendar">
                                                    <?php  //date、mktime及strftime函數的應用
                                                         $tyr1=date("Y", time());   //取得目前的年(給顯示今日用)
                                                         $tyr=date("Y", time());   //取得目前的年
                                                         if(isset($_GET['tyr'])){$tyr=$_GET['tyr'];}
                                                         $tmo1=date("n", time());   //取得目前的月(給顯示今日用)
                                                         $tmo=date("n", time());   //取得目前的月
                                                         if(isset($_GET['tmo'])){$tmo=$_GET['tmo'];}
                                                         $tda=date("j", time());   //取得目前的日
                                                         if(isset($_GET['tda'])){$tda=$_GET['tda'];}
                                                         $ym=$tyr." 年 ".$tmo." 月";
                                                         $tnum=(intval((date("U",mktime(0,0,0,$tmo,$tda,$tyr))/86400))); //取得目前的日數
                                                         $daycount=(intval((date("U",mktime(0,0,0,$tmo,1,$tyr))/86400)));//取得該月初一的日數
                                                         $sd=date("w",mktime(0,0,0,$tmo,1,$tyr));//該月初一是星期幾
                                                         $cd=1-$sd;//該月初一要退的空格數
                                                         $nd=mktime(0,0,0,$tmo+1,0,$tyr); //該月的最後一日
                                                         $nd=(strftime("%d",$nd));
                                                     ?>
                                                    <?php  //定義週期及表格屬性
                                                        $day=array("日","一","二","三","四","五","六");
                                                        $tw=500;
                                                        $th=100;
                                                        $al="align=\"center\" valign=\"middle\"";
                                                    ?>
                                                    <!---設定文字屬性--->
                                                    <span class="style2">
                                                        <style type="text/css">
                                                            .monthyear {
                                                                font-family: Verdana, sans-serif;
                                                                font-size: 16px;
                                                                font-weight: bold;
                                                                color: #CC0000
                                                            }

                                                            .daynames {
                                                                font-family: Arial, Helvetica;
                                                                font-size: 16px;
                                                                font-weight: bold;
                                                                color: #FFFFFF
                                                            }

                                                            .dates {
                                                                font-family: Arial, Helvetica;
                                                                font-size: 16px;
                                                                font-weight: bold;
                                                                color: #CC0000
                                                            }

                                                        </style>
                                                    </span>
                                                    <!---在螢幕輸出現在的年份及月份--->
                                                    <?php
                                                        if($tmo=='1'){$tyr3=$tyr-1; $tyr2=$tyr; $tmo2=$tmo; $tmo3=13;}
                                                        else if($tmo=='12'){$tyr2=$tyr+1; $tyr3=$tyr; $tmo2=0; $tmo3=$tmo;}
                                                        else{$tyr3=$tyr; $tyr2=$tyr; $tmo2=$tmo; $tmo3=$tmo;}
                                                    ?>
                                                    <table WIDTH="<?php echo $tw?>" align="center">
                                                        <tr CLASS="monthyear">
                                                            <td>
                                                                <div align="center"><a href="?tyr=<?php echo $tyr3?>&tmo=<?php echo $tmo3-1?>" title="上個月">&#171;</a>　
                                                                    <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
                                                                        <option value="?tyr=<?php echo $tyr?>&amp;tmo=<?php echo $tmo?>" selected="selected"><?php echo $tyr?></option>
                                                                        <?php for($i=$tyr1-1; $i>$tyr1-6; $i--){ ?>
                                                                        <?php if($i!=$tyr){?>
                                                                        <option value="?tyr=<?php echo $i?>&amp;tmo=<?php echo $tmo?>"><?php echo $i?></option>
                                                                        <?php } }?>
                                                                    </select>
                                                                    年
                                                                    <select name="menu2" onchange="MM_jumpMenu('parent',this,0)">
                                                                        <option value="?tyr=<?php echo $tyr?>&amp;tmo=<?php echo $tmo?>" selected="selected"><?php echo $tmo?></option>
                                                                        <?php for($j=1; $j<13; $j++){ ?>
                                                                        <?php if($j!=$tmo){?>
                                                                        <option value="?tyr=<?php echo $tyr?>&tmo=<?php echo $j?>"><?php echo $j?></option>
                                                                        <?php } }?>
                                                                    </select>
                                                                    月　
                                                                    <a href="?tyr=<?php echo $tyr2?>&tmo=<?php echo $tmo2+1?>" title="下個月">&#187;</a></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!---在螢幕輸出陣列中的值--->
                                                    <table WIDTH="<?php echo $tw?>" border="1" bordercolor="#CC0000">
                                                        <tr CLASS="daynames" bgcolor="#333333">
                                                            <?php
                                                                //印星期
                                                                for ($a=0;$a<7;$a++){
                                                                echo"<td>$day[$a]</td>";}
                                                            ?>
                                                        </tr>
                                                        <?php
                                                            //印星期
                                                            for ($i=1;$i<=6;$i++){
                                                            if ($cd>$nd) break;
                                                        ?>
                                                        <tr <?php echo $al?> CLASS="dates">
                                                            <?php 
  //在螢幕輸出日期
  for ($prow=1;$prow<8;$prow++) {
  //當日顏色不同   
  if ($daycount==$tnum && $cd>0 && $cd<=$nd){  
      echo "<td bgcolor=\"#CC0000";
      echo "\"><a href=list.php?tyr=$tyr&tmo=$tmo&tda=$cd>$cd</a></td>\n";
      $daycount++;
      $cd++;}	  
  
  else{echo "<td";
    //顯示日期
    if ($cd>0 && $cd<=$nd){
	
	//檢查是否有事情
	$tmo_2 = sprintf('%02d',$tmo);
	$tda_2 = sprintf('%02d',$cd);
	$day_have = "$tyr-$tmo_2-$tda_2";
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_CSRC_have = "SELECT time FROM csrc_data WHERE time like'%$day_have%' AND temp!='Y' ";
$CSRC_have = mysqli_query($conn_CSRC,$query_CSRC_have) or die(mysqli_connect_error());
$row_CSRC_have = mysqli_fetch_assoc($CSRC_have);
$totalRows_CSRC_have = mysqli_num_rows($CSRC_have);

      if ($totalRows_CSRC_have>0){
	    echo " bgcolor=\"#00CCFF\" title=\"此日有狀況\"";
        echo "\"><a href=list.php?tyr=$tyr&tmo=$tmo&tda=$cd>$cd</a></td>\n";
	    $daycount++;
       }
	  else{	
	    echo " bgcolor=\"#FFFFFF";
        echo "\"><a href=list.php?tyr=$tyr&tmo=$tmo&tda=$cd>$cd</a>";
        $daycount++;}
	}
		
    //顯示空白
    else {echo ">";}
    $cd++;}
   }}?>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <p>&nbsp;</p>
                                                <?php if ($totalRows_csrc_data > 0) { // Show if recordset not empty ?>
                                                <table width="800" border="0">
                                                    <tr>
                                                        <td width="150" bgcolor="#104E8B">
                                                            <div align="center"><span class="style3">案發時間</span></div>
                                                        </td>
                                                        <td width="200" bgcolor="#104E8B"><span class="style3">案件類別</span></td>
                                                        <td width="75" bgcolor="#104E8B">
                                                            <div align="center"><span class="style3">級別</span></div>
                                                        </td>
                                                        <td width="100" bgcolor="#104E8B">
                                                            <div align="center"><span class="style3">學號</span></div>
                                                        </td>
                                                        <td width="125" bgcolor="#104E8B"><span class="style3">姓名</span></td>
                                                        <td width="150">&nbsp;</td>
                                                    </tr>
                                                    <?php do { ?>
                                                    <tr valign="top">
                                                        <td width="150">
                                                            <div align="center"><?php echo $row_csrc_data['time'].' '.$row_csrc_data['time2'];?></div>
                                                        </td>
                                                        <td width="200"><?php echo $row_csrc_data['class'].' - '.$row_csrc_data['class2'];?></td>
                                                        <td width="75">
                                                            <div align="center"><?php if($row_csrc_data['secret']=='Y'){echo '*****';}else{echo $row_csrc_data['grade'];}?></div>
                                                        </td>
                                                        <td width="100">
                                                            <div align="center"><?php if($row_csrc_data['secret']=='Y'){echo '*********';}else{echo $row_csrc_data['student_id'];}?></div>
                                                        </td>
                                                        <td width="125"><?php if($row_csrc_data['secret']=='Y'){echo mb_substr($row_csrc_data['name'], 0, 1,"UTF-8");for($i=1;$i<mb_strlen($row_csrc_data['name'], "UTF-8");$i++){echo 'Ｏ';}}else{echo $row_csrc_data['name'];}?></td>
                                                        <td width="150">
                                                        <div align="center" class="link">
                                                            <a href="show.php?no=<?php echo $row_csrc_data['no'];?>">詳</a>
                                                            <?php if(($row_csrc_user['department']=="生輔組")||($row_csrc_user['department']=="學務處")||($row_csrc_user['department']=="秘書室")||($row_csrc_user['department']==$row_csrc_data['user_dep'])){?>
                                                            <a href="remark.php?no=<?php echo $row_csrc_data['no'];?>">追</a>
                                                            <?php if($_SESSION['CSRC_authority']=='1'){?>
                                                            <a href="edit.php?no=<?php echo $row_csrc_data['no'];?>">編</a>
                                                            <a href="javascript:if (confirm('您確定要將 <?php echo '【'.$row_csrc_data['grade'].'　'.$row_csrc_data['student_id'].'　'.$row_csrc_data['name'].'】';?> 從 校安狀況管制登記簿 移除嗎？')) location.href='delete.php?no=<?php echo $row_csrc_data['no']; ?>'">刪</a>
                                                            <?php }else{ echo "&nbsp;";}?>
                                                            <?php }else{echo "&nbsp;";}?>
                                                        </div>
                                                    </td>
                                                    </tr>
                                                    <?php } while ($row_csrc_data = mysqli_fetch_assoc($csrc_data)); ?>
                                                </table>
                                                <?php } // Show if recordset not empty ?>
                                                <?php if ($totalRows_csrc_data == 0) { // Show if recordset empty ?>
                                                <div align="center" style="color:#006600"><strong>今日無狀況</strong></div>
                                                <?php } // Show if recordset empty ?>
                                            </div>
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
                中央大學軍訓室 (03)-422-7151 #57212 , 57999 校安專線 03-280-5666
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
mysqli_free_result($csrc_data);
?>
