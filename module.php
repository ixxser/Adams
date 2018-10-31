<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
if (!function_exists('_g')) {
	emMsg('请先安装 <a href="https://www.emlog.net/plugin/144" target="_blank">模板设置插件</a>', BLOG_URL . 'admin/plugins.php');
}
?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul id="menu-header" class="menu">
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>

			<li id="menu-item" class="menu-item"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li id="menu-item" class="menu-item"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current_page_item' : '';
		?>
		<li id="menu-item-<?php echo $value['id'];?>" class="menu-item <?php echo $current_tab;?>">
			<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
    }
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '标签:';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog){?>
		<div class="alignleft"><a href="<?php echo Url::log($prevLog['gid']) ?>" rel="prev"><?php echo $prevLog['title'];?></a></div>
	<?php }else{?>
		<div class="alignleft"><span>已经没有文章啦~</span></div>
	<?php };?>

	<?php if($nextLog){?>
		 <div class="alignright"><a href="<?php echo Url::log($nextLog['gid']) ?>" rel="next"><?php echo $nextLog['title'];?></a></div>
	<?php }else{?>
		<div class="alignright"><span>已经没有文章啦~</span></div>
	<?php };?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
	
	<?php endif; ?>
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	$db=Database::getInstance();
	$sql = "SELECT date FROM ".DB_PREFIX."comment WHERE cid=".$cid;
	$result = $db->query($sql);
	while ($row = $db->fetch_array($result)) {
	?>

	<ol class="commentlist">
		<li class="comment even thread-even depth-1" id="comment-<?php echo $comment['cid']; ?>">
			<div id="div-comment-<?php echo $comment['cid']; ?>" class="comment-body">
			<div class="comment-author vcard">
				<?php if($isGravatar == 'y'): ?>
				<img alt="" src="<?php echo Gravatar($comment['mail'],40)?>" srcset="<?php echo Gravatar($comment['mail'],40)?>" class="avatar avatar-32 photo" height="32" width="32" originals="100" scale="1.25">
				<?php endif;?>
				<cite class="fn"><?php echo $comment['poster']; ?></cite>
				<span class="says">说道：</span>
			</div>
		<div class="comment-meta commentmetadata">
			<a href="#comment-<?php echo $comment['cid']; ?>"><?php echo diyTime($row['date']); ?></a>
		</div>

		<p><?php echo $comment['content'];?></p>
		<div class="reply">
			<a rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="return addComment.moveForm( &quot;div-comment-<?php echo $comment['cid']; ?>&quot;, &quot;<?php echo $comment['cid']; ?>&quot;, &quot;respond&quot;, &quot;<?php echo $comment['gid']; ?>&quot; ),commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
		</div>
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
		</li><!-- #comment-## -->
	</ol>

	<?php } endforeach; ?>
    <div id="pagenavi">
	    <?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
    $db=Database::getInstance();
	$sql = "SELECT date FROM ".DB_PREFIX."comment WHERE cid=".$comment['cid'];
	$result = $db->query($sql);
	while ($row = $db->fetch_array($result)) {
	?>

	<ul class="children">
		<li class="comment byuser comment-author-admin bypostauthor even depth-2" id="comment-<?php echo $comment['cid']; ?>">
				<div id="div-comment-<?php echo $comment['cid']; ?>" class="comment-body">
				<div class="comment-author vcard">
				<?php if($isGravatar == 'y'): ?>
				<img alt="" src="<?php echo Gravatar($comment['mail'],40)?>" srcset="<?php echo Gravatar($comment['mail'],40)?>" class="avatar avatar-32 photo" height="32" width="32" originals="100" scale="1.25">
				<?php endif;?>
				<cite class="fn">
					<?php echo $comment['poster']; ?>
				</cite>
					<span class="says">说道：</span>
				</div>
		
		<div class="comment-meta commentmetadata">
			<a href="#comment-<?php echo $comment['cid']; ?>"><?php echo diyTime($row['date']); ?></a>	
		</div>

		<p><?php echo $comment['content'];?></p>
		<div class="reply">
			<a rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="return addComment.moveForm( &quot;div-comment-<?php echo $comment['cid']; ?>&quot;, &quot;<?php echo $comment['cid']; ?>&quot;, &quot;respond&quot;, &quot;<?php echo $comment['gid']; ?>&quot; ),commentReply(<?php echo $comment['cid']; ?>,this)" aria-label="回复给谁">回复</a>
		</div>
	</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	</li><!-- #comment-## -->
</ul>

	<?php } endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>

	<div id="respond" class="comment-respond">
		<h3 id="reply-title" class="comment-reply-title">发表评论 <small><a rel="nofollow" id="cancel-comment-reply-link" href="<?php echo $logid; ?>#respond" style="display:none;">取消回复</a></small></h3>

		<form action="<?php echo BLOG_URL; ?>index.php?action=addcom" method="post" id="commentform" class="comment-form">
		<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
		<?php if(ROLE == ROLE_VISITOR): ?>
			<p class="comment-notes">
				<span id="email-notes">电子邮件地址不会被公开。</span> 必填项已用<span class="required">*</span>标注
			</p>
			<p class="comment-form-author">
				<label for="author">姓名 <span class="required">*</span></label>
				<input id="author" name="comname" type="text" value="<?php echo $ckname; ?>" size="30" maxlength="245" required="required">
			</p>
			<p class="comment-form-email">
				<label for="email">电子邮件 <span class="required">*</span></label>
				<input id="email" name="commail" type="text" value="<?php echo $ckmail; ?>" size="30" maxlength="100" aria-describedby="email-notes" required="required">
			</p>
			<p class="comment-form-url">
				<label for="url">站点</label>
				<input id="url" name="comurl" type="text" value="<?php echo $ckurl; ?>" size="30" maxlength="200">
			</p>
			<?php else: ?>
		        <p for="comment">以<a href="<?php echo BLOG_URL; ?>admin/blogger.php">admin</a>登录。 <a class="no-ajax" href="./admin/?action=logout">登出 »</a></p>
			<?php endif; ?>
			<p class="comment-form-comment">
				<label for="comment">评论</label>
				<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>
			</p>

			<div id="loading" style="display: none;">COMMITING...</div>
			<div id="error" style="display: none;">#</div><p></p>
			<div style="display:none;" id="smilies"></div>
			<p class="form-submit">
			<?php echo $verifyCode; ?>
				<input name="submit" type="submit" id="submit" class="submit" value="发表评论">
				<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
				<input type="hidden" name="comment_parent" id="comment_parent" value="0">
			</p>
		</form>
	</div>
</div>
	<?php endif; ?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>
<?php
//获取微语的第一条文字内容
function getonetwitter(){
$db = Database::getInstance();
$sql = "SELECT * FROM ".DB_PREFIX."twitter ORDER BY date DESC LIMIT 0,1";
//die($sql);
$twitter = $db->query($sql);
$row = $db->fetch_array($twitter);
    return $row['content'];
}
?>
<?php
function diyTime($targetTime)
{
    // 今天最大时间
    $todayLast   = strtotime(date('Y-m-d 23:59:59'));
    $agoTimeTrue = time() - $targetTime;
    $agoTime     = $todayLast - $targetTime;
    $agoDay      = floor($agoTime / 86400);

    if ($agoTimeTrue < 60) {
        $result = '刚刚';
    } elseif ($agoTimeTrue < 3600) {
        $result = (ceil($agoTimeTrue / 60)) . '分钟前';
    } elseif ($agoTimeTrue < 3600 * 12) {
        $result = (ceil($agoTimeTrue / 3600)) . '小时前';
    } elseif ($agoDay == 0) {
        $result = '今天 ' . date('H:i', $targetTime);
    } elseif ($agoDay == 1) {
        $result = '昨天 ' . date('H:i', $targetTime);
    } elseif ($agoDay == 2) {
        $result = '前天 ' . date('H:i', $targetTime);
    } elseif ($agoDay > 2 && $agoDay < 30) {
        $result = $agoDay . '天前 ';
    } elseif ($agoDay > 30 && $agoDay < 365) {
        $result = round($agoDay / 30) . '个月前 ';
    } elseif ($agoDay >= 365) {
        $result = round($agoDay / 365) . '年前 ';
    } else {
        $format = date('Y') != date('Y', $targetTime) ? "Y-m-d H:i" : "m-d H:i";
        $result = date($format, $targetTime);
    }
    return $result;
}?>
<?php
//分页函数
function diyPageUrl($count, $perlogs, $page, $url, $anchor = '')
{
    $pnums = @ceil($count / $perlogs);
    $page = @min($pnums, $page);
    $prepg = $page - 1;
    //上一页
    $nextpg = $page == $pnums ? 0 : $page + 1;
    //下一页
    $urlHome = preg_replace("|[\\?&/][^\\./\\?&=]*page[=/\\-]|", "", $url);
    //开始分页导航内容
    $re = "";
    if ($pnums <= 1) {
        return false;
    }
    //如果只有一页则跳出
    if ($prepg) {
        $re .= " <a class=\"page-numbers\" href=\"{$url}{$prepg}{$anchor}\" title=\"上一页\">&laquo;</a> ";
    }
    for ($i = $page - 2; $i <= $page + 2 && $i <= $pnums; $i++) {
        if ($i > 0) {
            if ($i == $page) {
                $re .= " <span class=\"page-numbers\">{$i}</span> ";
            } elseif ($i == 1) {
                $re .= " <a class=\"page-numbers\" href=\"{$urlHome}{$anchor}\">{$i}</a> ";
            } else {
                $re .= " <a class=\"page-numbers\" href=\"{$url}{$i}{$anchor}\">{$i}</a> ";
            }
        }
    }
    if ($nextpg) {
        $re .= " <a class=\"page-numbers\" href=\"{$url}{$nextpg}{$anchor}\" title=\"下一页\">&raquo;</a> ";
    }
    return $re;
}
?>
<?php
//avatar缓存
function Gravatar($email, $s = 50, $d = 'wavatar', $r = 'g') {
	$f = md5($email);
	$a = TEMPLATE_URL.'/images/gravatar/'.$f.'.jpg';
	$e = EMLOG_ROOT.'/content/templates/Adams/images/gravatar/'.$f.'.jpg';
	$t = 1296000;
	if (!is_file($e) || (time() - filemtime($e)) > $t ) {
	$g = sprintf("http://en.gravatar.com",
	(hexdec($f{0})%2)).'/avatar/'.$f.'?s='.$s.'&d='.$d.'&r='.$r;
	copy($g,$e); $a=$g;
    }
	if (filesize($e) < 500) copy($d,$e);
	return $a;
}?>
<?php
function diyPage($logid){
	$db=MySql::getInstance();
	$page=mysql_fetch_array(mysql_query("SELECT * FROM ".DB_PREFIX."blog WHERE type='page'"));
	$prevPage = mysql_fetch_array(mysql_query("SELECT * FROM ".DB_PREFIX."blog where gid = (select max(gid) from emlog_blog where gid < {$logid} and type='page')"));
	$nextPage = mysql_fetch_array(mysql_query("SELECT * FROM ".DB_PREFIX."blog where gid = (select max(gid) from emlog_blog where gid > {$logid} and type='page')"));
	?>
	<?php if($prevPage){?>
	<div class="alignleft"><a href="<?php echo Url::log($prevPage['gid']) ?>" rel="prev"><?php echo $prevPage['title'];?></a></div>
	<?php }else{?>
		<div class="alignleft"><span>已经没有页面啦~</span></div>
	<?php };?>
	
	<?php if($nextPage){?>
		 <div class="alignright"><a href="<?php echo Url::log($nextPage['gid']) ?>" rel="next"><?php echo $nextPage['title'];?></a></div>
	<?php }else{?>
		<div class="alignright"><span>已经没有页面啦~</span></div>
	<?php };?>
<?php };?>
<?php //点赞
function dotGood(){
	$DB = Database::getInstance();
	if($DB->num_rows($DB->query("show columns from ".DB_PREFIX."blog like 'likes'")) == 0){
		$sql = "ALTER TABLE ".DB_PREFIX."blog ADD likes int unsigned NOT NULL DEFAULT '0'";
		$DB->query($sql);
	}
}
dotGood();
function update($logid){
	$logid = intval($_POST['id']);
	$DB = Database::getInstance();
	$DB->query("UPDATE " . DB_PREFIX . "blog SET likes=likes+1 WHERE gid=$logid");
	setcookie('likespd_'. $logid, 'true', time() + 31536000);
}
function lemoninit() {
	if( @$_POST['plugin'] == 'likespd' &&@$_POST['action'] == 'likes' &&isset($_POST['id'])){
		$id = intval($_POST['id']);
		header("Access-Control-Allow-Origin: *");
		update($id);echo getnum($id);die;
	}
}
lemoninit();
function getnum($id){
	static $arr = array();
	$DB = Database::getInstance();
	if(isset($arr[$logid])) return $arr[$logid];
	$sql = "SELECT likes FROM " . DB_PREFIX . "blog WHERE gid=$id";
	$res = $DB->query($sql);
	$row = $DB->fetch_array($res);
	$arr[$id] = intval($row['likes']);
	return $arr[$id];
}
?>
<?php
//blog：自定义分页函数
function comPage($count, $perlogs, $page, $url, $anchor = '')
{
    $pnums = @ceil($count / $perlogs);
    $re = '';
    $urlHome = preg_replace("|[?&/][^./?&=]*page[=/-]|", "", $url);
    if ($page > 1) {
        $i = $page - 1;
        $re = ' <a href="' . $url . $i . '" rel="nofollow" rel="nofollow" rel="nofollow" rel="nofollow">上页</a> ' . $re;
    }
    if ($page < $pnums) {
        $i = $page + 1;
        $re .= ' <a href="' . $url . $i . '" rel="nofollow" rel="nofollow" rel="nofollow" rel="nofollow">下页</a> ';
    }
    return $re;
}?>
<?php
//获取文章中第一张图片，如果没有就调用随机图片
function imgsrc($str)
{
    preg_match_all("/\\<img.*?src\\=\"(.*?)\"[^>]*>/i", $str, $match);
    if (!empty($match[1])) {
        echo $match[1][0];
    }
}
?>
<?php
function is_mobile() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $mobile_browser = Array(
        "mqqbrowser", //手机QQ浏览器
        "opera mobi", //手机opera
        "juc","iuc",//uc浏览器
        "fennec","ios","applewebKit/420","applewebkit/525","applewebkit/532","ipad","iphone","ipaq","ipod",
        "iemobile", "windows ce",//windows phone
        "240x320","480x640","acer","android","anywhereyougo.com","asus","audio","blackberry","blazer","coolpad" ,"dopod", "etouch", "hitachi","htc","huawei", "jbrowser", "lenovo","lg","lg-","lge-","lge", "mobi","moto","nokia","phone","samsung","sony","symbian","tablet","tianyu","wap","xda","xde","zte"
    );
    $is_mobile = false;
    foreach ($mobile_browser as $device) {
        if (stristr($user_agent, $device)) {
            $is_mobile = true;
            break;
        }
    }
    return $is_mobile;
}
?>