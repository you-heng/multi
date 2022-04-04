<?php
require_once dirname(__FILE__) . '/Config.php';
require_once dirname(__FILE__) . '/vendor/autoload.php';

function getTaoke($page) {
    $client = new GetRankingList();
    $client->setAppKey(Config::$dataokeAppKey);
    $client->setAppSecret(Config::$dataokeAppSecret);
    $client->setVersion('v3.0.0');
    $client->setParams(['rankType' => Config::$dataokeList, 'pageSize' => 50, 'pageId' => $page]);
    $result = $client->request();
    $result = json_decode($result, true);

    $dataList = [];
    foreach ($result['data'] as $k => $v) {
        $dataList[$k]['item_id'] = $v['goodsId']; //商品Id
        $dataList[$k]['original_price'] = $v['originalPrice']; //商品原价
        $dataList[$k]['discount_price'] = $v['actualPrice']; //券后价
        $dataList[$k]['part_price'] = explode('.',sprintf("%1\$.2f", $v['actualPrice'])); //将价格根据小数点分割成一个数组
        $dataList[$k]['coupon'] = (string)$v['couponPrice']; //券价
        $dataList[$k]['sales_volume'] = $v['monthSales']; //销量
        $dataList[$k]['img'] = $v['mainPic']; //主图
        $dataList[$k]['title'] = $v['dtitle']; //标题
        $dataList[$k]['detail_img'] = explode(',', $v['imgs']); //详情图
        // 拼接二合一券
        $dataList[$k]['coupon_link'] = str_replace('https://uland.taobao.com/quan/detail', 'taobao://uland.taobao.com/coupon/edetail', $v['couponLink']);
        $dataList[$k]['coupon_link'] .= '&itemId=' . $v['goodsId'] . '&pid=' . Config::$dataokePid;
    }

    // 将内容存储起来
    $goods = json_encode(['code' => 0, 'msg' => '成功', 'data' => $dataList]);
    file_put_contents('./dataoke/' . $page . '.json', $goods);
    return true;
}
