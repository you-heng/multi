<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
if($data['type'] == 1){ //添加
    include 'role.php';
    $table = 'p_report';
    $res = judge($table);
    $report = $res['res'];
    $user = $res['user'];
    if($report){ echo json_encode(['code' => -1, 'msg' => '您已经上传过开题报告，如需重新上传请选择编辑']); return false; }

    $data['create_time'] = time();
    $sql = "insert into p_report (id,report_name,report_url,b_id,t_id,s_id,create_time) values (null,'{$data['report_name']}','{$data['report_url']}','{$user[0]['b_id']}','{$user[0]['t_id']}','{$user[0]['id']}','{$data['create_time']}')";
    $result = $link->query($sql);
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '添加成功']);
    }else{
        echo json_encode(['code' => -2, 'msg' => '添加失败']);
    }
}else if($data['type'] == 2){ //编辑
    $time = time();
    $sql = "UPDATE p_report SET
                report_name= '{$data['report_name']}' ,
                report_url= '{$data['report_url']}' ,
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
    $sql = 'DELETE FROM p_report WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}else if($data['type'] == 4){ //审核
    $time = time();
    $sql = "UPDATE p_report SET
                report_name= '{$data['report_name']}' ,
                is_state= '{$data['is_state']}' ,
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
}
