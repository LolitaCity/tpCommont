<?php
/**
 * 工具类
 * 
 * @author Lee<a605333742@gmail.com>
 * @date    2019-02-25
 */
namespace ext\tool;

use think\Validate;

class Tools{
    /**
     * 数据验证
     * 
     * @param array $item 需要验证的数据
     * @param array $rule 验证规则
     * @param array $message 验证提示信息
     * 
     * @return #
     */
    public static function validate($item,$rule,$message){
        if(!is_array($item) || !is_array($rule)||!is_array($message)){
            //抛出异常
        }
        $validate   = Validate::make($rule);
        $validate->check($item);
        $err=$validate->getError();
        if($err){
            //抛出异常,（应该抛出异常）
            return $err;
        }
        return array_intersect_key($item, $rule);
    }
    
    public static function json($data){
        return [
            'err'   =>0,
            'msg'   =>'ok',
            'data'  =>$data
        ];
    }
    
}