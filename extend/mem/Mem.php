<?php
/**
 * memcached 单例模式模型（三私一公）
 *
 * @author  Lee<a605333742@gmail.com>
 * @date    2018-12-18
 */
namespace ext\mem;

class Mem{
    public $memModel;
    private static $_instance;
    /**
     * 私有化构造函数
     *
     * @return #
     */
    private function __construct(){
        $this->memModel =new \Memcached();
        $this->memModel->addServer(config('memcached.host'),config('memcached.port'));
    }

    /**
     * 私有化克隆函数
     *
     * @return #
     */
    private function __clone(){}

    /**
     * 开放唯一的对外接口
     *
     * @return #
     */
    public static function memcached(){
        if(self::$_instance==NULL){
            self::$_instance=new self;
        }
        return self::$_instance->memModel;
    }
}