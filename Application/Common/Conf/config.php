<?php
return array(
		'DB_TYPE' 				=> 'mysql',
		'DB_HOST' 				=> 'localhost',
		'DB_NAME'				=> 'hstces',
		'DB_USER' 				=> 'root',
		'DB_PWD' 				=> '417708459',//数据库密码
		'DB_PORT'				=> '3306', // 端口号
		'DB_PREFIX' 			=> '', // 表前缀
		'SHOW_PAGE_TRACE'		=> true,
		'URL_CASE_INSENSITIVE'	=> true,//url不区分大小写
		'URL_MODEL'				=> 2, //设置为rewrite模式，用来隐藏index.php
		'TMPL_PARSE_STRING'     => array (
				'CSS' 			=> __ROOT__ . '/Public/Css',		//放CCS文件
				'JS' 			=> __ROOT__ . '/Public/Js',			//放JS文件 
				'IMG' 			=> __ROOT__ . '/Public/Images',		//放图片		
		),
);