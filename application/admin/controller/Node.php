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
        'beforeIndex'=>['only'=>'index,show']
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
    
    public function del() {
        $result=parent::del();        
        //$data="'".$result."'";
        var_dump($result->contentType);exit;
        //var_dump($result->data());exit; 
        //var_dump($result->data);exit; 
        var_dump(json_decode($data));exit;         
        //var_dump($result->toArray());exit;         
        
        session('nodeList_s',null);
        session('nodeList_t',null);
        
    }
}