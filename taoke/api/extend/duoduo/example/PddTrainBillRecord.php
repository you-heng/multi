<?php
/**
 * 示例接口名称：pdd.train.bill.record
*/
require_once dirname(__FILE__).'/Config.php';
require_once dirname(__FILE__)."/../vendor/autoload.php";

use Com\Pdd\Pop\Sdk\PopHttpClient;
use Com\Pdd\Pop\Sdk\Api\Request\PddTrainBillRecordRequest;
$client = new PopHttpClient(Config::$clientId, Config::$clientSecret);

$request = new PddTrainBillRecordRequest();

$request->setBookType(1);
$request->setChangedTime('str');
$request->setChangeType(1);
$request->setConfirmedTime('str');
$request->setCrhAccount(1);
$request->setCrhOrder('str');
$request->setSubCrhOrder('str');
$request->setDate('str');
$request->setOrderId('str');
$request->setSubOrderId('str');
$request->setPddOrderId('str');
$request->setSubPddOrderId('str');
$request->setReturnedTime('str');
$request->setServiceAmount(1);
$request->setServicePrice(1);
$request->setTicketStatus(1);
$request->setVersion(1);
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