<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>用户注册</title>
<style type="text/css">
* {
	margin: 0;
	padding: 0
}

.title {
	width: 100%;
	height: 30px;
	line-height: 30px;
	background: #abcdef;
	border-bottom: solid 4px #ccc;
}

.title h3 {
	font-size: 16px;
	color: #fff;
	padding-left: 20px;
}

#check {
	cursor: pointer;
	margin-right: 10px;
	border: 1px solid #ccc;
}

#isExist {
	
}

form {
	padding: 15px;
}

label {
	display: inline-block;
	width: 70px;
}

input {
	margin: 4px;
	background: none;
	padding: 5px;
	width: 150px;
}

button {
	padding: 5px 10px;
}
</style>
<link rel="stylesheet" href="/hstcesys/Public/Css/login.css">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>

<script type="text/javascript">
	window.onload
	/* 
	* 学号的正确性和是否已经被注册
	*/
	function checkStudentId(){
		var student_id = $("student_id").value;
		if (student_id == "") { //判断学号是否为空或者空格？
			document.getElementById("isExist").innerHTML = "<span style='color:red'>不能为空哦~</span>";
			return false;
		} else{
			$("isExist").innerHTML = "";
		}
		 var url = "<?php echo U('home/user/checkStudentId');?>";
		 jQuery.post(url,{"student_id" : student_id},
						function(msg) {
							if (msg.info == 'ok') {
								$("isExist").innerHTML = "<span style='color:blue'>可以注册</span>";
							} else {
								$("isExist").innerHTML = msg.msg;
							}
						}, 'json').error(function() {
							alert("网络连接错误，请稍后再试");
				}); 

	}

	function $(id) {
		return document.getElementById(id);
	}
	
	/*
	* 检查两次密码输入是否一致
	*/
	function checkPassword() {
		var pw1 = $("pw1").value;
		var pw2 = $("pw2").value;
		
		if(pw1.length<6 || pw1.length>16){
			$("isEqual").innerHTML = "";
		}
		if (pw1 == pw2) {
			$("isEqual").innerHTML = "<font color='green'>两次密码相同</font>";
			$("submit").disabled = false;
		} else {
			$("isEqual").innerHTML = "<font color='red'>两次密码不相同</font>";
			$("submit").disabled = true;
		}
	}
	
	/*
	* 密码长度的合法性
	*/
	function checkPasswordLength(){
		var pw = $("pw1").value;
		var length = pw.length;
		if(length < 6 || length > 16){
			$("passwordLength").innerHTML = "<font color='red'>不能少于6或大余16位</font>"
			return false;
		} else{
			$("passwordLength").innerHTML = "";
			return true;
		}
	}
	
	/*
	* 检查各项输入是否符合要求
	*/
	function checkSubmit(){
		var phoneReg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\d{8})$/; //验证手机号的正则表达式
		var phone = $("phone").value;
		var length = phone.length;
		if(!phoneReg.test(phone)){
			alert("请输入有效的手机号码");
			document.user_info.phone.focus();
			return false;
		} if($("student_id").value == ""){
			alert("请输入正确的学号");
			return false;
		} if($("user_name").value == ""){
			alert("姓名不能为空，请填写真实的姓名");
			return false;
		}
		return true;
	
	}
	
	
	
</script>

</head>
<body>
	<div id="addUser">
		<div class="warp">
			<div class="content">
				<form name="user_info" method="post" action="<?php echo U("home/user/adduser");?>" onSubmit="return checkSubmit()" style="margin-top: 10px">
					<label>学             号：</label><input type="text" name="student_id" id="student_id" onkeyup="checkStudentId()"/><span id="isExist"></span><br />
					<label>姓             名：</label><input type="text" name="user_name" id="user_name"/><br/>
					<label>密             码：</label><input type="password" name="password" id="pw1" onkeyup="checkPasswordLength()" placeholder="6-16位数字加字母"/>
						<span id="passwordLength"></span><br/>
					<label>确认密码：</label><input type="password" name="" id="pw2"
						onkeyup="checkPassword()" placeholder="再次输入密码"/><span id="isEqual"></span><br/>
					<label>手 机 号：</label><input type="text" name="phone" id="phone" placeholder="务必填写正确的号码！"/><br/>
						<label>院          系：</label> <select name="college_id">
						<?php if($colleges_list): if(is_array($colleges_list)): foreach($colleges_list as $key=>$college): ?><option value="<?php echo ($college["college_id"]); ?>"><?php echo ($college["college_name"]); ?></option><?php endforeach; endif; ?>
						</select><?php endif; ?>
						<br/>
					<button type="submit" id="submit">注 册</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>