<?php
/**
 * 后台首页
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date 2018-08-31
 */

namespace app\admin\controller;

class Index extends Common{
    protected $db;
    protected $listRows='listRows';
    protected $authModel;    
    /*
     * 构造函数
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
        input($this->listRows,100);
        $this->db   = db('Node');
        $this->authModel=new Auth();
    }
    /*
     * 构造函数
     * 
     * @return #
     */
    public function index($db="Node",$sort='id',$sortBy=false){
        $oneNodeList=$this->authModel->ckeckAuth();
        $twoNodeList=$this->authModel->ckeckAuth(1);
        $this->assign("oneNodeList",$oneNodeList);
        $this->assign("twoNodeList",$twoNodeList);
        return $this->fetch();
    }
}