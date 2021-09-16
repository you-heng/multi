<?php
$data = $_POST['data'];
include './datebase.php';
session_start();
if(strtoupper($data['code']) != $_SESSION['vcode']){ echo json_encode(['code' => -2, 'msg' => '验证码错误']); return false; }
unset($_SESSION['vcode']);
if($data['is_role'] == 1){
    $table = 'p_admin';
    $url = 'admin';
}else if($data['is_role'] == 2){
    $table = 'p_teacher';
    $url = 'teacher';
}else if($data['is_role'] == 3){
    $table = 'p_student';
    $url = 'student';
}
$sql = "SELECT * FROM {$table} WHERE username='{$data['username']}'";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
if($data['username'] != $user[0]['username'] || $data['password'] != $user[0]['password']){
    echo json_encode(['code' => -1, 'msg' => '账号密码错误']); return false;
}
$_SESSION['username'] = $data['username'];
$_SESSION['is_role'] = $user[0]['is_role'];

$res = [
    'ip' => $_SERVER['REMOTE_ADDR'],
    'login_time' => time(),
];
$sql = "UPDATE {$table} SET ip='{$res['ip']}',login_time='{$res['login_time']}' WHERE username='{$data['username']}'";
// var_dump($sql);die;
$result = mysqli_query($link, $sql);
$link->close();
$state = '?state='.$user[0]['state'];
if($result){
    echo json_encode(['code' => 0 , 'msg' => '登录成功', 'url' => $url,'state' => $state]);
}else{
    echo json_encode(['code' => -2, 'msg' => '登录失败']);
}