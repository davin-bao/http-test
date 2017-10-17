<?php
require 'Curl.php';
require  'Recorder.php';
//php request.php dms.test.com:80 10 false
//php client.php 服务器地址 请求数 是否测试 post 请求
if($argc < 3) exit('missing arguments');
$url = $argv[1];
$requestCount = $argv[2];
$post = $argc >= 4 ? $argv[3] : 'false';

$handles = [];
$curl = new \Common\Curl();

while($requestCount-- > 0){
    if($post === 'false'){
        \Common\Curl::HttpGet(\Common\Recorder::microtime(), $url);
    }else {
        $img = file_get_contents('example.jpg');
        \Common\Curl::HttpPost(\Common\Recorder::microtime(), [
            'img' => $img
        ], $url);
    }
}


