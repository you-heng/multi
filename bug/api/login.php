<?php
$data = $_POST['data'];
include './datebase.php';
$sql = "SELECT * FROM b_user WHERE username='{$data['username']}'";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
if($data['username'] != $user[0]['username'] && MD5($data['password'] != $user[0]['password'])){
    echo json_encode(['code' => -1, 'msg' => '账号密码错误']); return false;
}
session_start();
$_SESSION['token'] = MD5(time().$data['password']);
$_SESSION['username'] = $data['username'];
$_SESSION['is_role'] = $user[0]['is_role'];
$res = [
    'ip' => $_SERVER['REMOTE_ADDR'],
    'login_time' => time(),
    'token' => $_SESSION['token']
];
$sql = "UPDATE b_user SET login_ip='{$res['ip']}',token='{$res['token']}',login_time='{$res['login_time']}' WHERE username='{$data['username']}'";
$result = mysqli_query($link, $sql);
$link->close();

if($user[0]['is_role'] == 1 || $user[0]['is_role'] == 0){
    $url = 'admin';
}else if($user[0]['is_role'] == 2){
    $url = 'developer';
}else if($user[0]['is_role'] == 3){
    $url = 'tester';
}

if($result){
    echo json_encode(['code' => 0 , 'msg' => '登录成功', 'url' => $url]);
}else{
    echo json_encode(['code' => -2, 'msg' => '登录失败']);
}