<?php
/**
 * 数据库备份
 *
 * @author Lee<a605333742@gmail.com>
 * @date 2018-10-23
 */
namespace app\admin\controller;
header('Content-type:text/html; charset=utf-8');
Header("Content-type:application/octet-stream");
header("Content-Disposition:attachment; filename=\"".date( 'Ymd_His').'.sql'."\"");
class Bak extends Common{
    /**
    *返回数据库中的数据表
    */
    protected function getTable(){
        $dbName=config('database.database');
        $result=\think\Db::query('show tables from '.$dbName);
        foreach ($result as $v){
            $tbArray[]=$v['Tables_in_'.config('database.database')];
        }
        return $tbArray;
    }

    public function index($db='',$sort='id',$sortBy=TRUE,$condition=NULL){
        $this->display();
    }

    public function backup(){
        $table  =$this->getTable();
        $struct =$this->bakStruct($table);
        $record =$this->bakRecord($table);
        echo $struct;
        echo $record;
    }

    /**
    *备份数据表结构
    */
    protected function bakStruct($array){
        $sql='';
        foreach ($array as $v){
            $tbName=$v;
            $result=  \think\Db::query('show columns from '.$tbName);
            $sql.="--\r\n";
            $sql.="-- 数据表结构: `$tbName`\r\n";
            $sql.="--\r\n\r\n";
            $sql.="create table `$tbName` (\r\n";
            $rsCount=count($result);
            foreach ($result as $k=>$v){
                $field  =$v['Field'];
                $type   =$v['Type'];
                $default=$v['Default'];
                $extra  =$v['Extra'];
                $null   =$v['Null'];
                if(!($default=='')){$default='default '.$default;}
                $null=($null=='NO')?'not null':'null';
                $key=($v['Key']=='PRI')?"primary key":'';
                if($k<($rsCount-1)){
                    $sql.="`$field` $type $null $default $key $extra ,\r\n";
                }else{
                    //最后一条不需要","号
                    $sql.="`$field` $type $null $default $key $extra \r\n";
                }
            }
            $sql.=")engine=innodb charset=utf8;\r\n\r\n";
        }
        return str_replace(',)',')',$sql);
    }

    /**
    *备份数据表数据
    */
    protected function bakRecord($array){
        $sql='';
        foreach ($array as $v){
            $tbName=$v;
            $rs=  \think\Db::query('select * from '.$tbName);
                if(count($rs)<=0){
                continue;
            }
            $sql.="--\r\n";
            $sql.="-- 数据表中的数据: `$tbName`\r\n";
            $sql.="--\r\n\r\n";
            foreach ($rs as $k=>$v){
                $sql.="INSERT INTO `$tbName` VALUES (";
                    foreach ($v as $key=>$value){
                        if($value==''){
                            $value='null';
                        }
                        $type=gettype($value);
                        if($type=='string'){
                            $value="'".addslashes($value)."'";
                        }
                        $sql.="$value," ;
                    }
                    $sql.=");\r\n\r\n";
            }
        }
        return str_replace(',)',')',$sql);
    }
}
