<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends AuthController {
    public function index(){
    	$key = I("key",-1);
    	$exams = M("Exams");
    	$scores = M("Scores");
    	$filter = array();
    	if ($key != -1) {
    		$this->assign ( 'key', $key );
    		$filter ['title'] = array (
    				'like',
    				"%{$key}%"
    		);
    	}
    	
    	$total = $exams->where($filter)->count ();
    	if ($total>0) {
    		$perNum = 10;
    		$Page = new \Think\Page ( $total, $perNum );
    		$show = $Page->show ();
    			
    		$this->assign ( 'total', $total );
    		$this->assign ( 'page', $show );
    	}
    	$questions_list=array();
    	if($total>0){
    		$exams_list = $exams->where($filter)->limit
    		( $Page->firstRow . ',' . $Page->listRows )->select ();
    		
    	}
    	//对数据进行一定的转换
    	 foreach ($exams_list as $key => $exam){
    		$exam_id = $exam["exam_id"];
    		$student_id = $_SESSION['student_id'];
    		$exist = $scores->where(array("exam_id" => $exam_id,'student_id'=>$student_id))->find();
    		if($exist == false){
    			$is_exam = array("is_exam" => 1);
    		}else{
    			$is_exam = array("is_exam" => 0);
    		}
    		$exams_list[$key] = array_merge ( $exams_list [$key], $is_exam );
    		$now_time = time();
    		$start_time = $exams_list[$key]["start_time"];
    		$end_time = $exams_list[$key]["end_time"];
    		if($now_time > $start_time && $now_time < $end_time){
    			$can_exam = array("can_exam"=>1);
    		} else if($now_time < $start_time){
    			$can_exam = array("can_exam"=>0);
    		} else if($now_time > $end_time){
    			$can_exam = array("can_exam"=>2);
    		}
    		$exams_list[$key] = array_merge ( $exams_list [$key], $can_exam );
    		$exams_list[$key]["start_time"] = date("Y-m-d", $start_time);
    		$exams_list[$key]["end_time"] = date("Y-m-d", $end_time);
    		
    	}
    	$this->assign ( 'exams_list', $exams_list );
      	$this->display("home");
    }
}