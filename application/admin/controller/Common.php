<?php
/**
 * 权限认证
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-31
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;

class Common extends Controller{
    public $auth;
    /*
     * 构造函数，继承父类构造函，数权限验证
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
        if(session(config('USER_AUTH_KEY')==NULL)||empty(session(config('USER_AUTH_KEY')))){
            $this->redirect('Auth/index');
        }        
        //权限验证
        if(strtolower(request()->controller())!='index'){
            $this->auth=new Auth();
            $nodeList= $this->auth->ckeckAuth();
            $nodes=array();
            foreach ($nodeList as $vo){
                $nodes[]=$vo['controller'];
            }
            if(!in_array(request()->controller(),$nodes)){
                //无权登录
            }
        }
    }    
    
}

