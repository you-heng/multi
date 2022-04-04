<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddFdsWaybillReturnSlaveRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddFdsWaybillReturnSlaveRequest_Request, "request")
	*/
	private $request;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "request", $this->request);

	}

	public function getVersion()
	{
		return "V1";
	}

	public function getDataType()
	{
		return "JSON";
	}

	public function getType()
	{
		return "pdd.fds.waybill.return.slave";
	}

	public function setRequest($request)
	{
		$this->request = $request;
	}

}

class PddFdsWaybillReturnSlaveRequest_Request extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "mall_mask_id")
	*/
	private $mallMaskId;

	/**
	* @JsonProperty(String, "order_mask_sn")
	*/
	private $orderMaskSn;

	/**
	* @JsonProperty(List<String>, "waybill_codes")
	*/
	private $waybillCodes;

	/**
	* @JsonProperty(String, "wp_code")
	*/
	private $wpCode;

	public function setMallMaskId($mallMaskId)
	{
		$this->mallMaskId = $mallMaskId;
	}

	public function setOrderMaskSn($orderMaskSn)
	{
		$this->orderMaskSn = $orderMaskSn;
	}

	public function setWaybillCodes($waybillCodes)
	{
		$this->waybillCodes = $waybillCodes;
	}

	public function setWpCode($wpCode)
	{
		$this->wpCode = $wpCode;
	}

}
