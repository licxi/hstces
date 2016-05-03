<?php
namespace Admin\Controller;
use Think\Controller;

class FileController extends AuthController {
	function _empty() {
		$this->display('file_import');
	}
	function upload(){
		$_SESSION['file_id'] = "";
		$upload = new \Think\Upload (); // 实例化上传类
		$upload->maxSize = 0; // 设置附件上传大小,不限大小
		$upload->savePath = './file/'; // 设置附件上传目录
		$upload->replace = true;
		$upload->autoSub = false;
		// 上传文件
		$info = $upload->uploadOne ( $_FILES ['material'] );
		$file_data = array(
				'file_name'		=> $info['name'],
				'file_hash'		=> $info['sha1'],
				'file_save_name' => $info['savename']
		);
		if (! $info) { // 上传错误提示错误信息
			echo( $upload->getError () );
		} else { // 上传成功
			$this->save_to_db ($file_data);
		} 
	}
	/*
	 * 将上传的资料的信息保存到数据库，便于访问
	 */
	private function save_to_db($file_data){
		$file = M("Files");
		$result = $file->add($file_data);
		if($result>0){
			$data = array(
					'info'    =>'ok',
					'msg'		=>'上传成功',
					'file_id'  =>$result['file_id']
			);
			$_SESSION['file_id'] = $result['file_id'];
		}else{
			$data = array(
					'info'    =>'error',
					'msg'		=>'上传失败'
			);
		}
		$this->ajaxReturn($data);
	}
	
	/*
	 * 修改资料描述，
	 */
	public function  modifyFileDescribe(){
		if(isset($_POST['file_id'])){
			$file_id = $_POST['file_id'];
		}else {
			if(isset($_SESSION['file_id'])){
				$file_id = $_SESSION['file_id'];
			}	
		}
		$file = M('Files');
		if($file->create()){
			
		}
	}
}