<?php 
/* 
Custom:page-reader
Description:榜上有名
*/  
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container main-load">
    <article class="post_article" itemscope="" itemtype="https://schema.org/Article">
    	<?php echo $log_content; ?>
      <?php
global $CACHE;$user_cache = $CACHE->readCache('user');$name = $user_cache[1]['name'];
$DB = MySql :: getInstance();
$sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date >0 and poster !='". $name ."' and  poster !='匿名' and hide ='n' group by poster order by comment_nums DESC limit 0,280";
$result = $DB -> query( $sql );
$x=1; 
while( $row = $DB -> fetch_array( $result ) )
if ($x<=1) {
{
$img = "";
 if( $row[ 'url' ] )
{$tmp = "<a target=\"_blank\" href=\"". $row[ 'url' ] ."\" title=\"".$row[ 'poster' ]." - 共有 ". $row[ 'comment_nums' ] ." 条评论\"><img alt='' src=".getGravatar( $row[ 'mail' ]) ." class=\"avatar avatar-36 photo\" height=\"36\" width=\"36\" /></a>";
}
else
{$tmp = $img;}
$output .= $tmp;
$x++;
}
}elseif($x<=2){
$img = "";
 if( $row[ 'url' ] )
{$tmp = "<a target=\"_blank\" href=\"". $row[ 'url' ] ."\" title=\"".$row[ 'poster' ]." - 共有 ". $row[ 'comment_nums' ] ." 条评论\"><img alt='' src=".getGravatar( $row[ 'mail' ]) ." class=\"avatar avatar-36 photo\" height=\"36\" width=\"36\" /></a>";
}
else
{$tmp = $img;}
$output .= $tmp;
$x++;
}elseif($x<=3){
$img = "";
 if( $row[ 'url' ] )
{$tmp = "<a target=\"_blank\" href=\"". $row[ 'url' ] ."\" title=\"".$row[ 'poster' ]." - 共有 ". $row[ 'comment_nums' ] ." 条评论\"><img alt='' src=".getGravatar( $row[ 'mail' ]) ." class=\"avatar avatar-36 photo\" height=\"36\" width=\"36\" /></a>";
}
else
{$tmp = $img;}
$output .= $tmp;
$x++;
}elseif($x>=4){
$img = "";
 if( $row[ 'url' ] )
{$tmp = "<a target=\"_blank\" href=\"". $row[ 'url' ] ."\" title=\"".$row[ 'poster' ]." - 共有 ". $row[ 'comment_nums' ] ." 条评论\"><img alt='' src=".getGravatar( $row[ 'mail' ]) ." class=\"avatar avatar-36 photo\" height=\"36\" width=\"36\" /></a>";
}
else
{$tmp = $img;}
$output .= $tmp;
$x++;
}
$output = '<div class="readers">'.$output;
echo $output ;
 ?>
<style>
.container:before,.container:after{display:table;content:"";line-height:0}
.container:after{clear:both}
.readers avatar {
    width: 100%;
    height: auto;
    margin-bottom: 15px;
    margin-left: -5px;
    box-shadow: 10px 10px 20px -15px rgba(0,0,0,.3),-10px 10px 20px -15px rgba(0,0,0,.3);
    box-shadow: 0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12),0 2px 4px -1px rgba(0,0,0,.2)!important;}
.readers a{width: 72px;margin: 0 5px 25px 5px;float:left;text-align: center;color: #999;font-size: 12px;height: 65px;text-decoration: none;}
.readers a:hover{color: #FF5E52;}
.readers .avatar{
  	float: none;
  	position: relative;
  	border-radius: 100%;
    margin-left: 0px;
    border: 3px solid #F2F5F7;
    width: 62px;
    height: 62px;}</style>
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
