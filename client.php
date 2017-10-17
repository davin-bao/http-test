<?php
/**
 * 使用方法
 * php client.php dms.test.com:80 10 10 post
 * 参数说明 服务器地址 用户数  每个用户的请求数 是否测试 post 请求
 */
if($argc < 4) exit('missing arguments');
$url = $argv[1];
$userCount = $argv[2];
$requestCount = $argv[3];
$post = $argc >= 5 ? 'true' : 'false';

while($userCount-- > 0){
    exec("php request.php $url $requestCount $post");
}


