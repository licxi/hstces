<?php
namespace Admin\Controller;
use Think\Controller;
class AuthController extends Controller {
    public function _initialize(){
        $admin_id =  session('admin_name');
        if(!$admin_id){
            $this->redirect('Admin/Login/index');
        }
    }
}