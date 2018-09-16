<?php
/**
 * 权限检查，登录控制
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-31
 */
namespace app\admin\controller;

use think\Controller;
use think\captcha\Captcha;

class Auth extends Controller{
    /*
     * 构造函数
     * 
     * @return # 
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }
    
    /*
     * 登录页面
     * 
     * @return #
     */
    public function index(){
        return  $this->fetch();
    }
    
    /*
     * 登录验证,账号密码,验证码
     * 
     * @return #
     */
    public function checkLogin(){ 
        if(config('CAPTCHA_ON')==1){
            $captcha= new Captcha();
            if(!$captcha->check(input('captcha'))){
                echo '验证码错误';exit; 
            }
        }  
        if(!input('username')){
            echo '用户名不能为空';exit; 
        }
        if(!input('password')){
            echo '密码不能为空';exit; 
        }
        $map['name|tel|email']=input('username');
        $userInfo= db('Admin')->where($map)->find();
        if(empty($userInfo)){
            echo '用户不存在';exit; 
        }
        if($userInfo['status']!=1){
            echo '用户状态异常';exit; 
        }
        if(md5(input('password'))!=$userInfo['password']){
            echo '用户名或密码错误';exit; 
        }
        unset($userInfo['password']);
        session(config('USER_AUTH_KEY'),$userInfo['id']);
        session('user',$userInfo);
        $updata=array(
            'inc'           =>$userInfo['inc']+1,
            'last_logintime'=>time(),
            'last_ip'       => $this->request->ip()=="::1"?"127.0.0.1":$this->request->ip(),
        );        
        if(!db("Admin")->where("id",'=',$userInfo['id'])->update($updata)){            
            session(null);
            cookie(null);
            echo '系统繁忙';exit; 
        }
        //登陆成功信息写入日志
        self::addLog(0);
        echo 1000;exit;
    }  
    
    /*
     * 添加日志
     * 
     * @param $type 标记 0表示登录日志，1表示操作日志
     * @param $db  操作的数据库
     * 
     * @return #
     */
    public function addLog($type=0,$db='',$content=''){
        $map=array(
            'user_id'   =>session('user.id'),
            'add_time'  =>time(),
            'type'      =>$type,
        );
        if($type==0){
            $ipInfo =ip2Area($this->request->ip());
            $map['content'] =session('user.name').' 登录成功';
            $map['ip']      =$this->request->ip();
            $map['addr']    =$ipInfo['province'].'-'.$ipInfo['city'];  
        }else{
            $map['db']      =$db;
            $map['content'] =$content;
        }
        if(db("Log")->insert($map)){
            return TRUE;
        }
        return FALSE;
    }
    
    /*
     * 检查用户角色,角色有的权限
     * 
     * @param   $u_id 用户id，根据id查询角色
     * @param   $role_id    角色id，直接查询角色
     * 
     * @return  
     */
    public function checkRole($u_id='',$role_id=''){
        if($role_id==''){
            $role_id    =db("AdminRole")->where(array("a_id"=>$u_id))->value("role_id");
        }
        $roleInfo       =db("Role")->find($role_id);
        if(!$roleInfo['status'] || $roleInfo['status']==2){
            return FALSE;
        }
        $node_ids   =db("RoleNode")->where(array("role_id"=>$roleInfo['id']))->column("node_id");
        return $node_ids;
    }
    
    /*
     * 权限检查
     * 
     * @param   $level  层级，存在表示查询二级目录
     * @param   $role_id角色id，查询该角色的权限    
     * 
     * @return #
     */
    public function ckeckAuth($level=0,$role_id=''){         
        if($level && session('nodeList_s')){
            return session('nodeList_s');
        }else if(($level=='' || $level==0) && session('nodeList_t')){
            return session("nodeList_t");
        }
        //默认admin拥有所有节点权限
        if(session(config('USER_AUTH_KEY'))!=1){
            $node=array();
            $nodes  =$this->checkRole(session("authId"),$role_id); 
            foreach($nodes as $vo){
                $node[]     =$vo['node_id'];
            }            
            $map[]      =['id'=>$node];
        }        
        $map[]  =['status','=',1];
        $map[]  =$level==2?['level','<',10]:['level','=',$level];
        $nodeList   =db("Node")->where($map)->order("ord asc")->select(); 
        $level?session('nodeList_s',$nodeList):session("nodeList_t",$nodeList);
        return $nodeList;
    }
    
    /*
     * 系统信息
     * 
     * @return #
     */
    public function systemInfo(){
        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            'ThinkPHP版本'=>\think\facade\App::version() ,
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
            );
        $this->assign('info',$info);
        return $this->fetch();
    }
    
    /*
     * 退出
     * 
     * @return #
     */
    public function loginOut(){        
        if (session(config('USER_AUTH_KEY'))!=NULL ||!empty(session(config('USER_AUTH_KEY')))) {
            cookie(null);
            session(null);
            session_destroy();            
            $this->redirect('index');
        } 
        return json(jsonData('已经登出！',300));
    }
    
    /*
     * 生成验证码
     * 
     * @return verify
     */
    public function verify()
    {
        $config =    [            
            'fontSize'  =>13,   // 验证码字体大小             
            'length'    => 4,   // 验证码位数
            'reset'     =>TRUE, //验证成功重置
            'fontttf'   =>'5.ttf',//验证码字体
            'imageH'    =>'25',
            'imageW'    =>'90',
            'useCurve'  =>FALSE,
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();    
    }
    
}
