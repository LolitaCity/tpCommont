<?php
/**
 * phpinfo 显示
 * 
 * @author Lee<a605333742@gmail.com>
 * @date    2018-12-08
 */

namespace app\index\controller;

use think\Controller;

class Redis extends Controller{
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
    
    /**
     * redis 测试
     * 
     * @return #
     */
    public function testRedis1(){
        $redis=new \Redis();
        var_dump($redis);exit;
    }
    public function testRedis2(){
        var_dump(redis());exit;
    }
    public function testRedis3(){
        $redis= redis()->keys("*");
        var_dump($redis);exit;
    }
    public function testRedis4(){
        $redis= redis()->keys('name');
        var_dump($redis);exit;
    }
    public function testRedis5(){
        $redis= redis()->set('iphone','6sp');
        var_dump($redis);exit;
    }
    public function testRedis6(){
        $redis= redis()->get('iphone');
        var_dump($redis);exit;
    }
    public function testRedis7(){
        $model=new \ReflectionClass("redis");
        $redis= $model->getMethods();
        var_dump($redis);exit;
    }
    
    public function testRedis8(){
        
        $model=new \ReflectionClass("mysqli");
        $redis= $model->getMethods();
        var_dump($redis);exit;
    }
}