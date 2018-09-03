<?php
return array(
    //'配置项'=>'配置值'
    'SESSION_AUTO_START'=> true,                    //是否自动开启Session
    'USER_AUTH_KEY'     =>'authId',                 //设置session的标记名称
    'AUTH_PWD_ENCODE'   =>'md5',                    //用户认证加密方式
    'AUTH_ON'           => true,                    //认证开关 
    'CAPTCHA_ON'        =>1,                    //是否开启验证码
    //自定义错误页面
    'TMPL_ACTION_ERROR'     =>  'Public/error', 	
    
);