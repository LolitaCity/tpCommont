<?php
/**
 * 节点管理
 * 
 * @author Lee<a605333742@gamil.com>
 * @time 2018-09-04
 */
namespace app\admin\controller;

class Node extends Common{
    protected $db;
    protected $listRows;
    protected $url_query='';
    protected $beforeActionList = [
        'beforeIndex'=>['only'=>'index']
    ];
    /*
     * 构造函数
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
        $this->listRows =input('listRows',20);        
    }
    
    /*
     * index前值方法
     * 
     * @return #
     */
    public function beforeIndex(){
        $map['status']  =1;
        $map['level']   =0;
        $topNoList      =db("Node")->where($map)->field('id,name')->select();
        $this->assign("topNoList",$topNoList);
    }
}