<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>


<section class="container main-load">
    <ul>
    <?php
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    $db=Database::getInstance();
    $sql="SELECT date FROM ".DB_PREFIX."twitter WHERE id=".$val['id'];
    $result = $db->query($sql);
    while ($row = $db->fetch_array($result)) {
    ?> 

        <li class="wy_list">
            <div class="yan_box">
                <div class="yan_to">-「 <?php echo diyTime($row['date']);?> 」</div>
                <div class="yan_center">
                    <p><?php echo $val['t'].$img;?></p>
                </div>
            </div>
        </li>
        <?php }endforeach;?>
    </ul>
<nav class="wy_page" style="text-align: center;margin:30px 0;">
    <?php echo $pageurl;?>
</nav>
</section>
<?php
 include View::getView('footer');
?>