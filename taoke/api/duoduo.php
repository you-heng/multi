<?php
require_once dirname(__FILE__).'/Config.php';
require_once dirname(__FILE__)."/vendor/autoload.php";

use Com\Pdd\Pop\Sdk\PopHttpClient;
use Com\Pdd\Pop\Sdk\Api\Request\PddDdkGoodsRecommendGetRequest;
use Com\Pdd\Pop\Sdk\Api\Request\PddDdkGoodsPromotionUrlGenerateRequest;

function getDuoduo($page) {
    $client = new PopHttpClient(Config::$clientId, Config::$clientSecret);
    $request = new PddDdkGoodsRecommendGetRequest();

    $request->setChannelType(1);
    $request->setCustomParameters("{\"new\":1}");
    $request->setLimit(50);
    $request->setOffset(50 * $page);
    $request->setPid(Config::$duoduojinbaoPid);
    try{
        $response = $client->syncInvoke($request);
    } catch(Com\Pdd\Pop\Sdk\PopHttpException $e){
        echo $e->getMessage();
        exit;
    }
    $content = $response->getContent();
    if(isset($content['error_response'])) return false;
    $dataList = [];
    foreach ($content['goods_basic_detail_response']['list'] as $k => $v) {
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
    $page = $page + 1;
    // 将内容存储起来
    $goods = json_encode(['code' => 0, 'msg' => '成功', 'data' => $result]);
    file_put_contents('./duoduo/' . $page . '.json', $goods);
    return true;
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