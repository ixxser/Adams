<?php 
/**
 * 相册模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<style>
.imgList .reade_more{text-align:center;margin:12% 0}
.imgList .reade_more a,.imgList .reade_more .page-numbers{box-shadow:0 0 0 1px rgba(0,0,0,.1) inset;background:#F5F7FA;padding:10px 5%;border-radius:20px;transition:.3s;}
.imgList .reade_more a:hover,.imgList .reade_more span.page-numbers{background:#3274ff;color:#fff;padding:10px 10%;}
.imgList .reade_more .page-numbers,.imgList .reade_more .page-numbers:hover,.imgList .reade_more span.page-numbers{display:inline-block;border-radius:2px;padding:0;background:#fff;margin:0 .6%;padding:1% 2.6%;}
.imgList .reade_more .page-numbers:hover,.imgList .reade_more span.page-numbers{background:#3274ff;}
</style>
<section class="posts main-load">
    <div class="container">
        <div class="imgList">
            <?php
            $id = _g('album_sort');
            $db = Database::getInstance();
            $sql = "SELECT * FROM ".DB_PREFIX."blog WHERE sortid=$id and hide='n' ORDER BY 'date' DESC";
            $list = $db->query($sql);
            while($row = $db->fetch_array($list)){ 
            ?>

            <div class="imgShow">
            <a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title'];?>">
                <img src="<?php imgsrc($row['content']); ?>" alt="" width="210px" height="215px">
                <div class="mask transition3"><?php echo $row['title']?></div>
            </a>
            </div>
            <?php }?>
    <?php if($row = ''):?>
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