<?php
/**
 * tp5测试
 *
 * @author  Lee<a605333742@gmail.com>callable
 * @date    2018-12-10
 */
namespace app\index\controller;

use think\Controller;

class Demo extends Controller{
    /**
     * 构造函数
     *
     * @return #
     */
    public function __construct(){
	parent::__construct();
    }

    /**
     * 显示phpInfo
     *
     * @return #
     */
    public function index(){
	phpinfo();
    }
}