<?php require_once('Connections/conn_CSRC.php'); ?>
<?php require_once('statistics_graph_sql.php'); ?>
<?php
// content="text/plain; charset=utf-8"

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
// Some data
$data=array ($csrc_data_result[9][1],$csrc_data_result[9][2],$csrc_data_result[9][3],$csrc_data_result[9][4],$csrc_data_result[9][5],$csrc_data_result[9][6],$csrc_data_result[9][7],$csrc_data_result[9][8],$csrc_data_result[9][9],$csrc_data_result[9][10],$csrc_data_result[9][11],$csrc_data_result[9][12],$csrc_data_result[9][13],$csrc_data_result[9][14],$csrc_data_result[9][15],$csrc_data_result[9][16],$csrc_data_result[9][17],$csrc_data_result[9][18],$csrc_data_result[9][19],$csrc_data_result[9][20]);

//$data=array (1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);


// Create the Pie Graph. 
$graph = new PieGraph(600,700,'auto');

$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// Set A title for the plot
$graph->title->SetFont(FF_CHINESE,FS_NORMAL,14);
$graph->title->Set("校安統計圖-事件總計");
$graph->SetBox(true);

// Create
$p1 = new PiePlot($data);
$p2 = new PiePlot($data);

$graph->Add($p1);

$p1->value->Show(); 
$p1->SetLabelType(PIE_VALUE_PER);
$p1->value->SetFont(FF_ARIAL,FS_BOLD,12); 

//$p1->ShowBorder();
//$p1->SetColor('black');
//$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3','#FF7F00 ','#8B3E2F','#7A378B '));

$graph->Add($p2);

$p2->value->Show(false); 
$p2->SetLabelType(PIE_VALUE_ABS);
$graph->legend->SetFont(FF_CHINESE,FS_NORMAL,12);
$graph->legend->SetMarkAbsSize(10); 

$csrc_list = array("車禍","詐騙","運動受傷","意外傷害","意外死亡","火災","生病","送醫","協尋","物品尋獲","遺失","竊盜","設備故障","校外糾紛","校內糾紛","賃居糾紛","情緒不穩","自我傷害","疑似性平","其他");
for($m=0;$m<20;$m++) { $P2_Legends[$m] = $csrc_list[$m].' (%d)'; }
$p2->SetLegends($P2_Legends);
$p2->ShowBorder();
$p2->SetColor('black');
//$p2->SetSliceColors(array('#0066FF','#227700','#FF0000','#FF44AA','#660077','#BB5500','#666666','#9999FF','#0088A8','#FFCCCC','#000000','#FFBB66','#8C0044','#FF77FF','#99FF99','#886600','#AAAAAA'));
$p2->SetSliceColors(array('#000079','#0000C6','#003D79','#004B97','#0080FF','#97CBFF','#006030','#02C874','#28FF28','#5DA31B','#D1FF85','#4D0000','#AE0000','#FF0000','#F75000','#ff7575','#5B00AE','#9F35FF','#BE77FF','#DDDDDD'));

$graph->Stroke();

?>