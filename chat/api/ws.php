<?php
include_once "databases.php";

use think\facade\Db;
use Swoole\WebSocket\Server;

$redis = new \Redis();
$redis->connect('127.0.0.1', 6379);

//创建WebSocket Server对象，监听0.0.0.0:9502端口
$ws = new Server('0.0.0.0', 9502);
$ws->set([
    "dispatch_mode" => 5,
    'daemonize' => true //守护进程运行
]);

//监听WebSocket连接打开事件
$ws->on('Open', function ($ws, $request) use($redis){
    $uid = $request->get['uid'];
    $ws->bind($request->fd, $uid);
    $redis->set($uid, $request->fd);
    $ws->push($request->fd, '{"msg": "连接成功"}');
});

//监听WebSocket消息事件
$ws->on('Message', function ($ws, $frame) use($redis){
    $chat = json_decode($frame->data, true);
    Db::table('im_chat')->insert($chat);
    $chat['create_time'] = date('Y-d-m H:i:s', time());
    $t_fd = $redis->get($chat['t_id']);
    $ws->push($frame->fd, json_encode($chat));
    $ws->push($t_fd, json_encode($chat));
});

//监听WebSocket连接关闭事件
$ws->on('Close', function ($ws, $fd) {
    echo "连接-{$fd} 关闭\n";
});

$ws->start();
