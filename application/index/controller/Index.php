<?php
namespace app\index\controller;

use think\Db;
use app\index\model\Admin;
use think\Request;
use think\Controller;

class Index extends Controller
{
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }
    public function index()
    {
      return $this->fetch();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function routes(){
        echo "这是路由规则";exit;
    }

    public function redirectRoute(){
        echo '新的路由';
    }

    public function demo(){
        return func_get_args();
    }

}
