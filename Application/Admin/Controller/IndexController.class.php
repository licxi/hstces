<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AuthController {
	public function _empty(){
		$this->index();
	}
    public function index(){
    	$exam = M("Exams");
    	$question = M("Questions");
    	$user = M("Users");
    	$score = D("Scores");
    	$file = M("Files");
    	
    	$exam_count = $exam->count();
    	$this->assign("exam_count",$exam_count);
    	
    	$where = array(
    		'status'   => '1',
    		'start_time' =>array('lt',time()),
    		'end_time' => array('gt',time())
    	);
    	$examing_count = $exam->where($where)->count();
    	$this->assign("examing_count",$examing_count);
    	
    	$exams_list = $exam->limit(0,10)->select();
    	//对数据进行一定的转换
    	foreach ($exams_list as $key => $exam){
    		if($exam["status"]==1){
    			$exams_list[$key]["status"] = "进行中";
    		}if($exam["status"]==0){
    			$exams_list[$key]["status"] = "已终止";
    		}
    	}
    	$this->assign("exam_list", $exams_list);
    	
    	$question_count = $question->count();
    	$this->assign("question_count",$question_count);
    	
    	
   		$where = array(
   			'exam_time' =>array('gt',time()-432000)//统计五天内的考试人数	
   		);
    	$score_count_lately = $score->where($where)->count();
    	$this->assign('score_count_lately',$score_count_lately);
    	
    	$file_count = $file->count();
    	$this->assign("file_count",$file_count);
    	
    	$user_count = $user->count();
    	$this->assign("user_count",$user_count);
    	
    	$score_list = $score->relation ( true )->where($where)->order("exam_time desc")->limit(0,10)->select();
    	$this->assign("score_list", $score_list);
    	//var_dump($score_list);
    	$this->display("index");
    }
}