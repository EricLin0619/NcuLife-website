<?php require_once('../conn_military.php');  ?>

<?php

$query_military_bulletin_top = sprintf("SELECT * FROM `military_bulletin` WHERE `poster` = '孫守丕' ORDER BY time DESC");
$military_bulletin_top = mysqli_query($conn_military, $query_military_bulletin_top) or die(mysqli_error());
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
	<style>
		* {
			padding: 0;
			margin: 0;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			-box-sizing: border-box;

		}

		img {
			max-width: 100%;
			height: auto;
		}

		ul,
		ol {
			list-style-type: none;
		}

		body {
			background-color: #0273c7;
			font-family: 'cambria', sans-serif;
			overflow: scroll;
		}

		@media (min-width:768px) {
			.container {
				width: 900px;
			}

		}

		.container {
			margin: 10px auto;
			padding-top: 3%;
			position: relative;
			overflow: hidden;
		}

		.page-title a {
			color: #ff7777;
			text-decoration: none;
		}

		.page-title a:hover {
			text-decoration: underline;
			color: #ff3333;
		}

		.circle-menu-box {
			width: 30em;
			height: 30em;
			position: relative;
			margin: 30px auto;
		}

		a.menu-item {
			display: inline-block;
			vertical-align: middle;
			text-decoration: none;
			border-radius: 100%;
			margin: 20px;
			text-align: center;
			width: 100px;
			height: 100px;
			background-color: #6fb793;
			color: white;
			font-weight: bold;
			padding: 30px 0;
			line-height: 1.2;
			position: absolute;
			font-size: 15px;
			transition: all 0.5s;
			-moz-transition: all 0.5s;
			-webkit-transition: all 0.5s;
			-o-transition: all 0.5s;
		}

		.circle-menu-box a.menu-item:hover {
			transform: scale(1.2);
			-webkit-transform: scale(1.2);
			-moz-transform: scale(1.2);
			-o-transform: scale(1.2);
			color: #fff;
			background: #00AEAE;
		}

		span {
			display: inline-block;
			vertical-align: middle;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="menu-container">

			<div class="circle-menu-box">

				<a href="http://house.nfu.edu.tw/NCU" class="menu-item">
					<span class="fa fa-home">雲端<br>租屋網</span>
				</a>
				<a href="HousingInfo_Eng.html" class="menu-item">
					<span class="fa fa-home">Renting Services</span>
				</a>
				<a href="earthquake.html" class="menu-item">
					<span class="fa fa-tag">耐震初評<br>消防安檢<br>合格</span>
				</a>

				<a href="contract.html" class="menu-item">
					<span class="fa fa-info-circle">租屋<br>契約範本</span>
				</a>

				<a href="activities.html" class="menu-item">
					<span class="fa fa-comments">活動<br>花絮</span>
				</a>

				<a href="association.html" class="menu-item">
					<span class="fa fa-folder-open">校外房東<br>聯誼會</span>
				</a>

				<a href="scholarship.html" class="menu-item">
					<span class="fa fa-group">校外房東<br>獎學金</span>
				</a>

				<a href="dispute-QA.php" class="menu-item">
					<span class="fa fa-newspaper-o">租屋糾紛 Q&A <br> 及法令宣導</span>
				</a>

				<a href="./photos/25.htm" class="menu-item">
					<span class="fa fa-sitemap">一氧化碳<br>中毒宣導</span>
				</a>


			</div>

		</div>
		<div class="alert alert-danger" style="text-align:center; font-weight:bolder; font-size:1.1vw; width:50%; margin-left:27%" role="alert">

			考量租屋安全，<br>請同學選擇完成消防及耐震檢測合格之房屋為宜!
		</div>
		<?php include "housing_footer.php" ?>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../js/jquery.rwdImageMaps.min.js"></script>
	<script>
		$(document).ready(function(e) {
			$('img[usemap]').rwdImageMaps();
		});
		var items = document.querySelectorAll('.circle-menu-box a.menu-item');

		for (var i = 0, l = items.length; i < l; i++) {
			items[i].style.left = (40 - 35 * Math.cos(-0.5 * Math.PI - 2 * (1 / l) * i * Math.PI)).toFixed(4) + "%";

			items[i].style.top = (40 + 35 * Math.sin(-0.5 * Math.PI - 2 * (1 / l) * i * Math.PI)).toFixed(4) + "%";
		}
	</script>

	
</body>

</html>