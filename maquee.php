<!-- jQuery (Bootstrap 所有外掛均需要使用) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- 依需要參考已編譯外掛版本（如下），或各自獨立的外掛版本 -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/slider.js"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        setInterval('AutoScroll("#scrollDiv_T")', 5000);

        $(".p_a").hover(function() {
            $(this).addClass("p_a_hover");
            $(this).find("a").addClass("a_hover");
        }, function() {
            $(this).removeClass("p_a_hover");
            $(this).find("a").removeClass("a_hover");
        });
    });

    function AutoScroll(obj) {
        $(obj).find("dl:first").animate({
            marginTop: "-50px"
        }, 1000, function() {
            $(this).css({
                marginTop: "0px"
            }).find("dt:first").appendTo(this);
        });
    }

</script>

<div id="scrollDiv_T">
    <dl>
        <dt>
            <a href="http://www.nfa.gov.tw/main/Unit.aspx?ID=&MenuID=513&ListID=349" 
               title="瓦斯熱水器使用安全須知">提醒各位同學使用瓦斯熱水器，須注意室內保持空氣流通</a>
        </dt>
        <dt>
            <a href="http://military.ncu.edu.tw/CSRC/fraud.php" 
               title="校園安全公告：預防詐騙資訊">預防七大熱門詐騙請參閱校園安全公告</a>
        </dt>
        <!--
        <dt>
            <a href="" title="槍砲彈藥刀械管制條例修法說明"><<槍砲彈藥刀械管制條例>>修法通過囉!修法後操作槍將全面納管。</a>
        </dt>
        <dt>
            <a href="" title="操作槍報備說明">如果手上還有操作槍，請於109年6月12日至12月11日帶著操作槍及身分證明文件</a>
        </dt>
        <dt>
            <a href="" title="操作槍報備期限說明">到戶籍地的警察局或警察分局辦理報備持有逾期最高將面臨20萬元罰緩。</a>
        </dt>
        -->
    </dl>
</div>
