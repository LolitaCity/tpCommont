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

class Demo extends Controller{
    public $authV2;


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
        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = env('SINACALLBACKURL');
            try {
                $token = $this->authV2->getAccessToken( 'code', $keys ) ;
            } catch (\Exception $e) {}
        }
        if (!$token) {exit("授权失败");}
        $_SESSION['token'] = $token;
        setcookie( 'weibojs_'.$this->authV2->client_id, http_build_query($token) );
        
        $c = new SaeTClientV2(env("SINAAPPKEY"), env("SINAAPPSERCET"),$token['access_token'] );
        $ms  = $c->home_timeline(); // done
        $uid_get = $c->get_uid();
        $uid = $uid_get['uid'];
        $user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
        $this->assign("user_message",$user_message);
        $this->assign('ms',$ms);
        return $this->fetch();
    }
}