<?php
/*@support tpl_options*/

// Adams主题设置面板

!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(

	'header_icon' => array(
		'type' => 'text',
		'name' => '头部右侧导航图标',
		'values' => array(
			'czs-rss,czs-github-logo,czs-weibo',
		),
		'description' => '每个图标属性以英文逗号隔开,图标大全查看:<a href="http://chuangzaoshi.com/icon/">草莓图标库</a>',
	),
	'random_music' => array(
		'type' => 'radio',
		'name' => '网易云歌单随机选择',
		'description' => '多个网易云歌单随机选择播放,每个歌单id由逗号隔开,如果没开启默认播放第一个歌单',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),	
  
	'music_id' => array(
		'type' => 'text',
		'name' => '网易云歌单id',
		'values' => array(
			'2329097266',
		),
	),

	'header_f1_url' => array(
		'type' => 'text',
		'name' => '头部右侧导航网址一',
		'values' => array(
			'http://xxser.cn',
		),
	),
	'header_f2_url' => array(
		'type' => 'text',
		'name' => '头部右侧导航网址二',
		'values' => array(
			'http://xxser.cn',
		),
	),
	'header_f3_url' => array(
		'type' => 'text',
		'name' => '头部右侧导航网址三',
		'values' => array(
			'http://xxser.cn',
		),
	),

	'album_sort' => array(
		'type' => 'text',
		'name' => '相册分类ID',
		'values' => array(
			'2',
		),
		'description' => '请输入要展示相册对应的分类ID',
	),

	'footer_f1_name' => array(
		'type' => 'text',
		'name' => '底部导航一名称',
		'values' => array(
			'关于博主',
		),
	),
	'footer_f1_url' => array(
		'type' => 'text',
		'name' => '底部导航一链接网址',
		'values' => array(
			'http://xxser.cn',
		),
	),
	'footer_f2_name' => array(
		'type' => 'text',
		'name' => '底部导航二名称',
		'values' => array(
			'友情链接',
		),
	),
	'footer_f2_url' => array(
		'type' => 'text',
		'name' => '底部导航二链接网址',
		'values' => array(
			'http://xxser.cn',
		),
	),
	'footer_f3_name' => array(
		'type' => 'text',
		'name' => '底部导航三名称',
		'values' => array(
			'文章归档',
		),
	),
	'footer_f3_url' => array(
		'type' => 'text',
		'name' => '底部导航三链接网址',
		'values' => array(
			'http://xxser.cn',
		),
	),
	'footer_f4_name' => array(
		'type' => 'text',
		'name' => '底部导航四名称',
		'values' => array(
			'音乐歌单',
		),
	),
	'footer_f4_url' => array(
		'type' => 'text',
		'name' => '底部导航四链接网址',
		'values' => array(
			'http://xxser.cn',
		),
	),

	'x_alipay' => array(
	    'type' => 'image',
        'name' => '支付宝收款二维码',
        'values' => array(
            TEMPLATE_URL . 'images/c_alipay.png',
        ),
		'description' => '阅读页支付宝打赏收款二维码',
	),
	'x_wechat' => array(
	    'type' => 'image',
        'name' => '微信收款二维码',
        'values' => array(
            TEMPLATE_URL . 'images/c_wxpay.png',
        ),
		'description' => '阅读页微信打赏收款二维码',
	),

);