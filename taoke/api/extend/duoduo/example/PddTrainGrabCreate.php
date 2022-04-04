<?php
/**
 * 示例接口名称：pdd.train.grab.create
*/
require_once dirname(__FILE__).'/Config.php';
require_once dirname(__FILE__)."/../vendor/autoload.php";

use Com\Pdd\Pop\Sdk\PopHttpClient;
use Com\Pdd\Pop\Sdk\Api\Request\PddTrainGrabCreateRequest;
$client = new PopHttpClient(Config::$clientId, Config::$clientSecret);

$request = new PddTrainGrabCreateRequest();

$request->setCrhAccount('str');
$request->setCrhPassword('str');
$request->setDepartDates(array('str'));
$request->setEndTime('str');
$request->setHaveAccount('str');
$request->setIsReserveFirst(1);
$request->setPassengerInfos();
$request->setPddOrderId('str');
$request->setSeatTypes(array(1));
$request->setSumTicketPrice('str');
$request->setTravelInfos();
$request->setIsOtcbookGrab(1);
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