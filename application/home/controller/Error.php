<?php
/**
 * 默认空模块控制器操作
 *
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-27
 */
namespace app\home\controller;
use think\Controller;

class Error extends Controller{
    /*
     * 默认空操作
     */
    public function index(){
        echo "<img src='/static/admin/img/404.jpg' width='60%' style='text-align:center;'>";exit;
    }

    /*
     * Dwz默认错误操作
     *
     * @return #
     */
    public function _empty(){
        echo "<img src='/static/admin/img/404.jpg' width='60%' style='text-align:center;'>";exit;
    }
}
