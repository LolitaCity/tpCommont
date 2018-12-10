<?php
/**
 * redis 模型
 *
 * @author Lee<a605333742@gmail.com>
 * @date    2018-12-08
 */
namespace ext\redis;

class Redis extends \Redis{
    public static function redis() {
        $con = new \Redis();
        $con->connect(config('redis.host'), config('redis.port'),5);
        return $con;
    }
}