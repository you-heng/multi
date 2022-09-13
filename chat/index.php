<?php
include_once "api/databases.php";

use think\facade\Db;

$data = $_GET;

if(!empty($data)){
    /**
     * 查询判断当前用户是否存在
     * 如果用户存在就更新ip ua 等
     * 如果用户不存在就直接添加一条
     */
    $user = Db::table('im_consumer')->where('uid', $data['uid'])->field('id,uid')->find();
    if(empty($user)){
        Db::table('im_consumer')->insert([
            'uid' => $data['uid'],
            'ip' => $_SERVER['REMOTE_ADDR'],
            'ua' => $_SERVER['HTTP_USER_AGENT']
        ]);
    }else{
        Db::table('im_consumer')->where('uid', $user['uid'])->update([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'ua' => $_SERVER['HTTP_USER_AGENT']
        ]);
    }

    header("Location: http://mi.anmixiu.com/chat/template/chat.php?uid=". $user['uid'] . '&tid=' . $data['tid']);die;
}

echo "您访问的连接有误";
