<?php 

/**
 * 将文件的大小转换单位
 * @param int $file_size
 * @return string
 */
function size($file_size){
	if($file_size>(1024*1024)){
		$file_size = round($file_size/(1024*1024),2);
		return $file_size."MB";
	}else{
		$file_size = round($file_size/1024,2);
		return $file_size.'Kb';
	}
}