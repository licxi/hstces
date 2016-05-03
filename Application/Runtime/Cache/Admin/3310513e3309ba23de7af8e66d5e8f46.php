<?php if (!defined('THINK_PATH')) exit();?><!--公共头部 -->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>考试管理系统</title>

<!-- <script type="text/javascript" src="/hstcesys/Public/Js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="/hstcesys/Public/Css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/hstcesys/Public/Css/bootstrap-datetimepicker.css">
<script type="text/javascript" src="/hstcesys/Public/Js/bootstrap.js"></script>
<script type="text/javascript" src="/hstcesys/Public/Js/bootstrap-hover-dropdown.js"></script>
<script type="text/javascript" src="/hstcesys/Public/Js/moment-with-locales.js"></script>
<script type="text/javascript" src="/hstcesys/Public/Js/bootstrap-datetimepicker.js"></script>
 -->

<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/hstcesys/Public/Css/bootstrap-datetimepicker.css">
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>
 <!--   鼠标经过下拉标签时，自动显示标签 -->
 <script type="text/javascript" src="/hstcesys/Public/Js/bootstrap-hover-dropdown.js"></script>
<!-- <script src="//cdn.bootcss.com/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.js"></script> -->
<script type="text/javascript" src="/hstcesys/Public/Js/moment-with-locales.js"></script>
<!-- <script type="text/javascript" src="http://apps.bdimg.com/libs/moment/2.8.3/moment-with-locales.js"></script> -->
<script type="text/javascript" src="/hstcesys/Public/Js/bootstrap-datetimepicker.js"></script>


<!-- 设置表格内容居中显示 -->
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
.my_table{
    padding-top: 50px;
    padding-left: 50px;
    padding-right: 50px;
}

</style>
</head>
<body>
  <!-- 当小屏幕时，不能正确显示， -->
  <!-- <nav class="navbar navbar-default navbar-fixed-top">
   <div class="navbar-header" style="padding-left: 50px;">
      <a class="navbar-brand" href="<?php echo U("admin/index/index");?>"><strong>考试管理系统</strong></a>
   </div>
   <div>

      <ul class="nav navbar-nav">
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-delay="100">
               题目管理 <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
               <li><a href="<?php echo U("questions/index");?>">题目列表</a></li>
               <li><a href="<?php echo U("questions/export");?>">导出题目</a></li>
               <li><a href="<?php echo U("questions/import");?>">导入题目</a></li>
               
            </ul>
         </li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-delay="100">
               考试管理<b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
               <li><a href="<?php echo U("admin/exams/getexams");?>">考试列表</a></li>
               <li><a href="<?php echo U("admin/exams/addexam");?>">添加考试</a></li>
               <li><a href="#">成绩查看</a></li>
               <li><a href="#">导出成绩</a></li>
               
            </ul>
         </li>
      </ul>

      <ul class="nav navbar-nav navbar-right" style="padding-right: 50px;">
        <li><a href="<?php echo U("admin/index/index");?>">后台首页</a></li>
        <li><a href="<?php echo U("Home/Index/index");?>">网站首页</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-hover="dropdown" data-delay="100">
               <?php echo (session('admin_name')); ?><b class="caret"></b>
            </a>
          <ul class="dropdown-menu">
            <li><a href="#">资料管理</a></li>
            <li><a class="btn" data-toggle="modal" data-target="#add_admin" style="text-align: left;">添加管理员</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo U('Admin/logout/index');?>">退出</a></li>
          </ul>
        </li>
      </ul>

   </div>
</nav> -->
<nav class="navbar navbar-default navbar-fixed-top">
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
    <a class="navbar-brand" href="<?php echo U("admin/index/index");?>"><strong>考试管理系统</strong></a>
  </div>
  <div class="collapse navbar-collapse" id="example-navbar-collapse">
      <ul class="nav navbar-nav">
       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
             题目管理 <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
             <li><a href="<?php echo U("questions/index");?>">题目列表</a></li>
             <li><a href="<?php echo U("questions/export");?>">导出题目</a></li>
             <li><a href="<?php echo U("questions/import");?>">导入题目</a></li>
             
          </ul>
       </li>
       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
             考试管理<b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
             <li><a href="<?php echo U("admin/exams/getexams");?>">考试列表</a></li>
             <li><a href="<?php echo U("admin/exams/addexam");?>">添加考试</a></li>
          </ul>
       </li>
       <li><a href="<?php echo U("admin/file/index");?>">资料管理</a></li>
       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
             管理员管理<b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
             <li><a href="<?php echo U("admin/admin/getAdmins");?>">管理员列表</a></li>
             <li><a class="btn" data-toggle="modal" data-target="#add_admin" style="text-align: left;">添加管理员</a></li>
          </ul>
       </li>
    </ul>


    <ul class="nav navbar-nav navbar-right" style="padding-right: 50px;">
      <li><a href="<?php echo U("Home/Index/index");?>">网站首页</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
             <span id="show_nickname"><?php echo (session('nickname')); ?></span><b class="caret"></b>
          </a>
        <ul class="dropdown-menu">
          <!-- <li><a class="btn" data-toggle="modal" data-target="#add_admin" data-toggle="dropdown" style="text-align: left;">修改资料</a></li> -->
          <li><a class="btn" data-toggle="modal" data-target="#modify_password" data-toggle="dropdown" style="text-align: left;">修改密码</a></li>
          <li><a class="btn" data-toggle="modal" data-target="#modify_info" data-toggle="dropdown" style="text-align: left;">修改资料</a></li>
         <!--  <li><a herf="<?php echo U('Admin/admin/modify');?>">修改密码</a></li> -->
          <li role="separator" class="divider"></li>
          <li><a href="<?php echo U('Admin/logout/index');?>">退出</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>



<!-- 修改密码框 -->
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

<!-- 修改个人信息 -->
<div class="modal fade bs-example-modal-sm" id="modify_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改信息</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
          <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 昵称
              </span>
            </span>
            <input id ="nickname" name="nickname" class="form-control" placeholder="<?php echo (session('nickname')); ?>" type="text"/>
          </div>         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onClick="check_nickname()">修改</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- 添加管理员 -->
<div class="modal fade bs-example-modal-sm" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加管理员</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
          <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 登录名
              </span>
            </span>
            <input id ="add_admin_name" name="add_admin_name" class="form-control" placeholder="" type="text" autocomplete="off"/>
          </div><br/>
          <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 昵&nbsp;&nbsp;&nbsp;称&nbsp;
              </span>
            </span>
            <input id ="add_nickname" name="add_nickname" class="form-control" placeholder="" type="text" autocomplete="off"/>
          </div> <br/>
          <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 密&nbsp;&nbsp;&nbsp;码&nbsp;
              </span>
            </span>
            <input id ="add_admin_password" name="add_admin_password" class="form-control" placeholder="" type="password" autocomplete="off"/>
          </div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onClick="do_add_admin()">添加</button>
        </form>
        
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    /*检查信息是否合法*/
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
        
        var url = "<?php echo U('admin/admin/checkPassword');?>"
        jQuery.post(url, {
            old_password : old_password,
          }, function(msg) {
            if (msg.info == 'ok') {
              var modify_url = "<?php echo U('admin/admin/modifyPassword');?>"
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

    /*检查信息是否合法*/
    function check_nickname() {
        var nickname = $("#nickname").val();
        if(nickname == ""){
          alert("没有填写昵称！");
          $("#nickname").focus();
        } else{
          var modify_url = "<?php echo U('admin/admin/modifyNickname');?>"
          jQuery.post(modify_url, {
                nickname : nickname,
                }, function(msg) {
                if (msg.info == 'ok') {
                  $("#show_nickname").text(nickname);
                  $("#modify_info").modal("hide");
                  alert(msg.msg);
                } else {
                  alert(msg.msg);
                }
              }, 'json').error(function() {
                alert("网络连接错误，请稍后再试");
              });
        }
         
    }

    function do_add_admin(){
      var admin_name = $("#add_admin_name");
      var nickname = $("#add_nickname");
      var password = $("#add_admin_password");
      if(admin_name.val() == ""){
        alert("登录名不能为空！");
        admin_name.focus();
        return false;
      } else if(nickname.val() == ""){
        alert("昵称不能为空！");
        nickname.focus();
        return false;
      } else if(password.val == ""){
        alert("密码不能为空！")
        password.focus();
        return false;
      } else if(password.val().length>16 || password.val().length<6){
        alert("密码必须大于6位或小于16位");
        return false;
      } else {
        var url = "<?php echo U('admin/admin/addAdmin');?>";
         jQuery.post(url,{
          admin_name : admin_name.val(),
          nickname:nickname.val(),
          admin_password:password.val()
        },function(msg) {
              if (msg.info == 'ok') {
                alert(msg.msg);
                window.location.href=msg.callback;
              } else {
                alert(msg.msg);
              }
            }, 'json').error(function() {
              alert("网络连接错误，请稍后再试");
        });
      }
    }

    window.load = function(){ 
      $("#add_admin_name").text("");
      $("#add_nickname").text("");
      $("#add_admin_password").text("");
    }; 

</script>



<!-- 头部结束-->
<!-- 主容器 start -->
<link href="/hstcesys/Public/Css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="/hstcesys/Public/Js/fileinput.js" type="text/javascript"></script>
<script src="/hstcesys/Public/Js/fileinput_locale_zh.js" type="text/javascript"></script>
<div class="my_table">
			<!-- 标题 start -->
			<div>
				<h2>导入题目 <a class="btn btn-info navbar-right" href="<?php echo U('admin/questions/index');?>">返回题目列表</a></h2><hr>
				<!-- 标题 end -->
				
			</div>
			
			<!-- 主内容 start -->
			<div class="formBox" style="margin-bottom: 200px;margin-top: 10px">
				<div class="control-group">
					<label>表格格式：</label><br> <img src="/hstcesys/Public/Images/excel_format.png">
				</div>
				<form enctype="multipart/form-data">
	               <hr style="border: 2px dotted">
	               <label>上传excel表格，支持xls和xlsx格式<font color="red">(内容务必要符合表格格式!!!)</font></label>
	               <input id="excelData" name="excelData" type="file" multiple style="width: 100px">
            	</form>
			</div>
<script type="text/javascript">
	$('#excelData').fileinput({
        language: 'zh',
        uploadUrl: "<?php echo U("admin/questions/upload");?>",/* 文件上传的的地址 */
        maxFileCount: 1,/* 设置上传的文件的数量 */
        allowedFileExtensions : ['xlsx', 'xls'],/* 允许上传的文件格式 */
    });
    $("#excelData").on("fileuploaded", function (event, data, previewId, index) {
    	if(data.response.info == "ok"){
    			if(confirm("上传成功！是否跳转到试题列表")){
    				window.location.href=data.response.url;
    			}
    	}else{
    		alert("上传失败！请重试");
    	}
    });
	
</script>		
<!-- 主内容 end -->
<!-- 脚部 start -->
﻿
<!-- 版权开始 -->
<nav class="navbar navbar-default navbar-static-bottom" style="background-color: white;border: 0;padding-top: 100px">
  <div class="container" style="text-align: center;bottom: 100px;">
    2016 Hanshan Normal University. All RIGHTS
	RESERVED. [版权所有] 韩山师范学院
  </div>
</nav>
<!-- 版权结束 -->
</body>
</html>
<!-- 脚部 end -->