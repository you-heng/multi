<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockGetSupplierImgBodyRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockGetSupplierImgBodyRequest_SupplierFileReq, "supplier_file_req")
	*/
	private $supplierFileReq;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "supplier_file_req", $this->supplierFileReq);

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
		return "pdd.knock.get.supplier.img.body";
	}

	public function setSupplierFileReq($supplierFileReq)
	{
		$this->supplierFileReq = $supplierFileReq;
	}

}

class PddKnockGetSupplierImgBodyRequest_SupplierFileReq extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "robot_name")
	*/
	private $robotName;

	/**
	* @JsonProperty(String, "url")
	*/
	private $url;

	public function setRobotName($robotName)
	{
		$this->robotName = $robotName;
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

}
