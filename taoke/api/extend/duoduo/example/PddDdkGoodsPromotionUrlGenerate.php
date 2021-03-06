<?php
/**
 * 示例接口名称：pdd.ddk.goods.promotion.url.generate
*/
require_once dirname(__FILE__).'/Config.php';
require_once dirname(__FILE__)."/../vendor/autoload.php";

use Com\Pdd\Pop\Sdk\PopHttpClient;
use Com\Pdd\Pop\Sdk\Api\Request\PddDdkGoodsPromotionUrlGenerateRequest;
$client = new PopHttpClient(Config::$clientId, Config::$clientSecret);

$request = new PddDdkGoodsPromotionUrlGenerateRequest();

$request->setCashGiftId(1);
$request->setCashGiftName('str');
$request->setCustomParameters('str');
$request->setGenerateAuthorityUrl(true);
$request->setGenerateMallCollectCoupon(true);
$request->setGenerateQqApp(true);
$request->setGenerateSchemaUrl(true);
$request->setGenerateShortUrl(true);
$request->setGenerateWeApp(true);
$request->setGoodsSignList(array('str'));
$request->setMaterialId('str');
$request->setMultiGroup(true);
$request->setPId('str');
$request->setSearchId('str');
$request->setZsDuoId(1);
try{
	$response = $client->syncInvoke($request);
} catch(Com\Pdd\Pop\Sdk\PopHttpException $e){
	echo $e->getMessage();
	exit;
}
$content = $response->getContent();
if(isset($content['error_response'])){
	echo "异常返回";
}
echo json_encode($content,JSON_UNESCAPED_UNICODE);