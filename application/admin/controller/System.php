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
}
