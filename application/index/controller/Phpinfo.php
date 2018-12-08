<?php
/**
 * phpinfo 显示
 * 
 * @author Lee<a605333742@gmail.com>
 * @date    2018-12-08
 */

namespace app\index\controller;

use think\Controller;

class Phpinfo extends Controller{
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * 显示PHPinfo信息
     * 
     * @return #
     */
    public function index(){
        phpinfo();exit;
    }
}