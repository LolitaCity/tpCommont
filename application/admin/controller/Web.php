<?php
/**
 * 网站信息管理
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-09-14
 */
namespace app\admin\controller;


class Web extends Common{
    protected $auth;
    /*
     * 构造函数
     * 
     * @return #
     */
     public function __construct(\think\App $app = null) {
        parent::__construct($app);
        $this->auth=new Auth();
    }
    
    /*
     * 网站信息
     * 
     * @return webInfo
     */
    public function info(){
        $webInfo=db("Web")->where("status",'=',1)->find();
        $this->assign("webInfo",$webInfo);
        return $this->fetch();
    }
    
    /*
     * 角色分配
     * 
     * @return #
     */
    public function role(){
        $model  =db("Role");        
        $map    = $this->_search($model);        
        $map[]  =['status','=',1];
        $map[]  =['id','<>',1];
        $this->_list($model,$map);       
        return $this->fetch();
    }
    
    /*
     * 权限列表
     * 
     * @return #
     */
    public function nodeList(){
        $map['status']  =1;
        $map['level']   =0;
        $map1['status'] =1;
        $map1['level']  =1;
        $noeNodeList=db('Node')->where($map)->select();          //顶级节点
        $twoNodeList=db('Node')->where($map1)->select();         //次级节点
        $roleList   =$this->auth->checkRole('',input("role_id",'','code')); 
        $roles      =array();
        foreach($roleList as $vo){
            $roles[]=$vo['node_id'];
        }
        $this->assign("oneList",$noeNodeList);
        $this->assign("twoList",$twoNodeList);
        $this->assign("rList",$roles);
        $this->assign("role_id",input("role_id",'','code'));
        return $this->fetch();
    }
    
    /*
     * 授权
     * 
     * @return #
     */
    public function addAuth(){
        if(!input("role_id") && !input("nodeId")){
            return json(jsonData('授权失败',301));
        }
        db("RoleNode")->where("role_id",'=',input("role_id"))->delete();       
        foreach(input("nodeId") as $vo){
            $map['role_id'] =input("role_id");
            $map['node_id'] =$vo;
            if(!db("RoleNode")->insert($map)){
               return json(jsonData('授权失败',301));
            }
        }
        session('nodeList_s',null);
        session('nodeList_t',null);
        return json(jsonData('授权成功',201));
    }
}