<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockSupplierQueryMemberInfoByMobileMd5Request extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockSupplierQueryMemberInfoByMobileMd5Request_Request, "request")
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
		return "pdd.knock.supplier.query.member.info.by.mobile.md5";
	}

	public function setRequest($request)
	{
		$this->request = $request;
	}

}

class PddKnockSupplierQueryMemberInfoByMobileMd5Request_Request extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(List<String>, "md5_mobiles")
	*/
	private $md5Mobiles;

	public function setMd5Mobiles($md5Mobiles)
	{
		$this->md5Mobiles = $md5Mobiles;
	}

}
