<?php
require_once 'connet.php';
require_once 'api-auth.php';

use think\facade\Db;

$postData = $_POST;

if ($postData['type'] == 1) { //审核
    $data = false;
    $msg = '';
    if ($postData['is_star'] == 1) {
        $data = Db::table('sd_matter')->where('id', $postData['id'])->update(['is_star' => 2]);
        $msg = '反悔';
    } else if ($postData['is_star'] == 2) {
        $data = Db::table('sd_matter')->where('id', $postData['id'])->update(['is_star' => 1]);
        $msg = '审核';
    }
    if (!$data) {
        echo json_encode(['code' => -1, 'msg' => $msg . '失败']);
        return;
    }
    echo json_encode(['code' => 0, 'msg' => $msg . '成功']);
    return;
} else if ($postData['type'] == 2) { //打款
    $data = false;
    $msg = '';
    if ($postData['is_pay'] == 1) {
        $data = Db::table('sd_matter')->where('id', $postData['id'])->update(['is_pay' => 2]);
        $msg = '反悔';
    } else if ($postData['is_pay'] == 2) {
        $data = Db::table('sd_matter')->where('id', $postData['id'])->update(['is_pay' => 1]);
        $msg = '打款';
    }
    if (!$data) {
        echo json_encode(['code' => -1, 'msg' => $msg . '失败']);
        return;
    }
    echo json_encode(['code' => 0, 'msg' => $msg . '成功']);
    return;

} else if ($postData['type'] == 3) { //备注

    $data = Db::table('sd_matter')->where('id', $postData['id'])->update(['remark' => $postData['remark']]);
    if (!$data) {
        echo json_encode(['code' => -1, 'msg' => '备注失败']);
        return;
    }
    echo json_encode(['code' => 0, 'msg' => '备注成功']);
    return;

} else if ($postData['type'] == 4) { //搜索
    $result = Db::table('sd_matter')->where('user_phone', 'like', "%" . $postData['phone'] . "%")->page($postData['page'], $postData['limit'])->select()->toArray();
    if (empty($result)) {
        echo json_encode(['code' => 1, 'msg' => '暂无数据']);
        return;
    }
    $count = Db::table('sd_matter')->where('user_phone', $postData['phone'])->count();
    echo json_encode(['code' => 0, 'msg' => 'success', 'count' => $count, 'data' => $result, 'limit' => $postData['limit'], 'page' => $postData['page']]);
    return;
}