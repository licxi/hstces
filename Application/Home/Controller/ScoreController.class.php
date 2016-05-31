<?php
namespace Home\Controller;
use Think\Controller;
class ScoreController extends AuthController {
	public function index() {
		$exam_id = I("exam_id");
		$student_id = $_SESSION["student_id"];
		$scores = M("Scores");
		$score_info = $scores->where(array("exam_id" => $exam_id,'student_id'=>$student_id))->find();
		$this->assign("score_info",$score_info);
		$this->display('my_score');
	}
}