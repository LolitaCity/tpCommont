<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 公共函数库
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-31
 */
use think\Db;

/*
 * 根据ip获取ip归属地区信息
 *
 * @param string $ip  输入的ip
 * 
 * @return #
 */
if(!function_exists('ip2Area')){    
    function ip2Area($ip='113.102.163.199'){
        if ($ip=='127.0.0.1' || $ip=="::1" || substr($ip,0,3)=='192' ||substr($ip,0,3)=='10.') {
            $ip ='113.102.163.199'; //深圳
        }       
        $url    ="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
        $data   =file_get_contents($url);
        $obj    =json_decode($data);
        $code   =$obj->code;
        if ($code != 0) {
            //没有查到默认返回深圳地区的信息
            return array(
                'id' => '440300',
                'province' => '广东',
                'city' => '深圳',
                'area' => '华南',
            );
        }
        $obj2       =$obj->data;        //综合地址信息 
        $country    =$obj2->country;    //国家     
        $area       =$obj2->area;       //地区
        $province   =$obj2->region;     //省
        $city       =$obj2->city;       //城市 
        $county     =$obj2->county;     //区/县
        $isp        =$obj2->isp;        //运营商
        $ip         =$obj2->ip;

        $country_id =$obj2->country_id; //国家代码
        $area_id    =$obj2->area_id;    //地区代码
        $city_id    =$obj2->city_id;    //城市代码
        $province_id=$obj2->region_id;  //省份代码
        $isp_id     =$obj2->isp_id;     //营运商代码
        $province   =str_replace('省',"", $province);
        if(strpos("市",$province)){            
            $province   =str_replace('市',"", $province);
        }
        $city       =str_replace("市","", $city);
        if(empty($county)){
            $county     =str_replace("县","", $county);
            if(strpos("区",$city)){
                $county =str_replace("区","", $county);
            } 
        }             
        $areaInfo['id']         = $area_id;
        $areaInfo['country']    =$country;
        $areaInfo['area']       = $area;
        $areaInfo['province'] 	= $province;
        $areaInfo['city']       = $city;
        $areaInfo['county'] 	= $county;
        $areaInfo['ip'] 	= $ip;
        $areaInfo['isp'] 	= $isp;
        return $areaInfo;
    }
}
    
 /*
  * 根据id查询用户角色
  * 
  * @param user_id   用户id
  * 
  * @return $rName
  */
if(!function_exists('getAdminRole')){
    function getAdminRole($user_id=''){
        if($user_id==''){
            return '';
        }
        return Db::name("AdminRole")
                ->alias('a')
                ->join('Role r','r.id=a.role_id')
                ->where(array("a.a_id"=>session(config('USER_AUTH_KEY'))))
                ->value('r.name');
    }
}

/*
 * 根据节点id获取节点名
 * 
 * @param   $node_id    节点id
 * 
 * @return  str $nodeName
 */
if(!function_exists('getNodeName')){
    function getNodeName($node_id=''){
        if($node_id=="" ||$node_id==0){
            return "顶级节点";
        }
        return Db::name('Node')->where(array("status"=>1,'id'=>$node_id))->value('name');
    }
}

/*
 * 异位或加密解密
 * 
 * @param   $value  加密的字符
 * @param   $type   标志，true为加密，false为解密，默认为解密
 * 
 * $return  str
 */
if(!function_exists('code')){
    function code($value,$type=''){
        $key    =md5(config('AUTO_LOGIN_KEY'));
        $md5str =md5(rand(1,100000));
        if($type){
            //加密
            return strtoupper(substr($md5str,0,6)).str_replace("=",'',base64_encode($value ^ $key)).strtoupper(substr($md5str,rand(0,31),1));
        }
        //解密
        $value	=base64_decode(substr(substr($value,6),0,strlen(substr($value,6))-1));
        return  $value;
    }
}

/*
 * Json弹窗返回数据参数
 * 
 * @param str $content 弹窗内容
 * @param int $status  状态，默认200 ，提示成功，不带关闭
 * @param int $status  状态，201，提示成功，带关闭
 * @param int $status  状态，300，提示失败，不带关闭
 * @param int $status  状态，301，提示失败，带关闭
 * 
 * @return array $data;
 */
if(!function_exists('jsonData')){
    function jsonData($content='操作成功',$status=200){
        $data['statusCode']     =200;
        $data['message']        =$content;  
        $data['callbackType']   =($status==201)?"closeCurrent":'';
        $data['statusCode']     =($status==300)?300:200;
        if($status==301){
            $data['callbackType']   ="closeCurrent";
            $data['statusCode']     =300;
        }
        return $data;
    }
}
