<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
include './datebase.php';
session_start();
$username = $_SESSION['username'];
$is_role = $_SESSION['is_role'];
if($is_role == 1){
    $sql = "SELECT t2.* FROM p_admin AS t1 LEFT JOIN p_task AS t2 ON t1.b_id=t2.b_id WHERE t1.username='{$username}' limit {$page},{$data['limit']}";
    $id = "b_id";
}else if($is_role == 2){
    $sql = "SELECT t2.* FROM p_teacher AS t1 LEFT JOIN p_task AS t2 ON t1.id=t2.t_id WHERE t1.username='{$username}' limit {$page},{$data['limit']}";
    $id = "t_id";
}else if($is_role == 3){
    $sql = "SELECT t2.* FROM p_student AS t1 LEFT JOIN p_task AS t2 ON t1.t_id=t2.t_id WHERE t1.username='{$username}' limit {$page},{$data['limit']}";
    $id = "t_id";
}else{
    $sql = "SELECT * FROM p_task limit {$page},{$data['limit']}";
}
$result = $link->query($sql);
$task = mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach($task as $k => $v){
    $task[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $task[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
if($task[0]['id'] != null){
    if($is_role == 0){
        $sql = "SELECT count(*) FROM p_task";
    }else{
        $sql = "SELECT count(*) FROM p_task where {$id}={$task[0][$id]}";
    }
    $result = $link->query($sql);
    $count = mysqli_fetch_all($result,MYSQLI_ASSOC);
}else{
    $task = [];
    $count = 0;
}
$link->close();
if($task){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $task,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}