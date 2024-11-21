<?php require_once('Connections/conn_CSRC.php'); ?>
<?php require_once('statistics_graph_sql_new.php'); ?>
<?php
// content="text/plain; charset=utf-8"
require_once('jpgraph/jpgraph.php');
require_once('jpgraph/jpgraph_bar.php');


$title = array(
    "車\n禍",    "詐\n騙",    "運\n動\n受\n傷",    "意\n外\n傷\n害",    "意\n外\n死\n亡",     "火\n災", "意\n外\n．\n其\n他\n",
    "生\n病", "送\n醫", "協\n尋", "一\n般\n．\n其\n他\n",
    "物\n品\n尋\n獲", "遺\n失", "竊\n盜", "設\n備\n故\n障","財\n務\n．\n其\n他\n",
    "校\n外\n糾\n紛", "校\n內\n糾\n紛", "賃\n居\n糾\n紛","糾\n紛\n．\n其\n他\n",
    "墜\n落\n、\n滾\n落\n","跌\n倒\n","衝\n撞\n","物\n體\n飛\n落\n","物\n體\n倒\n塌\n、\n崩\n塌\n","被\n撞\n","被\n夾\n","被\n捲\n","被\n切\n、\n割\n、\n擦\n傷\n","踩\n踏\n","溺\n水\n","與\n高\n溫\n、\n低\n溫\n物\n體\n之\n接\n觸\n","與\n有\n害\n物\n之\n接\n觸\n","感\n電\n","爆\n炸\n","物\n體\n破\n裂\n","火\n災\n","不\n當\n動\n作\n","鐵\n公\n路\n交\n通\n事\n故\n","其\n他\n交\n通\n事\n故\n",
    "化\n學\n品\n洩\n漏\n","化\n學\n品\n火\n災\n、\n爆\n炸\n",
    "人\n員\n輻\n射\n誤\n照\n射\n","放\n射\n性\n物\n質\n洩\n漏\n","放\n射\n性\n物\n質\n遺\n失\n",
    "廢\n水\n異\n常\n排\n放\n","廢\n氣\n異\n常\n排\n放\n","廢\n棄\n物\n異\n常\n丟\n棄\n","噪\n音\n量\n異\n常\n",
    "情\n緒\n不\n穩", "自\n我\n傷\n害", "疑\n似\n性\n平", "其\n他"
);

$data_original =[];
for($i=1;$i<=53;$i++){
    array_push($data_original,$csrc_data_result[9][$i]);
}

arsort($data_original);
foreach ($data_original as $data_index => $data_value) {
    $data_sort_index[] = $title[$data_index];
    $data_sort_value[] = $data_value;
}

$data = array_slice($data_sort_value,0,10);

$max = 0;
for ($m = 1; $m <= 53; $m++) {
    $max = max($max, $csrc_data_result[9][$m]);
}
while ($max % 5 != 0) {
    $max++;
}
$max1 = $max / 5;
$max2 = $max1 / 2;

// Create the graph. These two calls are always required
$graph = new Graph(750, 650, 'auto');
$graph->SetScale("textlin");

$theme_class = new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(0, $max1, 2 * $max1, 3 * $max1, 4 * $max1, 5 * $max1), array($max2, $max1 + $max2, 2 * $max1 + $max2, 3 * $max1 + $max2, 4 * $max1 + $max2));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetFont(FF_CHINESE, FS_NORMAL, 12);
//$graph->xaxis->SetTickLabels(array($title[0],$title[1],$title[2],$title[3],$title[4],$title[5],$title[6],$title[7],$title[8],$title[9],$title[10],$title[11],$title[12],$title[13],$title[14],$title[15],$title[16],$title[17],$title[18],$title[19]));
$graph->xaxis->SetTickLabels(array_slice($data_sort_index,0,10));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false, false);
$graph->yaxis->SetLabelFormat('%d');

// Create the bar plots
$b1plot = new BarPlot($data);

// Create the grouped bar plot
//$gbplot = new GroupBarPlot(array($b1plot));
// ...and add it to the graPH
$graph->Add($b1plot);

$b1plot->value->Show();
$b1plot->value->SetFont(FF_ARIAL, FS_BOLD, 12);
$b1plot->value->SetFormat('%d');
$b1plot->SetColor("white");
$b1plot->SetFillColor("#cc1111");

$graph->title->SetFont(FF_CHINESE, FS_NORMAL, 14);
$graph->title->Set("校安統計圖-事件總計 Top10");

// Display the graph
$graph->Stroke();
?>