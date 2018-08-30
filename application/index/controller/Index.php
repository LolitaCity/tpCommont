<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use app\index\model\Admin;
use think\Request;

class Index extends Controller
{
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
    }
    public function index()
    {
        $admin= Admin::find(1);
        //dump($admin->append(['status_text'])->toArray());
        //dump($admin->append(['name'])->toArray());
        //dump($sql);exit;
        $requset= self::demo('2',3,'OOP');
        var_dump($requset);
        exit;
        
        $a=array('x'=>222,'c'=>333,'f'=>array(555,666,'b'=>'xcv'));
        $x=array('bx'=>2,"o"=>'dC','Dc'=>666);
        dump(array_change_key_case($x));exit;
        
        
        exit;
        $this->a=222;
        //$this->assign('a',$this->a);
        return $this->fetch();
        //echo "thinkphp5.1";exit;
        //return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
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
