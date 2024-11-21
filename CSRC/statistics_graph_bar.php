<?php require_once('Connections/conn_CSRC.php'); ?>
<?php require_once('statistics_graph_sql.php'); ?>
<?php
// content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');

$title = array("車\n禍","詐\n騙","運\n動\n受\n傷","意\n外\n傷\n害","意\n外\n死\n亡","火\n災","生\n病","送\n醫","協\n尋","物\n品\n尋\n獲","遺\n失","竊\n盜","設\n備\n故\n障","校\n外\n糾\n紛","校\n內\n糾\n紛","賃\n居\n糾\n紛","情\n緒\n不\n穩","自\n我\n傷\n害","疑\n似\n性\n平","其\n他");

$data_original = array ($csrc_data_result[9][1],$csrc_data_result[9][2],$csrc_data_result[9][3],$csrc_data_result[9][4],$csrc_data_result[9][5],$csrc_data_result[9][6],$csrc_data_result[9][7],$csrc_data_result[9][8],$csrc_data_result[9][9],$csrc_data_result[9][10],$csrc_data_result[9][11],$csrc_data_result[9][12],$csrc_data_result[9][13],$csrc_data_result[9][14],$csrc_data_result[9][15],$csrc_data_result[9][16],$csrc_data_result[9][17],$csrc_data_result[9][18],$csrc_data_result[9][19],$csrc_data_result[9][20]);

arsort($data_original);

foreach ($data_original as $data_index => $data_value) {
  $data_sort_index[] = $title[$data_index];
  $data_sort_value[] = $data_value;
}

$data = $data_sort_value;

  $max = 0;
  for($m=1;$m<=20;$m++) { $max = max($max, $csrc_data_result[9][$m]); }
  while($max % 5 !=0){$max++;}  
  $max1 = $max / 5;
  $max2 = $max1 / 2;

// Create the graph. These two calls are always required
$graph = new Graph(750,500,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(0,$max1,2*$max1,3*$max1,4*$max1,5*$max1), array($max2,$max1+$max2,2*$max1+$max2,3*$max1+$max2,4*$max1+$max2));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetFont(FF_CHINESE,FS_NORMAL,12);
//$graph->xaxis->SetTickLabels(array($title[0],$title[1],$title[2],$title[3],$title[4],$title[5],$title[6],$title[7],$title[8],$title[9],$title[10],$title[11],$title[12],$title[13],$title[14],$title[15],$title[16],$title[17],$title[18],$title[19]));
$graph->xaxis->SetTickLabels($data_sort_index);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
$graph->yaxis->SetLabelFormat('%d');

// Create the bar plots
$b1plot = new BarPlot($data);

// Create the grouped bar plot
//$gbplot = new GroupBarPlot(array($b1plot));
// ...and add it to the graPH
$graph->Add($b1plot);

$b1plot->value->Show(); 
$b1plot->value->SetFont(FF_ARIAL,FS_BOLD,12); 
$b1plot->value->SetFormat('%d');
$b1plot->SetColor("white");
$b1plot->SetFillColor("#cc1111");

$graph->title->SetFont(FF_CHINESE,FS_NORMAL,14);
$graph->title->Set("校安統計圖-事件總計");

// Display the graph
$graph->Stroke();
?>