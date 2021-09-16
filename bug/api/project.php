<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
if($data['type'] == 1){ //添加
    $sql = "SELECT * FROM b_project WHERE project_name='{$data['project_name']}'";
    $result = $link->query($sql);
    $project = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if($project){ echo json_encode(['code' => -1, 'msg' => '当前项目已存在']); return false; }
    $data['create_time'] = time();
    $sql = "insert into b_project (id,project_name,project_desc,create_time) values (null,'{$data['project_name']}','{$data['project_desc']}','{$data['create_time']}')";
    $result = $link->query($sql);
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '添加成功']);
    }else{
        echo json_encode(['code' => -2, 'msg' => '添加失败']);
    }
}else if($data['type'] == 2){ //编辑
    $time = time();
    $sql = "UPDATE b_project SET
                project_name= '{$data['project_name']}' ,
                project_desc='{$data['project_desc']}' ,
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
    $sql = 'DELETE FROM b_project WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}
