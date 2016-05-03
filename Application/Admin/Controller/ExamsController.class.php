<?php
namespace Admin\Controller;
use Think\Controller;
class ExamsController extends AuthController {
	public function _empty(){
		$this->getExams();
	}
    public function index(){
    	$this->getExams();
    }
    /*
     * 添加考试
     */
    public function addExam(){
    	$this->display("exams_add");
    }
    
    public function save(){
    	$title = I("title");
    	$author = $_SESSION["admin_name"];
    	$start_time=I("start_time",time());
    	$end_time=I("end_time",time());
    	$start_time = strtotime($start_time); //将格式化的时间转换为时间戳
    	$end_time = strtotime($end_time);
    	$exams = M("Exams");
    	$data=array(
    			"title"		 => $title,
    			"start_time" => $start_time,
    			"end_time" 		=>$end_time,
    			"status"	=>1,
    			"author"	=>$author
    	);
    	$result = $exams->add($data);
    	if($result>0){
    		//$this->success("添加成功！",U("Admin/Exams/index"));
    		$_SESSION["exam_id"] = $result;
    		$this->display(":Questions/Questions_import");
    	} else{
    		$this->error("添加失败！");
    	}
    }
    
    /*
     *获取考试列表
     */
    public function getExams(){
    	$exams = M("Exams");
    	$scores = M("Scores");
    	$total = $exams->count ();
    	if ($total>0) {
    		$perNum = 10;
    		$Page = new \Think\Page ( $total, $perNum );
    		$show = $Page->show ();
    			
    		$this->assign ( 'total', $total );
    		$this->assign ( 'page', $show );
    	}
    	$questions_list=array();
    	if($total>0){
    		$exams_list = $exams->limit
    		( $Page->firstRow . ',' . $Page->listRows )->select ();
    		
    	}
    	//对数据进行一定的转换
    	 foreach ($exams_list as $key => $exam){
    		$exam_id = $exam["exam_id"];
    		$total = $scores->where(array("exam_id" => $exam_id))->count();
    		$total_number = array("total_number" => $total);
    		$exams_list[$key] = array_merge ( $exams_list [$key], $total_number );
    		
    		if($exam["status"]==1){
    			$exams_list[$key]["status"] = "进行中";
    		}if($exam["status"]==0){
    			$exams_list[$key]["status"] = "已终止";
    		}
    		$exams_list[$key]["start_time"] = date("Y-m-d", $exams_list[$key]["start_time"]);
    		$exams_list[$key]["end_time"] = date("Y-m-d", $exams_list[$key]["end_time"]);
    	}
    	//var_dump($exams_list);
    	$this->assign ( 'exams_list', $exams_list );
    	$this->display ( "exams_list" );
    }
    /*
     * 删除一次考试，并删除相关考试成绩
     */
	public function del() {
		$id = I ( "exam_id" );
		$result = M ( 'Exams' )->delete ( $id );
		if($result>0){
			$result2 = M("Scores")->where(array("exam_id"=>$id))->delete();
			$data = array(
					'info' 	=> 'ok',
					'msg'	=> '删除成功'
			);
		}else{
			$data = array(
					'info' 	=> 'error',
					'msg'	=> '删除失败'
			);
		}
		$this->ajaxReturn($data);
	}
	
	/*
	 * 修改某次考试的状态（终止，进行）
	 * parmas exam_id
	 */
	public function changeExamStatus() {
		$exam_id = I("exam_id","");
		$exams = M("Exams");
		if($exam_id==""){
			$data = array(
					"info"	=>"error",
					"msg" 	=>"没有有效的编号！",
			);
		}else{
			$status = $exams->where($exam_id)->getField("status");
			if($status == 1){
				$result = $exams->where($exam_id)->setField(array("status" =>0));
				if($result){
					$data = array(
							"info"	=>"ok",
							"msg"	=>"开始",
							"tip"	=>"已终止"
					);
				}else{
					$data = array(
							"info"	=>"error",
							"msg" 	=>"修改失败！",
					);
				}
			} else if($status == 0) {
				$result = $exams->where($exam_id)->setField(array("status" =>1));
				if($result){
					$data = array(
							"info"	=>"ok",
							"msg"	=>"终止",
							"tip"	=>"进行中"
					);
				}else{
					$data = array(
							"info"	=>"error",
							"msg" 	=>"修改失败！",
					);
				}
			}
				
				
		}
		$this->ajaxReturn($data);
	}
	public function edit(){
		$exam_id = I("exam_id");
		if(!isset($exam_id)){
			$this->error("没有编号，不能修改！");
		}else{
			$exams = M("Exams");
			$exam_info = $exams->where($exam_id)->find();
			if($exam_info){
				$exam_info["start_time"] = date("m/d/Y h:i A",$exam_info["start_time"]);
				$exam_info["end_time"] = date("m/d/Y h:i A",$exam_info["end_time"]);
				$this->assign("exam_info",$exam_info);
				$this->display("exams_add");
			}
		}
	}
}