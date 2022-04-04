<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddOrderUploadRelationLogisticsRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(List<\Com\Pdd\Pop\Sdk\Api\Request\PddOrderUploadRelationLogisticsRequest_ExtraTrackListItem>, "extra_track_list")
	*/
	private $extraTrackList;

	/**
	* @JsonProperty(String, "order_sn")
	*/
	private $orderSn;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "extra_track_list", $this->extraTrackList);
		$this->setUserParam($params, "order_sn", $this->orderSn);

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
		return "pdd.order.upload.relation.logistics";
	}

	public function setExtraTrackList($extraTrackList)
	{
		$this->extraTrackList = $extraTrackList;
	}

	public function setOrderSn($orderSn)
	{
		$this->orderSn = $orderSn;
	}

}

class PddOrderUploadRelationLogisticsRequest_ExtraTrackListItem extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(Integer, "shipping_id")
	*/
	private $shippingId;

	/**
	* @JsonProperty(String, "tracking_number")
	*/
	private $trackingNumber;

	public function setShippingId($shippingId)
	{
		$this->shippingId = $shippingId;
	}

	public function setTrackingNumber($trackingNumber)
	{
		$this->trackingNumber = $trackingNumber;
	}

}
