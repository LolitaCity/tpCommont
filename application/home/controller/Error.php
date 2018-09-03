<?php
/**
 * 默认空模块控制器操作
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-27
 */
namespace app\home\controller;

class Error{
    /*
     * 默认空操作
     */
    public function index(){
        echo '不存在';exit;
    }
    
    /*
     * Dwz默认错误操作
     * 
     * @return #
     */
    public function _empty(){
        
        echo '我也不存在';exit;
    }
}
