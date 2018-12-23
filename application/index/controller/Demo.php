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

    /**
     * 获取指定类的document注释
     *
     * @return #
     */
    public function getDocument(){
	$class=new Sms();
	$model2	=new \ReflectionObject($class);
	foreach ($model2->getMethods(\ReflectionMethod::IS_PUBLIC) as $vo){
	     /* @var $method ReflectionMethod */
	    if (substr($vo->getName(), 0, 1) !== '_') {
		$list[$vo->getName()] = array(
		    'description' => $vo->getDocComment(),
		    'parameters'  => $vo->getParameters(),
		);
	    }
	}
	ksort($list);
	$this->assign('list',$list);
        return $this->fetch();
//	var_dump($list);exit;
    }

    /**
     * 测试http
     *
     * @return #
     */
    public function testHttp(){
        
    }
}