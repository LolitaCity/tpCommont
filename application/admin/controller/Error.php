<?php
/**
 * 默认空模块控制器操作
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-27
 */
namespace app\admin\controller;

class Error{
    /*
     * Dwz默认错误操作
     * 
     * @return #
     */
    public function _empty(){        
        echo "<img src='/static/admin/img/404.jpg' width='60%' style='text-align:center;'>";exit;
    }
}
