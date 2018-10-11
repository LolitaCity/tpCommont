<?php
/**
 * 系统管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2018-09-16
 */
namespace app\admin\controller;

class System extends Common{
    /*
     * 构造函数
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }
    
    /*
     * 登录日志
     * 
     * @return #
     */
    public function loginLog(){
        self::log(0);
        return $this->fetch('log');
    }
    
    /*
     *  操作日志
     * 
     * @return #
     */
    public function optionLog(){
        self::log(1);
        return $this->fetch('log');
    }


    /*
     * 公共日志方法
     * 
     * @return #
     */
    public function log($type=0){
        $model  =db("Log");
        $map    =$this->_search($model);
        $map[]  =['type','=',$type];
        //按操作人查询
        if(input('userId')){
            $map[]=['user_id',"IN", implode(',',getIds(input('userId'),'name','Admin','id'))];
        }
        $this->assign('type',$type);
        $this->_list($model,$map);
    }
    
    /**
     * 清除缓存
     * 
     * @return #
     */
    public function delCache(){
        delDir(app()->getRuntimePath());
        if(is_empty_dir(app()->getRuntimePath().'cache/')==FALSE){
            return json(jsonData('缓存清理失败',300));
        }
        session('nodeList_s',null);
        session('nodeList_t',null);
        $content= session('user.name').'清除了缓存文件';
        $this->auth->addLog(1,'',$content);
        return json(jsonData('缓存清理成功',200));
    }
    
    /**
     * 修改自己的密码
     * 
     * @return #
     */
    public function changepwd(){
        if(input('newPassword')==''){
            return $this->fetch();
        }
        $userInfo= db("Admin")->find(session("authId"));
        if($userInfo['password']!=md5(input('oldPassword','','md5'))){
            return json(jsonData('原密码错误',300));
        }
        if(!db("Admin")->update(['id'=> session('authId'),'password'=>md5(input('newPassword','','md5'))])){
            return json(jsonData('密码修改失败',300));
        }
        cookie(null);
        session(null);
        session_destroy();
        $this->redirect('index');
        //return json(jsonData('密码修改成功',201));
    } 
}
