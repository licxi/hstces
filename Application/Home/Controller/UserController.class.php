<?php

namespace Home\Controller;

use Think\Controller;

class UserController extends Controller {
	public function index() {
		$colleges = M ( "Colleges" );
		$colleges_list = $colleges->field ( "college_id,college_name" )->select ();
		$this->assign ( "colleges_list", $colleges_list );
		$this->display ( "register" );
	}
	
	/**
	 * 用户注册，
	 */
	public function addUser() {
		$users = M ( 'Users' );
		$student_id = I ( 'student_id' );
		$isExist = $users->where ( array (
				'student_id' => $student_id 
		) )->find ();
		if ($isExist) {
			$this->error ( "学号已经存在，请检查学号是否正确" );
		} else {
			$user_name = I ( 'user_name' );
			$college_id = I ( 'college_id' );
			$phone = I ( 'phone' );
			$family_difficulties = I ( 'family_difficulties', 0 );
			$support = I ( 'support', 0 );
			$loan = I ( 'loan', 0 );
			$password = I ( 'password' );
			$password = md5 ( $password );
			$data = array (
					'student_id' => $student_id,
					'user_name' => $user_name,
					'password' => $password,
					'college_id' => $college_id,
					'phone' => $phone,
					'family_difficulties' => $family_difficulties,
					'support' => $support,
					'loan' => $loan 
			);
			$insert_id = $users->add ( $data );
			if ($insert_id) {
				$this->success ( "注册成功，请登录!", U ( "home/login/index", "", "" ), 1 );
			} else {
				$this->error ( "抱歉！注册失败，请重试" );
			}
		}
	}
	public function checkStudentId() {
		$users = M ( 'Users' );
		$student_id = I ( 'student_id' );
		$isExist = $users->where ( array (
				'student_id' => $student_id 
		) )->find ();
		if ($isExist) {
			$result = array (
					'info' => 'error',
					'msg' => '学号已经存在，请检查学号是否正确' 
			);
		} else {
			$result = array (
					'info' => 'ok',
					'msg' => 'ok' 
			);
		}
		$this->ajaxReturn ( $result );
	}
	public function Upload() {
		$this->display ();
	}
	
	/*
	 * 判断输入的密码是否相同
	 */
	public function checkPassword() {
		$student_id = $_SESSION ["student_id"];
		$old_password = I ( "old_password" );
		
		$old_password = md5 ( $old_password );
		
		$filter = array (
				'student_id' => $student_id,
				'password' => $old_password 
		);
		
		$user_info = M ( 'Users' )->where ( $filter )->find ();
		if ($user_info) {
			$result = array (
					"info" => "ok",
					"msg" => "密码一致" 
			);
		} else {
			$result = array (
					"info" => "error",
					"msg" => "密码不一致,不能修改" 
			);
		}
		$this->ajaxReturn ( $result );
	}
	
	/*
	 * 修改密码
	 */
	public function modifyPassword() {
		if (isset ( $_SESSION ["student_id"] )) {
			$user = M ( "Users" );
			$student_id = $_SESSION ["student_id"];
			if (isset ( $_POST ["new_password"] )) {
				$new_password = md5 ( I ( "new_password" ) );
			}
			/* e10adc3949ba59abbe56e057f20f883e */
			if ($student_id != "") {
				if ($new_password) {
					if ($user->where ( array (
							"student_id" => $student_id 
					) )->save ( array (
							"password" => $new_password 
					) )) {
						$result = array (
								"info" => "ok",
								"msg" => "修改成功" 
						);
					} else {
						$result = array (
								"info" => "error",
								"msg" => "修改失败" 
						);
					}
				} else {
					$result = array (
							"info" => "error",
							"msg" => "修改失败" 
					);
				}
			}
			$this->ajaxReturn ( $result );
		}
	}
	public function modify() {
		$student_id = $_SESSION ['student_id'];
		$filter = array (
				'student_id' => $student_id 
		);
		
		$user_info = D ( 'Users' )->where ( $filter )->relation ( true )->find ();
		
		$colleges = M ( "Colleges" );
		$colleges_list = $colleges->field ( "college_id,college_name" )->select ();
		$this->assign ( "user_info", $user_info );
		$this->assign ( "colleges_list", $colleges_list );
		$this->display ();
	}
	public function doModify() {
		if (isset ( $_SESSION ["student_id"] )) {
			$user = M ( "Users" );
			$student_id = $_SESSION ['student_id'];
			$user_name = I ( "user_name", "" );
			$phone = I ( 'phone' );
			$college_id = I ( 'college_id' );
			$family_difficulties = I ( 'family_difficulties', 0 );
			$support = I ( 'support', 0 );
			$loan = I ( 'loan', 0 );
			$data = array (
					'user_name' => $user_name,
					'college_id' => $college_id,
					'phone' => $phone,
					'family_difficulties' => $family_difficulties,
					'support' => $support,
					'loan' => $loan
			);
			if ($student_id != "") {
				if ($user->where ( array (
						"student_id" => $student_id 
				) )->save ( $data )) {
					$_SESSION ["user_name"] = $user_name;
					$this->success("修改成功！",'/home');
				} else {
					$this->error("修改失败！");
				}
			}
		} else {
			$this->error("未登录！");
		}
	}
}