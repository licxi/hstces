<?php

namespace Admin\Controller;

use Think\Controller;

class ScoresController extends AuthController {
	public function _empty() {
		
	}
	/*
	 * 获取某次考试的参与考试的所得成绩
	 */
	public function getScores() {
		$exam_id = I ( "exam_id", "" );
		$key = I("key",-1);
		$title = M("Exams")->where(array("exam_id"=>$exam_id))->getField("title");
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
			$this->assign ( 'exam_id', $exam_id );
			$filter = array (
					"exam_id" => $exam_id 
			);
		}
		if($key != -1){
			$this->assign("key",$key);
			$filter["_query"] = "student_id=$key";
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
			$scores_list = $scores->where ( $filter )->order("score desc,use_time")->relation ( true )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		}
		foreach ($scores_list as $key => $score){
			if($score['family_difficulties']==1){
				$scores_list[$key]['family_difficulties']="是";
			}else{
				$scores_list[$key]['family_difficulties']="否";
			}
			if($score['support']==1){
				$scores_list[$key]['support']="是";
			}else{
				$scores_list[$key]['support']="否";
			}
			if($score['loan']==1){
				$scores_list[$key]['loan']="是";
			}else{
				$scores_list[$key]['loan']="否";
			}
		}
		$this->assign ( "scores_list", $scores_list );
		$this->display ( "scores_list" );
		//var_dump($scores_list);
	}
	/*
	 * 删除一条成绩
	 */
	public function del() {
		$score = M("Scores");
		$id = I("id",-1);
		$exam_id = I("exam_id",-1);
		if($id != -1 && $exam_id != -1){
			$where = array(
					"id"		=> $id,
					"exam_id"	=> $exam_id
			);
			$result = $score->where($where)->delete();
			if($result){
				$data = array(
						"info"	=> "ok",
						"msg"	=> "删除成功"
				);
			}else{
				$data = array(
						"info"	=> "error",
						"msg"	=> "删除失败"
				);
			}
		} else {
			$data = array(
					"info"	=> "error",
					"msg"	=> "未提供有效编号"
			);
		}
		$this->ajaxReturn($data);
	}
	
	
	public function scoresExport(){
		$this->display("scores_export");
		
	}
	
	/**
	 * 导出成绩数据
	 */
	public function export(){
		$exam_id = I ( "exam_id", "" );
		$key = I("key",-1);
		$title = M("Exams")->where(array("exam_id"=>$exam_id))->getField("title");
		$this->assign("title",$title);
		$scores = D ( "Scores" );
		$filter = array ();
		if ($exam_id && isset ( $exam_id )) {
			$this->assign ( 'exam_id', $exam_id );
			$filter = array (
					"exam_id" => $exam_id
			);
		}
		if($key != -1){
			$this->assign("key",$key);
			$filter["_query"] ="student_id=$key";
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
			$scores_list = $scores->where ( $filter )->order("score desc,use_time")->relation ( true )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		}
		foreach ($scores_list as $key => $score){
			if($score['family_difficulties']==1){
				$scores_list[$key]['family_difficulties']="是";
			}else{
				$scores_list[$key]['family_difficulties']="否";
			}
			if($score['support']==1){
				$scores_list[$key]['support']="是";
			}else{
				$scores_list[$key]['support']="否";
			}
			if($score['loan']==1){
				$scores_list[$key]['loan']="是";
			}else{
				$scores_list[$key]['loan']="否";
			}
			$scores_list[$key]['student_id']="'".$score['student_id'];
			$scores_list[$key]['exam_time']= date("Y-m-d H:i", $score['exam_time']);
		}
		//var_dump($scores_list);
		$this->scores_export ( $scores_list );
	}
	

	// 导出数据方法
	protected function scores_export($scores_list = array()) {
		$data = array ();
		$data = $scores_list;
		$headArr = array ("编号","学号","得分","用时","试卷编号","考试时间","姓名","家庭困难","受资助","贷款","院系编号","院系");
		$filename = "scores_list";
	
		$this->getExcel ( $filename, $headArr, $data );
	}
	private function getExcel($fileName, $headArr, $data) {
		// 导入PHPExcel类库，因为PHPExcel没有用命名空间，只能import导入
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