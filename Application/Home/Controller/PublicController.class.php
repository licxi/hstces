<?php
namespace Home\Controller;

use Think\Controller;
use Think\Verify;

/**
 * 一些公用的方法
 * @author liuce
 *
 */
class PublicController extends Controller
{

    public function index(){
    	
    }
    
    Public function code() {
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 16;
    	$Verify->length   = 5;
    	$Verify->imageH = 40;
    	$Verify->entry();
    }
    
    Public function check_verify($code,$id=""){
    	$verify = new Verify();
    	if($verify->check($code,$id)){
    		$data = array(
    			"info"	=> "ok",
    			"msg"	=> "验证成功"
    		);
    	}else{
    		$data = array(
    				"info"	=> "error",
    				"msg"	=> "验证码错误！"
    		);
    	}
    	$this->ajaxReturn($data);
    }
    
}