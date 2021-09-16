<?php
class Base
{
    function index()
    {
        session_start();
        if(!$_SESSION["token"]){
            echo json_encode(['code' => -1,'msg' => '请先登录!!!']);
            exit;
        }
    }
}
$Base = new Base();
echo $Base->index();