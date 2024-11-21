<?php require_once('Connections/conn_CSRC.php'); ?>
<?php //限制存取頁面
if (!isset($_SESSION)) {
  session_start();
}

$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $user, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_user set equal to their user. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($user)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($user, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their user. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['CSRC_user'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['CSRC_user'], $_SESSION['CSRC_authority'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
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
  $insertSQL = sprintf("INSERT INTO csrc_user (user, password, name, department, authority, authority2) VALUES (%s, password(%s), %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user'], "text"),
					   GetSQLValueString($_POST['user'], "text"),
					   GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['department'], "text"),
                       GetSQLValueString($_POST['authority'], "text"),
					   GetSQLValueString($_POST['authority2'], "text"));

  mysqli_select_db($conn_CSRC,$database_conn_CSRC);
  $Result1 = mysqli_query($conn_CSRC,$insertSQL) or die(mysqli_connect_error());

  $insertGoTo = "member.php";
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE csrc_user SET name=%s, department=%s, authority=%s, authority2=%s WHERE `no`=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['department'], "text"),
                       GetSQLValueString($_POST['authority'], "text"),
					   GetSQLValueString($_POST['authority2'], "text"),
                       GetSQLValueString($_POST['no'], "int"));

  mysqli_select_db($conn_CSRC,$database_conn_CSRC);
  $Result1 = mysqli_query($conn_CSRC,$updateSQL) or die(mysqli_connect_error());
}

$colname_CSRC_member = "-1";
if (isset($_GET['no'])) {
  $colname_CSRC_member = (get_magic_quotes_gpc()) ? $_GET['no'] : addslashes($_GET['no']);
}
mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_CSRC_member = sprintf("SELECT * FROM csrc_user WHERE `no` = %s", $colname_CSRC_member);
$CSRC_member = mysqli_query($conn_CSRC,$query_CSRC_member) or die(mysqli_connect_error());
$row_CSRC_member = mysqli_fetch_assoc($CSRC_member);
$totalRows_CSRC_member = mysqli_num_rows($CSRC_member);

mysqli_select_db($conn_CSRC,$database_conn_CSRC);
$query_CSRC_member_list = "SELECT * FROM csrc_user ORDER by department DESC, name ASC";
$CSRC_member_list = mysqli_query($conn_CSRC,$query_CSRC_member_list) or die(mysqli_connect_error());
$row_CSRC_member_list = mysqli_fetch_assoc($CSRC_member_list);
$totalRows_CSRC_member_list = mysqli_num_rows($CSRC_member_list);
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
<SCRIPT src="member_jquery.js" type=text/javascript></SCRIPT>

<SCRIPT type=text/javascript>
<!--
$(document).ready(function() {
	$('#userLoading').hide();
	$('#user').blur(function(){
	  $('#userLoading').show();
      $.post("member_check.php", {
        user: $('#user').val()
      }, function(response){
        $('#userResult').fadeOut();
        setTimeout("finishAjax('userResult', '"+escape(response)+"')", 400);
      });
    	return false;
	});
});

function finishAjax(id, response) {
  $('#userLoading').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} //finishAjax

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</SCRIPT>
<style type="text/css">
<!--
.style1 {color: #FFFFFF; font-weight: bold; }
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
                      <h2>校安狀況管制人員權限</h2>
					  <p>| 
			            <a href="?new">新增</a> | 
			            <a href="member.php">列表</a> |
					  </p>
					  <div align="justify"> 
                        <?php if (isset($_GET['new']))  { // Show If Var Is Set ?>
                        <p><strong>§ 新增人員</strong></p>
                      <form action="<?php echo $editFormAction; ?>" method="post" id="form1">
                        <table align="center">
                          <tr valign="baseline">
                            <td nowrap="nowrap" align="right">帳號：</td>
                            <td><input name="user" type="text" id="user" value="" size="20" maxlength="20"/>
                              <br />
                              <span id="userLoading"><img src="images/loading.gif" width="15" height="15" /></span><span id="userResult">　</span></td>
                          </tr>
                          <tr valign="baseline">
                            <td width="140" align="right" nowrap="nowrap">姓名：</td>
                            <td width="268"><input type="text" name="name" value="" size="32" /></td>
                          </tr>

                          <tr valign="baseline">
                            <td nowrap="nowrap" align="right">單位：</td>
                            <td><input name="department" type="text" id="department" value="" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap="nowrap" align="right">權限：</td>
                            <td><select name="authority" id="authority">
                                <option value="0" selected="selected">一般權限</option>
                                <option value="1">管理權限</option>
                              </select>
							</td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right" nowrap="nowrap">軍訓室主任：</td>
                            <td><select name="authority2" id="authority2">
                              <option value="0" selected="selected">否</option>
                              <option value="1">是</option>
                            </select></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><div align="center">
                                <input name="submit" type="submit" value="新增資料" />
                            </div></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="form1" />
                      </form>
                      <?php } // Show If Var Is Set ?>
                      <?php if (isset($_GET['edit']))  { // Show If Var Is Set ?>
                      <p><strong>§ 修改人員</strong></p>
                      <form id="form2" method="post" action="<?php echo $editFormAction; ?>">
                        <table align="center">
                          <tr valign="baseline">
                            <td align="right" nowrap="nowrap">帳號：</td>
                            <td><strong><?php echo $row_CSRC_member['user']; ?></strong></td>
                          </tr>
                          <tr valign="baseline">
                            <td width="140" align="right" nowrap="nowrap">姓名：</td>
                            <td width="268"><input name="name" type="text" id="name" value="<?php echo $row_CSRC_member['name']; ?>" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right" nowrap="nowrap">單位：</td>
                            <td><input name="department" type="text" id="department" value="<?php echo $row_CSRC_member['department']; ?>" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right" nowrap="nowrap">權限：</td>
                            <td><select name="authority" id="authority">
                              <option value="0" <?php if (!(strcmp(0, $row_CSRC_member['authority']))) {echo "selected=\"selected\"";} ?>>一般權限</option>
                              <option value="1" <?php if (!(strcmp(1, $row_CSRC_member['authority']))) {echo "selected=\"selected\"";} ?>>管理權限</option>
                            </select></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right" nowrap="nowrap">軍訓室主任：</td>
                            <td><select name="authority2" id="authority2">
                              <option value="0" <?php if (!(strcmp(0, $row_CSRC_member['authority2']))) {echo "selected=\"selected\"";} ?>>否</option>
                              <option value="1" <?php if (!(strcmp(1, $row_CSRC_member['authority2']))) {echo "selected=\"selected\"";} ?>>是</option>
                            </select></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><div align="center">
                                <input name="submit" type="submit" value="修改資料" />
                                <input name="no" type="hidden" id="no" value="<?php echo $_GET['no']; ?>" />
                            </div></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_update" value="form2" />
                      </form>
                      <?php } // Show If Var Is Set ?>
                      <?php if (!isset($_GET['new'])&&!isset($_GET['edit']))  { // Show If Var Is Not Set ?>
                      <p><strong>§ 人員列表</strong></p>
                      <table width="750" align="center">
					     <tr valign="baseline">
                          <td bgcolor="#104E8B" ><span class="style1">人員</span></td>
                          <td bgcolor="#104E8B" ><div align="center"><span class="style1">權限</span></div></td>
                          <td bgcolor="#104E8B" ><div align="center"><span class="style1">軍訓室主任</span></div></td>
                          <td bgcolor="#104E8B" ><div align="center"><span class="style1">最後登入時間</span></div></td>
                          <td >&nbsp;</td>
                        </tr>
                        <?php do { ?>
                        <tr valign="baseline">
                          <td width="170" nowrap="nowrap"><div align="center">
                            <div align="left"><?php echo $row_CSRC_member_list['department'].'-'.$row_CSRC_member_list['name']; ?></div>
                          </div></td>
                          <td width="100" nowrap="nowrap">
                            
                              <div align="center">
                                <?php
					switch($row_CSRC_member_list['authority']){
					case 0:	echo '一般權限';  break;
					case 1:	echo '管理權限';  break;
					}  ?>
                            </div></td>
                          <td width="150" nowrap="nowrap">
                            
                              <div align="center">
                                <?php
					switch($row_CSRC_member_list['authority2']){
					case 0:	echo '';  break;
					case 1:	echo '是';  break;
					}  ?>
                            </div></td> 
                          <td width="150"><div align="center"><?php echo $row_CSRC_member_list['login_time']; ?></div></td>
                          <td width="150" class="link"><div align="center"> <a href="member.php?edit&amp;no=<?php echo $row_CSRC_member_list['no']; ?>">修改</a>　<a href="javascript:if (confirm('您確定要將 <?php echo '【'.$row_CSRC_member_list['department'].'-'.$row_CSRC_member_list['name'].'】'; ?> 從成員中移除嗎？')) location.href='member_delete.php?no=<?php echo $row_CSRC_member_list['no']; ?>'">刪除</a></div></td>
                        </tr>
                        <?php } while ($row_CSRC_member_list = mysqli_fetch_assoc($CSRC_member_list)); ?>
                      </table>
                      <?php } // Show If Var Is Not Set ?>
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
