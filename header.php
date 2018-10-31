<?php
/*
Template Name:Adams
Description:极简、轻量化的设计风格,适用于个人技术博客!
Version:1.2.1
Author:xxser
Author Url:http://www.xxser.cn
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>images/favicon.ico" type="image/x-icon" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link href="<?php echo TEMPLATE_URL; ?>style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo TEMPLATE_URL; ?>static/caomei1.2.8/style.css?v1.2.9" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="//cdn.staticfile.org/jquery/3.1.1/jquery.min.js?ver=v1.2.9"></script>
<script type="text/javascript" src="//cdn.staticfile.org/prettify/r298/prettify.js?ver=v1.2.9"></script>
<script type="text/javascript" src="//cdn.staticfile.org/instantclick/3.0.1/instantclick.min.js?ver=v1.2.9"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>static/script.js?ver=v1.2.9"></script>
<script>var js ={url:'http://www.emlog.com/',theme:'<?php echo TEMPLATE_URL; ?>',};</script>
<?php doAction('index_head'); ?>
  <style>#wenkmPlayer .player .musicbottom .volumecontrol .volume{margin-top:5px}</style>
</head>
<body>
<header class="header">
    <section class="container">
        <hgroup itemscope="" itemtype="https://schema.org/EMHeader">
            <h1 class="fullname">
            	<?php
            	if($logid){
            		echo $log_title;
            	}else{
            		echo $blogname;
            	}
            	?>
            </h1>
        </hgroup>
        <?php 
        $hdico = _g('header_icon');
        $hdarr = explode(',',$hdico);
        ?>

        <nav class="social">
        	<ul id="menu-socialx" class="menu">
	        	<li id="menu-item" class="<?php echo $hdarr[0];?> menu-item"><a target="_blank" href="<?php echo _g('header_f1_url');?>"></a></li>
				<li id="menu-item" class="<?php echo $hdarr[1];?> menu-item"><a target="_blank" href="<?php echo _g('header_f2_url');?>"></a></li>
				<li id="menu-item" class="<?php echo $hdarr[2];?> menu-item"><a target="_blank" href="<?php echo _g('header_f3_url');?>"></a></li>
			</ul>
		</nav>
		<nav class="header_nav">
			<?php blog_navi();?>
		</nav>    
</section>
    
    <section class="infos">
        <div class="container">
            <h2 class="fixed-title">
            	<?php
            	if($logid){
            		echo $log_title;
            	}else{
            		echo $blogname;
            	}
            	?>
            </h2>
            <?php if(!$logid){?>
            <div class="fixed-menus">
            	<?php blog_navi();?>
			</div>
			<?php }?>
			<?php if($logid){?>
			<?php 
			$db = Database::getInstance();
			$sql = "SELECT date FROM ".DB_PREFIX."blog WHERE gid=".$logid;
            $result = $db->query($sql);
            while ($row = $db->fetch_array($result)) {
			?>
			<div class="fields">
                <span><i class="czs-time-l"></i> <time datetime="<?php echo gmdate('Y-n-j', $date); ?>" itemprop="datePublished" pubdate=""><?php echo diyTime($row['date']);?></time></span> / 
                <span><i class="czs-talk-l"></i> <?php echo $comnum; ?> 评</span> / 
                <a href="javascript:;" data-action="topTop" data-id="<?php echo $logid;?>" class="likespd <?php if(isset($_COOKIE["likespd_$logid"])){echo 'done';}?>" data-likespd="<?php echo $logData['logid'];?>">
                    <i class="czs-thumbs-up-l"></i><i class="czs-thumbs-up"></i>
                    <span class="count"><font><?php echo(isset($logData['likes'])?$logData['likes']:getnum($logData['logid']));?></font></span> 赞
                </a>
            </div>
            
            <div class="socials">
                <div class="donate">
                    <a href="javascript:;"><i class="czs-coin-l s"></i><i class="czs-coin h"></i> 赏</a>
                    <div class="window">
                        <ul>
                            <li class="alipay"><img src="<?php echo _g('x_alipay');?>" scale="0" width="65"></li>
                            <li><img src="<?php echo _g('x_wechat');?>" scale="0" width="65"></li>
                        </ul>
                    </div>
                </div>
                <div class="share">
                    <a href="javascript:;" data-qrcode="//api.qrserver.com/v1/create-qr-code/?size=150x150&amp;margin=10&amp;data=<?php echo Url::log($logid);?>"><i class="czs-scan-l s"></i><i class="czs-qrcode-l h"></i> 码</a>
                </div>
            </div>
            <?php }}else{?>
            <div class="placard">
            	<?php echo getonetwitter();?>
            </div>
            <?php }?>
        </div>
    </section>
</header>