<?php
require_once 'connet.php';
require_once 'api-auth.php';
use think\facade\Db;
$data = $_GET;
$result = Db::table('sd_shop')->page($data['page'],$data['limit'])->select()->toArray();
if(!empty($result)) {
    $count = Db::table('sd_shop')->count();
    echo json_encode(['code' => 0, 'msg' => '成功', 'data' => $result, 'page' => $data['page'], 'limit' => $data['limit'], 'count' => $count]);return;
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容~']);
}