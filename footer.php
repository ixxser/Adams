<?php
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<footer class="footer">
	<section class="container">
        <ul id="menu-bottom" class="menu">
        	<li id="menu-item" class="menu-item"><a href="<?php echo _g('footer_f1_url');?>"><?php echo _g('footer_f1_name');?></a></li>
			<li id="menu-item" class="menu-item"><a href="<?php echo _g('footer_f2_url');?>"><?php echo _g('footer_f2_name');?></a></li>
			<li id="menu-item" class="menu-item"><a href="<?php echo _g('footer_f3_url');?>"><?php echo _g('footer_f3_name');?></a></li>
			<li id="menu-item" class="menu-item"><a href="<?php echo _g('footer_f4_url');?>"><?php echo _g('footer_f4_name');?></a></li>
		</ul>
		<p>
            <span class='left'>&copy; 2018 <a href="<?php echo BLOG_URL;?>"><?php echo $blogname;?></a> . <?php echo $icp;?><?php echo $footer_info; ?></span>
            <span class='right'>Theme by <a href="https://xxser.cn" target="_blank">Adams</a></span>
        </p>
	</section>
</footer>

<div class="setting_tool iconfont">
    <a class="back2top" style="display:none;"><i class="czs-arrow-up-l"></i></a>
    <a class="sosearch"><i class="czs-search-l"></i></a>
    <a class="socolor"><i class="czs-clothes-l"></i></a>
    <div class="s">
        <form method="get" action="<?php echo BLOG_URL; ?>index.php" class="search">
            <input class="search-key" name="keyword" autocomplete="off" placeholder="输入关键词..." type="text" value="" required="required">
        </form>
    </div>
    <div class="c">
        <ul>
            <li class="color undefined">默认</li>
            <li class="color sepia">护眼</li>
            <li class="color night">夜晚</li>
            <li class="hr"></li>
            <li class="font serif">Serif</li>
            <li class="font sans">Sans</li>
        </ul>
    </div>
</div>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/theia-sticky-sidebar.js?ver=v1.2.9'></script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/ajax-comment.js?ver=v1.2.9'></script>
<?php doAction('index_footer'); ?>
<?php doAction('myhk_player'); ?>

<script data-no-instant>
    (function ($) {
        $.extend({
            adamsOverload: function () {
                $('.navigation:eq(0)').remove();
                $(".post_article a").attr("rel" , "external");
                $("a[rel='external'],a[rel='external nofollow']").attr("target","_blank");
                $("a.vi").attr("rel" , "");
                $.viewImage({
                    'target'  : '.post_article img',
                    'exclude' : '.readerswall img,.gallery img',
                    'delay'   : 300
                });
                $('pre').addClass('prettyprint').attr('style', 'overflow:auto');
                window.prettyPrint && prettyPrint();
            }
        });
    })(jQuery);
    InstantClick.on('change', function(isInitialLoad) {
        jQuery.adamsOverload();
        if (isInitialLoad === false) {
            // support MathJax
            if (typeof MathJax !== 'undefined') MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
            // support google code prettify
            if (typeof prettyPrint !== 'undefined') prettyPrint();
            // support 百度统计
            if (typeof _hmt !== 'undefined') _hmt.push(['_trackPageview', location.pathname + location.search]);
            // support google analytics
            if (typeof ga !== 'undefined') ga('send', 'pageview', location.pathname + location.search);
        }
    });
    InstantClick.on('wait', function() {
        // pjax href click
    });
    InstantClick.on('fetch', function() {
        // pjax begin
    });
    InstantClick.on('receive', function() {
        // pjax end
    });
    InstantClick.init('mousedown');
</script>
</body>
</html>
