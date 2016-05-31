<?php
namespace Home\Controller;
use Think\Controller;
class AuthController extends Controller {
    public function _initialize(){
        $student_id =  session('student_id');
        if(!$student_id){
            $this->redirect('home/Login/index');
        }
    }
}