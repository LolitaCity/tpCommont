<?php
/**
 * redis 配置项
 *
 * @author Lee<a605333742@gmail.com>
 * @date 2018-12-08
 */

return [
    'host'  => env("REDISHOST",'180.76.190.150'),
    'port'  => env("REDISPORT",'6379'),
    'auth'  => env("REDISAUTH",''),
];