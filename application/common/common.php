<?php
/**
 * 公共函数库
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-31
 */

if(!function_exists('ip2Area')){
    /*
     * 根据ip获取ip归属地区信息
     *
     * @param string $ip  输入的ip
     * 
     * @return #
     */
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
