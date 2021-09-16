<?php
include './Base.php';
$data = $_POST['data'];
$data['create_time'] = time();
include './database.php';
session_start();
$token = $_SESSION['token'];
$sql = "SELECT is_sign FROM user WHERE token ='{$token}'";
$result = $link->query($sql);
$sign = mysqli_fetch_all($result,MYSQLI_ASSOC);
if($sign[0]['is_sign'] == 1){ echo json_encode(['code' => -2 , 'msg' => '已经签过到了！不用重复签到']); die; }
$sql = "INSERT INTO sign (id,name,student,is_temp,is_leave,address,create_time) values (null,'{$data['name']}','{$data['student']}','{$data['is_temp']}','{$data['is_leave']}','{$data['address']}','{$data['create_time']}')";
$result = mysqli_query($link, $sql);

$sql = "UPDATE user SET is_sign=1 WHERE name='{$data['name']}'";
mysqli_query($link, $sql);
// 关闭数据库连接
$link->close();
if($result){
    echo json_encode(['code' => 0 , 'msg' => '提交成功']);
}else{
    echo json_encode(['code' => -1, 'msg' => '提交失败']);
}