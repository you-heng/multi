<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
include "./admin-auth.php";
if($data['type'] == 1){ //添加
    $sql = "SELECT * FROM p_college WHERE name='{$data['name']}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if($user){ echo json_encode(['code' => -1, 'msg' => '当前学院已存在']); return false; }
    $data['create_time'] = time();
    $sql = "insert into p_college (id,name,number,create_time) values (null,'{$data['name']}','{$data['number']}','{$data['create_time']}')";
    $result = $link->query($sql);
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '添加成功']);
    }else{
        echo json_encode(['code' => -2, 'msg' => '添加失败']);
    }
}else if($data['type'] == 2){ //编辑
    $time = time();
    $sql = "UPDATE p_college SET
                name= '{$data['name']}' ,
                number='{$data['number']}' ,
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
    $sql = 'DELETE FROM p_college WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}
