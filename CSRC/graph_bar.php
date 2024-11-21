<?php require_once('Connections/conn_CSRC.php'); ?>
<?php require_once('graph_sql.php'); ?>
<?php
// content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
print $test;
$data_original = $csrc_data_result;

if($_SESSION['csrc_data_select']=='1'){ $csrc_list_bar = $csrc_list; $graph_x_width = 800; $graph_y_width=500; }
else if($_SESSION['csrc_data_select']=='5'){ $csrc_list_bar = $csrc_list2; $graph_x_width = 750; $graph_y_width=500; }
else if($_SESSION['csrc_data_select']=='7'){ $csrc_list_bar = $csrc_list3; $graph_x_width = 500+$csrc_list_count*27.5; $graph_y_width=500; }
else{ $csrc_list_bar = $csrc_list; $graph_x_width = 500+$csrc_list_count*27.5; $graph_y_width=400; }

arsort($data_original);

foreach ($data_original as $data_index => $data_value) {
  $data_sort_index[] = $csrc_list_bar[$data_index];
  $data_sort_value[] = $data_value;
}

$data = $data_sort_value;

// Create the graph. These two calls are always required
$graph = new Graph($graph_x_width,$graph_y_width,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(0,$max1,2*$max1,3*$max1,4*$max1,5*$max1), array($max2,$max1+$max2,2*$max1+$max2,3*$max1+$max2,4*$max1+$max2));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
if($_SESSION['csrc_data_select']=='1'){ $graph->xaxis->SetFont(FF_CHINESE,FS_NORMAL,11); }
else{ $graph->xaxis->SetFont(FF_CHINESE,FS_NORMAL,12); }

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
$graph->title->Set("校安統計圖-".$class2);

// Display the graph
$graph->Stroke();
?>