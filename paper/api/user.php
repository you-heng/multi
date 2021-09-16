<?php
include './Base.php'; //验证登录
include "./datebase.php";
$data = $_POST['data'];
if($data['is_role'] == 1){
    $table = 'p_admin';
}else if($data['is_role'] == 2){
    $table = 'p_teacher';
}else if($data['is_role'] == 3){
    $table = 'p_student';
}
$time = time();
if($data['password'] == ''){
    $sql = "UPDATE {$table} SET
                username= '{$data['username']}' ,
                serialNumber= '{$data['serialNumber']}' ,
                email= '{$data['email']}' ,
                phone= '{$data['phone']}' ,
                b_id= '{$data['b_id']}' ,
                state= 2 ,
                update_time={$time} 
                WHERE id=" . $data["id"];
}else{
    $sql = "UPDATE {$table} SET
                username= '{$data['username']}' ,
                serialNumber= '{$data['serialNumber']}' ,
                email= '{$data['email']}' ,
                phone= '{$data['phone']}' ,
                b_id= '{$data['b_id']}' ,
                state= 2 ,
                password='{$data['password']}' ,
                update_time={$time} 
                WHERE id=" . $data["id"];
}
$result = $link->query($sql);
// 关闭数据库连接
$link->close();
if($result){
    echo json_encode(['code' => 0, 'msg' => '更新成功']);
}else{
    echo json_encode(['code' -1, 'msg' => '更新失败']);
}