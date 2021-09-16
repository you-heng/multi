<?php
$data = $_GET;
include './database.php';
//全部
if($data['state'] == 1){
    $sql = "SELECT * FROM sign";
    $result = $link->query($sql);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $link->close();
    foreach($data as $k => $v){
        $v['is_temp'] == 1 ? $data[$k]['temp'] = '是' : $data[$k]['temp'] = '否';
        $v['is_leave'] == 1 ? $data[$k]['leave'] = '是' : $data[$k]['leave'] = '否';
        $data[$k]['create_time'] = date('Y-d-m H:i:s',$v['create_time']);
    }
    echo json_encode(['code' => 0 , 'data' => $data]);
}else if($data['state'] == 2){ //异常
    $sql = "SELECT * FROM sign WHERE is_temp = 2 OR is_leave = 1";
    $result = $link->query($sql);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $link->close();
    foreach($data as $k => $v){
        $v['is_temp'] == 1 ? $data[$k]['temp'] = '是' : $data[$k]['temp'] = '否';
        $v['is_leave'] == 1 ? $data[$k]['leave'] = '是' : $data[$k]['leave'] = '否';
        $data[$k]['create_time'] = date('Y-d-m H:i:s',$v['create_time']);
    }
    echo json_encode(['code' => 0 , 'data' => $data]);
}else if($data['state'] == 3){ //未签到
    $sql = "SELECT * FROM user WHERE is_sign = 2";
    $result = $link->query($sql);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $link->close();
    foreach($data as $k => $v){
        $v['is_sign'] == 1 ? $data[$k]['sign'] = '已签到' : $data[$k]['sign'] = '未签到';
        $v['is_state'] == 1 ? $data[$k]['state'] = '学生' : $data[$k]['state'] = '教师';
        $data[$k]['login_time'] = date('Y-d-m H:i:s',$v['login_time']);
    }
    echo json_encode(['code' => 0 , 'data' => $data]);
}