<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>韩山师范学院</title>

<link  rel="stylesheet"  href="/hstces/Public/Css/admin.css"  type="text/css">
    <link  rel="stylesheet"  href="/hstces/Public/Css/bootstrap.css"  type="text/css">
    <link  rel="stylesheet"  href="/hstces/Public/Css/bootstrap_fix.css"  type="text/css">
    <link  rel="stylesheet"  href="/hstces/Public/Css/jquery-ui.min.css"  type="text/css">
    
    
    <script  type="text/javascript"  src="/hstces/Public/Js/jquery-1.8.3.min.js"></script>
    <script  type="text/javascript"  src="/hstces/Public/Js/Validform_v5.3.2_min.js"></script>
    <script  type="text/javascript"  src="/hstces/Public/Js/jquery-ui.min.js"></script>
    <script  type="text/javascript"  src="/hstces/Public/Js/jquery.cookie.js"></script>
    <script  type="text/javascript"  src="/hstces/Public/Js/jquery.ui.datepicker-zh-CN.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
.row-fluid>.span2 {
	width: 11%;
}

.row-fluid>.span10 {
	width: 86%;
}

::-webkit-scrollbar{
	width:0px;
}
html{
	over-flow:-moz-scrollbars-vertical;
}

</style>


<script type="text/javascript">
	$(function() {
		//记录上次菜单折叠状态
		var clickMenu = $.cookie('sMenu');
		if (clickMenu == null) {
			clickMenu = 1;
		}
		$('.main-menu .main-menu-tit').each(function(i) {
			if (i != clickMenu) {
				$(this).next().css('display', 'none');
			}
			$(this).click(function() {
				if ($(this).next().css('display') == 'none') {
					$('.main-menu .main-menu-tit').next().slideUp('fast');
					$(this).next().slideDown('fast');
					$.cookie('sMenu', i, {
						expires : 3600 * 24 * 30,
						path : '/'
					});
				} else {
					$(this).next().slideUp('fast');
				}
			});
		});
	});
</script>

</head>

<body>
<div id="wapper"> 
<div id="main-content1"> 
	<div id="header" class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<div>
					<a class="brand" href="<?php echo U('admin/index/index');?>">考试管理后台</a>
				</div>
				<div>
					<ul class="nav pull-right">
						<li id="navUserInfo"><a href="javascript:void(0);"
							style="color: white;">欢迎您:&nbsp;<i
								class="icon-user icon-white"></i><?php echo (session('admin_name')); ?>
						</a></li>
						<li class="divider-vertical" style="margin: 0;"></li>
						<li><a href="<?php echo U('Admin/Index/index');?>" style="color: white;">后台首页</a>
						</li>
						<li><a href="<?php echo U('Home/Index/index');?>" target="_blank"
							style="color: white;">网站首页</a></li>
						<li class="dropdown"><a href="<?php echo U('Admin/logout/index');?>"
							class="dropdown-toggle" data-toggle="dropdown"
							style="color: white;">退出</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="sideBar" class="span2">
  <ul class="nav nav-tabs nav-stacked" id="admin-menu-bar">
  	
      <li class="active main-menu">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-list-alt"></i> 产品管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Goods/index');?>" class="noborder">产品列表</a>
            <a href="<?php echo U('Goods/export');?>" class="noborder">导出产品</a>
            <a href="<?php echo U('Goods/import');?>" class="noborder">导入产品</a>
          </li> 
        </ul>
      </li>

      <li class="active main-menu">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-th-large"></i> 品牌管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Brand/index');?>" class="noborder">品牌列表</a>
          </li> 
        </ul>
      </li>
	  
      <li class="active main-menu">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-tags"></i> 类别管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Category/index');?>" class="noborder">类别列表</a>
          </li> 
        </ul>
      </li>
	  
      <li class="active main-menu">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-random"></i> 机型管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Type/index');?>" class="noborder">机型列表</a>
          </li> 
        </ul>
      </li>	  
	  
      <li class="active main-menu ">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-lock"></i>安全管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Password/edit');?>" class="noborder">修改用户名/密码</a>
          </li> 
        </ul>
      </li>	
	    	        
      <li class="active main-menu ">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-cog"></i>系统设置</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Config/base');?>" class="noborder">基本设置</a>
          </li> 
        </ul>
      </li>
	  
      
  </ul>
</div>

<!-- 主要内容 -->
<style>
#foot {
	position: fixed;
	_position: absolute;
	bottom: 0px;
	_bottom: 0px;
	left:40%;
	_margin-top: expression(this.style.pixelHeight + document.documentElement.scrollTop)
}
</style>
</div>
<!-- 页脚 -->
<!-- <div id="foot">2016 Hanshan Normal University. All RIGHTS
	RESERVED. [版权所有] 韩山师范学院</div>
</div> -->
<nav class="navbar navbar-default navbar-static-bottom">
  <div class="container" style="text-align: center;bottom: 100px">
    2016 Hanshan Normal University. All RIGHTS
	RESERVED. [版权所有] 韩山师范学院
  </div>
</nav>
<!-- 版权结束 -->
</body>
</html>