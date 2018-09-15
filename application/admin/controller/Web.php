<?php
/**
 * 网站信息管理
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-09-14
 */
namespace app\admin\controller;

class Web extends Common{
    /*
     * 构造函数
     * 
     * @return #
     */
     public function __construct(\think\App $app = null) {
        parent::__construct($app);
        
    }
    
    /*
     * 网站信息
     * 
     * @return webInfo
     */
    public function info(){
        $webInfo=db("Web")->where("status",'=',1)->find();
        $this->assign("webInfo",$webInfo);
        return $this->fetch();
    }
}