<?php
require_once 'connet.php';
use think\facade\Db;
$data = $_POST;
if(sizeof($data['field']['id']) == 1){
    try {
        $matter = Db::table('sd_matter')->where('id',$data['field']['id'][0])->update(['number' => $data['field']['number'][0],'is_pay' => 2]);
        if($matter){
            echo json_encode(['code' => 0, 'msg' => '提交成功，等待客服审核']); return;
        }else{
            echo json_encode(['code' => -2, 'msg' => '提交失败，网络异常~']); return;
        }
    }catch (Exception $e){

    }
}else{
    for($i=0; $i<sizeof($data['field']['id']); $i++){
        Db::table('sd_matter')->where('id',$data['field']['id'][$i])->update(['number' => $data['field']['number'][$i], 'is_pay' => 2]);
    }
    echo json_encode(['code' => 0, 'msg' => '提交成功，等待客服审核']);return;
}