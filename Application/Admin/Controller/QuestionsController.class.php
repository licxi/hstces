<?php

namespace Admin\Controller;

use Think\Controller;

class QuestionsController extends AuthController {
	
	/**
	 * 搜索題目，没有参数是，显示所有题目
	 *
	 * @param string $action        	
	 */
	public function _empty($action = 'index') {
		$exam_id = I("exam_id",-1);
		$title = M("Exams")->where(array("exam_id"=>$exam_id))->getField("title");
		if($title && isset($title)){
			$this->assign("title",$title);
		}
		$this->assign ( 'exam_id', $exam_id );
		$_SESSION['exam_id'] = $exam_id;
		$questions = M ( 'Questions' );
		// 搜索条件
		$key = I ( 'key', '' );
		// 获取查找条件,
		$filter = array();
		if($exam_id != -1){
			$filter['exam_id'] = $exam_id;
		}
		if ($key && isset ( $key )) {
			$this->assign ( 'key', $key );
			$filter ['question'] = array (
					'like',
					"%{$key}%" 
			);
		}
		
		// 数据过多，分页显示
		$total = $questions->where ( $filter )->count ();
		
		if ($total>0) {
			$perNum = 10;
			$Page = new \Think\Page ( $total, $perNum );
			$show = $Page->show ();
			
			$this->assign ( 'total', $total );
			$this->assign ( 'page', $show );
		}
		$questions_list=array();
		if($total>0){			
			$questions_list = $questions->where ( $filter )->limit 
			( $Page->firstRow . ',' . $Page->listRows )->select ();
			
		}
		$this->assign ( 'questions_list', $questions_list );
		$this->display ( "questions_list" );
	}
	
	// 添加题目
	public function add() {
		$exam_id = I("exam_id");
		$questions_info["exam_id"] = $exam_id;
		$this->assign("questions_info",$questions_info);
		$this->display ( 'questions_add' );
	}
	
	// 检查问题的题目
	public function check_question() {
		$title = I ( 'param' );
		$result = check_question ( 'goods', $title );
		
		if ($result) {
			$this->ajaxReturn ( array (
					'status' => 'n',
					'info' => '该产品已经存在' 
			) );
		} else {
			$this->ajaxReturn ( array (
					'status' => 'y',
					'info' => '' 
			) );
		}
	}
	
	// 获取某个题目的内容
	public function edit() {
		$id = I ( 'id',-1 );
		$questions_info = M ( 'Questions' )->find ( $id );
		$this->assign ( 'questions_info', $questions_info );
		$this->display ( 'questions_add' );
	}
	
	// 保存来自表单的数据
	public function save() {
		$exam_id = I("exam_id");
		$id = I ( 'id' );
		$questions = M ( 'Questions' );
		$info = $questions->find ( $id );
		if ($questions->create ()) {
			if ($info) {
				// 更新操作
				$result = $questions->where ( array (
						'id' => $id 
				) )->save ();
				if ($result || $result === 0) {
					$this->success("修改成功！",U("admin/questions/index?exam_id=$exam_id","",""));
				} else if ($result === FALSE) {
					$this->error("修改失败！请重试！");
				}
			} else {
				// 入库操作
				$result = $questions->add ();
				if ($result) {
					$this->success("添加成功！",U("admin/questions/index?exam_id=$exam_id","",""));
				} else {
					$this->error("添加失败！请重试！");
				}
			}
		} else {
			$this->error("添加失败！请重试！");
		}
	}
	public function del() {
		$id = I ( 'id' );
		$result = M ( 'Questions' )->delete ( $id );
		if($result>0){
			$result = array(
					'info' 	=> 'ok',
					'msg'	=> '删除成功'
			);
		}else{
			$result = array(
					'info' 	=> 'error',
					'msg'	=> '删除失败'
			);
		}
		$this->ajaxReturn($result);
	}
	
	// 导入数据页面
	public function import() {
		$exam_id = $_GET["exam_id"];
		//var_dump($exam_id);
		$this->assign("exam_id",$exam_id);
		$this->display ( 'questions_import' );
	}
	// 上传方法
	public function upload() {
		$exam_id = $_GET["exam_id"];
		header ( "Content-Type:text/html;charset=utf-8" );
		$upload = new \Think\Upload (); // 实例化上传类
		$upload->maxSize = 0; // 设置附件上传大小,不限大小
		$upload->exts = array (
				'xls',
				'xlsx' 
		); // 设置附件上传类
		$upload->savePath = '/'; // 设置附件上传目录
		                         // 上传文件
		$info = $upload->uploadOne ( $_FILES ['excelData'] );
		$filename = './Uploads' . $info ['savepath'] . $info ['savename'];
		$exts = $info ['ext'];
		// print_r($info);exit;
		if (! $info) { // 上传错误提示错误信息
			$this->error ( $upload->getError () );
		} else { // 上传成功
			$this->questions_import ( $filename, $exts,$exam_id);
		}
	}
	
	
	
	// 导入数据方法
	protected function questions_import($filename, $exts = 'xls',$exam_id) {
		//$exam_id = $_SESSION['exam_id'];
		// 导入PHPExcel类库，因为PHPExcel没有用命名空间，只能import导入
		/* import("Org.Util.PHPExcel"); */
		// 此方法无法加载，原因待查
		vendor ( "PHPExcel.PHPExcel" );
		// 创建PHPExcel对象，注意，不能少了\
		$objPHPExcel = new \PHPExcel ();
		// 如果excel文件后缀名为.xls，导入这个类
		if ($exts == 'xls') {
			import ( "Org.Util.PHPExcel.Reader.Excel5" );
			$PHPReader = new \PHPExcel_Reader_Excel5 ();
		} else if ($exts == 'xlsx') {
			import ( "Org.Util.PHPExcel.Reader.Excel2007" );
			$PHPReader = new \PHPExcel_Reader_Excel2007 ();
		}
		
		// 载入文件
		$objPHPExcel = $PHPReader->load ( $filename );
		// 获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
		$currentSheet = $objPHPExcel->getSheet ( 0 );
		// 获取总列数
		$allColumn = $currentSheet->getHighestColumn ();
		// 获取总行数
		$allRow = $currentSheet->getHighestRow ();
		// 循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
		for($currentRow = 2; $currentRow <= $allRow; $currentRow ++) {
			// 从哪列开始，A表示第一列
			for($currentColumn = 'A'; $currentColumn <= 'F'; $currentColumn ++) {
				// 数据坐标
				$address = $currentColumn . $currentRow;
				// 读取到的数据，保存到数组$arr中
				$cell = $currentSheet->getCell ( $address )->getValue ();
				// $cell = $data[$currentRow][$currentColumn];
				if ($cell instanceof \PHPExcel_RichText) {
					$cell = $cell->__toString ();
				}
				$row [] = $cell;
			}
			$row[] = $exam_id;
			$data [] = $row;
			unset ( $row );
		}
		//var_dump ( $data ); // 测试是否能获取数据
		
		if (isset ( $data )) {
			unlink ( $filename );
			$this->save_import ( $data ,$exam_id);
		}
	}
	
	// 保存导入数据
	public function save_import($data,$exam_id=-1) {
		$questions = M ( 'Questions' );
		foreach ( $data as $k => $v ) {
			$q = array (
					"question" => $v [0],
					"answer1" => $v [1],
					"answer2" => $v [2],
					"answer3" => $v [3],
					"answer4" => $v [4],
					"rightAnswer" => $v [5],
					"exam_id"=>$v[6]
			);
			// 问题一样是，更改答案，不允许多种答案
			/*
			 * $isExist = $questions->where ( array (
			 * "question" => $question ["question"]
			 * ) )->find ();
			 * if ($isExist) {
			 * // 更新操作
			 * $result = $questions->where ( array (
			 * "id" => $isExist ["id"]
			 * ) )->save ( $question );
			 * } else {
			 * // 入库操作
			 * $result = $questions->add ( $question );
			 * }
			 */
			/* $result = $questions->data($q)->add (); */
			$questionList [] = $q;
		}
		// 题目相同时，可以答案不一样，
		$result = $questions->addAll ( $questionList );
		if (false !== $result || 0 !== $result) {
			//$this->success ( '产品导入成功', 'Admin/questions/index' );
			$data = array(
					"info"  => "ok",
					"url"	=> U("Admin/questions/index?exam_id=$exam_id","","")
			);
		} else {
			$data = array(
					"info"  => "error",
					"error_img"=>"上传失败"
			);
		}
		$this->ajaxReturn($data);
	}
	public function export() {
		$exam_id = I("exam_id",0);
		$question = M ( "Questions" );
		$field = array("id","question","answer1","answer2","answer3","answer4","rightAnswer");
		$question_list = $question->where(array("exam_id" => $exam_id))->field($field)->select ();
		$this->questions_export ( $question_list );
	}
	
	// 导出数据方法
	protected function questions_export($questions_list = array()) {
		$data = array ();
		$data = $questions_list;
		$headArr = array (
				"id" => "编号",
				"question" => "问题",
				"answer1" => "选项一",
				"answer2" => "选项二",
				"answer3" => "选项三",
				"answer4" => "选项四",
				"rightanswer" => "正确答案" 
		);
		$filename = "questios_list";
		
		$this->getExcel ( $filename, $headArr, $data );
	}
	private function getExcel($fileName, $headArr, $data) {
		// 导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		// import ( "Org.Util.PHPExcel" );
		vendor ( "PHPExcel.PHPExcel" );
		import ( "Org.Util.PHPExcel.Writer.Excel2007" );
		import ( "Org.Util.PHPExcel.IOFactory.php" );
		
		$date = date ( "Y_m_d", time () );
		$fileName .= "_{$date}.xlsx";
		
		// 创建PHPExcel对象，注意，不能少了\
		$objPHPExcel = new \PHPExcel ();
		$objProps = $objPHPExcel->getProperties ();
		
		// 设置表头
		$key = ord ( "A" );
		// print_r($headArr);exit;
		foreach ( $headArr as $v ) {
			$colum = chr ( $key );
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colum . '1', $v );
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colum . '1', $v );
			$key += 1;
		}
		
		$column = 2;
		$objActSheet = $objPHPExcel->getActiveSheet ();
		
		// print_r($data);exit;
		foreach ( $data as $key => $rows ) { // 行写入
			$span = ord ( "A" );
			foreach ( $rows as $keyName => $value ) { // 列写入
				$j = chr ( $span );
				$objActSheet->setCellValue ( $j . $column, $value );
				$span ++;
			}
			$column ++;
		}
		
		$fileName = iconv ( "utf-8", "gb2312", $fileName );
		
		// 重命名表
		// $objPHPExcel->getActiveSheet()->setTitle('test');
		// 设置活动单指数到第一个表,所以Excel打开这是第一个表
		$objPHPExcel->setActiveSheetIndex ( 0 );
		ob_end_clean (); // 清除缓冲区,避免乱码
		header ( 'Content-Type: application/vnd.ms-excel' );
		header ( "Content-Disposition: attachment;filename=\"$fileName\"" );
		header ( 'Cache-Control: max-age=0' );
		
		$objWriter = \PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' ); // 文件通过浏览器下载
		exit ();
	}
}