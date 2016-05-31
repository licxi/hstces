<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>学生答题信息查询</title>

   	<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet"/>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js">
    </script>
    <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js">
    </script>
    <link rel="stylesheet" href="/hstcesys/Public/Css/new_examRsult.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript">
			function pageCloseddd() {
				window.close();
			}
		</script>
  </head>
  <body>
	<div class="container" >
		<div class="panel panel-primary" >
			<div class="panel-heading">
				<h1 class="panel-title"style="text-align: center;"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>考生考试结果</h1>
			</div>
			
				<table class="table table-hover table-striped table-responsive table-bordered">
					<thead>
						<tr>
							<th>&nbsp;<span class="glyphicon glyphicon-fire" aria-hidden="true"></span> 学号</th>
							<th>&nbsp;<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 姓名</th>
							<th>&nbsp;<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 所得分数</th>
							<th>&nbsp;<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 答对题数</th>
							<th>&nbsp;<span class="glyphicon glyphicon-time" aria-hidden="true"></span>所用时间</th>
							<th>&nbsp;<span class="glyphicon glyphicon-time" aria-hidden="true"></span> 考试时间</th>
						</tr>
					</thead>
					<tbody >
						<tr >
							<td><?php echo ($score_info[student_id]); ?></td>
							<td><?php echo (session('user_name')); ?></td>
							<td><?php echo ($score_info[score]); ?></td>
							<td><?php echo ($score_info[score]/2); ?></td>
							<td><?php echo ($score_info[use_time]); ?></td>
							<td><?php echo (date("m-d h:i",$score_info[exam_time])); ?></td>
						</tr>
					</tbody>
				</table>
			
		<div class="panel-footer" style="text-align: center;">
			
				
    	 			<!--&nbsp;&nbsp;-->
    	 	<button class="btn btn-danger btn-lg " href="#" role="button" onclick="pageCloseddd()" >
    	 				<span class="glyphicon glyphicon-off" aria-hidden="true" ></span>关闭窗口
    	 			</button>
			
					
		</div>	
			
		</div>
	</div>
  </body>
</html>