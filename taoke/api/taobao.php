<?php
require_once dirname(__FILE__) . '/Config.php';
require_once dirname(__FILE__) . '/extend/taobao/TopSdk.php';

function getTaobao($page) {
    $c = new TopClient;
    $c->appkey = Config::$taobaoAppKey;
    $c->secretKey = Config::$taobaoAppSecret;
    $req = new TbkDgOptimusMaterialRequest;
    $req->setPageSize(50);
    $req->setAdzoneId(Config::$taobaoPid);
    $req->setPageNo($page);
    $req->setMaterialId(Config::$taobaolist);
    $resp = $c->execute($req);
    //将xml对象转换为json
    $searchData = json_encode($resp);
    // 将json转化为数组
    $searData = json_decode($searchData, true);
    // 拿到数据
    $taoke = $searData['result_list']['map_data'];
    if (!isset($taoke)) return false;

    $dataList = [];
    foreach ($taoke as $k => $v) {
        $dataList[$k]['item_id'] = $v['item_id']; //商品Id
        $dataList[$k]['original_price'] = $v['zk_final_price']; //商品原价
        $dataList[$k]['discount_price'] = bcsub(floatval($v["zk_final_price"]), floatval($v["coupon_amount"]), 1); //券后价
        $dataList[$k]['part_price'] = explode('.',bcsub(floatval($v["zk_final_price"]), floatval($v["coupon_amount"]), 2)); //将价格根据小数点分割成一个数组,保留两位小数点，没有补0
        $dataList[$k]['coupon'] = (string)$v['coupon_amount']; //券价
        $dataList[$k]['sales_volume'] = $v['volume']; //销量
        $dataList[$k]['img'] = $v['pict_url']; //主图
        $dataList[$k]['title'] = $v['title']; //标题
        $dataList[$k]['detail_img'] = $v['small_images']['string']; //详情图
        $dataList[$k]['coupon_link'] = 'taobao:' . $v['coupon_share_url']; //二合一券
    }

    $goods = json_encode(['code' => 0, 'msg' => '成功', 'data' => $dataList]);
    file_put_contents('./taobao/' . $page . '.json', $goods);
    return true;
}