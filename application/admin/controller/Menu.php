<?php
/**
 * 菜单管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-24
 */
namespace app\admin\controller;

class Menu extends Common{
    protected $beforeActionList = [
        'beforeIndex'   =>['only'=>'show'],
        'beforeDel'     =>['only'=>'del']
    ];
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }
    
    /*
     * index前值方法
     *
     * @return #
     */
    public function beforeIndex(){
        $map[]  =['status','=',1];
        $map[]  =['level',"<",2];
        $menuList   =db("Menu")->where($map)->field('id,name,level')->select();
        $this->assign("menuList",$menuList);
    }
    
    /**
     * 菜单列表
     * 
     * @return #
     */
    public function index($db='Menu',$sort='path',$sortBy=TRUE,$condition=['id','>',0]){
        $model  =db("Menu");
        $map    =$this->_search($model);
        $map[]  =['status','=',1];
        $this->_list($model, $map);
        return $this->fetch();
    }
}