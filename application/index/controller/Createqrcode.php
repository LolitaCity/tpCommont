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
	include env("EXTEND_PATH").'qr/Phpqrcode.php';
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
	$errorCorrectionLevel   = 'H';//容错级别
	$matrixPointSize        = 6;//生成图片大小
	$logo                   =$logoPath.'logo.jpg';//准备好的logo图片  需要加入到二维码中的logo
	//生成二维码图片
	$qrModel =new Phpqrcode\QRcode();
	$qrModel::png($value,$QR,$errorCorrectionLevel, $matrixPointSize,2);
	/*
	    第一个参数$text，就是上面代码里的URL网址参数，
	    第二个参数$outfile默认为否，不生成文件，只将二维码图片返回，否则需要给出存放生成二维码图片的路径
	    第三个参数$level默认为L，这个参数可传递的值分别是L(QR_ECLEVEL_L，7%)，M(QR_ECLEVEL_M，15%)，Q(QR_ECLEVEL_Q，25%)，H(QR_ECLEVEL_H，30%)。这个参数控制二维码容错率，不同的参数表示二维码可被覆盖的区域百分比。
	    利用二维维码的容错率，我们可以将头像放置在生成的二维码图片任何区域。
	    第四个参数$size，控制生成图片的大小，默认为4
	    第五个参数$margin，控制生成二维码的空白区域大小
	    第六个参数$saveandprint，保存二维码图片并显示出来，$outfile必须传递图片路径。
	 */
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
        echo '<img src='.$imgPath."qrLogoCode.png".'>';exit;
	return $logoQr;
    }
}