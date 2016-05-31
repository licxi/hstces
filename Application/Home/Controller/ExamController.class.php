<?php

namespace Home\Controller;

use Think\Controller;

class ExamController extends AuthController {
	public function _empty() {
		$this->index ();
	}
	public function index() {
	}
	public function startExam() {
		$exam_id = I ( 'exam_id' );
		$scores = M("Scores");
		$student_id = $_SESSION["student_id"];
		$exist = $scores->where(array("exam_id" => $exam_id,'student_id'=>$student_id))->find();
		if($exist == false){
			$this->assign ( "exam_id", $exam_id );
			$this->display ( 'readyexam' );
		}else{
			$this->error("你已经考过了，不能重复测试");
		}
	}
	public function examing() {
		$exam_id = I ( 'exam_id' );
		$question = M ( "questions" );
		$where = array (
				'exam_id' => $exam_id 
		);
		$question_count = $question->where ( $where )->count ();
		if ($question_count > 50) {
			$offset = rand ( 0, $question_count - 50 );
			$question_list = $question->where ( $where )->limit ( $offset, 50 )->select ();
		} else {
			$question_list = $question->where ( $where )->limit ( 0, $question_count )->select ();
		}
		
		$right_answer = array ();
		foreach ( $question_list as $key => $question_info ) {
			$right_answer [] = $question_info ['rightanswer'];
		}
		session ( "right_answer", $right_answer );
		session ( "question_list", $question_list );
		$this->assign ( "exam_id", $exam_id );
		$this->assign ( 'question_count', $question_count );
		$this->assign ( "question_list", $question_list );
		$this->display ( 'exam' );
		// $question_list = $question->where($where)->select();
	}
	public function submit() {
		$right_answer = $_SESSION ["right_answer"];
		$student_id = $_SESSION ["student_id"];
		$exam_id = I ( "exam_id" );
		$exam_time = time ();
		$use_time = I ( "use_time" );
		$size = sizeof ( $right_answer );
		$answer = array ();
		$determine = array();
		$score = 0;
		for($i = 0; $i < $size; $i ++) {
			$answer [] = I ( "answer" . $i, "0" );
			if (strcasecmp ( $answer [$i], $right_answer [$i] ) == 0) {
				$score += 2;
				$determine[$i] = 1;
			}else{
				$determine[$i] = 0;
			}
		} 
		$data = array (
				'student_id' => $student_id,
				'score' => $score,
				'use_time' => $use_time,
				'exam_id' => $exam_id,
				'exam_time' => $exam_time 
		);
		$scores = M("Scores");
		$exist = $scores->where(array("exam_id" => $exam_id,'student_id'=>$student_id))->find();
		if($exist == false){
			$result = $scores->add($data);
		}else{
			$this->error("你已经考过了，不能重复测试",U("home/index/index","",""));
		}
		//var_dump ( $_SESSION ['question_list'] );
		$this->assign("exam_info",$data);
		$this->assign("right_answer",$right_answer);
		$this->assign("answer",$answer);
		$this->assign("determine", $determine);
		$this->assign("count",$size);
		$this->assign("question_list",$_SESSION ['question_list']);
		$this->display("reviewExam");
	}
}