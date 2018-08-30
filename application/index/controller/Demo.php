<?php
/**
 * 测试文件
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-28
 */
namespace app\index\controller;

class Demo{
    /*
     * 默认控制器
     * 
     * @return #
     */
    public function index($id='',$name=''){
        var_dump($id);
        var_dump($name);
        echo "这里是  　　index/Demo/index";exit;
    }
}