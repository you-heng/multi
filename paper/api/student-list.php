<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
include './datebase.php';
session_start();
$is_role = $_SESSION['is_role'];
$username = $_SESSION['username'];
if($is_role == 1){
    $sql = "SELECT b_id FROM p_admin where username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $sql = "SELECT t1.*,t2.username as teacher_name,t3.group_name,t4.task_name,t5.name FROM p_student AS t1
LEFT JOIN p_teacher AS t2 ON t1.t_id=t2.id
LEFT JOIN p_group AS t3 ON t1.g_id=t3.id
LEFT JOIN p_task AS t4 ON t1.ts_id=t4.id
LEFT JOIN p_college AS t5 ON t1.b_id=t5.id
where t1.b_id={$user[0]['b_id']}
limit {$page},{$data['limit']}";
    $result = $link->query($sql);
    $student = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sql = "SELECT count(*) FROM p_student where b_id={$user[0]['b_id']}";
}else if($is_role == 2){
    $sql = "SELECT id FROM p_teacher where username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $sql = "SELECT t1.*,t2.username as teacher_name,t3.group_name,t4.task_name,t5.name FROM p_student AS t1
LEFT JOIN p_teacher AS t2 ON t1.t_id=t2.id
LEFT JOIN p_group AS t3 ON t1.g_id=t3.id
LEFT JOIN p_task AS t4 ON t1.ts_id=t4.id
LEFT JOIN p_college AS t5 ON t1.b_id=t5.id
where t1.t_id={$user[0]['id']}
limit {$page},{$data['limit']}";
    $result = $link->query($sql);
    $student = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sql = "SELECT count(*) FROM p_student where t_id={$user[0]['id']}";
}else{
    $sql = "SELECT t1.*,t2.username as teacher_name,t3.group_name,t4.task_name,t5.name FROM p_student AS t1
LEFT JOIN p_teacher AS t2 ON t1.t_id=t2.id
LEFT JOIN p_group AS t3 ON t1.g_id=t3.id
LEFT JOIN p_task AS t4 ON t1.ts_id=t4.id
LEFT JOIN p_college AS t5 ON t1.b_id=t5.id
limit {$page},{$data['limit']}";
    $result = $link->query($sql);
    $student = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sql = "SELECT count(*) FROM p_student";
}

$result = $link->query($sql);
$count = mysqli_fetch_all($result,MYSQLI_ASSOC);
$link->close();
include 'config.php';
foreach($student as $k => $v){
    $student[$k]['role'] = $config['role'][$v['is_role']];
    $student[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $student[$k]['login_time'] = date('Y-m-d H:i:s',$v['login_time']);
    $student[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
if($student){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $student,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}