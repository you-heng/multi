<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
include './datebase.php';
session_start();
$is_role = $_SESSION['is_role'];
if($is_role == 1 || $is_role == 0){
    $sql = "SELECT * FROM p_notice limit {$page},{$data['limit']}";
}else if($is_role == 2){
    $sql = "SELECT * FROM p_notice where is_auth=2 or is_auth=1 limit {$page},{$data['limit']}";
}else if($is_role == 3){
    $sql = "SELECT * FROM p_notice where is_auth=3 or is_auth=1 limit {$page},{$data['limit']}";
}
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
$sql = "SELECT count(*) FROM p_admin";
$result = $link->query($sql);
$count = mysqli_fetch_all($result,MYSQLI_ASSOC);
$link->close();
foreach($user as $k => $v){
    $user[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $user[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
if($user){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $user,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}