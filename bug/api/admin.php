<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
if($data['type'] == 1){ //添加
    $sql = "SELECT * FROM b_user WHERE username='{$data['username']}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if($user){ echo json_encode(['code' => -1, 'msg' => '当前用户已存在']); return false; }
    $data['create_time'] = time();
    $data['password'] = MD5($data['password']);
    $sql = "insert into b_user (id,username,password,is_role,create_time) values (null,'{$data['username']}','{$data['password']}','{$data['is_role']}','{$data['create_time']}')";
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
        $sql = "UPDATE b_user SET
                username= '{$data['username']}' ,
                is_role={$data['is_role']} ,
                update_time={$time} 
                WHERE id=" . $data["id"];
    }else{
        $data['password'] = MD5($data['password']);
        $sql = "UPDATE b_user SET
                username= '{$data['username']}' ,
                password='{$data['password']}' ,
                is_role={$data['is_role']} ,
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
    $sql = 'DELETE FROM b_user WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}else if($data['type'] == 4){
    $data['password'] = MD5($data['password']);
    $data['update_time'] = time();
    $sql = "UPDATE b_user SET
                username= '{$data['username']}' ,
                password='{$data['password']}' ,
                update_time='{$data['update_time']}'
                WHERE id=" . $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '修改成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '修改失败']);
    }
}
