<?php
/**
 * memcached 一致性hash测试
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2018-12-15
 */
namespace app\index\controller;

use think\Controller;
use ext\mem\Mem;

class Memc extends Controller{
    
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }
    
    /**
     * 首页测试
     * 
     * @return #
     */
    public function index(){
        // 使用测试-----start
        $con = new Mem();
        //比如配置文件 $memServerConfArr = ['168.10.1.7:5566','168.10.1.2:7788','168.10.1.72:8899']
        $memServerConfArr= array('168.10.1.7:5566','168.10.1.2:7788','168.10.1.72:8899');
        foreach ($memServerConfArr as $mem_config) {
            $con->addNode($mem_config);//添加节点
        }
        $key = 'www.lashou.com';
        $key2= '014f';
        $memNode= $con->findNode($key2);
        //echo($memNode);die();  测试落到 168.10.1.7:5566这个节点上
        $mem = explode(':', $memNode);
        $host = $mem[0];
        $port = $mem[1];
        $memcache= new Memcached();
        $memcache->connect($host, $port);
        $memcache->set($key, 'test_string', MEMCACHE_COMPRESSED, 50);
    }
    
    /**
     * memcached 链接测试
     * 
     * @return #
     */
    public function memTest1(){
        var_dump(memcached());exit;
    }
    
    public function memTest2(){
        $mem=new \Memcached();
        $mem->addServer(config('memcached.host'), config('memcached.port'));
        var_dump($mem);exit;
    }
    
    public function memTest3(){
        $mem=new \Memcached();
        $mem->addServer('127.0.0.1','11211');
        var_dump($mem);exit;
    }
    
    public function memTest4(){
        $model  =new \ReflectionClass("memcached");
        $method =$model->getMethods();
        var_dump($method);exit;
    }
    
    public function memTest5(){
        $mem    =new \Memcached();
        $model  =new \ReflectionClass($mem);
        $method =$model->getMethods();
        var_dump($method);exit;
    }
    
}