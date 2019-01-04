<?php
/**
 * excel 导出类
 *
 * @author  Lee<a605333742@gmail.com>
 * @date    2018-12-20
 */
namespace ext\excel;

class Excel {
   /**
    *处理Excel导出
    *@param $datas array 设置表格数据
    *@param $titlename string 设置head
    *@param $title string 设置表头
    */
    public function excelData($datas,$titlename,$filename){
        $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
        $str .="<table border=1><head>".$titlename."</head>";
        $str .= '';
        foreach ($datas as $key=> $rt ){
            $str .= "<tr>";
            foreach ( $rt as $k => $v ){
                $str .= "<td>{$v}</td>";
            }
            $str .= "</tr>\n";
        }
        $str .= "</table></body></html>";
        header( "Content-Type: application/vnd.ms-excel; name='excel'" );
        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=".$filename );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );
        exit( $str );
    }
}