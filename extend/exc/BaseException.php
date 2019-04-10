<?php
namespace ext\exc;

use Exception;
use think\exception\Handle;

class BaseException extends Handle
{
    public function render(Exception $e)
    {
        $data   =[
            'err'   =>$e->getCode(),
            'msg'   =>$e->getMessage()
        ];
        var_dump(json($data));exit;
        return json($data);
    }

}
