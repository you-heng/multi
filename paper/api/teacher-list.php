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

    $sql = "SELECT * FROM p_teacher where b_id={$user[0]['b_id']} limit {$page},{$data['limit']}";
    $result = $link->query($sql);
    $teacher = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sql = "SELECT count(*) FROM p_teacher where b_id={$user[0]['b_id']}";
}else{
    $sql = "SELECT * FROM p_teacher limit {$page},{$data['limit']}";
    $result = $link->query($sql);
    $teacher = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sql = "SELECT count(*) FROM p_teacher";
}

$result = $link->query($sql);
$count = mysqli_fetch_all($result,MYSQLI_ASSOC);
$sql = "SELECT * FROM p_college";
$result = $link->query($sql);
$college = mysqli_fetch_all($result,MYSQLI_ASSOC);
$link->close();
include 'config.php';
foreach($teacher as $k => $v){
    foreach($college as $key => $val){
        if($val['id'] == $v['b_id']){
            $teacher[$k]['college'] = $val['name'];
        }
    }
    $teacher[$k]['role'] = $config['role'][$v['is_role']];
    $teacher[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $teacher[$k]['login_time'] = date('Y-m-d H:i:s',$v['login_time']);
    $teacher[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
if($teacher){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $teacher,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}