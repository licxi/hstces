<?php if (!defined('THINK_PATH')) exit();?><!--公共头部 -->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
<link rel="shortcut icon" href="/hstcesys/Public/Images/favicon.ico" type="image/x-icon" />
<!-- <meta http-equiv="X-UA-Compatible" content="IE=9" /> -->
<title>高校资助政策知识竞赛后台管理</title>

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
    <a class="navbar-brand" href="/hstcesys/admin"><strong>竞赛后台管理</strong></a>
  </div>
  <div class="collapse navbar-collapse" id="example-navbar-collapse">
      <ul class="nav navbar-nav">
      <!--  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
             题目管理 <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
             <li><a href="<?php echo U("questions/index",'','');?>">题目列表</a></li>
             <li><a href="<?php echo U("questions/export",'','');?>">导出题目</a></li>
             <li><a href="<?php echo U("questions/import",'','');?>">导入题目</a></li>
             
          </ul>
       </li> -->
       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
             考试管理<b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
             <li><a href="<?php echo U("admin/exams/getexams",'','');?>">考试列表</a></li>
             <li><a href="<?php echo U("admin/exams/addexam",'','');?>">添加考试</a></li>
          </ul>
       </li>
       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
             资料管理<b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
             <li><a href="<?php echo U("admin/file/index","","");?>">资料列表</a></li>
             <li><a href="<?php echo U("admin/file/fileupload","","");?>">资料上传</a></li>
          </ul>
       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
             管理员管理<b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
             <li><a href="<?php echo U("admin/admin/getadmins",'','');?>">管理员列表</a></li>
             <li><a class="btn" data-toggle="modal" data-target="#add_admin" style="text-align: left;">添加管理员</a></li>
          </ul>
       </li>
       <li><a href="<?php echo U("admin/admin/background",'','');?>">登录背景</a></li>
    </ul>


    <ul class="nav navbar-nav navbar-right" style="padding-right: 50px;">
      <li><a href="<?php echo U("Home/index/index",'','');?>">网站首页</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="100">
             <span id="show_nickname"><?php echo (session('nickname')); ?></span><b class="caret"></b>
          </a>
        <ul class="dropdown-menu">
          <!-- <li><a class="btn" data-toggle="modal" data-target="#add_admin" data-toggle="dropdown" style="text-align: left;">修改资料</a></li> -->
          <li><a class="btn" data-toggle="modal" data-target="#modify_password" data-toggle="dropdown" style="text-align: left;b">修改密码</a></li>
          <li><a class="btn" data-toggle="modal" data-target="#modify_info" data-toggle="dropdown" style="text-align: left;">修改资料</a></li>
         <!--  <li><a herf="<?php echo U('Admin/admin/modify');?>">修改密码</a></li> -->
          <li role="separator" class="divider"></li>
          <li><a href="<?php echo U('Admin/logout/index','','');?>">退出</a></li>
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
            <input id ="add_admin_name " style="height: height: " name="add_admin_name" class="form-control" placeholder="" type="text" value="" />
          </div><br/>
          <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 昵&nbsp;&nbsp;&nbsp;称&nbsp;
              </span>
            </span>
            <input id ="add_nickname" name="add_nickname" class="form-control" placeholder="" type="text" value="" autocomplete="off"/>
          </div> <br/>
          <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 密&nbsp;&nbsp;&nbsp;码&nbsp;
              </span>
            </span>
            <input id ="add_admin_password" name="add_admin_password" class="form-control" placeholder="" type="password" value="" autocomplete="off"/>
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
      $("#add_admin_name").text("");
      $("#add_nickname").text("");
      $("#add_admin_password").text("");
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
        
        var url = "<?php echo U('admin/admin/checkPassword','','');?>"
        jQuery.post(url, {
            old_password : old_password,
          }, function(msg) {
            if (msg.info == 'ok') {
              var modify_url = "<?php echo U('admin/admin/modifyPassword','','');?>"
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
          var modify_url = "<?php echo U('admin/admin/modifyNickname','','');?>"
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
        var url = "<?php echo U('admin/admin/addAdmin','','');?>";
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
</script>



<!-- 头部结束-->

<div class="modal fade" id="scores_export" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">设置导出个数</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo U("admin/scores/export");?>" method="post" id="m_form">
          <div class="input-group " id="id">
          <input name="exam_id" type="hidden" value="<?php echo ($exam_id); ?>"/>
            <span class="input-group-addon" id="sizing-addon1">
              <span >个数
              </span>
            </span>
            <input id ="number" name="number" onkeydown="onlyNum();"  class="form-control" placeholder="只能输入数字,不填代表导出全部" type="text"/>
            </div>
            <br/>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" id="btn_scores_export" class="btn btn-primary" data-dismiss="modal">导出</button>

        </form>
        </div>
    </div>
  </div>
</div>

<div class="my_table">

      <h2 style="text-align: center;">
        <span class="navbar-left">成绩管理</span><span><?php echo ($title); ?></span><a class="btn btn-info navbar-right" data-toggle="modal" 
        data-target="#scores_export">导出成绩</a>
        <a class="btn btn-info navbar-right" href="<?php echo U("admin/scores/getScores?exam_id=$exam_id","","");?>" style="margin-right: 5px">所有成绩</a><hr>
        <!-- 标题 end -->
        
      </h2>
      <!-- <form id="searchForm" name="searchform" class="well form-search"
          action="<?php echo U("admin/scores/getscores","","");?>" method="GET">
          <input name="exam_id" type="hidden" value="<?php echo ($exam_id); ?>" />
          <div class="row">
            <div class="col-sm-6 col-lg-6">
              <div class="input-group input-group-sm">
                  <span class="input-group-addon" id="sizing-addon1">学号</span>
                  <input type="text" name="key" value="<?php echo ($key); ?>"class="form-control" placeholder="支持模糊查询" aria-describedby="sizing-addon1">
              </div>
            </div>
            <div class="col-sm-6 col-lg-6">
              <input type="submit" class="btn btn-info" value="搜索" /> 
            </div>
          </div>
        </form> -->
      <?php if($scores_list): ?><div class="dataBox">
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped center">
          <thead>
            <tr>
              <th style="width: 5%">编号</th>
              <th style="width: 10%">学号</th>
              <th style="width: 10%">姓名</th>
              <th style="width: 5%">得分</th>
              <th style="width: 5%">用时</th>
              <th style="width: 15%">院系</th>
              <th style="width: 10%">考试时间</th>
              <th style="width: 8%">家庭困难</th>
              <th style="width: 8%">受资助</th>
              <th style="width: 8%">贷款</th>
              <th style="width: 9%">操作</th>
            </tr>
          </thead>
          <tbody>

            <?php if(is_array($scores_list)): foreach($scores_list as $key=>$vo): ?><tr id="tr<?php echo ($vo["id"]); ?>">
              <td ><?php echo ($vo["id"]); ?></td>
              <td ><?php echo ($vo["student_id"]); ?></td>
              <td ><?php echo ($vo["user_name"]); ?></td>
              <td ><?php echo ($vo["score"]); ?></td>
              <td ><?php echo ($vo["use_time"]); ?></td>
              <td ><?php echo ($vo["college_name"]); ?></td>
              <td ><?php echo (date("m-d h:i",$vo["exam_time"])); ?></td>
              <td ><?php echo ($vo["family_difficulties"]); ?></td>
              <td ><?php echo ($vo["support"]); ?></td>
              <td ><?php echo ($vo["loan"]); ?></td>
              <td >

                <div class="dropdown">
                  <button type="button" class="btn dropdown-toggle"
                    id="dropdownMenu1" data-toggle="dropdown">
                    操作 <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu"
                    aria-labelledby="dropdownMenu1" style="min-width: 80px;">
                      <li><a class="btn" data-toggle="modal" data-target="#del_exam" onclick="del(<?php echo ($vo["id"]); ?>,<?php echo ($vo["exam_id"]); ?>)">删除</a></li>
                  </ul>
                </div></td>
            </tr><?php endforeach; endif; ?>

          </tbody>
        </table>
        </div>
      </div>
      <?php else: ?>
      <tr>
        <td colspan="13">暂无相关信息</td>
      </tr><?php endif; ?>
      <!-- 显示分页页数 -->
<?php if($page): ?><div style="text-align: right;"> <span id="total">共<?php echo ($total); ?>条记录</span></div>
<div style="text-align: center;">
   <?php echo ($page); ?>
</div><?php endif; ?>
</div>
<script>
  //设置为只能输入数据，防止输入非法字符
	    function onlyNum() {
        if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
        if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
        event.returnValue=false;
      }
    //提示导出的个数
      $("#btn_scores_export").click(function(){
         if($("#number").val()==""){
            if(confirm("将导出所有的考试成绩")){
                $("#m_form").submit();
                $("#scores_export").modal("hide");
            } else{
                return false;
            }
        } else {
            var number = $("#number").val();
            if(confirm("将导出前"+number+"的考试成绩！")){
                $("#m_form").submit();
            } else{
                return false;
            }
        }
        return false;
      });
      function del(id,exam_id){
        if(confirm("是否删除,删除后不可恢复")){
          var url = "<?php echo U('admin/scores/del','','');?>";
          jQuery.post(url,{"id" :id,"exam_id":exam_id},
                function(msg) {
                  if (msg.info == 'ok') {
                    $("#tr"+id).remove();//在表格中移除被删除的数据
                    $("#total").text("共"+<?php echo ($total-1); ?>+"条记录");
                    alert(msg.msg);
                  } else {
                    alert(msg.msg);
                  }
                }, 'json').error(function() {
                  alert("网络连接错误，请稍后再试");
            });
        }
      }
</script>
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