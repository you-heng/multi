<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockSupplierQueryMemberInfoByKnockIdRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockSupplierQueryMemberInfoByKnockIdRequest_Request, "request")
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
		return "pdd.knock.supplier.query.member.info.by.knock.id";
	}

	public function setRequest($request)
	{
		$this->request = $request;
	}

}

class PddKnockSupplierQueryMemberInfoByKnockIdRequest_Request extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(List<String>, "knock_id_list")
	*/
	private $knockIdList;

	public function setKnockIdList($knockIdList)
	{
		$this->knockIdList = $knockIdList;
	}

}
