<?php
/**
 * 模拟http协议访问
 *
 * @author  Lee<a605333742gamil.com>
 * @date    2018-12-14
 */
use think\Controller;

class  Socket extends Controller{
    protected $http_tpye = 'HTTP/1.1';
    protected $url = '';
    protected $request_type = '';
    protected $lines = '';
    protected $fsoket_open = '';
    protected $port = '';
    protected $errstr = '';
    protected $timeout = 0;
    protected $parse_url = '';
    protected $content_type = '';
    protected $content_length = 0;
    protected $body = '';

    function __construct($url, $request_type = '', $port = 80, $timeout = 5)
    {
        $this->url = $url;
        $this->request_type = $request_type;
        $this->port = $port;
        $this->timeout = $timeout;
        $this->parse_url = parse_url($url);
        //链接
        $this->connect();

    }

    /*
     *设置请求行
     * */
    public function get()
    {
        $this->content_type = 'text/html';
        $this->lines = $this->request_type . ' ' . $this->parse_url['path'] . ' ' . $this->http_tpye;
        $this->request();
    }

    public function post($param)
    {
        //设置头信息
        $this->content_type = 'application/x-www-form-urlencoded';
        $data = $this->body_info($param);
        $this->content_length = strlen($data);
        $this->lines = $this->request_type . ' ' . $this->parse_url['path'] . ' ' . $this->http_tpye;
        $this->body = $data;
        $this->request();
    }

    public function request()
    {
        $getinfo = '';
        echo $this->lines . "\r\n" . implode("\r\n", $this->header_info()) . " \n\r\n" . $this->body;
        exit();
        //链接成功进行写入头信息
        fwrite($this->fsoket_open, $this->lines . "\n" . implode("\n", $this->header_info()) . "\n\r\n" . $this->body);
        while (!feof($this->fsoket_open)) {
            $getinfo .= fgets($this->fsoket_open, 1024);
        }
        fclose($this->fsoket_open);
        echo "以下是获取的信息：<br>" . $getinfo;
    }

    /*
     * 链接
     * */
    public function connect()
    {
        try {
            $this->fsoket_open = fsockopen($this->parse_url['host'], $this->port, $this->errstr, $this->timeout);
        } catch (Exception $exception) {
            echo 'connect is failed :' . $exception->getMessage() . 'r\n' . $this->errstr;
        }
    }

    /*
     * 设置头信息
     * */
    public function header_info()
    {
        return array(
            "Host:" . $this->parse_url['host'],
            "Content-type:" . $this->content_type,
            "Content-length:" . $this->content_length
        );
    }

    /*
     * 设置主体
     * */
    public function body_info($param)
    {
        // 生成 URL-encode 之后的请求字符串
        return http_build_query($param);
    }
}