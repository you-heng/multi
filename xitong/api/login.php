<?php

class login
{
    function index()
    {
        $data = $_POST['data'];
        if($data['name'] == '' || $data['pass'] == ''){ echo json_encode(['code' => -1, 'msg' => '账号密码不能为空']); return; }
        include './database.php';
        $sql = "SELECT name,pass,is_state FROM user WHERE name='{$data['name']}'";
        $result = $link->query($sql);
        $account = mysqli_fetch_all($result,MYSQLI_ASSOC);
        
        if($account[0]['name'] == $data['name'] && $account[0]['pass'] == $data['pass']){
            session_start();
            $_SESSION["token"] = MD5(time().$account['name']);
            $time = time();
            $sql = "update user set login_time='{$time}',token='{$_SESSION["token"]}' where name='{$data['name']}'";
            mysqli_query($link, $sql);
            $link->close();
            echo json_encode(['code' => 0, 'msg' => '登录成功', 'state' => $account[0]['is_state']]);
            return;
        }
        echo json_encode(['code' => -2, 'msg' => '账号密码错误']);
        return;
        
    }
}
$login = new login();
echo $login->index();

