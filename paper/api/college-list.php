<?php
include './Base.php';
include "./admin-auth.php";
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
include './datebase.php';
$sql = "SELECT * FROM p_college limit {$page},{$data['limit']}";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
$sql = "SELECT count(*) FROM p_college";
$result = $link->query($sql);
$count = mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach($user as $k => $v){
    $user[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $user[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
if($user){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $user,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}