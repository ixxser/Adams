<?php 
/* 
Custom:page-links
Description:友情链接
*/  
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container main-load">
    <article class="post_article" itemscope="" itemtype="https://schema.org/Article">
    	<ul class="links">
    	<?php 
		global $CACHE;
		$link_cache = $CACHE->readCache('link');
		foreach($link_cache as $value): ?>
		<li><a href="<?php echo $value['url']; ?>" target="_blank" rel="external" title="<?php echo $value['des']; ?>"><?php echo $value['link']; ?></a><div class="bg" style="background-image:url(https://api.asilu.com/favicon/?host=<?php echo $value['url']; ?>)"></div></li>
		<?php endforeach; ?>
		</ul>
      <?php echo $log_content; ?>
    </article>
    <nav class="nearbypost">
	<?php diyPage($logid);?>
    </nav>
</section>
<section class="comments">
<div class="container" data-no-instant="">
<?php blog_comments($comments); ?>
<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
</div>
</section>
<?php
 include View::getView('footer');
?>