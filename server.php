<?php
require 'Recorder.php';
mkdir('uploads');

$id =$_REQUEST['id'];
\Common\Recorder::$dataPath = 'server_data.json';
\Common\Recorder::request('ID_' . $id);

if(isset($_REQUEST['img'])){
    $img = $_REQUEST['img'];
    file_put_contents('uploads/' . $id. '.jpg', $img);
}else{
    sleep(rand(0,10));
}

\Common\Recorder::response('ID_' . $id);
var_dump(\Common\Recorder::microtime());


