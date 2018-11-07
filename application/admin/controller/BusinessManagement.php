<?php
/**
 * 企业管理
 * @author Lee<a605333742@gmail.com>
 * @time    2018-111-01
 */
namespace app\admin\controller;

class BusinessManagement extends Common{
    /**
     * 构造函数
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }

    public function index($db='Admin',$sort='id',$sortBy=TRUE,$condition=['company_id','>',0]){
        $model  =db("Admin");
        $map    =$this->_search($model);
        $map[]  =['status','=',1];
        $map[]  =['company_id','>',0];
        $this->_list($model, $map);
        return $this->fetch();
    }

}