<?php
/**
 * 测试文件
 *
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-28
 */
namespace app\index\controller;

use ext\sina\SaeTClientV2;
use ext\sina\SaeTOAuthV2;
use think\Controller;

class Demo extends Controller{
    /*
     * 默认控制器
     *
     * @return #
     */
    public function index(){
	$model=new SaeTClientV2();
	var_dump($model);exit;
    }
}