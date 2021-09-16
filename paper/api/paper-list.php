<?php
include './Base.php';
$data = $_GET;
$page = ($data['page'] - 1) * $data['limit'];
$tabel = 'p_paper';
include "role.php";
$res = role($tabel,$page,$data['limit']);
include 'config.php';
$paper = $res['res'];
if($paper[0]['id'] != NULL){
    $count = $res['count'];
    foreach($paper as $k => $v){
        $paper[$k]['state'] = $config['paper_state'][$v['is_state']];
        $paper[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
        $paper[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
    }
}else{
    $paper = NULL;
    $count[0]['count(*)'] = 0;
}

if($paper){
    echo json_encode(['code' => 0, 'msg' => 'Succeed', 'data' => $paper,'page' => $data['page'], 'limit' => $data['limit'],'count' => $count[0]['count(*)']]);
}else{
    echo json_encode(['code' => -1, 'msg' => '暂无内容','data' => []]);
}