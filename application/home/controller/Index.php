<?php
/**
 * 空模块测试
 * 
 * @author  Lee<a605333742@gamil.com>
 * @date    2019-01-02
 */

namespace app\home\controller;

use think\Controller;

class Index extends Controller{
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
        echo "<img src='/static/admin/img/404.jpg' width='60%' style='text-align:center;'>";exit;
    }
}