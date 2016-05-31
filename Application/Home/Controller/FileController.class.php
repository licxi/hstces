<?php
namespace Home\Controller;
use Think\Controller;

class FileController extends Controller {
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
		
		if(!isset($_SESSION["student_id"])){
			$student_id = -1;
		} else{
			$student_id = $_SESSION["student_id"];
		}
		$this->assign("student_id",$student_id);
		$this->assign ( 'files_list', $files_list );
		$this->display('file_download');
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