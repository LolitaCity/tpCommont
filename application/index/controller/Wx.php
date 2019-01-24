<?php
/**
 * 微信测试
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-14
 */
namespace app\index\controller;

use think\Controller;
use EasyWeChat\Factory;

class Wx extends Controller{
     //微信参数
    protected $app_id   ="wx927b20872844e740";
//    protected $secret   ="LDPpsBzLOqo6dVjfGj2wWXYZHa9UdcO7";
    protected $secret   ="5efeb59bdcd043012d48634c3aa35edb";
    protected $api_key  ="LDPpsBzLOqo6dVjfGj2wWXYZHa9UdcO7";
    protected $wxConfig =array();
    protected $response_type="array";
    protected $cert_path;    
    protected $key_path;    
    protected $wxApp;
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
        $this->wxConfig = [
            'app_id' => $this->app_id,
            'secret' => $this->secret,
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => $this->response_type,
        ];
        $this->wxApp= Factory::officialAccount($this->wxConfig);
    }
    
    /**
     * 测试
     * 
     * 
     */
    public function index(){
        $appid='wx927b20872844e740';
        $redirect_uri =urlencode('http://work.nat300.top/index/wx/getinfo');
        $url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
        header("Location:".$url);
    }
    
    /**
     * 获取用户信息
     * 
     * @return #
     */
    public function getinfo(){
        $appid = "wx927b20872844e740";  
        $secret = "5efeb59bdcd043012d48634c3aa35edb";  
        $code = $_GET["code"];
        file_put_contents('code.log',json_encode($code));
        //第一步:取全局access_token
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
        $token = self::getJson($url);
        file_put_contents('token.log',json_encode($token));
        //第二步:取得openid
        $oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
        $oauth2 = self::getJson($oauth2Url);
        file_put_contents('oauth2.log',json_encode($oauth2));
        //第三步:根据全局access_token和openid查询用户信息  
        $access_token = $token["access_token"];  
        $openid = $oauth2['openid'];  
        $get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
        $userinfo = self::getJson($get_user_info_url);
        file_put_contents('userinfo.log',json_encode($userinfo));
        //打印用户信息
        print_r($userinfo);
    }
    
    public function getJson($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }
    
    
    /**
     * 发起授权
     * 
     * @return #
     */
    public function auth(){ 
        session(Null);
        $this->wxConfig['oauth']=[
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '/index/Wx/oauthCallback',
        ];
        $this->wxApp=Factory::officialAccount($this->wxConfig);
        $oauth  =$this->wxApp->oauth;
        if (empty(session('wechat_user'))) {
           session("target_url",'/index/Wx/profile/id/9999');
            return $oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
          }
          // 已经登录过
           echo '<pre/>';
          $user = session('wechat_user');
          var_dump($user);exit;
    }
    
    /**
     * 回调
     */
    public function oauthCallback(){
        $this->wxApp=Factory::officialAccount($this->wxConfig);
        $oauth = $this->wxApp->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        session('wechat_user',$user->toArray());
        file_put_contents("userinfo.txt", json_encode(session('wechat_user')));
        echo '<pre/>';
        var_dump(session("wechat_user"));exit;
        
//        $targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];
//        header('location:'. $targetUrl); // 跳转到 user/profile
    }
    
    
    /**
     * 需要授权访问
     * 
     * @return #
     */
    public function profile(){
        $a='{"id":"ouXMO1EJJT5tAwBxHfaBXgGaiWPc","name":"Lee","nickname":"Lee","avatar":"http:\/\/thirdwx.qlogo.cn\/mmopen\/vi_32\/PH3I8XibiaaCzg5NgD1HtNberkjfqANaXppkiaEAbhdRj01MlX7ianlM6uIaLYRu5fGv7QLGSmgoPMuqI8BDTiavBYQ\/132","email":null,"original":{"openid":"ouXMO1EJJT5tAwBxHfaBXgGaiWPc","nickname":"Lee","sex":1,"language":"zh_CN","city":"\u6df1\u5733","province":"\u5e7f\u4e1c","country":"\u4e2d\u56fd","headimgurl":"http:\/\/thirdwx.qlogo.cn\/mmopen\/vi_32\/PH3I8XibiaaCzg5NgD1HtNberkjfqANaXppkiaEAbhdRj01MlX7ianlM6uIaLYRu5fGv7QLGSmgoPMuqI8BDTiavBYQ\/132","privilege":[]},"token":"17_fspoapIaqqD_qz56fY_Iatu0rC61xpagLTecQtd18NUvDFDw4N_ShIltpiI36WjYvJ3FSgdiEfL1BmQ0zQEPqIJpT_Sx22ATTPCfayI3dAY","provider":"WeChat"}';
        
        echo '<pre/>';
        var_dump(json_decode($a));exit;
//        var_dump(\GuzzleHttp\json_decode($a,true));exit;
    }
}