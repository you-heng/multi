<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
if($data['type'] == 1){ //添加
    session_start();
    $username = $_SESSION['username'];
    $sql = "SELECT id FROM b_user WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $data['create_time'] = time();
    $data['put_id'] = $user[0]['id'];
    $data['is_state'] = 1;
    $sql = "insert into b_bug (id,bug_title,is_role,is_type,is_priority,is_weight,solve_id,project_id,put_id,is_state,system,system_ver,bug_img,bug_desc,create_time) values (null,'{$data['bug_title']}','{$data['is_role']}','{$data['is_type']}','{$data['is_priority']}','{$data['is_weight']}','{$data['solve_id']}','{$data['project_id']}','{$data['put_id']}','{$data['is_state']}','{$data['system']}','{$data['system_ver']}','{$data['bug_img']}','{$data['bug_desc']}','{$data['create_time']}')";
    $result = $link->query($sql);
    $sql = "SELECT LAST_INSERT_ID()";
    $result = $link->query($sql);
    $bug_id = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $link->close();

    $log = [
        'hand_id' => $user[0]['id'],
        'action' => '添加',
        'username' => $username,
        'title' => $data['bug_title'],
        'time' => $data['create_time'],
        'bug_id' => $bug_id[0]['LAST_INSERT_ID()']
    ];
    bug_log($log);

    if($result){
        echo json_encode(['code' => 0, 'msg' => '添加成功']);
    }else{
        echo json_encode(['code' => -2, 'msg' => '添加失败']);
    }
}else if($data['type'] == 2){ //编辑
    $time = time();
    $sql = "UPDATE b_bug SET
                bug_title= '{$data['bug_title']}' ,
                is_role= '{$data['is_role']}' ,
                is_type= '{$data['is_type']}' ,
                is_priority= '{$data['is_priority']}' ,
                is_weight= '{$data['is_weight']}' ,
                solve_id= '{$data['solve_id']}' ,
                project_id= '{$data['project_id']}' ,
                system= '{$data['system']}' ,
                system_ver= '{$data['system_ver']}' ,
                bug_img= '{$data['bug_img']}' ,
                bug_desc= '{$data['bug_desc']}' ,
                is_role={$data['is_role']} ,
                update_time={$time} 
                WHERE id=" . $data["id"];
    $result = $link->query($sql);
    session_start();
    $username = $_SESSION['username'];
    $sql = "SELECT id FROM b_user WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    // 关闭数据库连接
    $link->close();

    $log = [
        'hand_id' => $user[0]['id'],
        'action' => '修改',
        'username' => $username,
        'title' => $data['bug_title'],
        'time' => $time,
        'bug_id' => $data["id"]
    ];
    bug_log($log);

    if($result){
        echo json_encode(['code' => 0, 'msg' => '更新成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '更新失败']);
    }
}else if($data['type'] == 3){ //删除
    $sql = 'DELETE FROM b_bug WHERE id='. $data['id'];
    $result = $link->query($sql);
    // 关闭数据库连接
    $link->close();
    if($result){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '删除失败']);
    }
}else if($data['type'] == 4){
    $time = time();
    $sql = "UPDATE b_bug SET
                is_state= '{$data['is_state']}' ,
                update_time={$time} 
                WHERE id=" . $data["id"];
    $result = $link->query($sql);
    session_start();
    $username = $_SESSION['username'];
    $sql = "SELECT id FROM b_user WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    // 关闭数据库连接
    $link->close();
    $log = [
        'hand_id' => $user[0]['id'],
        'action' => '修改',
        'username' => $username,
        'title' => $data['bug_title'],
        'time' => $time,
        'bug_id' => $data["id"],
        'state' => $data['is_state']
    ];
    bug_state($log);
    if($result){
        echo json_encode(['code' => 0, 'msg' => '修改成功']);
    }else{
        echo json_encode(['code' -1, 'msg' => '修改失败']);
    }
}

function bug_log($data)
{
    include './datebase.php';
    $data['content'] = $data['username'].$data['action'].'了一条标题为'.$data['title'].'的缺陷报告';
    $sql = "insert into b_bug_log (id,bug_id,hand_id,content,create_time) values (null,'{$data['bug_id']}','{$data['hand_id']}','{$data['content']}','{$data['time']}')";
    $link->query($sql);
    $link->close();
}

function bug_state($data)
{
    include './datebase.php';
    include './config.php';
    $data['content'] = $data['username'].'将标题为'.$data['title'].'的缺陷报告状态改为'.$config['state'][$data['state']];
    $sql = "insert into b_bug_log (id,bug_id,hand_id,content,create_time) values (null,'{$data['bug_id']}','{$data['hand_id']}','{$data['content']}','{$data['time']}')";
    $link->query($sql);
    $link->close();
}
