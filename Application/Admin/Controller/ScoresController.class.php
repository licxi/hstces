<?php

namespace Admin\Controller;

use Think\Controller;

class ScoresController extends AuthController {
	public function _empty() {
		$this->getExams ();
	}
	public function index() {
		$this->getExams ();
	}
	/*
	 * 添加考试
	 */
	public function addExam() {
		$this->display ( "exams_add" );
	}
	/*
	 * 保存考试信息 
	 */
	public function save() {
		$title = I ( "title" );
		$author = $_SESSION ["admin_name"];
		$start_time = I ( "start_time", time () );
		$end_time = I ( "end_time", time () );
		$start_time = strtotime ( $start_time ); // 将格式化的时间转换为时间戳
		$end_time = strtotime ( $end_time );
		$exams = M ( "Exams" );
		$data = array (
				"title" => $title,
				"start_time" => $start_time,
				"end_time" => $end_time,
				"status" => 1,
				"author" => $author 
		);
		if ($exams->add ( $data ) > 0) {
			$this->success ( "添加成功！", U ( "Admin/Exams/index","","" ) );
		} else {
			$this->error ( "添加失败！" );
		}
	}
	
	/*
	 * 获取某次考试的参与考试的所得成绩
	 */
	public function getScores() {
		$exam_id = I ( "exam_id", "" );
		$title = I("title","试题");
		$this->assign("title",$title);
		$scores = D ( "Scores" );
		/*
		 * if($exam_id==""){
		 * $total = $scores->count();
		 * $scores_list = $scores->relation ( true )->select();
		 * }
		 */
		
		$filter = array ();
		if ($exam_id && isset ( $exam_id )) {
			$this->assign ( '$exam_id', $exam_id );
			$filter = array (
					"exam_id" => $exam_id 
			);
		}
		
		// 数据过多，分页显示
		$total = $scores->where ( $filter )->count ();
		
		if ($total > 0) {
			$perNum = 10;
			$Page = new \Think\Page ( $total, $perNum );
			$show = $Page->show ();
			$this->assign ( 'total', $total );
			$this->assign ( 'page', $show );
		}
		$scores_list = array ();
		if ($total > 0) {
			$scores_list = $scores->where ( $filter )->relation ( true )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		}
		$this->assign ( "scores_list", $scores_list );
		$this->display ( "scores_list" );
		//var_dump($scores_list);
	}
	/*
	 * 删除
	 */
	public function del() {
		
	}
	public function scoresExport(){
		$this->display("scores_export");
		
	}
	
	/**
	 * 导出成绩数据
	 */
	public function export(){
		$scores = M("Scores");
		$exam_id = I("exam_id","");
		$number = I("number","");
		$count = $scores->where($exam_id)->count();
		if($number>$count){
			$number = $count;
		}
		if($number == ""){
			$scores_list = $scores->select ();
		} else{
			$scores_list = $scores->order("score desc,use_time")->limit(0,$number)->select ();
		}
		
		$this->scores_export ( $scores_list );
	}
	

	// 导出数据方法
	protected function scores_export($scores_list = array()) {
		$data = array ();
		$data = $scores_list;
		$headArr = array ("编号","学号", "姓名","得分","用时","院系");
		$filename = "scores_list";
	
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