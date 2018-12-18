<?php
/**
 * memcached 测试
 *
 * @author  Lee<a605333742@gmail.com>
 * @date    2018-12-13
 */
namespace app\index\controller;

use think\Controller;

class Memcached extends Controller{
    /**
     * 构造函数
     *
     * @return #
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * 测试memcached
     *
     * @return #
     */
    public function index(){
        $memcache   =new \Memcache();
        $model  =new \ReflectionClass($memcache);
        $mem    = $model->getMethods();
        var_dump($mem);exit;
    }
}
