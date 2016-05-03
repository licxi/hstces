<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<title>后台登录</title>
<link rel="stylesheet" href="/hstcesys/Public/Css/login.css">
</head>
<body onkeydown="input_enter()">
	<div id="login">
		<div class="warp">
			<div class="content">
				<h1></h1>
				<form action="" method="post" name="login_main" id="login_main">
					<div class="item">
						<div class="input">
							<div class="icon" title="用户名"></div>
							<input value="" tabindex="1" id="admin_name" type="text"
								name="admin_name" />
						</div>
						<label>用户名：</label>
					</div>
					<div class="item">
						<div class="input">
							<div class="icon2" title="密码"></div>
							<input value="" tabindex="2" id="admin_password" type="password"
								name="admin_password" />
						</div>
						<label>密码：</label>
					</div>
					<input type="button" value="" class="submit" onclick="do_submit()" />
				</form>
				<p class="copyright">2016 Hanshan Normal University. All RIGHTS RESERVED. [版权所有] 韩山师范学院</p>
			</div>
		</div>
	</div>
	
	<script type='text/javascript'>
	function input_enter(){
		if(window.event.keyCode == 13){
  			do_submit();
   		}
	}

	function do_submit(){
		var admin_name = $("#admin_name").val();
				var admin_password = $("#admin_password").val();
				if (admin_password == "" || admin_name == "") {
					alert('登录名与密码不能为空 ');
					$("#admin_name").focus();
					return false;
				} else {
					/*检查用户名和密码是否匹配  */
					var url = "<?php echo U('admin/login/check');?>";
					jQuery.post(url, {
						admin_name : admin_name,
						admin_password : admin_password
					}, function(msg) {
						if (msg.info == 'ok') {
							 alert('登录成功，正在转向后台主页！');
							window.location.href = msg.callback;
						} else {
							alert(msg.info);
						}
					}, 'json').error(function() {
						alert("网络连接错误，请稍后再试");
					});

				}
	}

		/*$(function() {
			$('.submit').click(function() {
				var admin_name = $("#admin_name").val();
				var admin_password = $("#admin_password").val();
				if (admin_password == "" || admin_name == "") {
					alert('登录名与密码不能为空 ');
					$("#admin_name").focus();
					return false;
				} else {
					/*检查用户名和密码是否匹配  *//*/
					var url = "<?php echo U('admin/login/check');?>";
					jQuery.post(url, {
						admin_name : admin_name,
						admin_password : admin_password
					}, function(msg) {
						if (msg.info == 'ok') {
							 alert('登录成功，正在转向后台主页！');
							window.location.href = msg.callback;
						} else {
							alert(msg.info);
						}
					}, 'json').error(function() {
						alert("网络连接错误，请稍后再试");
					});

				}
			})

		});*/
		
	</script>
	</body>
	</html>