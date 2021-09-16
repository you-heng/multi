<?php
require_once 'connet.php';
require_once 'api-auth.php';
use think\facade\Db;
$data = $_GET;
$result = Db::table('sd_link')
    ->alias('t1')
    ->join('sd_shop t2','t1.shop_id=t2.id','left')
    ->field('t1.*,t2.shop_name')
    ->page($data['page'],$data['limit'])->select()->toArray();
if(!empty($result)) {
    $count = Db::table('sd_link')->count();
    echo json_encode(['code' => 0, 'msg' => '成功', 'data' => $result, 'page' => $data['page'], 'limit' => $data['limit'], 'count' => $count]);return;
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容~']);
}