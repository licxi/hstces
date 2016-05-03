<?php
namespace home\Controller;
use Think\Controller;
class LoginController extends Controller {
    //后台登录页面
    public function index()
    {
    	$this->display(':login');
    }

    //检验用户登录信息是否正确
    public function check()
    {
        $student_id     = I('student_id', '');
        $password = I('password', '');

        $password = md5($password);

        $filter = array(
        		'student_id'	=> $student_id,
        		'password'		=> $password
        );

        $user_info = M('Users')->where($filter)->find();

        if($user_info){
            session('student_id',$student_id);
            session('user_name',$user_info['user_name']);
            $callback = U('home/index/index');
            $data = array(
            	'info' => 'ok',
            	'callback' => $callback
            );
        }else{
            $data = array(
                    'info' => '登录失败，请检查登录名和密码是否正确'
            );
        }

        $this->ajaxReturn($data);
    }

}