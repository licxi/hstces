<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function index() {
		$colleges = M("Colleges");
		$colleges_list = $colleges->field("college_id,college_name")->select();
		$this->assign("colleges_list",$colleges_list);
		$this->display("addUser");
	}
	
	/**
	 * 用户注册，
	 */
	public function addUser(){
		$users = M('Users');
		$student_id = I('student_id');
		$isExist = $users->where(array('student_id'=>$student_id))->find();
		/* if($isExist){ 	//使用ajax返回注册结果
			$result = array(
					'info' 	=> 'error',
					'msg'	=> '学号已经存在，请检查学号是否正确'
			);
		}else{
			if($users->create()){
				$insert_id = $users->add();
				if($insert_id>0){
					$result = array(
							'info' 	=> 'ok',
							'msg'	=> '注册成功，请登录!'
					);
				}else{
					$result = array(
							'info' 	=> 'error',
							'msg'	=> '注册失败，请重试!'
					);
				}
			}
		} 
		$this->ajaxReturn($result);
		*/
		if($isExist){
			$this->error("学号已经存在，请检查学号是否正确");
		} else{
			if($users->create()){
				$insert_id = $users->add();
				if($insert_id){
					$this->success("注册成功，请登录!",U("Admin/questions/index"),1);
				}else{
					$this->error("抱歉！注册失败，请重试");
				}
			}
		}
			
	}
	
	public function checkStudentId(){
		$users = M('Users');
		$student_id = I('student_id');
		$isExist = $users->where(array('student_id'=>$student_id))->find();
		if($isExist){
			$result = array(
					'info' 	=> 'error',
					'msg'	=> '学号已经存在，请检查学号是否正确'
			);
		}else{
			$result = array(
					'info' 	=> 'ok',
					'msg'	=> 'ok'
			);
		}
		$this->ajaxReturn($result);
	}
	public  function Upload(){
		$this->display();
	}
}