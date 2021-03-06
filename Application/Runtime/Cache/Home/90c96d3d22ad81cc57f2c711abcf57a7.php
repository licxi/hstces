<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="shortcut icon" href="/hstcesys/Public/Images/favicon.ico" type="image/x-icon" />
        <title>
            考试页面
        </title>
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
        <link href="/hstcesys/Public/Css/style.css" rel="stylesheet" type="text/css"/>
        <link href="/hstcesys/Public/Css/exam.css" rel="stylesheet" type="text/css"/>
        </script>
        <script type="text/javascript">
            /*点击某题的答案时，改变相应格子的颜色*/
            function change_bg_color(id){
				$("#bg_"+id).css("background-color","#23BBEA");
			}
        </script>
    </head>
    <body oncopy="alert('对不起，禁止复制！');return false;">
            <div class="mainBox" id="bgContext_div">
                <div class="mainRight" id="bgContent_div">
                    <div style="#FFFFFF; height: 45px;background-color: #519ED2;">
                        <div class="titleright">
                            已考时间：
                            <span id="use_time_minutes" value=0>
                                0
                            </span>
                            <span>分</span>
                            <span id="use_time_seconds">0</span>
                            <span>秒</span>
                        </div>
                        <div class="titleleft">
                            <span class="title" id="  ">
                                韩山师范学院高校资助政策知识竞赛
                            </span>
                            <span class="title_info" id="  ">
                                (共1种题型，计时40分钟)
                            </span>
                        </div>
                    </div>
                    <div class="finish">
                        <div class=" finish-info ">
                            <input class="examsubmit" id="" onclick="doSubmit()" type="button" value="交卷"/>
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                    <!--左边导航栏-->
                    <div class="navigation" style="">
                        <br/>
                        <div class="student_info">
                            姓  名：
                            <span id="   " style="font-weight: bold;">
                                <?php echo (session('user_name')); ?>
                            </span>
                            <br/>
                            学  号：
                            <span id="   " style="font-weight: bold;">
                                <?php echo (session('student_id')); ?>
                            </span>
                            <br/>
                        </div>
                        <br/>
                        <div class="shousuo">
                            <!--<span style="color: white; font-size: 14px;"></span>-->
                            <br/>
                            <span style="color: #666666; font-weight: normal;">
                                已答试题：以
                                <span style="color: #23BBEA">
                                    蓝色
                                </span>
                                标识
                                <br/>
                                未答试题：以白色标识
                            </span>
                            <br/>
                            <br/>
                            <div style=" clear:both;">
                            </div>
                            <div style="width: 100%; color: #000000;">
                                <ul>
                                    <li>
                                        <a href="#questions">
                                            单项选择题
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="shousuo_content">
                                <ul>
                                    <div style="clear:both;">
                                    </div>
                                    <?php if(is_array($question_list)): foreach($question_list as $key=>$vo): ?><li id="bg_<?php echo ($key); ?>">
                                            <a href="#<?php echo ($vo[id]); ?>">
                                                <?php echo ($key+1); ?>
                                            </a>
                                        </li><?php endforeach; endif; ?>
                                </ul>
                            </div>
                            <div style="clear: both; background-color: #6AA4D3;">
                            </div>
                        </div>
                        <input class="examsubmit" style="margin-top: 10px" id="" onclick="doSubmit()" type="button" value="交卷"/>
                    </div>
                    <!--右边答题区域-->
                    <div class="examList" id="exam_paper">
                        <div style="width: 96%; height: auto; ">
                            <div class="questions">
                                单项选择题 (共<?php echo ($question_count); ?>道题，每道题2.0分)
                            </div>
                                <form class="examform" id="exam_form" method="post" action="<?php echo U("home/exam/submit","","");?>">
                                <div id="add">
                                    
                                </div>
                                <input type="hidden" value="<?php echo ($exam_id); ?>" name="exam_id" />
                                 <?php if(is_array($question_list)): foreach($question_list as $key=>$vo): ?><div class="questions_title" id="<?php echo ($vo[id]); ?>">
                                <?php echo ($key+1); ?>.<?php echo ($vo["question"]); ?>
                                <span style="color:#666666">
                                    ( 2.00 分)
                                </span>
                            </div>
                                <div class="questions_content">
                                        <label>
                                            <input name="answer<?php echo ($key); ?>" onclick="change_bg_color(<?php echo ($key); ?>)" type="radio" value="A"/>
                                             A.<?php echo ($vo["answer1"]); ?>
                                        </label>
                                </div>
                                <div class="questions_content">
                                    <label>
                                        <input name="answer<?php echo ($key); ?>" onchange="change_bg_color(<?php echo ($key); ?>)" type="radio" value="B"/>
                                        B.<?php echo ($vo["answer2"]); ?>
                                    </label>
                                    
                                </div>
                                <div class="questions_content">
                                    <label>
                                        <input name="answer<?php echo ($key); ?>" onchange="change_bg_color(<?php echo ($key); ?>)" type="radio" value="C"/>
                                        C.<?php echo ($vo["answer3"]); ?>
                                    </label>
                                </div>
                                <div class="questions_content">
                                    <label>
                                        <input name="answer<?php echo ($key); ?>" onchange="change_bg_color(<?php echo ($key); ?>)" type="radio" value="D"/>
                                        D.<?php echo ($vo["answer4"]); ?>
                                    </label>
                                    
                                </div>
                                <div class="questions_content">
                                    <span style="">
                                    </span>
                                </div><?php endforeach; endif; ?>
                            </form>
                        </div>
                    </div>
                    
                    <div class="clear">
                    </div>
                </div>
                
            </div>

        
    </body>
    <script type="text/javascript">
        function doSubmit(){
            if(confirm("是否交卷")){
                var use_time_minutes = $("#use_time_minutes");
                var use_time_seconds = $("#use_time_seconds");
                var form1 = document.getElementById("add"); 
                var use_time_minutes_value = jQuery.trim(use_time_minutes.html());
                var use_time_seconds_value = jQuery.trim(use_time_seconds.html());
                var use_time1 = use_time_minutes_value+":"+use_time_seconds_value;
                var time = document.createElement("input");  
                time.tpye = "hidden";
                time.name = "use_time"
                time.value = use_time1;
                form1.appendChild(time);  
                //alert(use_time);
                //$("form").attr("use_time1",use_time1);
               // $("#exam_form").action="<?php echo U("home/exam/submit","","");?>/use_time/"+use_time1;
                $("form").submit();
            }
        }
        function use_time(){
            var use_time_minutes = $("#use_time_minutes");
            var use_time_seconds = $("#use_time_seconds");
            var use_time_minutes_value = use_time_minutes.html();
            var use_time_seconds_value = use_time_seconds.html();
            if(parseInt(use_time_seconds_value) == 59){
                use_time_seconds_value = 0;
                use_time_minutes_value = parseInt(use_time_minutes_value)+1;
            }else{
                use_time_seconds_value = parseInt(use_time_seconds_value)+1;
            }
            if(parseInt(use_time_minutes_value) == 1){
            	alert("考试时间到，系统自动交卷！");
            	$("form").submit();
            }
            use_time_minutes.text(use_time_minutes_value);
            use_time_seconds.text(use_time_seconds_value);
            
            //alert(use_time_seconds_value);
        }

        window.setInterval("use_time()",1000);
    </script>
</html>