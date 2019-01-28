<?php
/**
 * 菜单管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-24
 */
namespace app\admin\controller;

use think\Db;
use app\admin\controller\Auth;

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
    
    /**
     * 编辑菜单
     * 
     * @return #
     */
    public function edit(){
        $data= array_filter(input());
        $model  =Db::name("Menu");
       // $model->startTrans();
        $parentInfo='';
        if(isset($data['p_id'])&&$data['p_id']!=false){
            $parentInfo =$model->where('id','=',$data['p_id'])->value('path');
        }
        if(isset($data['id'])&&$data['id']!=false){
            $result = parent::update();    
        }else{
            $result = parent::insert();
        }
        if($result['err']!==0){
            return json(jsonData($result['msg'],201));
        }
        $id=$data['id']??$result['data'];
        $map['path']    =$parentInfo?$parentInfo.$id."_":$id.'_';
        if(!Db::name("Menu")->where(['id'=>$id])->update($map)){
            $model->rollback();
            return json(jsonData("菜单编辑失败，请检查参数",301));
        }
        $model->commit();
        return json(jsonData("菜单编辑成功",201));
    }
    
}