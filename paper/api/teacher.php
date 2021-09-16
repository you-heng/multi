<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
include './admin-auth.php';
if($data['type'] == 1){ //添加
    $sql = "SELECT * FROM p_teacher WHERE username='{$data['username']}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if($user){ echo json_encode(['code' => -1, 'msg' => '当前教师已存在']); return false; }
    $data['create_time'] = time();
    $sql = "insert into p_teacher (id,username,password,serialNumber,b_id,is_role,create_time) values (null,'{$data['username']}','{$data['password']}','{$data['serialNumber']}','{$data['b_id']}',2,'{$data['create_time']}')";
    $result = $link->query($sql);
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '添加成功']);
    }else{
        echo json_encode(['code' => -2, 'msg' => '添加失败']);
    }
}else if($data['type'] == 2){ //编辑
    $time = time();
    if($data['password'] == ''){
        $sql = "UPDATE p_teacher SET
                username= '{$data['username']}' ,
                serialNumber= '{$data['serialNumber']}' ,
                b_id= '{$data['b_id']}' ,
                update_time={$time} 
                WHERE id=" . $data["id"];
    }else{
        $data['password'] = MD5($data['password']);
        $sql = "UPDATE p_teacher SET
                username= '{$data['username']}' ,
                serialNumber= '{$data['serialNumber']}' ,
                b_id= '{$data['b_id']}' ,
                password='{$data['password']}' ,
                update_time={$time} 
                WHERE id=" . $data["id"];
    }

    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '更新成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '更新失败']);
    }
}else if($data['type'] == 3){ //删除
    $sql = 'DELETE FROM p_teacher WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}
