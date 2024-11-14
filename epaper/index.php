<!DOCTYPE html>
<html lang="zh-TW">
<?php
    header("Content-Type: text/html;charset=utf-8");
    session_start();
    $_SESSION['browse'] = 1;
?>
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Hsing-Chien">
	<meta name="editor" content="Richard Chen">
	<title>國立中央大學生活輔導組</title>
	<!--引用bootstrap及carousel.js-->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link href="index.css" rel="stylesheet">
	<style>
		body {
			font-family: Roboto,"PingFang TC", "Noto Sans CJK TC", "黑體-繁", "Heiti TC","蘋果儷中黑", "Apple LiGothic Medium", "微軟正黑體", "Microsoft JhengHei", sans-serif;
			background-image: url("images/bg.png");
			background-attachment: fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.footer {
			text-align: center;
		}
	</style>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>
	<div class="card">
		<div class="content">
			<a id="nav-link" href="../index.php" title="返回生活輔導組網站首頁">
				前往生活輔導組首頁 >>
			</a>
			<img id="hero" src="images/BiNews.png" alt="雙週報標頭">
			<div class="col-container">
				<div class="col">
					<div class="block">
						<h2><a href="https://pip.moi.gov.tw/V3/B/SCRB0102.aspx" title="查看內政部租金補貼專區">內政部-300億元中央擴大租金補貼專區</a></h2>
						
						<a href="images/懶人包_1-20230707.jpg" title="查看租金補貼懶人包第一頁">
							<img src="images/懶人包_1-20230707.jpg" alt="租金補貼計畫說明懶人包第一頁">
						</a>						
						<a href="images/懶人包_2-20230707.jpg" title="查看租金補貼懶人包第二頁">
							<img src="images/懶人包_2-20230707.jpg" alt="租金補貼計畫說明懶人包第二頁">
						</a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>113年10月8日工學院交通安全宣講</h2>
						<a href="images/20241008_103222.jpg" title="查看工學院交通安全宣講活動照片">
							<img src="images/20241008_103222.jpg" alt="工學院交通安全宣講活動照片">
						</a>						
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>113年10月1日管院交通安全宣講</h2>
						<a href="images/20241001_110155.jpg" title="查看管院交通安全宣講活動照片">
							<img src="images/20241001_110155.jpg" alt="管院交通安全宣講活動照片">
						</a>						
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>113年9月24日物理所交安宣導</h2>
						<a href="images/20240924_144852.jpg"><img src="images/20240924_144852.jpg"></a>						
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>113年9月5日新進外籍交換生交通安全宣導</h2>
						<a href="images/113年9月5日新進外籍交換生交通安全宣導.jpg"><img src="images/113年9月5日新進外籍交換生交通安全宣導.jpg"></a>						
					</div>
				</div>
				
				<div class="col">
					<div class="block">
						<h2>腳踏車失竊頻繁，請小心注意，務必上鎖</h2>
						<a href="images/腳踏車宣導勿借騎海報.jpg" title="查看腳踏車防竊宣導海報">
							<img src="images/腳踏車宣導勿借騎海報.jpg" alt="腳踏車防竊宣導海報">
						</a>						
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>校園安全報你知</h2>
						<a href="images/第0031期.jpg"><img src="images/投影片1.jpg"></a>						
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>桃園市政府交通局唐英峰技士入班宣導交通安全</h2>
						<a href="images/桃園市政府交通局唐英峰技士1.jpg"><img src="images/桃園市政府交通局唐英峰技士2.jpg"></a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>租屋族的消費者保護法</h2>
						<a href="images/簡報1-租屋族的消費者保護法.jpg"><img src="images/簡報1-租屋族的消費者保護法.jpg"></a>
						
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>租屋防詐騙注意事項</h2>
						<a href="images/簡報2-租屋防詐騙注意事項.jpg"><img src="images/簡報2-租屋防詐騙注意事項.jpg"></a>
						
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>租賃消費糾紛注意事項</h2>
						<a href="images/簡報3-租賃消費糾紛注意事項.jpg"><img src="images/簡報3-租賃消費糾紛注意事項.jpg"></a>		
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>賃居宣導-新版租賃契約</h2>
						<a href="images/2748039-PH.jpg" target=_blank><img src="images/2748039-PH.jpg"></a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>賃居宣導-7大注意要點</h2>
						<a href="images/2017年賃居宣傳海報.jpg" target=_blank><img src="images/2017年賃居宣傳海報.jpg"></a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>校外租屋火場自救與逃生</h2>
						<iframe width="360" height="300" 
							src="https://www.youtube.com/embed/_mZEr50_oNk" 
							title="校外租屋火場自救與逃生教學影片"
							frameborder="0" 
							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
							allowfullscreen>
						</iframe>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>瓦斯熱水器CO中毒危險度</h2>
						<a href="images/居家熱水器CO中毒危險度.jpg"><img src="images/居家熱水器CO中毒危險度.jpg"></a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>租屋切記-防範 CO 中毒</h2>
						<!--原本尺寸是548*333-->
						<iframe width="360" height="300" src="https://www.youtube.com/embed/4fird_h1UIw?list=PLIOTQ0p_8fAzMQS4KZVnrDjmL9KawrtqH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>校外租屋需考量注意事項</h2>
						<a href="images/教育部賃居安全宣傳海報_110-10.png"><img src="images/教育部賃居安全宣傳海報_110-10.png"></a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>「假房東.真詐騙」宣導</h2>
						<video width="360" height="300" controls>
						  	<source src="images/桃園市政府「假房東真詐騙」宣導影片.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</div>
				</div>
				
				<div class="col">
					<div class="block">
						<h2>高齡者行人安全 好習慣篇</h2>
						<video width="360" height="300" controls>
						  	<source src="images/高齡者行人安全 好習慣篇.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>OLOO嚕車安全注意事項</h2>
						<a href="images/OLOO嚕車安全注意事項.jpg"><img src="images/OLOO嚕車安全注意事項.jpg"></a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>交通安全宣導月</h2>
						<a href="images/112宣導海報.jpg"><img src="images/112宣導海報.jpg"></a>
					</div>
				</div>
 
				<div class="col">
					<div class="block">
						<h2>公共自行車傷害險</h2>
						<a href="images/公共自行車傷害險.jpg"><img src="images/公共自行車傷害險.jpg"></a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>求職防詐騙宣導</h2>
						<a href="images/求職防詐騙宣導.jpg"><img src="images/求職防詐騙宣導.jpg"></a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>校園安全宣導</h2>
						<a href="images/校園安全宣導.jpg" target="_blank" title="查看校園安全宣導海報">
							<img src="images/校園安全宣導.jpg" alt="校園安全宣導海報">
						</a>
					</div>
				</div>
				
				<div class="col">
					<div class="block">
						<h2>防制藥物濫用</h2>
						<a href="images/毒品新樣貌.jpg" target=_blank><img src="images/毒品新樣貌.jpg"></a>
					</div>
				</div>
 
				<div class="col">
					<div class="block">
						<h2>暑期常見兵役問題</h2>
						<a href="../download/暑期常見兵役問題.pdf" title="下載暑期常見兵役問題說明文件">
							<img src="images/暑期常見兵役問題.png" alt="暑期常見兵役問題說明海報">
						</a>
					</div>
				</div>
 
				<div class="col">
					<div class="block">
						<h2>交通安全</h2>
						<a href="images/交通安全1.png"><img src="images/交通安全1.png"></a>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>交通安全</h2>
						<a href="images/交通安全2.png"><img src="images/交通安全2.png"></a>
					</div>
				</div>
				
				<div class="col">
					<div class="block">
						<h2>112年交通安全微電影徵件比賽第一名-菜鳥松鼠</h2>
						<video width="360" height="300" controls>
						  	<source src="../video/traffic/112/菜鳥松鼠.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>112年交通安全微電影徵件比賽第二名-Squirrels are watching</h2>
						<video width="360" height="300" controls>
						  	<source src="../video/traffic/112/Squirrels are watching.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</div>
				</div>
				<div class="col">
					<div class="block">
						<h2>112年交通安全微電影徵件比賽第三名-校內自行車安全猴厲害</h2>
						<video width="360" height="300" controls>
						  	<source src="../video/traffic/112/校內自行車安全猴厲害.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<p>國立中央大學校園安全中心<br>Military Training Office of National Central University<br>校安專線 Emergency Call: 03-2805666 / 0911-949-630</p>
			<p>Page design by Hsing-Chien</p>
		</div>
	</div>
</body>
</html>