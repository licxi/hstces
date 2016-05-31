<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <link rel="shortcut icon" href="/hstcesys/Public/Images/favicon.ico" type="image/x-icon" />
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <title>
            用户注册
        </title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet"/>
        <link href="/hstcesys/Public/Css/user_login.css" rel="stylesheet" type="text/css"/>
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js">
        </script>
        <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js">
        </script>
        <link href="/hstcesys/Public/Css/register.css" rel="stylesheet"/>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
<body draggable="false">
    <div class="container">
        <div class="panel panel-primary" style="box-shadow: 5px 5px 5px #888;">
            <div class="panel-heading text-center">用户注册</div>
            <form action="<?php echo U('home/user/adduser','','');?>" class="form-register" id="reg" method="post">
                
                <div class="input-group">
                    <div class="input-group-addon">
                        <label for="number">
                            <span aria-hidden="true" class="glyphicon glyphicon-fire">
                            </span>
                        </label>
                    </div>
                    <label class="sr-only" for="number">
                        学号
                    </label>
                    <input class="form-control number" id="student_id" name="student_id" onkeyup="checkStudentId()" placeholder="输入您的学号" required="" type="text">
                    </input>
                </div>
                <span id="isExist">
                </span>
                <br/>
                <div class="input-group">
                    <div class="input-group-addon">
                        <label for="user">
                            <span aria-hidden="true" class="glyphicon glyphicon-user">
                            </span>
                        </label>
                    </div>
                    <label class="sr-only" for="user">
                        姓名
                    </label>
                    <input class="form-control user" id="user" name="user_name" placeholder="输入姓名" required="" type="text">
                    </input>
                </div>
                <br/>
                <div class="input-group">
                    <div class="input-group-addon">
                        <label for="password">
                            <span aria-hidden="true" class="glyphicon glyphicon-lock">
                            </span>
                        </label>
                    </div>
                    <label class="sr-only" for="password">
                        密码
                    </label>
                    <input class="form-control password" id="password" name="password" onkeyup="checkPasswordLength()" placeholder="输入密码" required="" type="password">
                    </input>
                </div>
                <span id="passwordLength">
                </span>
                <br/>
                <div class="input-group">
                    <div class="input-group-addon">
                        <label for="repassword">
                            <span aria-hidden="true" class="glyphicon glyphicon-check">
                            </span>
                        </label>
                    </div>
                    <label class="sr-only" for="repassword">
                        确认密码
                    </label>
                    <input class="form-control repassword" id="repassword" onkeyup="checkPassword()" placeholder="再一次输入密码" required="" type="password">
                    </input>
                </div>
                <span id="isEqual">
                </span>
                <br/>
                <div class="input-group">
                    <div class="input-group-addon">
                        <label for="tel">
                            <span aria-hidden="true" class="glyphicon glyphicon-phone-alt">
                            </span>
                        </label>
                    </div>
                    <label class="sr-only" for="tel">
                        联系电话
                    </label>
                    <input class="form-control tel" id="phone" name="phone" placeholder="您的联系电话（长号）" required="" type="text">
                    </input>
                </div>
                <br/>
                <div class="input-group">
                    <div class="input-group-addon">
                        <label for="select">
                            <span aria-hidden="true" class="glyphicon glyphicon-home">
                            </span>
                        </label>
                    </div>
                    <select class="form-control select" id="select" name="college_id">
                       <?php if($colleges_list): if(is_array($colleges_list)): foreach($colleges_list as $key=>$college): ?><option value="<?php echo ($college["college_id"]); ?>"><?php echo ($college["college_name"]); ?></option><?php endforeach; endif; endif; ?>
                    </select>
                </div>
                <div class="form-group helper">
                    <div class="checkbox">
                        <label for="checkbox1 ">
                            <input id="checkbox1 " type="checkbox" value="1" name="family_difficulties">
                                家庭经济困难学生
                            </input>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="checkbox2 ">
                            <input id="checkbox2 " type="checkbox" value="1" name="support">
                                曾受资助
                                <small>
                                    （国家奖学金、国家励志奖学金、国家助学金等）
                                </small>
                            </input>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="checkbox3 ">
                            <input id="checkbox3 " type="checkbox" value="1" name="loan">
                                国家助学贷款
                                <small>
                                    （含生源地信用助学贷款）
                                </small>
                            </input>
                        </label>
                    </div>
                </div>
                 <div class="input-group">
                <input type="text" id="code" name="code" class="form-control" placeholder="输入右边的验证码" style="max-width:180px; margin-right: 10px"/>
                <img id="code_img" src="<?php echo U("home/public/code"),"","";?>" title="点击刷新" onClick="refalsh_code()"/>
                </div>
                <label style="color: #D43F3A;">
                    *请正确填写您的个人信息，方便我们及时联系您
                </label>
               
                
                <button class="btn btn-lg btn-primary btn-block register" id="register" onClick="checkSubmit()" type="button">
                    确认注册
                </button>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript">
	function refalsh_code(){
		var captcha_img = $('#code_img') 
		var verifyimg = captcha_img.attr("src");  
		captcha_img.attr('title', '点击刷新');  
		if( verifyimg.indexOf('?')>0){  
			captcha_img.attr("src", verifyimg+'&random='+Math.random());  
		}else{  
			captcha_img.attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());  
		}  
	}
	

  /* 
  * 学号的正确性和是否已经被注册
  */
  function checkStudentId(){
    var student_id_reg = /^(20+\d{8})$/; //验证学号的正则表达式
    var student_id = $("#student_id").val();
    if (student_id == "") { //判断学号是否为空或者空格？
      $("#isExist").text("不能空！");
      return false;
    } else if(!student_id_reg.test(student_id)){
        $("#isExist").css("color","red");
        $("#isExist").text("输入正确的学号");
        return false;
    } else if(student_id_reg.test(student_id)){
      $("#isExist").text("");
    }
    /*检查学号是否已经注册*/
     var url = "<?php echo U('home/user/checkStudentId');?>";
     jQuery.post(url,{"student_id" : student_id},
            function(msg) {
              if (msg.info == 'ok') {
                $("#isExist").css("color","blue");
                $("#isExist").text("可以注册");
                $('#register').attr("disabled",false);
              } else {
                $("#isExist").css("color","red");
                $("#isExist").text("已被注册！不可以注册");
                $('#register').attr("disabled",true);
              }
            }, 'json').error(function() {
              alert("网络连接错误，请稍后再试");
        }); 

  }

  /*
  * 检查两次密码输入是否一致
  */
  function checkPassword() {
    var pw1 = $("#password").val();
    var pw2 = $("#repassword").val();
    
    if(pw1.length<6 || pw1.length>16){
      $("#isEqual").text("");
    }
    if (pw1 == pw2) {
      $("#isEqual").css("color","green");
      $("#isEqual").text("两次密码相同");
      //$("submit").disabled = false;
      $('#register').attr("disabled",false);
    } else {
      $("#isEqual").css("color","red");
      $("#isEqual").text("两次密码不相同");
      //$("submit").disabled = true;
      $('#register').attr("disabled",true);
    }
  }
  
  /*
  * 密码长度的合法性
  */
  function checkPasswordLength(){
    var pw = $("#password").val();
    var length = pw.length;
    if(length < 6 || length > 16){
      $("#passwordLength").css("color","red");
      $("#passwordLength").text("密码不能少于6或大余16位");
      return false;
    } else{
      $("#passwordLength").text("");
      return true;
    }
  }
  
  /*
  * 检查各项输入是否符合要求
  */
  function checkSubmit(){
    var phoneReg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\d{8})$/; //验证手机号的正则表达式
    var phone = $("#phone").val();
    var length = phone.length;
    var code = $("#code");
    if(!phoneReg.test(phone)){
      alert("请输入有效的手机号码");
      $("#phone").focus();
      return false;
    } else if($("#student_id").val() == ""){
      alert("请输入正确的学号");
      return false;
    } else if($("#user_name").val() == ""){
      alert("姓名不能为空，请填写真实的姓名");
      return false;
    } 
    var url = "<?php echo U("home/Public/check_verify","","");?>"
	var code = $("#code");
    jQuery.post(url, {
        code : code.val(),
    }, function(msg) {
        if (msg.info == 'ok') {
             //alert('登录成功，正在转向后台主页！');
            //window.location.href = msg.callback;
        	$("form").submit();
        } else if(msg.info == "error"){
        	refalsh_code();
      	  	code.val("");
      	  	code.focus();
      	  	alert("验证码错误！请重新输入");
        }
    	}, 'json').error(function() {
        alert("网络连接错误，请稍后再试");
	});
  }
</script>
</html>