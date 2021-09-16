<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
include './datebase.php';
session_start();
$is_role = $_SESSION['is_role'];
$username = $_SESSION['username'];
if($is_role == 1){
    $tabel = 'p_admin';
}else if($is_role == 2){
    $tabel = 'p_teacher';
}else if($is_role == 3){
    $table = 'p_student';
}
$sql = "SELECT t2.* FROM {$tabel} AS t1 LEFT JOIN p_group AS t2 ON t1.b_id=t2.b_id WHERE t1.username='{$username}' limit {$page},{$data['limit']}";
$result = $link->query($sql);
$group = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach($group as $k => $v){
    $group[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $group[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
if($group[0]['id'] != null){
    $sql = "SELECT count(*) FROM p_group where b_id = {$group[0]['b_id']}";
    $result = $link->query($sql);
    $count = mysqli_fetch_all($result,MYSQLI_ASSOC);
}else{
    $count = 0;
    $group = [];
}
if($group){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $group,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}