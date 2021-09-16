<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
include './datebase.php';

session_start();
$is_role = $_SESSION['is_role'];
$username = $_SESSION['username'];
if($is_role == 2 || $is_role ==3){
    $sql = "SELECT id FROM b_user WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sql = "SELECT t1.*,t2.project_name,t3.username as put_name,t4.username as solve_name 
FROM b_bug AS t1 
LEFT JOIN b_project AS t2 ON t1.project_id=t2.id 
LEFT JOIN b_user as t3 ON t1.put_id=t3.id 
LEFT JOIN b_user as t4 ON t1.solve_id=t4.id
WHERE
(CASE
WHEN t1.is_role = 2 THEN t1.solve_id = {$user[0]['id']}
WHEN t1.is_role = 1 THEN t1.is_role = 1
END)
OR
(CASE
WHEN t1.is_role = 2 THEN t1.put_id = {$user[0]['id']}
WHEN t1.is_role = 1 THEN t1.is_role = 1
END)
ORDER BY t1.create_time DESC
limit {$page},{$data['limit']}";
}else{
    $sql = "SELECT t1.*,t2.project_name,t3.username as put_name,t4.username as solve_name 
FROM b_bug AS t1 
LEFT JOIN b_project AS t2 ON t1.project_id=t2.id 
LEFT JOIN b_user as t3 ON t1.put_id=t3.id 
LEFT JOIN b_user as t4 ON t1.solve_id=t4.id
ORDER BY t1.create_time DESC
limit {$page},{$data['limit']}";
}

$result = $link->query($sql);
$bug = mysqli_fetch_all($result,MYSQLI_ASSOC);

if($is_role == 2 || $is_role ==3){
    $sql = "SELECT count(*) FROM b_bug WHERE IF(solve_id={$user[0]['id']}, is_role=2,is_role = 1)";
}else{
    $sql = "SELECT count(*) FROM b_bug";
}
$result = $link->query($sql);
$count = mysqli_fetch_all($result,MYSQLI_ASSOC);

include './config.php';
foreach($bug as $k => $v){
    $bug[$k]['role'] = $config['role'][$v['is_role']];
    $bug[$k]['state'] = $config['state'][$v['is_state']];
    $bug[$k]['type'] = $config['type'][$v['is_type']];
    $bug[$k]['weight'] = $config['weight'][$v['is_weight']];
    $bug[$k]['priority'] = $config['priority'][$v['is_priority']];
    $bug[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $bug[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
$link->close();
if($bug){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $bug,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}