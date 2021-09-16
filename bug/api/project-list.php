<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
include './datebase.php';
$sql = "SELECT * FROM b_project limit {$page},{$data['limit']}";
$result = $link->query($sql);
$project = mysqli_fetch_all($result,MYSQLI_ASSOC);
$sql = "SELECT count(*) FROM b_project";
$result = $link->query($sql);
$count = mysqli_fetch_all($result,MYSQLI_ASSOC);
$link->close();
foreach($project as $k => $v){
    $project[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $project[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
if($project){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $project,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}