<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
include "./admin-auth.php";
if($data['type'] == 1){ //添加
    $data['create_time'] = time();
    $sql = "insert into p_notice (id,title,notice_desc,is_auth,is_type,create_time) values (null,'{$data['title']}','{$data['notice_desc']}','{$data['is_auth']}','{$data['is_type']}','{$data['create_time']}')";
    $result = $link->query($sql);
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '添加成功']);
    }else{
        echo json_encode(['code' => -2, 'msg' => '添加失败']);
    }
}else if($data['type'] == 2){ //编辑
    $time = time();
    $sql = "UPDATE p_notice SET
                title= '{$data['title']}' ,
                notice_desc= '{$data['notice_desc']}' ,
                is_auth= '{$data['is_auth']}' ,
                is_type= '{$data['is_type']}' ,
                update_time={$time} 
                WHERE id=" . $data["id"];

    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '更新成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '更新失败']);
    }
}else if($data['type'] == 3){ //删除
    $sql = 'DELETE FROM p_notice WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}
