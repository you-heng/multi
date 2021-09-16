<?php
$data = $_POST['data'];
include './datebase.php';
session_start();
if(strtoupper($data['code']) != $_SESSION['vcode']){ echo json_encode(['code' => -2, 'msg' => '验证码错误']); return false; }
unset($_SESSION['vcode']);
$sql = "SELECT * FROM p_student WHERE username='{$data['username']}'";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
if($data['username'] == $user[0]['username']){ echo json_encode(['code' => -3, 'msg' => '您已经注册过，请前往登录']); return false; }
$res = [
    'ip' => $_SERVER['REMOTE_ADDR'],
    'create_time' => time(),
    'is_role' => 3
];
$sql = "insert into p_student (id,username,password,ip,is_role,create_time,login_time) values (null,'{$data['username']}','{$data['password']}','{$res['ip']}',{$res['is_role']},'{$res['create_time']}','{$res['create_time']}')";
$result = mysqli_query($link, $sql);
$link->close();
$_SESSION['username'] = $data['username'];
$_SESSION['is_role'] = 3;
$url = 'student';
if($result){
    echo json_encode(['code' => 0 , 'msg' => '注册成功', 'url' => $url]);
}else{
    echo json_encode(['code' => -2, 'msg' => '网络异常，请稍后重试~']);
}