<?php
/**
 * redis 单例模式redis模型(三私一共)
 *
 * @author Lee<a605333742@gmail.com>
 * @date    2018-12-08
 */
namespace ext\redis;

class Redis{
    public $redisModel;
    private static $_instance;
    /**
     * 私有化构造函数
     *
     * @return \Redis
     */
    private function __construct() {
        $this->redisModel   =new \Redis();
        $this->redisModel->pconnect(config('redis.host'), config('redis.port'),5);
	$this->redisModel->auth(config('redis.auth'));
    }
    /**
     * 私有化clone函数
     *
     * @return #
     */
    private function __clone() {}

    /**
     * 开放唯一静态入口函数
     *
     * @return #
     */
    public static function redis() {
        if(self::$_instance ==NULL){
            self::$_instance =new self;
        }
        return self::$_instance->redisModel;
    }
}