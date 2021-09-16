<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
include './datebase.php';
$sql = "SELECT t1.*,t2.bug_title,t3.username FROM b_bug_log AS t1 LEFT JOIN b_bug AS t2 ON t1.bug_id=t2.id LEFT JOIN b_user AS t3 ON t1.hand_id=t3.id ORDER BY t1.create_time DESC limit {$page},{$data['limit']}";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
$sql = "SELECT count(*) FROM b_bug_log";
$result = $link->query($sql);
$count = mysqli_fetch_all($result,MYSQLI_ASSOC);
$link->close();
foreach($user as $k => $v){
    $user[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
}
if($user){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $user,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}