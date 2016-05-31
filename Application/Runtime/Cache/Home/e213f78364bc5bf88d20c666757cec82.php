<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8"/>
        <title>
            韩山师范学院高校资助政策知识竞赛
        </title>
        <link rel="shortcut icon" href="/hstcesys/Public/Images/favicon.ico" type="image/x-icon" />
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js">
        </script>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet"/>
        <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js">
        </script>
        <script type="text/javascript" src="/hstcesys/Public/Js/bootstrap-hover-dropdown.js"></script>
        <style>
		   .table th{
		      text-align: center;
		   }
		  .table tr{
		      text-align: center;
		   }
			html{
				over-flow:-moz-scrollbars-vertical;
			
			}
			::-webkit-scrollbar{
				width : 0px;
			}
			.my-panel {
			    min-width: 420px;
			    max-width: 520px;
			    /*margin: 0 auto;*/
			    margin-left: 27%;
			    box-shadow: 5px 5px 5px #888;
			    margin-top: 5%;
			}
			.form-register {
		    min-width: 340px;
		    max-width: 430px;
		    padding: 15px;
		    margin: 0 auto;
			}
		</style>
</head>

<body>
<nav class="navbar navbar-default navbar-static-top">
  <div class="navbar-header" style="padding-left: 40px;">
    <button class="navbar-toggle" data-target="#example-navbar-collapse" data-toggle="collapse" type="button">
      <span class="sr-only">
          切换导航
      </span>
      <span class="icon-bar">
      </span>
      <span class="icon-bar">
      </span>
      <span class="icon-bar">
      </span>
    </button>
    <a class="navbar-brand" href="/hstcesys/home"><strong>韩师资助政策知识竞赛网</strong></a>
  </div>
  <div class="collapse navbar-collapse" id="example-navbar-collapse">
     <ul class="nav navbar-nav">
     <li><a href="/hstcesys/home">考试</a></li>
     <li><a href="<?php echo U("home/file/index","","");?>">资料下载</a></li>
   	 </ul>

    <ul class="nav navbar-nav navbar-right" style="padding-right: 50px;">
      <?php if($student_id != -1): ?><li class="dropdown">
      	  <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
      	       <span id="show_user_name"><?php echo (session('user_name')); ?></span><b class="caret"></b>
      	    </a>
      	  <ul class="dropdown-menu">
      	    <li><a class="btn" data-toggle="modal" data-target="#modify_password" data-toggle="dropdown" style="text-align: left;">修改密码</a></li>
      	    <li><a class="btn" href="<?php echo U("home/user/modify","","");?>" style="text-align: left;">修改资料</a></li>
      	    <li role="separator" class="divider"></li>
      	    <li><a href="<?php echo U('home/logout/index','','');?>">退出</a></li>
      	  </ul>
      	</li>
      <?php else: ?>
      	<li><a href="<?php echo U("home/login/index","","");?>">登录</a></li>
      	<li><a href="<?php echo U('home/user/index','','');?>">注册</a></li><?php endif; ?>
      
    </ul>
  </div>
</nav>

<!-- 修改密码框弹窗 -->
<div class="modal fade bs-example-modal-sm" id="modify_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改密码</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
          <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 旧密码
              </span>
            </span>
            <input id ="old_password" name="old_password" class="form-control" type="password"/>
          </div>
            <br/>
          <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 新密码
              </span>
            </span>
            <input id ="new_password" name="new_password" class="form-control" type="password"/>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" onClick="check_password()" class="btn btn-primary">修改</button>
        </form>
      </div>
    </div>
  </div>
</div>


 <div class="container" style="max-width: 500px">
        <div class="panel panel-primary" style="box-shadow: 5px 5px 5px #888;">
            <div class="panel-heading">信息修改</div>
            <form action="<?php echo U('home/user/domodify','','');?>" class="form-register" id="reg" method="post" onSubmit="return checkSubmit()">
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
                    <input class="form-control user" id="user" name="user_name" placeholder="输入姓名" required="" type="text"
                    value="<?php echo ($user_info["user_name"]); ?>"/>
                </div>
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
                    <input class="form-control tel" id="phone" name="phone" placeholder="您的联系电话（长号）" required="" 
                    type="text" value="<?php echo ($user_info["phone"]); ?>"/>
                    
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
                    	<option value="<?php echo ($user_info["college_id"]); ?>"><?php echo ($user_info["college_name"]); ?></option>
                       <?php if($colleges_list): if(is_array($colleges_list)): foreach($colleges_list as $key=>$college): ?><option value="<?php echo ($college["college_id"]); ?>"><?php echo ($college["college_name"]); ?></option><?php endforeach; endif; endif; ?>
                    </select>
                </div>
                <div class="form-group helper">
                    <div class="checkbox">
                        <label for="checkbox1 ">
                        	<?php if($user_info[family_difficulties] == 1): ?><input id="checkbox1 " type="checkbox" value="1" name="family_difficulties" checked="checked">
                            <?php else: ?> <input id="checkbox1 " type="checkbox" value="1" name="family_difficulties"><?php endif; ?>
                                家庭经济困难户
                            </input>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="checkbox2 ">
                        	<?php if($user_info[support] == 1): ?><input id="checkbox2 " type="checkbox" value="1" name="support" checked="checked"/>
	                         <?php else: ?> <input id="checkbox2 " type="checkbox" value="1" name="support"/><?php endif; ?>
	                                曾受资助
	                                <small>
	                                    （国家奖学金、国家励志奖学金、国家助学金等）
	                                </small>
	                            </input>

                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="checkbox3 ">
                        	<?php if($user_info[loan] == 1): ?><input id="checkbox3 " type="checkbox" value="1" name="loan" checked="checked">
                            <?php else: ?> <input id="checkbox3 " type="checkbox" value="1" name="loan"><?php endif; ?>
                                国家助学贷款
                                <small>
                                    （含生源地信用助学贷款）
                                </small>
                            </input>
                        </label>
                    </div>
                </div>
                <label style="color: #D43F3A;">
                    *请正确填写您的个人信息，方便我们及时联系您
                </label>
                <div class="row">
                	<div class="col-md-6">
                		<a class="btn btn-primary btn-block register" href="/hstcesys/home">
                		    取消
                		</a>
                	</div>	
                	<div class="col-md-6">
                		<button class="btn btn-primary btn-block register" id="register" type="submit">
                		    修改
                		</button>
                	</div>	
                </div>

                
                
            </form>
        </div>
    </div>
<script type="text/javascript">
  /*
  * 检查各项输入是否符合要求
  */
  function checkSubmit(){
    var phoneReg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\d{8})$/; //验证手机号的正则表达式
    var phone = $("#phone").val();
    var length = phone.length;
    if(!phoneReg.test(phone)){
      alert("请输入有效的手机号码");
      $("#phone").focus();
      return false;
    } else if($("#user_name").val() == ""){
      alert("姓名不能为空，请填写真实的姓名");
      return false;
    } else{
        return true;
    }
    
  
  }
</script>

<script type="text/javascript">
    function check_password() {
        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        if(old_password == ""){
          alert("旧密码未填写");
          $("#old_password").focus();
          return;
        } if(new_password == ""){
          alert("新密码未填写");
          $("#new_password").focus();
          return;
        } if(new_password.length>16 || new_password.length<6){
          alert("密码必须大于6位或小于16位");
          $("#new_password").focus();
          return;
        }
        /*检查旧密码是否正确，使用ajax无刷新检查,*/
        var url = "<?php echo U('home/user/checkPassword','','');?>"
        jQuery.post(url, {
            old_password : old_password,
          }, function(msg) {
            if (msg.info == 'ok') {
              var modify_url = "<?php echo U('home/user/modifyPassword','','');?>"
              jQuery.post(modify_url, {
                    new_password : new_password,
                    }, function(msg) {
                    if (msg.info == 'ok') {
                        alert(msg.msg);
                        $("#modify_password").modal("hide");
                    } else {
                        alert(msg.msg);
                    }
                    }, 'json').error(function() {
                        alert("网络连接错误，请稍后再试");
              });
            } else {
              alert(msg.msg);
              $("#old_password").focus();
            }
          }, 'json').error(function() {
            alert("网络连接错误，请稍后再试");
          });
    }
</script>
<nav class="navbar navbar-default navbar-static-bottom" style="background-color: white;border: 0;padding-top: 100px">
  <div class="container" style="text-align: center;bottom: 100px;">
    2016 Hanshan Normal University. All RIGHTS
	RESERVED. [版权所有] 韩山师范学院
  </div>
</nav>
</body>
</html>