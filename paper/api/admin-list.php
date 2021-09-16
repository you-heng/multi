<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
include './datebase.php';
$sql = "SELECT * FROM p_admin limit {$page},{$data['limit']}";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
$sql = "SELECT count(*) FROM p_admin";
$result = $link->query($sql);
$count = mysqli_fetch_all($result,MYSQLI_ASSOC);
$sql = "SELECT * FROM p_college";
$result = $link->query($sql);
$college = mysqli_fetch_all($result,MYSQLI_ASSOC);
$link->close();
include 'config.php';
foreach($user as $k => $v){
    foreach($college as $key => $val){
        if($val['id'] == $v['b_id']){
            $user[$k]['college'] = $val['name'];
        }
    }
    $user[$k]['role'] = $config['role'][$v['is_role']];
    $user[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $user[$k]['login_time'] = date('Y-m-d H:i:s',$v['login_time']);
    $user[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
if($user){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $user,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}