<?php
/**
 * 云之讯短信发送接口管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2018-12-08
 */

namespace app\index\controller;

use think\Controller;
use ext\sms\Ucpaas;

class Sms extends Controller{
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }
    
    /**
     * 显示短信发送
     * 
     * @return #
     */
    public function index(){
        return $this->fetch();
    }
    
    /**
     * 
     * 短信发送
     * 
     * @return bool
     */
    public function sends(){
        $time       =5;                   //验证码有效期
        $options    =['accountsid'=> env('SMSACCOUNTSID',''),'token'=> env('SMSTOKEN')];
        $ucpass     =new Ucpaas($options);
        $appid      =env("SMSAPPID");	//应用的ID，可在开发者控制台内的短信产品下查看
        $templateid =env("SMSTEMPLATEID");    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
        $param      =input('param',rand(100000,999999)).','.$time;  //生成验证码; 多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
        $mobile     =input("mobile",'13117766264');         //接受手机号码
        $uid = "";
        //70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
        $result = json_decode($ucpass->SendSms($appid,$templateid,$param,$mobile,$uid),TRUE);
        /*
         array(7) {
            ["code"]=>
            string(6) "000000"
            ["count"]=>
            string(1) "1"
            ["create_date"]=>
            string(19) "2018-12-08 16:40:05"
            ["mobile"]=>
            string(11) "13117766264"
            ["msg"]=>
            string(2) "OK"
            ["smsid"]=>
            string(32) "a6a9a15abfb26eb1eabe376b2a5fb80d"
            ["uid"]=>
            string(0) ""
        }
        */
        if(!$result['code']!='000000'){
            var_dump('失败');exit;
        }
        var_dump('成功');exit;

    }
}