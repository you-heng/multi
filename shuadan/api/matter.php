<?php
require_once 'connet.php';
require_once 'api-auth.php';
use think\facade\Db;

$page = $_GET['page'];
$limit = $_GET['limit'];

$data = Db::table('sd_matter')->page($page,$limit)->order('is_pay','desc')->select()->toArray();

if(empty($data)){
    echo json_encode(['code'=>1,'msg'=>'暂无数据']);die;
}

$count = Db::table('sd_matter')->count();
echo json_encode(['code' => 0, 'msg' => 'success', 'count' => $count, 'data' => $data, 'page' => $page, 'limit' => $limit]);