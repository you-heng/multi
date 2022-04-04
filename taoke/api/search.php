<?php
require_once dirname(__FILE__) . '/Config.php';
require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/extend/taobao/TopSdk.php';

use Com\Pdd\Pop\Sdk\PopHttpClient;
use Com\Pdd\Pop\Sdk\Api\Request\PddDdkGoodsSearchRequest;
use Com\Pdd\Pop\Sdk\Api\Request\PddDdkGoodsPromotionUrlGenerateRequest;

$data = $_GET;
if(empty($data['q'])){ echo json_encode(['code' => -1, 'msg' => '搜索内容不能为空', 'data' => []]); return false; }

$dataList = [];
if ($data['state'] == 1) {
    $dataList = taoSearch($data['q'], $data['page']);
} else if($data['state'] == 2) {
    $dataList = duoSearch($data['q'], $data['page']);
}

echo json_encode(['code' => 0, 'msg' => '成功', 'data' => $dataList]);

// 请求淘宝联盟
function taoSearch($q, $page) {
    $c = new TopClient;
    $c->appkey = Config::$taobaoAppKey;
    $c->secretKey = Config::$taobaoAppSecret;
    $req = new TbkDgMaterialOptionalRequest;
    $req->setStartTkRate(100);
    $req->setPageSize(50);
    $req->setPageNo($page);
    $req->setQ($q);
    $req->setHasCoupon("true");
    $req->setAdzoneId(Config::$taobaoPid);
    $resp = $c->execute($req);
    //将xml对象转换为json
    $searchData = json_encode($resp);
    // 将json转化为数组
    $searData = json_decode($searchData,true);
    // 拿到数据
    $data = $searData['result_list']['map_data'];

    $dataList = [];
    foreach ($data as $k => $v) {
        if ($v['pict_url'] !== '') {
            $dataList[$k]['original_price'] = $v['zk_final_price']; //原价
            $dataList[$k]['item_id'] = $v['item_id']; //商品id
            $dataList[$k]['discount_price'] = bcsub(floatval($v["zk_final_price"]), floatval($v["coupon_amount"]), 1); //券后价
            $dataList[$k]['part_price'] = explode('.',bcsub(floatval($v["zk_final_price"]), floatval($v["coupon_amount"]), 2)); //将价格根据小数点分割成一个数组,保留两位小数点，没有补0
            $dataList[$k]['coupon'] = $v['coupon_amount']; //优惠券价格
            $dataList[$k]['sales_volume'] = $v['volume']; //销量
            $dataList[$k]['img'] = $v['pict_url']; //商品主图
            $dataList[$k]['title'] = $v['title']; //标题
            $dataList[$k]['coupon_link'] = 'taobao:' . $v['coupon_share_url'];  //二合一链接
            $dataList[$k]['detail_img'] = $v['small_images']['string']; //详情图
        }
    }
    return $dataList;
}

// 多多进宝搜索接口
function duoSearch($q, $page) {
    $client = new PopHttpClient(Config::$clientId, Config::$clientSecret);
    $request = new PddDdkGoodsSearchRequest();

    $request->setActivityTags(array());
    $request->setBlockCatPackages(array());
    $request->setBlockCats(array());
    $request->setCatId('');
    $request->setCustomParameters("{\"new\":1}");
    $request->setGoodsImgType(1);
    $request->setGoodsSignList(array());
    $request->setIsBrandGoods(true);
    $request->setKeyword($q);
    $request->setListId('');
    $request->setMerchantType(1);
    $request->setMerchantTypeList(array());
    $request->setOptId('');
    $request->setPage($page);
    $request->setPageSize(100);
    $request->setPid(Config::$duoduojinbaoPid);
    $request->setRangeList(array());
    $request->setSortType('');
    $request->setWithCoupon('');
    try{
        $response = $client->syncInvoke($request);
    } catch(Com\Pdd\Pop\Sdk\PopHttpException $e){
        echo $e->getMessage();
        exit;
    }
    $content = $response->getContent();
    if(isset($content['error_response'])) return false;
    $dataList = [];
    foreach ($content['goods_search_response']['goods_list'] as $k => $v) {
        if ($v['goods_image_url'] !== '') {
             $dataList[] = $v;
        }
    }
    $goodsList = [];
    foreach ($dataList as $k => $v) {
        $goodsList[$k] = $v['goods_sign'];
    }
    $dataLink = urlGenerate($goodsList);
    if ($dataLink === false) $dataLink = urlGenerate($goodsList);
    $dataLink = $dataLink['goods_promotion_url_generate_response']['goods_promotion_url_list'];
    foreach ($dataList as $k => $v) {
        $dataList[$k]['coupon_link'] = $dataLink[$k]['mobile_short_url'];
    }
    $result = [];
    foreach ($dataList as $k => $v) {
        $result[$k]['state'] = 2; //状态 2-表示要发起请求从拼多多拉取信息
        $result[$k]['original_price'] = bcdiv($v['min_group_price'],100,2); //原价
        $result[$k]['item_id'] = $v['goods_id']; //商品id
        $result[$k]['discount_price'] = bcsub(bcdiv($v['min_group_price'],100),bcdiv($v['coupon_discount'],100),2); //券后价
        $result[$k]['part_price'] = explode('.',bcsub(bcdiv($v['min_group_price'],100,2),bcdiv($v['coupon_discount'],100),2), 2); //将价格根据小数点分割成一个数组,保留两位小数点，没有补0
        $result[$k]['coupon'] = bcdiv($v['coupon_discount'],100,2); //优惠券价格
        $result[$k]['sales_volume'] = $v['sales_tip']; //销量
        $result[$k]['img'] = $v['goods_image_url']; //商品主图
        $result[$k]['title'] = $v['goods_name']; //标题
        $result[$k]['goods_sign'] = $v['goods_sign'];  //id
        //判断是否有轮播图，如果有轮播图就把轮播图当作详情，如果没有将主图当作详情图
        if(isset($v['goods_gallery_urls'])){
            $result[$k]['detail_img'] = $v['goods_gallery_urls']; //详情图
        }else{
            $result[$k]['detail_img'] = array($v['goods_image_url']); //详情图
        }
        $result[$k]['coupon_link'] = str_replace('https','pinduoduo',$v['coupon_link']); //二合一券
    }
    return $result;
}

// 多多进宝换链接接口
function urlGenerate($goodsList) {
    $client = new PopHttpClient(Config::$clientId, Config::$clientSecret);
    $request = new PddDdkGoodsPromotionUrlGenerateRequest();

    $request->setCashGiftName('');
    $request->setCustomParameters("{\"new\":1}");
    $request->setGenerateAuthorityUrl(true);
    $request->setGenerateMallCollectCoupon(true);
    $request->setGenerateQqApp(true);
    $request->setGenerateSchemaUrl(true);
    $request->setGenerateShortUrl(true);
    $request->setGenerateWeApp(true);
    $request->setGoodsSignList($goodsList);
    $request->setMaterialId('str');
    $request->setMultiGroup(true);
    $request->setPId(Config::$duoduojinbaoPid);
    $request->setSearchId('str');
    $request->setZsDuoId(1);
    try{
        $response = $client->syncInvoke($request);
    } catch(Com\Pdd\Pop\Sdk\PopHttpException $e){
        echo $e->getMessage();
        exit;
    }
    $content = $response->getContent();
    if (isset($content['error_response'])){
        return false;
    } else {
        return $content;
    }
}