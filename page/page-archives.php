<?php 
/* 
Custom:page-archives
Description:文章归档
*/  
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container main-load">
    <article class="post_article archives" itemscope="" itemtype="https://schema.org/Article">
<?php
function displayRecord(){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	$output = '';
	foreach($record_cache as $value){
		$output .= '<h3>'.substr($value['date'],0,6).'</h3>'.displayRecordItem($value['date']).'';
	}
	return $output;
}
function displayRecordItem($record){
	if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
		$days = getMonthDayNum($match[2], $match[1]);
		$record_stime = strtotime($record . '01');
		$record_etime = $record_stime + 3600 * 24 * $days;
	} else {
		$record_stime = strtotime($record);
		$record_etime = $record_stime + 3600 * 24;
	}
	$sql = "and date>=$record_stime and date<$record_etime order by top desc ,date desc";

	$result = archiver_db($sql);
	return $result;
}
function archiver_db($condition = ''){
	$DB = Database::getInstance();
	$sql = "SELECT gid, title, date, views, sortid FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
	$result = $DB->query($sql);
	$output = '';
	while ($row = $DB->fetch_array($result)) {
      if ($row['sortid']== _g('album_sort')) continue;
		$log_url = Url::log($row['gid']);
		$output .= '<tr><td width="80" style="text-align:right;">'.date('m-d',$row['date']).'</td><td><a href="'.$log_url.'" rel="external" target="_blank">'.$row['title'].' - '.$row['gid'].'</a></td></tr>';
	}
	$output = empty($output) ? '<li>暂无文章</li>' : $output;
	$output = '<table>'.$output.'</table>';
	return $output;
}
?>
<?php
if($res['hide'] == 'y' || !function_exists('displayRecord')) emMsg('不存在的页面！');
$show_type == 'sort' ? $log_content .= displaySort() : $log_content .= displayRecord();
?>
	<?php echo $log_content; ?>

    </article>
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