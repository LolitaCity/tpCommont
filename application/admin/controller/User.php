<?php
/**
 * 用户管理
 *
 * @author Lee<a605333742@gmail.com>
 * @date 2018-09-17
 */
namespace app\admin\controller;
use think\Db;

class User extends Common{
    protected $data;
    protected $beforeActionList = [
        'beforeShow'=>['only'=>'show'],
        'beforeDel' =>['only'=>'del'],
    ];
    /*
     * 构造函数
     *
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
        $this->data= input();
    }

    /*
     * 后台用户管理
     *
     * @return #
     */
    public function adminIndex(){
        $model  =db("Admin");
        $map    =$this->_search($model);
        $map[]  =['status','=',1];
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

    /**
     * 编辑用户，包括前台用户和后台用户，新增和修改
     *
     * @return #
     */
    public function edit() {
        if(isset($this->data['flag'])&&$this->data['flag']==1){
            // 后台用户编辑（新增和修改）
            if(isset($this->data['id'])&&!empty($this->data['id'])){
                //后台用户编辑
                Db::startTrans();
                //判断编辑后的用户名密码，手机，邮箱是否已经存在
                $isExists=db("Admin")
                            ->where(function($query){
                                $query->where('name','=',trim($this->data['name']))
                                        ->whereOr('tel','=',trim($this->data['tel']))
                                        ->whereOr('email','=',trim($this->data['email']));
                            })
                            ->where('id','<>',$this->data['id'])
                            ->find();
                if($isExists){
                    return json(jsonData('用户已存在',300));
                }
                $oldRole=db("AdminRole")->where('a_id','=', $this->data['id'])->value('role_id');
                if($oldRole!= $this->data['role_id']){
                    //说明有修改过权限
                    $map['role_id']= $this->data['role_id'];
                    if(!db("adminRole")->where('a_id','=', $this->data['id'])->update($map)){
                        Db::rollback();
                        return json(jsonData('参数错误，用户编辑失败',300));
                    }
                }
                $condition=array();
                //是否编辑密码
                if(isset($this->data['password'])&&!empty($this->data['password'])){
                    $condition['password']=md5(md5($this->data['password']));
                }
                $condition['id']        =trim($this->data['id']);
                $condition['nick_name'] =trim($this->data['nick_name'])??'';
                $condition['name']      =trim($this->data['name'])??'';
                $condition['tel']       =trim($this->data['tel'])??'';
                $condition['email']     =trim($this->data['email'])??'';
                $condition['edit_a_id'] =session("user.id");
                $condition['edit_time'] =time();
                try{
                    db("Admin")->update($condition);
                } catch (\Exception $e){
                    Db::rollback();
                    return json(jsonData($e->getMessage(),300));
                }
                Db::commit();
                return json(jsonData('用户编辑成功',201));
            }
            //后台用户新增
            //数据验证
            if(!isset($this->data['name'])||empty($this->data['name'])){
                return json(jsonData('用户名不能为空',300));
            }
            if(!isset($this->data['nick_name'])||empty($this->data['nick_name'])){
                return json(jsonData('昵称不能为空',300));
            }
            if(!isset($this->data['password'])||empty($this->data['password'])){
                return json(jsonData('密码不能为空',300));
            }
            if($this->data['password']!= $this->data['rnewPassword']){
                return json(jsonData('两次密码不一致，请重新输入',300));
            }
            $is_exists=db('admin')
                        ->where('name','=', $this->data['name'])
                        ->whereOr('tel','=',$this->data['tel'])
                        ->whereOr('email','=',$this->data['email'])
                        ->find();
            if($is_exists){
                Db::rollback();
                return json(jsonData('用户已存在',300));
            }
            $condition=array(
                'id'        =>trim($this->data['id']),
                'name'      =>trim($this->data['name']),
                'nick_name' =>trim($this->data['nick_name']),
                'password'  =>trim(md5(md5($this->data['password']))),
                'tel'       =>trim($this->data['tel']??''),
                'email'     =>trim($this->data['email']??''),
                'add_time'  =>time(),
                'add_a_id'  =>session("user.id"),
                'edit_a_id' =>session("user.id"),
                'edit_time' =>time()
            );
            try{
                $newId  =db("Admin")->insertGetId($condition);
            }catch(\Exception $e){
                Db::rollback();
                return json(jsonData($this->error($e),300));
            }
            //修改权限对应表
            $roleMap=array(
                'role_id'   =>$this->data['role_id'],
                'a_id'      =>$newId
            );
            if(!db('AdminRole')->insert($roleMap)){
                Db::rollback();
                return json(jsonData('参数错误，用户新增失败',300));
            }
            Db::commit();
            return json(jsonData('新增用户成功',201));
        }
        if(isset($this->data['id'])&&!empty($this->data['id'])){
            //前台用户编辑
        }
        //前台用户新增
    }

    /**
     * 删除用户
     *
     * @return bool
     */
    public function beforeDel(){
        $data= input();
        $id=$data['id'];
        if(!is_array($id)){
            $id=array(code($id));
        }
        if(in_array('1',$id)||in_array(session('authId'),$id)){
            return '不能删除超级管理员或者自己';
        }
        return TRUE;
    }
}
