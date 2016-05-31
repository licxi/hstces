<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
<link rel="shortcut icon" href="/hstcesys/Public/Images/favicon.ico" type="image/x-icon" />

<title>韩山师范学院高校资助政策知识竞赛</title>

<!--[if lt IE 8]>
<script type="text/javascript">window.location="http://www.ncvt.cn/browser.html";</script>
<![endif]-->
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/hstcesys/Public/Css/user_login.css"/>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>
<!--引入下列.js文件-->

<script type="text/javascript">

</script>

</head>

<body onkeydown="input_enter()">
<div class="skin-container" style="background-color: rgb(255, 255, 255);background-image:url(&quot;/hstcesys/Public/Images/BG.png?2&quot;);">  </div>
<div class="container">
    <form class="form-signin" name="login" method="post">
            <div class="form-group" id="account-div">
                <div class="input-group">
                    <span class="input-group-addon" id=""> <span
                        class="glyphicon glyphicon-user"> </span> </span> <input
                        class="form-control" id="student_id" name="student_id"
                        placeholder="请输入您的账号" type="text" value="" />
                </div>
            </div>
            <div class="form-group" id="password-div">
                <div class="input-group">
                    <span class="input-group-addon" id=""> <span
                        class="glyphicon glyphicon-lock"> </span> </span> <input
                        class="form-control" id="password" name="password" id="password"
                        placeholder="请输入您的密码" type="password" value="" /> <span
                        class="input-group-addon" id="eye-open-close" onclick="eyeOpen()">
                        <span class="glyphicon glyphicon-eye-open"></span> </span>
                </div>
            </div>
            <div class="text-center">
                <input class="btn btn-primary form-control" type="button" onClick="do_login()" value="登录"><hr/>
                <a class="btn btn-primary form-control" href="<?php echo U('home/user/index','','');?>">
                    注册</a>
                <a href="<?php echo U("home/file/index","","");?>" ><img src="/hstcesys/Public/Images/file_download.png" style="margin-top: 10px"></a>
            </div>
        </form>

</div>
</div>
<div class="footer" id="footer">
<div style="float:center;">
2016 Hanshan Normal University. All RIGHTS RESERVED. [版权所有] 韩山师范学院&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="float:center"></div>
<div style="clear:both;"></div>
<div style="padding-top:10px; text-align:center; color:red">建议使用谷歌浏览器或IE11以上版本的浏览器浏览
</div>
</div>
</div>
<script type="text/javascript">
	function input_enter(){
		if(window.event.keyCode == 13){
			do_login();
		}
	}
    function eyeOpen() {
        $("#password").attr("type", "text");
        $("#eye-open-close").attr("onclick", "eyeClose()");
        $("#eye-open-close").html("<span class=\"glyphicon glyphicon-eye-close\"></span>");
    }
    function eyeClose() {
        $("#password").attr("type", "password");
        $("#eye-open-close").attr("onclick", "eyeOpen()");
        $("#eye-open-close").html("<span class=\"glyphicon glyphicon-eye-open\"></span>");
    }

    function do_login(){
        var student_id = $("#student_id");
        var password = $("#password");
        if(student_id.val()==""){
            alert("用户名不能为空！");
            student_id.focus();
            return false;
        }
        if(password.val()==""){
            alert("密码不能为空！");
            password.focus();
            return false;
        }
        var url = "<?php echo U('home/login/check','','');?>";
        jQuery.post(url, {
                        student_id : student_id.val(),
                        password : password.val()
                    }, function(msg) {
                        if (msg.info == 'ok') {
                             //alert('登录成功，正在转向后台主页！');
                            window.location.href = msg.callback;
                        } else {
                            alert(msg.msg);
                        }
                    }, 'json').error(function() {
                        alert("网络连接错误，请稍后再试");
                });
    }
</script>
</body>

</html>