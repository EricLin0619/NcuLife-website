<?php require_once('../../conn_military.php'); ?>
<?php
header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
 if(!isset($_SESSION['military_Username'])){
 echo "<script language=\"javascript\">document.location.href=\"loginforlodger.php\";</script>";
}
?>
<!DOCTYPE html>
<!-- saved from url=(0038)https://kkbruce.tw/bs3/Examples/theme# -->
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="https://kkbruce.tw/Content/AssetsBS3/img/favicon.ico">
	<title>中央大學賃居實地訪視紀錄網</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/theme.css" rel="stylesheet">
	<link href="css/sticky-footer.css" rel="stylesheet">
	<!--[if lt IE 9]><script src=~/Scripts/AssetsBS3/ie8-responsive-file-warning.js></script><![endif]-->
	<script src="/s/newjs/ie-emulation-modes-warning.js"></script>
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]><script src=https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js></script><script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script><![endif]-->
</head>
<SCRIPT type="text/javascript">
	function check() {
		/*var checkflag = 0;
		for (var i = 1; i <= 12; i++) {
		    var radio = document.getElementsByName("radiogroup" + i);
		    for (var j = 0; j < radio.length; j++) {
		        if (radio[j].checked) {
		            checkflag++;
		        }
		    }
		}
		if (academicyear.value == "") {
		    alert("未輸入第幾學年度");
		    document.form.academicyear.focus();
		} else if (semester.value == "") {
		    alert("未選擇第幾學期");
		    document.form.semester.focus();
		} else if (department.value == "") {
		    alert("未選擇科系");
		    document.form.department.focus();
		} else if (stdname.value == "") {
		    alert("未輸入學生姓名")
		    document.form.stdname.focus();
		} else if (stdid.value == "") {
		    alert("未輸入學生學號")
		    document.form.stdid.focus();
		} else if (phonenum.value == "") {
		    alert("未輸入學生手機")
		    document.form.phonenum.focus();
		} else if (landlordname.value == "") {
		    alert("未輸入房東姓名")
		    document.form.landlordname.focus();
		} else if (visitedate.value == "") {
		    alert("未選擇訪視日期")
		    document.form.visitedate.focus();
		} else if (stdaddress.value == "") {
		    alert("未輸入賃居地址")
		    document.form.stdaddress.focus();
		} else if (mins.value == "") {
		    alert("未輸入通勤時間")
		    document.form.mins.focus();
		} else if (rentcost.value == "") {
		    alert("未輸入租金")
		    document.form.rentcost.focus();
		} else if (tempmoney.value == "") {
		    alert("未輸入押金")
		    document.form.tempmoney.focus();
		} else if (startsigndate.value == "") {
		    document.form.startsigndate.focus();
		} else if (endsigndate.value == "") {
		    alert("未選擇截止簽約時間")
		    document.form.endsigndate.focus();
		} else if (point.value == "") {
		    alert("未輸入交談要點")
		    document.form.point.focus();
		} else if (advice.value == "") {
		    alert("未輸入訪視建議")
		    document.form.advice.focus();
		} else if (miliname.value == "") {
		    alert("未輸入訪視教官姓名")
		    document.form.miliname.focus();
		} else if (checkflag != 12) {
		    alert("尚有選項未選取")
		}
		<!-- 若以上條件皆不符合，也就是表單資料皆有填寫的話，則將資料送出 -->
		else {*/
		alert("【新增成功】")
		document.form.submit();
		//}
	}

</SCRIPT>

<body>
	<?php include "header.php"; ?>
	<div name="presentation" style="width: 80%; display: table; margin: 0 auto;">
		<div class="page-header">
			<h3 align="center">國立中央大學校外賃居生實地訪視紀錄表</h3>
		</div>
		<form class="form-horizontal" role="form" name="form" method="post" action="Student_Visit.php" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-4 col-xs-12">
					<label for="academicyear" class="col-xs-4 control-label">學年*</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="academicyear" id="academicyear" placeholder="輸入第幾學年度">
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<label for="semester" class="col-xs-4 control-label">學期*</label>
					<div class="col-xs-4 control-label">
						<select name="semester" id="semester">
							<option value="" select="selected">請選擇學期</option>
							<option value="一">第一學期</option>s
							<option value="二">第二學期</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<label for="department" class="col-xs-4 control-label">科系*</label>
					<div class="col-xs-8 control-label">
						<select name="department" id="department">
							<option value="" select="selected">請選擇科系</option>
							<optgroup label="文學院">
								<option value="中國文學系">中國文學系</option>
								<option value="英美語文學系">英美語文學系</option>
								<option value="法國語文學系">法國語文學系</option>
								<option value="哲學研究所">哲學研究所</option>
								<option value="藝術學研究所">藝術學研究所</option>
								<option value="歷史研究所">歷史研究所</option>
								<option value="學習與教學研究所">學習與教學研究所</option>
								<option value="亞際文化研究國際碩士學位學程(台聯大)">亞際文化研究國際碩士學位學程(台聯大)</option>
							<optgroup label="理學院">
								<option value="理學院學士班">理學院學士班</option>
								<option value="物理學系">物理學系</option>
								<option value="數學系">數學系</option>
								<option value="化學學系">化學學系</option>
								<option value="光電科學與工程學系">光電科學與工程學系</option>
								<option value="天文研究所">天文研究所</option>
								<option value="光電博士學位學程(台聯大)">光電博士學位學程(台聯大)</option>
							<optgroup label="工學院">
								<option value="化學工程與材料工程學系">化學工程與材料工程學系</option>
								<option value="土木工程學系">土木工程學系</option>
								<option value="機械工程學系">機械工程學系</option>
								<option value="能源工程研究所">能源工程研究所</option>
								<option value="環境工程研究所">環境工程研究所</option>
								<option value="營建管理研究所">營建管理研究所</option>
								<option value="材料科學與工程研究所">材料科學與工程研究所</option>
								<option value="國際永續發展碩士在職專班">國際永續發展碩士在職專班</option>
								<option value="應用材料科學國際研究生碩士學位學程">應用材料科學國際研究生碩士學位學程</option>
							<optgroup label="管理學院">
								<option value="企業管理學系">企業管理學系</option>
								<option value="資訊管理學系">資訊管理學系</option>
								<option value="財務金融學系">財務金融學系</option>
								<option value="經濟學系">經濟學系</option>
								<option value="會計研究所">會計研究所</option>
								<option value="產業經濟研究所">產業經濟研究所</option>
								<option value="人力資源管理研究所">人力資源管理研究所</option>
								<option value="工業管理研究所">工業管理研究所</option>
								<option value="管理學院高階主管企管碩士班(EMBA)">管理學院高階主管企管碩士班(EMBA)</option>
							<optgroup label="資訊電機學院">
								<option value="電機工程學系">電機工程學系</option>
								<option value="資訊工程學系">資訊工程學系</option>
								<option value="通訊工程學系">通訊工程學系</option>
								<option value="網路學習科技研究所">網路學習科技研究所</option>
							<optgroup label="地球科學學院">
								<option value="地球科學學系">地球科學學系</option>
								<option value="大氣科學學系">大氣科學學系</option>
								<option value="太空科學研究所">太空科學研究所</option>
								<option value="應用地質研究所">應用地質研究所</option>
								<option value="水文與海洋科學研究所">水文與海洋科學研究所</option>
								<option value="地球系統科學國際研究生博士學位學程">地球系統科學國際研究生博士學位學程</option>
							<optgroup label="客家學院">
								<option value="客家語文暨社會科學學系">客家語文暨社會科學學系</option>
								<option value="法律與政府研究所">法律與政府研究所</option>
							<optgroup label="生醫理工學院">
								<option value="生命科學系">生命科學系</option>
								<option value="認知神經科學研究所">認知神經科學研究所</option>
								<option value="生醫科學與工程學系">生醫科學與工程學系</option>
								<option value="跨領域神經科學博士學位學程(台聯大)">跨領域神經科學博士學位學程(台聯大)</option>
							<optgroup label="太空及遙測研究學院">
								<option value="遙測科技碩士學位學程">遙測科技碩士學位學程</option>
								<option value="環境科技博士學位學程(台聯大)">環境科技博士學位學程(台聯大)</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12">
					<label for="stdname" class="col-xs-4 control-label">姓名*</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="stdname" id="stdname" placeholder="輸入學生姓名">
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<label for="stdid" class="col-xs-4 control-label">學號*</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="stdid" id="stdid" placeholder="輸入學生學號">
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<label for="phonenum" class="col-xs-4 control-label">手機*</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="phonenum" id="phonenum" placeholder="請輸入學生手機">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12">
					<label for="landlordname" class="col-xs-4 control-label">房東姓名*</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="landlordname" id="landlordname" placeholder="輸入房東姓名">
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<label for="landlordname" class="col-xs-4 control-label">房東電話*</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="landlordname" id="landlordname" placeholder="輸入房東電話">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12">
					<label for="phonenum" class="col-xs-4 control-label">室友1姓名</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="phonenum" id="phonenum" placeholder="請輸入室友姓名">
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<label for="landlordname" class="col-xs-4 control-label">電話</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="landlordname" id="landlordname" placeholder="輸入室友電話">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12">
					<label for="phonenum" class="col-xs-4 control-label">室友2姓名</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="phonenum" id="phonenum" placeholder="請輸入室友姓名">
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<label for="landlordname" class="col-xs-4 control-label">電話</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="landlordname" id="landlordname" placeholder="輸入室友電話">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-pull-2 col-xs-12">
					<label for="stdaddress" class="col-xs-4 control-label">賃居地址*</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="stdaddress" id="stdaddress" placeholder="請輸入學生賃居地址">
					</div>
				</div>
			</div>
			<div class="col-md-4 col-xs-12">
				<label for="visitedate" class="col-xs-4 control-label">訪視日期*</label>
				<div class="col-xs-8">
					<input type="date" id="visitedate" name="visitedate" min="<?php echo date('Y-m-d'); ?>">
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">是否簽訂正式契約*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup1" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup1" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label for="tempmoney" class="col-xs-4 control-label">簽約日期*</label>
				<div class="col-xs-8">
					<input type="date" id="startsigndate" name="startsigndate">
					<p>至</p>
					<input type="date" id="endsigndate" name="endsigndate">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12">
					<label for="phonenum" class="col-xs-4 control-label">來自什麼縣市</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="phonenum" id="phonenum" placeholder="請輸入縣市名稱">
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<label for="landlordname" class="col-xs-4 control-label">多久返家一次</label>
					<div class="col-xs-8">
						<input type="text" class="form-control" name="landlordname" id="landlordname" placeholder="">
					</div>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">是否有打工*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup2" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup2" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">是否曾在租屋處失竊*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup3" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup3" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">賃居消息來源*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup4" id="inlineRadio1" value="安靜"> 學長姐/朋友
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup4" id="inlineRadio2" value="尚可"> 生輔組
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup4" id="inlineRadio3" value="尚可"> 沿路抄電話
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup4" id="inlineRadio4" value="尚可"> 本校租賃資訊網
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup4" id="inlineRadio5" value="尚可"> 臉書、BBS
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup4" id="inlineRadio6" value="尚可"> 校外租屋網、仲介
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">賃居考慮因素*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup5" id="inlineRadio1" value="安靜"> 租金與房間坪數
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup5" id="inlineRadio2" value="尚可"> 與同學朋友為鄰
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup5" id="inlineRadio3" value="尚可"> 通風、採光
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup5" id="inlineRadio4" value="尚可"> 生活機能
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup5" id="inlineRadio5" value="尚可"> 房東親切負責
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup5" id="inlineRadio6" value="尚可"> 環境安寧、整潔、出入單純
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup5" id="inlineRadio7" value="尚可"> 停車、交通
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup5" id="inlineRadio7" value="尚可"> 房間及公共設備
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup5" id="inlineRadio7" value="尚可"> 安全設施
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">環境安寧*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup6" id="inlineRadio1" value="安靜"> 非常滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup6" id="inlineRadio2" value="尚可"> 滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup6" id="inlineRadio3" value="尚可"> 尚可
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup6" id="inlineRadio4" value="尚可"> 不滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup6" id="inlineRadio5" value="尚可"> 很不滿意
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">採光通風*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup7" id="inlineRadio1" value="安靜"> 非常滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup7" id="inlineRadio2" value="尚可"> 滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup7" id="inlineRadio3" value="尚可"> 尚可
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup7" id="inlineRadio4" value="尚可"> 不滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup7" id="inlineRadio5" value="尚可"> 很不滿意
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">清潔衛生*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup8" id="inlineRadio1" value="安靜"> 非常滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup8" id="inlineRadio2" value="尚可"> 滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup8" id="inlineRadio3" value="尚可"> 尚可
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup8" id="inlineRadio4" value="尚可"> 不滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup8" id="inlineRadio5" value="尚可"> 很不滿意
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">安全設施*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup9" id="inlineRadio1" value="安靜"> 非常滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup9" id="inlineRadio2" value="尚可"> 滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup9" id="inlineRadio3" value="尚可"> 尚可
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup9" id="inlineRadio4" value="尚可"> 不滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup9" id="inlineRadio5" value="尚可"> 很不滿意
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">租屋管理*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup10" id="inlineRadio1" value="安靜"> 非常滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup10" id="inlineRadio2" value="尚可"> 滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup10" id="inlineRadio3" value="尚可"> 尚可
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup10" id="inlineRadio4" value="尚可"> 不滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup10" id="inlineRadio5" value="尚可"> 很不滿意
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">室友相處*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup11" id="inlineRadio1" value="安靜"> 非常滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup11" id="inlineRadio2" value="尚可"> 滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup11" id="inlineRadio3" value="尚可"> 尚可
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup11" id="inlineRadio4" value="尚可"> 不滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup11" id="inlineRadio5" value="尚可"> 很不滿意
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">停車空間*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup12" id="inlineRadio1" value="安靜"> 非常滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup12" id="inlineRadio2" value="尚可"> 滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup12" id="inlineRadio3" value="尚可"> 尚可
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup12" id="inlineRadio4" value="尚可"> 不滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup12" id="inlineRadio5" value="尚可"> 很不滿意
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">生活適應*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup13" id="inlineRadio1" value="安靜"> 非常滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup13" id="inlineRadio2" value="尚可"> 滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup13" id="inlineRadio3" value="尚可"> 尚可
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup13" id="inlineRadio4" value="尚可"> 不滿意
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup13" id="inlineRadio5" value="尚可"> 很不滿意
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">是否會推薦同學租賃*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup14" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup14" id="inlineRadio2" value="尚可"> 否
					</label>
					<label class="radio-inline">
						<input type="text" class="form-control" name="stdaddress" id="stdaddress" placeholder="請輸入原因">
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">機車/腳踏車是否影響逃生路線*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup14" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup14" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">是否有緊急照明設備*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup15" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup15" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">是否使用瓦斯熱水器*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup16" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup16" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">熱水器是否置放室外且通風良好</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup17" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup17" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">是否有監視錄影設備*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup18" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup18" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">室內/外電線完整無斷裂破損*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup19" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup19" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">知道滅火器擺放位置*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup20" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup20" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">知道手電筒擺放位置*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup21" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup21" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">熟悉逃生路線*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup22" id="inlineRadio1" value="安靜"> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup22" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">訪視建議*</label>
				<div class="col-xs-8">
					<textarea class="form-control col-xs-8" rows="3" id="advice" name="advice"></textarea>
				</div>
			</div>

			<div class="raw">
				<div class="col-md-4 col-xs-12 control-label">
					<label for="miliname" class="col-xs-4 control-label">訪視教官*</label>
					<div class="col-xs-4 control-label">
						<select name="miliname" id="miliname">
							<option value="" select="selected">請選擇教官</option>
							<option value="孫中運">孫中運</option>
							<option value="許文瀞">許文瀞</option>
							<option value="陳盈滿">陳盈滿</option>
							<option value="孫守丕">孫守丕</option>
							<option value="高潤清">高潤清</option>
							<option value="蔣家騏">蔣家騏</option>
							<option value="熊英才">熊英才</option>
							<option value="鄔啟華">鄔啟華</option>
							<option value="廖河順">廖河順</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 col-xs-12 control-label">
					<label for="senimiliname" class="col-xs-4 control-label">生輔組組長</label>
					<div class="col-xs-8">
						<input type="email" class="form-control" id="senimiliname" name="senimiliname" placeholder="輸入軍訓室主任姓名">
					</div>
				</div>
				<div class="col-md-4 col-xs-12 control-label">
					<label for="deanofaffairsname" class="col-xs-4 control-label">學務長</label>
					<div class="col-xs-8">
						<input type="email" class="form-control" id="deanofaffairsname" name="deanofaffairsname" placeholder="輸入學務長姓名">
					</div>
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12 control-label">
				<label for="file" class="col-xs-4 control-label">上傳照片</label>
				<div class="col-xs-8">
					<input type="file" name="image_1" id="image_1">
					<input type="file" name="image_2" id="image_2">
				</div>
			</div>
			<div class="col-md-10 col-md-pull-2 col-xs-12">
				<label class="col-xs-4 control-label">暫存*</label>
				<div class="col-xs-8">
					<label class="radio-inline">
						<input type="radio" name="radiogroup23" id="inlineRadio1" value="安靜" checked> 是
					</label>
					<label class="radio-inline">
						<input type="radio" name="radiogroup23" id="inlineRadio2" value="尚可"> 否
					</label>
				</div>
			</div>
			<div class="col-md-4 col-md-push-5 col-xs-12 col-xs-push-4">
				<p>
					<button type="button" class="btn btn-primary" onclick="check()" name="send">送出</button>
					<button type="reset" class="btn btn-secondary">清除</button>
				</p>
			</div>
		</form>
	</div>
</body>

</html>
