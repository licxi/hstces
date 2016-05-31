<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="shortcut icon" href="/hstcesys/Public/Images/favicon.ico" type="image/x-icon" />
        <title>
            考生答題信息
        </title>
        <link href="/hstcesys/Public/Css/reviewExam.css" rel="stylesheet" type="text/css"/>
        <link href="/hstcesys/Public/Css/style.css" rel="stylesheet" type="text/css"/>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet"/>
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js">
        </script>
        <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js">
        </script>
        <style>
            .table th{
		      text-align: center;
		      width: 20%;
		   }
		  .table tr{
		      text-align: center;
		      width: 20%;
		   }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top">
 		 <div class="navbar-header" style="padding-left: 40px;">
   		 <span class="navbar-brand"><strong>考试成绩</strong></span>
  		</div>
  		<div class="collapse navbar-collapse" id="example-navbar-collapse">
      <ul class="nav navbar-nav navbar-right" style="padding-right: 50px;">
      <li><a href="<?php echo U("Home/index/index",'','');?>">返回首页</a></li>
      </ul>
      </div>
	</nav>
        <form action=" " id="  " method="post">
            <div id="main">
                <div class="post">
                    <div style="width: 98%; margin: 0px auto;">
                        <div style="margin: 0px auto; margin-top: 70px; width: 95%;">
                            <div class="sousuo">
                                <div class="clear">
                                </div>
                            </div>
                            <div class="finish">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-striped center">
                                        <thead>
                                            <tr>
                                                <th>
                                                    姓名
                                                </th>
                                                <th>
                                                    考试得分
                                                </th>
                                                <th>
                                                    试题数量
                                                </th>
                                                <th>
                                                    用时
                                                </th>
                                                <th>
                                                    考试时间
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo (session('user_name')); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($exam_info[score]); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($count); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($exam_info[use_time]); ?>
                                                </td>
                                                <td>
                                                    <?php echo (date("m-d h:i A ",$exam_info[exam_time])); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bookList">
                                    <div class="questions">
                                        单项选择题(共<?php echo ($count); ?>道题)
                                    </div>
                                    <?php if(is_array($question_list)): foreach($question_list as $key=>$vo): ?><div class="questions_title">
                                        1.<?php echo ($vo["question"]); ?>
                                        <span style="color:#666666">
                                            (2.00 分)
                                        </span>
                                    </div>
                                    <div class="questions_content">
                                        A.<?php echo ($vo["answer1"]); ?>
                                    </div>
                                    <div class="questions_content">
                                        A.<?php echo ($vo["answer2"]); ?>
                                    </div>
                                    <div class="questions_content">
                                        A.<?php echo ($vo["answer3"]); ?>
                                    </div>
                                    <div class="questions_content">
                                        A.<?php echo ($vo["answer4"]); ?>
                                    </div>
                                    <div class="questions_content">
                                        <span style="color:#D46531">
                                            ★ 正确答案：<?php echo ($right_answer[$key]); ?>
                                        </span>
                                    </div>
                                    <div class="viewexam_Sheet">
                                        <span style="color:#0D8839">
                                            ★ 考生答案：<?php echo ($answer[$key]); ?>
                                        </span>
                                    </div>
                                    <div class="viewexam_Sheet">
                                        <span style="color:#1E6698">
                                            ★ 评判结果：
                                            <span style="color:#124DFF">
                                            <?php if($determine[$key] == 1): ?>正确
                                                <span style="font-size:15px; font-weight:bold;">
                                                    √
                                                </span>
                                            </span>
                                            得分：2.00 分
                                            <?php else: ?>
                                                <span style="font-size:15px; font-weight:bold;color: red">
                                                   错误 ×
                                                </span><?php endif; ?>
                                                
                                        </span>
                                    </div><?php endforeach; endif; ?>
                                </div>
                                <div class="examResult" style="width: 100%; text-align:center; margin:5px; float: left;">
                                    <a class="btn btn-primary" href="<?php echo U("home/index/index","","");?>">返回首页</a>
                                </div>
                                <span class="clear">
                                </span>
                            </div>
                            <div class="clear">
                            </div>
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>