<?php
/**
 * 用户管理
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-09-17
 */
namespace app\admin\controller;

class User extends Common{
    protected $beforeActionList = [
        'beforeShow'   =>['only'=>'show']
    ];
    /*
     * 构造函数
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }
    
    /*
     * 前台用户管理
     * 
     * @return #
     */
//    public function index($db = 'Admin', $sort = 'id', $sortBy = TRUE) {
//        parent::index($db, $sort, $sortBy, $where, $view);
//    }
    
    /*
     * 后台用户管理
     * 
     * @return #
     */
    public function adminIndex(){
        $model  =db("Admin");
        $map    =$this->_search($model);
        $this->_list($model, $map);
        return $this->fetch();
    }
    
    /*
     * 显示前置操作
     * 
     * @return #
     */
    public function beforeShow() {
        $map[]  =['status','=',1];
        if(session('authId')==1){
            $roleList   =db("Role")->where($map)->select();
        }else{
            $map[]  =['id','>',2];
            $roleList   =db("Role")->where($map)->select();
        }
        $this->assign("rlist",$roleList);
    }
}
