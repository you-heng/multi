<?php
require_once 'connet.php';
require_once 'api-auth.php';

use think\facade\Db;

$data = $_POST;
if ($data['type'] == 1) { //增加
    $result = Db::table('sd_shop')->insert(['shop_name' => $data['shop_name']]);
    if ($result) {
        echo json_encode(['code' => 0, 'msg' => '添加成功']);return;
    } else {
        echo json_encode(['code' => -1, 'msg' => '添加失败']);return;
    }
} else if ($data['type'] == 2) { //修改
    $result = Db::table('sd_shop')->where('id', $data['id'])->update(['shop_name' => $data['shop_name']]);
    if ($result) {
        echo json_encode(['code' => 0, 'msg' => '修改成功']);return;
    } else {
        echo json_encode(['code' => -1, 'msg' => '修改失败']);return;
    }
} else if ($data['type'] == 3) { //删除
    if (Db::table('sd_shop')->delete($data['id'])) {
        echo json_encode(['code' => 0, 'msg' => '删除成功']);return;
    } else {
        echo json_encode(['code' => -1, 'msg' => '删除失败']);return;
    }
} else if ($data['type'] == 4) { //搜索
    $result = Db::table('sd_shop')->where('shop_name', 'like', "%" . $data['data']['shop_name'] . "%")->select()->toArray();
    if (!empty($result)) {
        $count = Db::table('sd_shop')->count();
        echo json_encode(['code' => 0, 'msg' => '成功', 'data' => $result, 'page' => $data['page'], 'limit' => $data['limit'], 'count' => $count]);return;
    } else {
        echo json_encode(['code' => -1, 'msg' => '暂无内容~']);
    }
} else if ($data['type'] == 5) { //状态
    $result = false;
    $msg = '';
    if ($data['open'] == 1) {
        $result = Db::table('sd_shop')->where('id', $data['id'])->update(['open' => 2]);
        $msg = '关闭';
    } else if ($data['open'] == 2) {
        $result = Db::table('sd_shop')->where('id', $data['id'])->update(['open' => 1]);
        $msg = '开启';
    }
    if (!$result) {
        echo json_encode(['code' => -1, 'msg' => $msg . '失败']);return;
    }
    echo json_encode(['code' => 0, 'msg' => $msg . '成功']);return;
} else if ($data['type'] == 6) { //根据open获得店铺列表
    $shop = Db::table('sd_shop')->where('open', 1)->select()->toArray();
    echo json_encode(['code' => 0, 'msg' => 'success', 'data' => $shop]);
}