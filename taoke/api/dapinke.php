<?php
require_once dirname(__FILE__).'/Config.php';
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Com\Pdd\Pop\Sdk\PopHttpClient;
use Com\Pdd\Pop\Sdk\Api\Request\PddDdkGoodsPromotionUrlGenerateRequest;

function getPinke($page) {
    // 获取大拼客榜单
    $result = getDapinke($page);

    // 将goods_id取出来
    $goodsList = [];
    foreach($result as $k => $v) {
        $goodsList[] = $v['goods_sign'];
    }

    // 使用goods_id换取链接
    $dataLink = urlGenerate($goodsList);

    if ($dataLink === false) return false;

    // 将链接加上去
    foreach($dataLink['goods_promotion_url_generate_response']['goods_promotion_url_list'] as $k => $v) {
        $result[$k]['coupon_link'] = $v['mobile_short_url'];
    }

    // 将需要的信息过滤出来
    $dataList = [];
    foreach($result as $k => $v){
        $dataList[$k]['item_id'] = $v['goods_sign']; //id
        $dataList[$k]['original_price'] = $v['price'];//原价
        $dataList[$k]['discount_price'] = $v['after_coupon_price'];//券后价
        $dataList[$k]['part_price'] = explode('.',sprintf("%1\$.2f", $v['after_coupon_price']));  //将价格根据小数点分割成一个数组,保留两位小数点，没有补0
        $dataList[$k]['coupon'] = $v['coupon_discount']; //券价
        $dataList[$k]['sales_volume'] = $v['sales_tip']; //销量
        $dataList[$k]['img'] = $v['index_image']; //主图
        $dataList[$k]['title'] = $v['goods_title']; //标题
        $dataList[$k]['goods_sign'] = $v['goods_sign']; //goods_sign
        //判断是否有详情图
        if($v['img_show']){
            $dataList[$k]['detail_img'] = $v['img_show']; //详情图
        }else{
            $dataList[$k]['detail_img'] = [
                0 => $v['index_image'],
                1 => $v['second_image']
            ];
        }
        $dataList[$k]['coupon_link'] = str_replace('https','pinduoduo',$v['coupon_link']); //二合一券
    }

    // 将内容存储起来
    $goods = json_encode(['code' => 0, 'msg' => '成功', 'data' => $dataList]);
    file_put_contents('./dapinke/' . $page . '.json', $goods);
    return true;
}

// 大拼客接口
function getDapinke($page) {
    $postData = array(
        'app_key' => Config::$dapinkeAppKey,
        'page' => $page,
        'pageSize' => 50
    );
    $headers = array('Content-Type: application/x-www-form-urlencoded');
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, Config::$dapinkeUrl); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData)); // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        echo 'Errno'.curl_error($curl);//捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    $res = json_decode($result,true);
    return $res['data']['data'];
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
        // echo "异常返回";
        return false;
    } else {
        return $content;
    }
}
