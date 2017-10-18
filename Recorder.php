<?php
namespace Common;

use HttpResponseException;

/**
 * User: davin.bao
 * Date: 2017/9/14
 * Time: 17:50
 */
class Recorder
{
    public static $dataPath = 'client_data.json';
    protected static $cache = [];

    public static function request($Id){
        static::$cache[$Id] = [
            'request' => static::microtime()
        ];
    }

    public static function response($Id){
        static::$cache[$Id]['response'] = static::microtime();
        static::put(static::$cache);
        static::$cache = [];
    }

    public static function all(){
        if(!file_exists(static::$dataPath)){
            static::put([]);
        }
        return json_decode(file_get_contents(static::$dataPath));
    }

    public static function put($value){
        if(file_exists(static::$dataPath)) {
            $cache = json_decode(file_get_contents(static::$dataPath));
        }else {
            $cache = [];
        }
        array_push($cache, $value);
        file_put_contents(static::$dataPath, json_encode($cache));
    }

    public static function microtime(){
        list($usec, $sec) = explode(" ", microtime());
        return $usec + $sec;
    }
}

