<?php
/**
 * 示例接口名称：pdd.ktt.purchase.order.list
*/
require_once dirname(__FILE__).'/Config.php';
require_once dirname(__FILE__)."/../vendor/autoload.php";

use Com\Pdd\Pop\Sdk\PopHttpClient;
use Com\Pdd\Pop\Sdk\Api\Request\PddKttPurchaseOrderListRequest;
$client = new PopHttpClient(Config::$clientId, Config::$clientSecret);

$request = new PddKttPurchaseOrderListRequest();

$request->setCancelStatus(1);
$request->setEndUpdatedTime(1);
$request->setPageNo(1);
$request->setPageSize(1);
$request->setShippingStatus(1);
$request->setStartUpdateTime(1);
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