<?php
/**
 * 二维码生成
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2018-12-08
 */
namespace app\index\controller;

use think\Controller;
use ext\qr\Phpqrcode;

class Createqrcode extends Controller{
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }
    
    /**
     * 二维码生成
     * 
     * @param   str $value 二维码生成内容
     * 
     * @return  str $qrPath 二维码保存地址
     */
    public function index(){
        $value      =input('map','http://www.baidu.com');
        $basePath   =env('ROOT_PATH').'public';
        $imgPath    ='/static/qrcode/'.date('Ymd',time()).'/';
        $qrCodePath =$basePath.$imgPath;
	if(!is_dir($qrCodePath)){
	    mkdir($qrCodePath,0777,true);
	}
	if(file_exists($qrCodePath.'qrLogoCode.png')){
            echo '<img src='.$imgPath."qrLogoCode.png".'>';exit;
	    return $qrCodePath.'qrLogoCode.png';
	}
	$QR         =$qrCodePath.'qrcode.png';//生成的原始二维码图
	$logoPath   =$basePath.'/static/logo/';
        if(!is_dir($logoPath)){
	    mkdir($logoPath,0777,true);
	}
	$errorCorrectionLevel   = 'L';//容错级别
	$matrixPointSize        = 6;//生成图片大小
	$logo                   =$logoPath.'logo.jpg';//准备好的logo图片  需要加入到二维码中的logo
	//生成二维码图片
        include env("EXTEND_PATH").'qr/Phpqrcode.php';
	$qrModel =new Phpqrcode\QRcode();
	$qrModel::png($value,$QR,$errorCorrectionLevel, $matrixPointSize,2);
	if ($logo !== FALSE) {
	    $QR =imagecreatefromstring(file_get_contents($QR));
	    $logo =imagecreatefromstring(file_get_contents($logo));
	    $QR_width = imagesx($QR);//二维码图片宽度
	    //$QR_height = imagesy($QR);//二维码图片高度
	    $logo_width = imagesx($logo);//logo图片宽度
	    $logo_height = imagesy($logo);//logo图片高度
	    $logo_qr_width = $QR_width /4;
	    $scale = $logo_width/$logo_qr_width;
	    $logo_qr_height = $logo_height/$scale;
	    $from_width = ($QR_width - $logo_qr_width) / 2;
	    //重新组合图片并调整大小
	    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);
	}
	//输出图片
	$logoQr=$qrCodePath.'qrLogoCode.png';
        imagepng($QR,$logoQr);
//        <img src="/static/admin/dwz/themes/default/images/login_banner_.jpg" />
        echo '<img src='.$imgPath."qrLogoCode.png".'>';exit;
	return $logoQr;
    }
}