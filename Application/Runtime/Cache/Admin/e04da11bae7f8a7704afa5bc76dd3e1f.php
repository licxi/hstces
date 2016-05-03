<?php if (!defined('THINK_PATH')) exit();?><!-- 公共头部 -->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>考试管理系统</title>
<!-- <link rel="stylesheet" href="/hstcesys/Public/Css/bootstrap.css">
<link rel="stylesheet" href="/hstcesys/Public/Css/jquery-ui.min.css">
<script type="text/javascript" src="/hstcesys/Public/Js/bootstrap.js"></script>
<script type="text/javascript" src="/hstcesys/Public/Js/jquery.min.js"></script> -->
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/hstcesys/Public/Css/bootstrap-datetimepicker.css">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>
   <!-- 鼠标经过下拉标签时，自动显示标签 -->
<script src="//cdn.bootcss.com/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.js"></script>
<script type="text/javascript" src="http://apps.bdimg.com/libs/moment/2.8.3/moment-with-locales.js"></script>
<script type="text/javascript" src="/hstcesys/Public/Js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript">
function getElement(id) {
    return document.getElementById(id);
  }
    /*检查信息是否合法*/
    function check_admin_info() {
        if(getElement("admin_name").value == ""){
            alert("管理员账号不能为空");
            getElement("admin_name").focus();
            return false;
        } if (getElement("admin_password").value == "") {
            alert("密码不能为空");
            getElement("admin_password").focus();
            return false;
        }
        return true;
    }
</script>
   <!-- 设置表格内容居中显示 -->
<style>
   .table th{
      text-align: center;
   }
  .table tr{
      text-align: center;
   }
</style>
</head>
<body>
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
             <!-- <li><a href="<?php echo U("admin/scores/getscores");?>">成绩查看</a></li> -->
             <!-- <li><a href="#">导出成绩</a></li> -->
             
          </ul>
       </li>
       <li><a href="<?php echo U("admin/index/index");?>">资料管理</a></li>
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
</nav>



<!--  -->
<div class="modal fade bs-example-modal-sm" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加管理员</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post" onSubmit="return check_admin_info()">
          <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 管理员账号
              </span>
            </span>
            <input id ="admin_name" name="admin_name" class="form-control" placeholder="账号（不能是中文）" type="text"/>
            </div>
            <br/>
      <div class="input-group " id="id">
            <span class="input-group-addon" id="sizing-addon1">
              <span > 管理员密码
              </span>
            </span>
            <input id ="admin_password" name="admin_password" class="form-control" placeholder="登录密码" type="password"/>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">添加</button>

        </form>
        
      </div>
    </div>
  </div>
</div>
<div style="padding-top: 50px;padding-left: 50px;padding-right: 50px">
    <h2>
        导出成绩
        <a class="btn btn-info navbar-right" href="<?php echo U('Admin/exams/index');?>">
            返回考试列表
        </a>
    </h2>
    <hr>
        <!-- 标题 end -->
        <!-- 内容区块 start -->
        <div class="row">
            <form action="<?php echo U("admin/scores/export");?>" method="post" onsubmit="return check_form()">
                <input name="exam_id" type="hidden" value="<?php echo ($exam_id); ?>"/>
                <div class="input-group input-group-sm col-md-4 col-md-offset-4">
                    <div class="input-group " id="id">
                        <span class="input-group-addon" id="sizing-addon1">
                            <span aria-hidden="true" >个数
                            </span>
                        </span>
                        <input class="form-control" id="number" name="number" onkeydown="onlyNum()" 
                         placeholder="导出前多少名,默认导出全部" type="text"/>
                    </div>
                </div>
                <div class="input-group input-group-sm col-md-4 col-md-offset-4">
                    <input class="btn btn-primary Sub" type="submit" value="导出"/>
                </div>
                <br/>
            </form>
        </div>
    </hr>
</div>
<!-- 主内容 end -->
<script type="text/javascript">
    /*只能输入数字*/
    function onlyNum() {
        if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
        if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
        event.returnValue=false;
    }
    function check_form(){
        if($("#number").value==""){
            if(confirm("将导出所有的考试成绩")){
                return true;
            } else{
                return false;
            }
        } else {
            var number = $("#number").value;
            if(confirm("将导出前"+number+"的考试成绩！")){
                return true;
            } else{
                return false;
            }
        }
        return false;
    }
</script>
<include file="Public/footer">
</include>