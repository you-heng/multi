<?php
require_once 'connet.php';
require_once 'api-auth.php';
use think\facade\Db;
$data = $_POST;
if($data['type'] == 1){ //增加
    $result = Db::table('sd_link')->insert(['shop_id' => $data['data']['shop_id'],'link' => $data['data']['link']]);
    if($result){
        echo json_encode(['code' => 0, 'msg' => '添加成功']);return;
    }else{
        echo json_encode(['code' => -1, 'msg' => '添加失败']);return;
    }
}else if($data['type'] == 2){ //修改
    $result = Db::table('sd_link')->where('id',$data['data']['id'])->update($data['data']);
    if($result){
        echo json_encode(['code' => 0, 'msg' => '修改成功']);return;
    }else{
        echo json_encode(['code' => -1, 'msg' => '修改失败']);return;
    }
}else if($data['type'] == 3){ //删除
    if(Db::table('sd_link')->delete($data['id'])){
        echo json_encode(['code' => 0, 'msg' => '删除成功']);return;
    }else{
        echo json_encode(['code' => -1, 'msg' => '删除失败']);return;
    }
}else if($data['type'] == 4){ //获取店铺名
    $result = Db::table('sd_shop')->select()->toArray();
    if(!empty($result)){
        echo json_encode(['code' => 0, 'msg' => '成功','data' => $result]);return;
    }else{
        echo json_encode(['code' => -1, 'msg' => '失败']);return;
    }
}else if($data['type'] == 5){ //搜索
    $result = Db::table('sd_shop')
        ->alias('t1')
        ->join('sd_link t2','t1.id=t2.shop_id','left')
        ->where('t1.shop_name','like',"%".$data['data']['shop_name']."%")
        ->field('t1.shop_name,t2.*')
        ->page($data['page'],$data['limit'])
        ->select()
        ->toArray();
    foreach($result as $k => $v){
        if($v['id'] == NULL){
            unset($result[$k]);
        }
    }
    if(!empty($result)){
        echo json_encode(['code' => 0, 'msg' => '成功','data' => $result]);
    }else{
        echo json_encode(['code' => -1, 'msg' => '暂无内容~']);
    }
}