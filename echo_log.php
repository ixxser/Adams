<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container main-load" style="poistion:relative">
    <article class="post_article" itemscope="" itemtype="https://schema.org/Article">
    	<?php echo $log_content; ?>
    </article>
    <?php doAction('log_related', $logData); ?>
    <nav class="nearbypost">
        <?php neighbor_log($neighborLog); ?>
    </nav>
</section>
<div id="log_memu">
</div>
<section class="comments">
<div class="container" data-no-instant="">

	<h3 id="comments">
<?php if(empty($comnum)): ?>
	既然没有吐槽，那就赶紧抢沙发吧！
<?php else: ?>
 <?php echo $comnum;?>条回应：“<?php echo $log_title;?>”
<?php endif; ?>
</h3>
<?php blog_comments($comments); ?>
<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
</div>
</section>
<?php
 include View::getView('footer');
?>