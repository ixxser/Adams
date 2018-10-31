<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="posts main-load">
    <div class="container">
        <div class="post-list">
        <?php doAction('index_loglist_top'); ?>
        
        <?php
		if (!empty($logs)):
		foreach($logs as $value): if ($value['sortid']== _g('album_sort')) continue;
		$db=Database::getInstance();
		$sql="SELECT date FROM ".DB_PREFIX."blog WHERE gid=".$value['gid'];
        $result = $db->query($sql);
        while ($row = $db->fetch_array($result)) {
		?>
            <article class="meta" itemscope="" itemtype="http://schema.org/BlogPosting">
                <header>
                    <a href="<?php echo $value['log_url']; ?>" itemprop="url"><h2 itemprop="name headline"><?php echo $value['log_title']; ?></h2></a>
                </header>
                <main>
                    <p itemprop="articleBody">
                    	<?php echo subString(strip_tags($value['log_description']),0,140,"..."); ?>
                    </p>
                </main>
                <footer>
                    <span class="time"><?php echo diyTime($row['date']);?>发布</span>
                    <span class="hr"></span>
                    <span class="comments"><?php echo $value['comnum']; ?> 条评论</span>
                    <!-- <span class="comments"><?php echo $value['views']; ?> Views</span> -->
                    <span class="hr"></span><span class="likes"><?php echo getnum($value['logid']);?> 人喜欢</span>
                </footer>
            </article>
            <?php
            }
			endforeach;
			else:
			?>
	<h3 class="searchNo">未找到</h3>
	<p>抱歉，没有符合您查询条件的结果。</p>
	<?php endif;?>
                <nav class="reade_more">
                   	<?php echo diyPageUrl($lognum,$index_lognum,$page,$pageurl);?>
                </nav>
            </div>
        </div>
    </section>
<?php
 include View::getView('footer');
?>