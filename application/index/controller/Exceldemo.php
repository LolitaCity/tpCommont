<?php
/**
 * 数据导出到Excel
 *
 * @author  Lee<a605333742@gmail.com>
 * @date    2018-12-20
 */
namespace app\index\controller;

use think\Controller;
use ext\excel\Excel;

class Exceldemo extends Controller{
    /**
     * 构造函数
     *
     * @return #
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * 测试Excel导出
     *
     * @return #
     */
    public function index(){
        $dataResult = array();      //todo:导出数据（自行设置）
        $headTitle = "XX保险公司 优惠券赠送记录";
        $title = "优惠券记录";
        $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>";
        $titlename = "<tr>
               <th style='width:70px;' >合作商户</th>
               <th style='width:70px;' >会员卡号</th>
               <th style='width:70px;'>车主姓名</th>
               <th style='width:150px;'>手机号</th>
               <th style='width:70px;'>车牌号</th>
               <th style='width:100px;'>优惠券类型</th>
               <th style='width:70px;'>优惠券名称</th>
               <th style='width:70px;'>优惠券面值</th>
               <th style='width:70px;'>优惠券数量</th>
               <th style='width:70px;'>赠送时间</th>
               <th style='width:90px;'>截至有效期</th>
           </tr>";
        $content='<tr>';
        for($i=1;$i<50;$i++){
            $content.="<td>AAA".$i."</td>";
            $content.="<td>BBB".$i."</td>";
            $content.="<td>CCC".$i."</td>";
            $content.="<td>DDD".$i."</td>";
            $content.="<td>EEE".$i."</td>";
            $content.="<td>FFF".$i."</td>";
            $content.="<td>GGG".$i."</td>";
            $content.="<td>HHH".$i."</td>";
            $content.="<td>TTT".$i."</td>";
            $content.="<td>VVV".$i."</td>";
            $content.="<td>KKK".$i."</td></tr>";
        }
        $filename = $title.".xls";
        $model   =new Excel();
        $model->excelData($dataResult,$titlename.$content,$headtitle,$filename);
    }

    /**
     * 上传Excel
     *
     * @return #
     */
    public function upExcel(){
        $filename  =strtr(env('ROOT_PATH'),'\\', '/').'public/static/upload/mh_log.xlsx';
        if(!is_file($filename)){
            echo '文件不存在';
        }
        require_once strtr(env("EXTEND_PATH"),'\\', '/').'demo/PHPExcel.php';
        require_once strtr(env("EXTEND_PATH"),'\\', '/').'demo/PHPExcel/IOFactory.php';
        require_once strtr(env("EXTEND_PATH"),'\\', '/').'demo/PHPExcel/Reader/Excel5.php';
        $model      =new \PHPExcel_IOFactory();
        $fileInfo   =pathinfo($filename);
        $objReader  =$model::createReader('Excel5');
        if($fileInfo['extension']=="xlsx"){
            $objReader  =$model::createReader('Excel2007');
        }
        $objPHPExcel = $objReader->load($filename); //$filename可以是上传的文件，或者是指定的文件
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $k = 0;
        var_dump($sheet);
        var_dump($highestRow);
        var_dump($highestColumn);

    }
}