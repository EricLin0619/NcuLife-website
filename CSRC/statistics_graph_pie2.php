<?php require_once('Connections/conn_CSRC.php'); ?>
<?php require_once('statistics_graph_sql.php'); ?>
<?php
// content="text/plain; charset=utf-8"

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');

$csrc_list = array("其他","文學院","理學院","工學院","管理學院","資電學院","地科學院","客家學院","生醫理工學院");

// Some data
$data_original=array ($csrc_data_result[0][0],$csrc_data_result[1][0],$csrc_data_result[2][0],$csrc_data_result[3][0],$csrc_data_result[4][0],$csrc_data_result[5][0],$csrc_data_result[6][0],$csrc_data_result[7][0],$csrc_data_result[8][0]);

arsort($data_original);

foreach ($data_original as $data_index => $data_value) {
  $data_sort_index[] = $csrc_list[$data_index];
  $data_sort_value[] = $data_value;
}

$data = $data_sort_value;

// Create the Pie Graph. 
$graph = new PieGraph(600,475,'auto');

$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// Set A title for the plot
$graph->title->SetFont(FF_CHINESE,FS_NORMAL,14);
$graph->title->Set("校安統計圖-學院總計");
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

for($m=0;$m<8;$m++) { $P2_Legends[$m] = $data_sort_index[$m].' (%d)'; }

$p2->SetLegends($P2_Legends);
$p2->ShowBorder();
$p2->SetColor('black');
$p2->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3','#FF7F00','#8B3E2F','#68228B','#2523D7','#440000','#003300','#444444'));


$graph->Stroke();

?>