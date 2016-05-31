<?php
namespace Admin\Controller;
use Think\Controller;

class FileController extends AuthController {
	
	private $format = array(
			'zip' => array('zip','rar','7z','jar','tar','gzip'),
			'doc' => array('doc','docx','pdf','txt','wps','rtf'),
			'img' => array('png','jpeg','gif','bmp','jpg'),
			'sheet'=>array('xlsx','xls','et','xlt'),
			'audio'=>array('mp3','wma','wav','acc','cd','ape','flac'),
			'video' =>array('mp4','mkv','rm','rmvb','flv','mov','3gp')
	);
	function _empty() {
		$this->index();
	}
	
	function index(){
		$files = M ( 'Files' );
		// 搜索条件
		$key = I ( 'key', '' );
		// 获取查找条件,
		$filter = array();
		if ($key && isset ( $key )) {
			$this->assign ( 'key', $key );
			$filter ['file_name'] = array (
					'like',
					"%{$key}%"
			);
		}
		
		// 数据过多，分页显示
		$total = $files->where ( $filter )->count ();
		
		if ($total>0) {
			$perNum = 10;
			$Page = new \Think\Page ( $total, $perNum );
			$show = $Page->show ();
		
			$this->assign ( 'total', $total );
			$this->assign ( 'page', $show );
		}
		$files_list=array();
		if($total>0){
			$files_list = $files->where ( $filter )->limit
			( $Page->firstRow . ',' . $Page->listRows )->select ();
		
		}
		$this->assign ( 'files_list', $files_list );
		$this->display('file_list');
	}
	
	function  fileUpload(){
		$this->display('file_import');
	}
	
	function upload(){
		$_SESSION ['file_id'] = "";
		$upload = new \Think\Upload (); // 实例化上传类
		$upload->maxSize = 0; // 设置附件上传大小,不限大小
		$upload->savePath = './file/'; // 设置附件上传目录
		$upload->replace = true;
		$upload->autoSub = false;
		// 上传文件
		$info = $upload->uploadOne ( $_FILES ['material'] );
		$ext = $info['ext'];
		$file_ext=$this->get_ext($ext);
		$file_data = array (
				'file_name' => $info ['name'],
				'file_hash' => $info ['sha1'],
				'file_save_name' => $info ['savename'],
				'file_size'=>$info['size'],
				'file_ext'=>$file_ext,
				'file_type'=>$info['type']
		);
		if (! $info) { // 上传错误提示错误信息
			echo ($upload->getError ());
		} else { // 上传成功
			$this->save_to_db ( $file_data );
			//var_dump($file_data);
		}
	}
	
	/**
	 * 获取文件类型
	 * @param string $ext
	 * @return string
	 */
	private function get_ext($ext){
		$file_ext='其他';
		foreach ($this->format as $key =>$vo){
			if(in_array_case($ext, $vo)){
				if($key=='zip'){
					$file_ext='压缩文件';
				}else if($key=='doc'){
					$file_ext='文档';
				}else if($key=='img'){
					$file_ext='图片';
				}else if($key=="sheet"){
					$file_ext='表格';
				}else if($key =='audio'){
					$file_ext='音频';
				}else if($key=="video"){
					$file_ext='视频';
				}else{
					$file_ext='其他';
				}
			}
		}
		return $file_ext;
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
	public function modify() {
		$file_id = I ( 'file_id' );
		$file = M ( 'Files' );
		$file_info = $file->where ( array (
				'file_id' => $file_id 
		) )->find ();
		$this->assign ( 'file_info', $file_info );
		$this->display ( 'file_modify' );
	}
	public function save() {
		$file_id = I ( "file_id", - 1 );
		$file_name = I ( "file_name", "" );
		$file_describe = I ( "file_describe", "" );
		$data = array (
				"file_name" => $file_name,
				"file_describe" => $file_describe 
		);
		$file = M ( 'Files' );
		$result = $file->where ( array (
				"file_id" => $file_id 
		) )->data ( $data )->save ();
		if ($result) {
			$data = array (
					'info' => 'ok',
					'msg' => '修改成功！',
					'callback' => U("admin/file/index") 
			);
		} else {
			$data = array (
					'info' => 'error',
					'msg' => '修改失败！' 
			);
		}
		$this->ajaxReturn ( $data );
	}
	public function del() {
		$files = M ( "Files" );
		$file_id = I ( "file_id", - 1 );
		$filter = array (
				"file_id" => $file_id 
		);
		$file_sava_name = $files->where ( $filter )->getField ( 'file_save_name' );
		$file_path = "./Uploads/file/" . $file_sava_name;
		/*
		 * if (file_exists($file_path)){
		 * $result = array (
		 * 'info' => 'error',
		 * 'msg' => '存在'
		 *
		 * );
		 * } else{
		 * $result = array (
		 * 'info' => 'error',
		 * 'msg' => $file_path
		 *
		 * );
		 * }
		 */
		if ($file_id != - 1) {
			if (unlink ( $file_path )) {
				// 删除本地保存的文件
				$result = $files->where ( $filter )->delete ();
				if ($result > 0) {
					$result = array (
							'info' => 'ok',
							'msg' => '删除成功' 
					);
				} else {
					$result = array (
							'info' => 'error',
							'msg' => '删除失败' 
					);
				}
			} else {
				$result = array (
						'info' => 'error',
						'msg' => '删除本地保存文件失败' 
				);
			}
		} else {
			$result = array (
					'info' => 'error',
					'msg' => '没有提供编号！无法删除！' 
			);
		}
		$this->ajaxReturn ( $result );
	}
	
	public function download() {
		$file_id = I("file_id",-1);
		$files = M("Files");
		$data = $files->find ($file_id);
		if (empty ( $data )) {
			header ( 'HTTP/1.0 404 Not Found' );
			header ( 'Location: .' );
		} else {
			$path = './Uploads/file/' . $data ['file_save_name'];
			header ( "Content-Type:" . $data ['file_type'] );
			header ( 'Content-Disposition: attachment; filename="' . $data ['file_save_name'] . '"' );
			header ( 'Content-Length:' . $data ['file_size'] );
			ob_clean ();
			flush ();
			readfile ( $path );
		}
	}
}