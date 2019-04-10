<?php
return array(
    'default_return_type'   => 'json',
    'exception_handle' => function($e) { 
	// 参数验证错误 
	return json(
        [
            'msg'=>'服务器异常，原因：'.$e->getMessage(),
            'code'=>'500',
            'result'=>'',
        ]
    );
    },
);