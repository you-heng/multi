<?php
include './Base.php'; //验证登录
$data = $_POST['data'];
include './datebase.php';
$sql = "SELECT * FROM p_document WHERE t_id='{$data['id']}'";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
$time = time();
if(!empty($user)){
    $sql = "UPDATE p_document SET
                paper_report= '{$data['paper_report']}' ,
                guide_report= '{$data['guide_report']}' ,
                reply_report= '{$data['reply_report']}' ,
                b_id= '{$data['b_id']}' ,
                update_time={$time} 
                WHERE t_id=" . $data["id"];
}else{
    $sql = "insert into p_document (id,paper_report,guide_report,reply_report,b_id,t_id,create_time) values (null,'{$data['paper_report']}','{$data['guide_report']}','{$data['reply_report']}','{$data['b_id']}','{$data['id']}','{$time}')";
}
$result = $link->query($sql);
$link->close();
if($result){
    echo json_encode(['code' => 0, 'msg' => '成功']);
}else{
    echo json_encode(['code' => -2, 'msg' => '失败']);
}