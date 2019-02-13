<?php
/**
 * 测试文件
 *
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-28
 */
namespace app\index\controller;

use ext\sina\SaeTClientV2;
use ext\sina\SaeTOAuthV2;
use think\Controller;

class Sina extends Controller{
    public $authV2;
    public $content;

    /**
     * 构造函数
     *
     * @return #
     */
    public function __construct(){
        parent::__construct();
        $this->authV2   =new SaeTOAuthV2(env("SINAAPPKEY"), env("SINAAPPSERCET"));
    }


    /**
     * 默认控制器
     *
     * @return #
     */
    public function index(){
        $code_url   =$this->authV2->getAuthorizeURL(env('SINACALLBACKURL'));
	$this->assign("code_url",$code_url);
        return $this->fetch();
    }

    /**
     * 回掉页面
     *
     * @return #
     */
    public function callback(){
	$token=session('token');
	if(!$token){
	    if (input('code')==NULL) {$this->error("授权失败");}
	    $keys = array();
	    $keys['code'] =input('code');
	    $keys['redirect_uri'] = env('SINACALLBACKURL');
	    $token = $this->authV2->getAccessToken( 'code', $keys ) ;
	    if (!$token) {$this->error("授权失败");}
	    session('token',$token);
	    setcookie( 'weibojs_'. $this->authV2->client_id, http_build_query($token) );
	}
        $c = new SaeTClientV2(env("SINAAPPKEY"), env("SINAAPPSERCET"),$token['access_token'] );
        $ms  = $c->home_timeline(); // done
        $uid_get = $c->get_uid();
        $uid = $uid_get['uid'];
        $user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
        $this->assign("user_message",$user_message);
        $this->assign('ms',$ms);
        return $this->fetch();
    }

    /**
     * 发送微博
     *
     * @param str $map微博内容
     *
     * @return bool
     */
    public function  sendWeibo(){
	if(input('text')==NULL){
	    $this->error('微博内容不能为空');
	}
	$clientModel=new SaeTClientV2(env("SINAAPPKEY"), env("SINAAPPSERCET"),session('token.access_token'));
	$sendweibo	=$clientModel->share(input('text').'| http://www.titmom.com');
	if(isset($sendweibo['error_code'])&&$sendweibo['error_code']>0){
	    echo "微波发送失败,",$sendweibo['error_code'].':'.$sendweibo['error'];exit;
	}
	$this->success("微博发送成功","Sina/callback");
    }

    /**
     * 类反射对象
     *
     * @return #
     */
    public function getMethod1(){
	$model	=new \ReflectionClass($this->authV2);
	$SaeTClientV2= $model->getMethods();
	$doc	=$model->newInstance();
	//var_dump($SaeTClientV2);exit;
	var_dump($doc);exit;
    }

    public function getMethod2(){
        $model=new \ReflectionClass("SaeTOAuthV2");
        $SaeTClientV2= $model->getMethods();
        var_dump($SaeTClientV2);exit;
    }
}