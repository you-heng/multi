<?php
require_once 'connet.php';
require_once 'api-auth.php';

use think\facade\Db;

$postData = $_POST;
if ($postData['type'] == 1) { //搜索
    $result = Db::table('sd_user')->where('phone', 'like', "%" . $postData['phone'] . "%")->page($postData['page'], $postData['limit'])->select()->toArray();
    if (empty($result)) {
        echo json_encode(['code' => 1, 'msg' => '暂无数据']);
        return;
    }
    $count = Db::table('sd_user')->where('phone', $postData['phone'])->count();
    echo json_encode(['code' => 0, 'msg' => 'success', 'count' => $count, 'data' => $result, 'limit' => $postData['limit'], 'page' => $postData['page']]);
    return;
} else if ($postData['type'] == 2) { //备注
    $result = Db::table('sd_user')->where('id', $postData['id'])->update(['remark' => $postData['remark']]);
    if ($result) {
        echo json_encode(['code' => 0, 'msg' => '备注成功']);
        return;
    }
    echo json_encode(['code' => 0, 'msg' => '备注失败']);
    return;
} else if ($postData['type'] == 3) { //删除
    if (Db::table('sd_user')->delete($postData['id'])) {
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
        return;
    }
    echo json_encode(['code' => -1, 'msg' => '删除失败']);
    return;
}