<?php

/**
 * 生成刷单列表
 */
require_once 'connet.php';
require_once 'api-auth.php';

use think\facade\Db;

// 手机校验
function is_mobile_phone($mobile_phone)
{
    $chars = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/";
    if (preg_match($chars, $mobile_phone)) {
        return true;
    }
    return false;
}

// 判断请求参数是否有效
if (!isset($_GET['phone']) || empty(trim($_GET['phone'])) || !is_mobile_phone(trim($_GET['phone']))) {
    echo json_encode(['code' => 1, 'msg' => '暂无数据']);die;
}
$phone = trim($_GET['phone']);
$elect = trim($_GET['elect']);

// 查找用户
$user = Db::table('sd_user')->where('phone', $phone)->find();

// 如果用户不存在则注册该用户
if (empty($user)) {
    Db::table('sd_user')->save(
        [
            'phone' => $phone,
            'num' => 0,
            'remark' => '',
            'create_time' => date('Y-m-d H:i:s', time())
        ]
    );
}

//判断是否根据自选分配
if($elect){ //随机
    // 获取所有链接
    $res_links = Db::table('sd_link')->field('id')->select()->toArray();

    $links = [];
    if (!empty($res_links)) {
        foreach ($res_links as $item) {
            array_push($links, $item['id']);
        }
    }

    // 获取用户已分配过的链接
    $user_links = Db::table('sd_matter')->where('user_phone', $phone)->field('link_id')->distinct(true)->select()->toArray();
    $user_link_ids = [];
    if (!empty($user_links)) {
        foreach ($user_links as $item) {
            array_push($user_link_ids, $item['link_id']);
        }
    }

    // 计算为分配过的链接
    $can_use_links = array_diff($links, $user_link_ids);

    // 链接随机分布
    shuffle($can_use_links);

    // 取出5个未分配的链接
    $gen_links = array_slice($can_use_links, 0, 5);

    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $links = json_decode($redis->get('links'),true);

    if(empty($links) || sizeof($links) > 5){
        $links = Db::table('sd_link')->select()->toArray();
        $redis->set('links',json_encode($links));
    }

    $user_links = [];
    foreach($links as $k => $v){
        foreach($gen_links as $key => $val){
            if($v['id'] == $val){
                $id = Db::table('sd_matter')->insertGetId([
                    'user_phone' => $phone,
                    'link_id' => $v['id'],
                    'shop_id' => $v['shop_id'],
                ]);
                $user_links[$k] = $v;
                $user_links[$k]['id'] = $id;
                unset($links[$k]);
            }
        }
    }

    $redis->set('links',json_encode($links));
}else{ //自选
    $shop_id = trim($_GET['shop_id']);
    //获取当前店铺的
    $shop = Db::table('sd_link')->where('shop_id',$shop_id)->field('id')->select()->toArray();

    $links = [];
    if (!empty($shop)) {
        foreach ($shop as $item) {
            array_push($links, $item['id']);
        }
    }

    // 获取用户已分配过的链接
    $user_links = Db::table('sd_matter')->where('user_phone', $phone)->field('link_id')->distinct(true)->select()->toArray();
    $user_link_ids = [];
    if (!empty($user_links)) {
        foreach ($user_links as $item) {
            array_push($user_link_ids, $item['link_id']);
        }
    }

    // 计算为分配过的链接
    $can_use_links = array_diff($links, $user_link_ids);

    if(empty($can_use_links)){
        echo json_encode(['code' => -1, 'msg' => '当前用户当月店铺链接已刷完']);return;
    }

    // 链接随机分布
    shuffle($can_use_links);

    // 取出5个未分配的链接
    $gen_links = array_slice($can_use_links, 0, 5);

    $links = Db::table('sd_link')->select()->toArray();
    $user_links = [];
    foreach($links as $k => $v){
        foreach($gen_links as $key => $val){
            if($v['id'] == $val){
                $id = Db::table('sd_matter')->insertGetId([
                    'user_phone' => $phone,
                    'link_id' => $v['id'],
                    'shop_id' => $v['shop_id'],
                ]);
                $user_links[$k] = $v;
                $user_links[$k]['id'] = $id;
                unset($links[$k]);
            }
        }
    }
}

echo json_encode(['code' => 0, 'msg' => 'success', 'data' => $user_links]);