<?php
return array(
    //'配置项'=>'配置值'
    'SESSION_AUTO_START'=> true,                    //是否自动开启Session
    'USER_AUTH_KEY'     =>'authId',                 //设置session的标记名称
    'AUTH_PWD_ENCODE'   =>'md5',                    //用户认证加密方式
    'AUTH_ON'           => true,                    //认证开关 
    'CAPTCHA_ON'        =>0,                    //是否开启验证码
    'VAR_PAGE'          =>'pageNum',            //设置分页参数名称,默认为p，如为p可不设置
    'AUTO_LOGIN_KEY'    =>md5('liyujin'),       //移位或加密密钥
    //自定义错误页面
    
);