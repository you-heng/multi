<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if($username == 'admin'){
    if($username == 'admin' && $password =='123456'){
        $_SESSION["token"] = uniqid();
        echo json_encode(['code'=>0,'msg'=>'登录成功', 'url' => '/']);
    }else{
        echo json_encode(['code'=>-2,'msg'=>'账号密码错误']);
    }
}else if($username == 'test'){
    if($username == 'test' && $password =='123456'){
        $_SESSION["token"] = uniqid();
        echo json_encode(['code'=>0,'msg'=>'登录成功', 'url' => 'kefu.php']);
    }else{
        echo json_encode(['code'=>-2,'msg'=>'账号密码错误']);
    }
}else{
    echo json_encode(['code'=>1,'msg'=>'账号密码错误']);
}



