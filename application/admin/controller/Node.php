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
        'beforeIndex'   =>['only'=>'index,show'],
        'beforeDell'    =>['only'=>'del']
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
    
    /*
     * ajax查询控制器名称并返回控制器
     * 
     * @return array $controlName
     */
    public function ajaxControl(){
        return  db("Node")->where('id','=',input('pid','int'))->value('controller');
    }
    
    /*
     * 编辑节点操作
     * 
     * @return #
     */
    public function edit(){
        if(!input('id')){
            $addNodeNewId= Common::insert();
            $path   =self::changPath($addNodeNewId,input('p_id'));
            if($path){
                session('nodeList_s',null);
                session('nodeList_t',null);
                return json(jsonData("节点新增成功",201));
            }
            return json(jsonData("节点新增失败",301));
        }        
        if(Common::update()==FALSE){
            return json(jsonData('节点编辑失败',301));
        }        
        if(self::changPath(\input("id"),\input("p_id"),1)){
            session('nodeList_s',null);
            session('nodeList_t',null);
            return json(jsonData("节点编辑成功",201));
        }
        return json(jsonData('节点编辑失败',301));
    }
    
    /*
     * 路径修改
     * 
     * @param int $id 节点id
     * @param int $p_id 父节点id
     * @param int $sing 判断是否为修改
     * 
     * @return 
     */
    public function changPath($id,$p_id='0',$sign=''){
        //$sign判断是否为修改，如果为修改，查询是否修改路径
        if(!$sign){
            $map['add_time']=time();
            $map['add_a_id']=session("user.id");
        }
        $map['edit_time']   =time();
        $map['edit_a_id']   =session("user.id");
        $map['path']  =$p_id?db("Node")->where('id','=',$p_id)->value('path').$id.'_':$id.'_';         
        return db('Node')->where('id','=',$id)->update($map);
    }
    
    /*
     * 节点删除前判断是否为顶级节点，是否存在子节点
     * 
     * @return #
     */
    public function beforeDell(){
        $id= is_array(input('id'))?input('id'):array(input('id','','code'));
        //提取顶级节点ID
        $condition['id']    =$id;
        $condition['status']=1;
        $condition['level'] =0;
        $topIds =db('Node')->where($condition)->column('id');
        if(count($topIds)==0){return TRUE;}
        //删除的节点带有顶级节点
        $where['status'] =1;
        foreach ($topIds as $vo){
            $where['p_id']  =$vo;
            $twoIds =db('Node')->where($where)->column('id');
            if(count($twoIds)==0){return TRUE;}
            if(!empty(array_diff($twoIds, $id))){
                return '节点 '.getNodeName($vo).' 存在子节点，请先删除子节点';
            }
            return TRUE;
        }
    }


    /*
     * 节点删除成功后续操作，删除缓存
     * 
     * @return #
     */
    public function del() {
        $result=parent::del()->getdata();
        if(isset($result['statusCode'])&&$result['statusCode']==200){
            session('nodeList_s',null);
            session('nodeList_t',null);
            return json(jsonData($result['message']));
        }
        return json(jsonData($result['message'],300));
    }
}