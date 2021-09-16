<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
$tabel = 'p_report';
include "role.php";
$res = role($tabel,$page,$data['limit']);
include 'config.php';
$report = $res['res'];
if($report[0]['id'] != NULL){
    $count = $res['count'];
    foreach($report as $k => $v){
        $report[$k]['state'] = $config['paper_state'][$v['is_state']];
        $report[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
        $report[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
    }
}else{
    $report = NULL;
    $count[0]['count(*)'] = 0;
}
if($report){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $report,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}