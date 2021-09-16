<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
if($data['type'] == 3){ //删除
    $sql = 'DELETE FROM b_bug_log WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}
