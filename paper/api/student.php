<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
include './admin-auth.php';
if($data['type'] == 1){ //添加
    $sql = "SELECT * FROM p_student WHERE username='{$data['username']}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if($user){ echo json_encode(['code' => -1, 'msg' => '当前用户名已存在']); return false; }
    $data['create_time'] = time();
    $sql = "insert into p_student (id,username,password,serialNumber,t_id,b_id,g_id,is_role,create_time) values (null,'{$data['username']}','{$data['password']}','{$data['serialNumber']}','{$data['t_id']}','{$data['b_id']}','{$data['g_id']}',3,'{$data['create_time']}')";
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
        $sql = "UPDATE p_student SET
                username= '{$data['username']}' ,
                update_time={$time} 
                WHERE id=" . $data["id"];
    }else{
        $data['password'] = MD5($data['password']);
        $sql = "UPDATE p_student SET
                username= '{$data['username']}' ,
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
    $sql = 'DELETE FROM p_student WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}else if($data['type'] == 4){
    $sql = "SELECT * FROM p_college";
    $result = $link->query($sql);
    $college = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if($college){
        echo json_encode(['code' => 0, 'msg' => '成功', 'data' => $college]);
    }else{
        echo json_encode(['code' => 0, 'msg' => '失败']);
    }
}else if($data['type'] == 5){
    $sql = "SELECT * FROM p_teacher where b_id={$data['id']}";
    $result = $link->query($sql);
    $teacher = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if($teacher){
        echo json_encode(['code' => 0, 'msg' => '成功', 'data' => $teacher]);
    }else{
        echo json_encode(['code' => 0, 'msg' => '失败']);
    }
}else if($data['type'] == 6){
    $sql = "SELECT * FROM p_group where b_id={$data['id']}";
    $result = $link->query($sql);
    $group = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if($group){
        echo json_encode(['code' => 0, 'msg' => '成功', 'data' => $group]);
    }else{
        echo json_encode(['code' => 0, 'msg' => '失败']);
    }
}
