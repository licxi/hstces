<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 管理员
 * @author TrueLE
 *
 */
class AdminController extends AuthController{
	/*
	 * 添加管理员
	 */
	public function addAdmin(){
		$admin = M("Admin");
		$admin_name = I("admin_name","");
		$nickname = I("nickname");
		$admin_password = I("admin_password");
		$admin_info = array(
				'admin_name'		=> $admin_name,
				'nickname'			=> $nickname,
				'admin_password'	=> md5($admin_password)
		);
		if(isset($admin_info)) {
			$result = $admin->add($admin_info);
			if($result>0) {
				$data = array(
						'info' => 'ok',
						'msg'  => '添加管理员成功',
						'callback'=> U("admin/admin/getAdmins")
				);
			}else{
				$data = array(
						'info'	=> 'error',
						'msg' 	=> '添加管理员失败'
				);
			}
		}else{
			$data = array(
					'info'	=> 'error',
					'msg' 	=> '未知错误，请重试！'
			);
		}
		$this->ajaxReturn($data);
	}
	
	public function getAdmins(){
		$admin = M("Admin");
		// 数据过多，分页显示
		$total = $admin->count ();
		
		if ($total>0) {
			$perNum = 10;
			$Page = new \Think\Page ( $total, $perNum );
			$show = $Page->show ();
			$this->assign ( 'total', $total );
			$this->assign ( 'page', $show );
		}
		$questions_list=array();
		if($total>0){
			$admins_list = $admin->limit
			( $Page->firstRow . ',' . $Page->listRows )->select ();
				
		}
		$this->assign("admins_list",$admins_list);
		
		$this->display("admins_list");
	}
	
	
	/*
	 * 保存管理员
	 */
	public function save(){
		$admin = M("Admin");
		if($admin->create()){
			if($admin->add()){
				$result = array(
						"info"	=> "ok",
						"msg"	=> "添加成功"
				);
			}else{
				$result = array(
						"info"	=> "error",
						"msg"	=> "添加失败"
				);
			}
		}else{
			$result = array(
						"info"	=> "error",
						"msg"	=> "添加失败"
				);
		}
		$this->ajaxReturn($result);
	}

	
	/*
	 * 修改密码
	 */
	public function modifyPassword(){
		if(isset($_SESSION["admin_name"])){
			$admin = M("Admin");
			$admin_name = $_SESSION["admin_name"];
			if(isset($_POST["new_password"])){
				$new_password = md5(I("new_password"));
			}
			/* e10adc3949ba59abbe56e057f20f883e */
			if($admin_name != ""){
				if($new_password){
					if($admin->where(array("admin_name"=>$admin_name))->save(array("admin_password"=>$new_password))){
						$result = array(
								"info"	=> "ok",
								"msg"	=> "修改成功"
						);
					}else{
						$result = array(
							"info"	=> "error",
							"msg"	=> "修改失败"
						);
					}
					
				}
				else{
					$result = array(
							"info"	=> "error",
							"msg"	=> "修改失败"
					);
				}
			}
			$this->ajaxReturn($result);
		}
	}
	
	public function modifyNickname(){
		if(isset($_SESSION["admin_name"])){
			$admin = M("Admin");
			$admin_name = $_SESSION["admin_name"];
			$nickname = I("nickname","");
			/* e10adc3949ba59abbe56e057f20f883e */
			if($admin_name != ""){
				if(isset($nickname)){
					if($admin->where(array("admin_name"=>$admin_name))->save(array("nickname"=>$nickname))){
						$_SESSION["nickname"] = $nickname;
						$result = array(
								"info"	=> "ok",
								"msg"	=> "修改成功"
						);
					}else{
						$result = array(
								"info"	=> "error",
								"msg"	=> "修改失败"
						);
					}
						
				}
				else{
					$result = array(
							"info"	=> "error",
							"msg"	=> "修改失败"
					);
				}
			}
			$this->ajaxReturn($result);
		}else{
			$this->display();
		}
	}
	
	/*
	 * 删除管理员
	 */
	public function del(){
		$admin = M("Admin");
		$admin_name = I("admin_name","");
		if($admin_name != ""){
			if($admin->where(array("admin_name" => $admin_name))->delete()){
				$result = array(
						"info"	=> "ok",
						"msg"	=> "删除成功"
				);
			}else{
				$result = array(
						"info"	=> "error",
						"msg"	=> "删除失败"
				);
			}
		}else{
			$result = array(
					"info"	=> "error",
					"msg"	=> "请提供有效地用户名"
			);
		}
		$this->ajaxReturn($result);
	}
	
	/*
	 *判断输入的密码是否相同 
	 */
	public function checkPassword(){
		$admin_name = $_SESSION["admin_name"];
		$old_password = I("old_password");
		
		$old_password = md5($old_password);
		
		$filter = array(
				'admin_name'     => $admin_name,
				'admin_password' => $old_password
		);
		
		$admin_info = M('Admin')->where($filter)->find();
		if($admin_info){
			$result = array(
					"info" 	=> "ok",
					"msg"	=> "密码一致"
			);
		}else{
			$result = array(
					"info" 	=> "error",
					"msg"	=> "密码不一致,不能修改"
			);
		}
		$this->ajaxReturn($result);
	}
	
	public function background(){
		$this->display('modify_bg_img');
	}
	
	public function upload(){
		$upload = new \Think\Upload (); // 实例化上传类
		$upload->maxSize = 0; // 设置附件上传大小,不限大小
		$upload->savePath = '../public/Images/'; // 设置附件上传目录 */
		/* $upload->savePath = './file/'; // 设置附件上传目录 */
		$upload->saveName = "BG";
		$upload->saveExt = "png";
		$upload->replace = true;
		$upload->autoSub = false;
		// 上传文件
		$info = $upload->uploadOne ( $_FILES ['bg_img'] );
		if (! $info) { // 上传错误提示错误信息
			echo ($upload->getError ());
		} else { // 上传成功
			$data = array(
					"info"	=> "ok",
					"msg"	=> "上传成功！"
			);
			$this->ajaxReturn($data);
		}
		
	}
}