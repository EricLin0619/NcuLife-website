<?php require_once('Connections/conn_CSRC.php'); ?>
<?php require_once('statistics_graph_sql.php'); ?>
<?php
// content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');

$title = array("其他","文學院","理學院","工學院","管理學院","資電學院","地科學院","客家學院","生醫理工學院");

$data_original = array ($csrc_data_result[0][0],$csrc_data_result[1][0],$csrc_data_result[2][0],$csrc_data_result[3][0],$csrc_data_result[4][0],$csrc_data_result[5][0],$csrc_data_result[6][0],$csrc_data_result[7][0],$csrc_data_result[8][0]);

arsort($data_original);

foreach ($data_original as $data_index => $data_value) {
  $data_sort_index[] = $title[$data_index];
  $data_sort_value[] = $data_value;
}

$data = $data_sort_value;

  $max = 0;
  for($m=0;$m<9;$m++) { $max = max($max, $csrc_data_result[$m][0]); }
  while($max % 5 !=0){$max++;}  
  $max1 = $max / 5;
  $max2 = $max1 / 2;

// Create the graph. These two calls are always required
$graph = new Graph(800,350,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(0,$max1,2*$max1,3*$max1,4*$max1,5*$max1), array($max2,$max1+$max2,2*$max1+$max2,3*$max1+$max2,4*$max1+$max2));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetFont(FF_CHINESE,FS_NORMAL,11);
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
$graph->title->Set("校安統計圖-學院總計");

// Display the graph
$graph->Stroke();
?>