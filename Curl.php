<?php
namespace Common;

use \Exception;

/**
 * User: davin.bao
 * Date: 2017/9/14
 * Time: 17:50
 */
class Curl {

    public static function HttpGet($id, $uri = null){
        $url = $uri . '?id=' . $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        Recorder::request('ID_'. $id);
        $body = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        Recorder::response('ID_'. $id);

        if($httpCode > 199 && $httpCode < 299) {
            $bodyDecode = json_decode($body, true);
            return is_null($bodyDecode) ? $body : $bodyDecode;
        }else if($httpCode >99 && $httpCode < 600) {
            throw new Exception($body);
        }else if($httpCode == 0 || $body == false){
            throw new Exception("The test server can't connect");
        }

        throw new Exception($body, $httpCode);
    }

    public static function HttpPost($id, $params, $uri = null){
        $url = $uri . '?id=' . $id;
        $params_str = $params;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_str);

        Recorder::request('ID_'. $id);
        $body = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        Recorder::response('ID_'. $id);

        $body = json_decode($body);

        if($httpCode > 299) {
            throw new Exception($httpCode, $body->message);
        } else {
            return $body;
        }
    }
}