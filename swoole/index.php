<?php
include_once __DIR__ . "/config/databases.php";
use think\facade\Db;

$uid = $_GET['uid'];
$user = Db::table('im_user')->where(['uid' => $uid])->field('uid,is_black')->find();
if($user['is_black'] == 1){
    $user = $user['uid'];
    if($user === NULL){
        $user = Db::table("im_user")->insertGetId(['uid' => $uid]);
    }
    $service = Db::table("im_service")->where(['is_line' => 2])->field('uid,fd,serve_num')->select()->toArray();
    if(isset($service)){
        $service = Db::table("im_service")->field('uid,fd,serve_num')->select()->toArray();
    }
    $arr = array_column($service, 'serve_num');
    $min = min($arr);
    $sid = $service[array_search($min, $arr)]['uid'];
    include_once __DIR__ . "/app/info.php";
    $isMobile = \app\info::isMobile();
    Db::table('im_user')->where(['uid' => $user])->update(['sid' => $sid]);
    if($isMobile === 1){
        header("Location:./views/chat.html?uid={$user}&sid={$sid}");
    }else if($isMobile == 2){
        header("Location:./views/client.html?uid={$user}&sid={$sid}");
    }
    exit;
}
header("Location:./views/404.html");


