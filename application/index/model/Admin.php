<?php
/**
 * 管理员管理模型
 *
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-29
 */
namespace app\index\model;

use think\Model;

class Admin extends Model{
    public $name;

    public function jsonSerialize() {

    }
}
