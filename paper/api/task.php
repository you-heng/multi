<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
if($data['type'] == 1){ //添加
    session_start();
    $username = $_SESSION['username'];
    $sql = "SELECT b_id,id FROM p_teacher WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $data['create_time'] = time();
    $sql = "insert into p_task (id,task_name,task_desc,t_id,b_id,create_time) values (null,'{$data['task_name']}','{$data['task_desc']}',{$user[0]['id']},{$user[0]['b_id']},'{$data['create_time']}')";
    $result = $link->query($sql);
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '添加成功']);
    }else{
        echo json_encode(['code' => -2, 'msg' => '添加失败']);
    }
}else if($data['type'] == 2){ //编辑
    $time = time();
    $sql = "UPDATE p_task SET
                task_name= '{$data['task_name']}' ,
                task_desc= '{$data['task_desc']}' ,
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
    $sql = 'DELETE FROM p_task WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}else if($data['type'] == 4){ //选择课题
    $time = time();
    $sql = "UPDATE p_student SET
                ts_id= {$data['ts_id']} ,
                update_time={$time} 
                WHERE username='{$data['username']}'";

    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '更新成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '更新失败']);
    }
}
