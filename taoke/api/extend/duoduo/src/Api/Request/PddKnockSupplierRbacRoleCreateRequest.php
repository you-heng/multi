<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockSupplierRbacRoleCreateRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockSupplierRbacRoleCreateRequest_Request, "request")
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
		return "pdd.knock.supplier.rbac.role.create";
	}

	public function setRequest($request)
	{
		$this->request = $request;
	}

}

class PddKnockSupplierRbacRoleCreateRequest_Request extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "org_number")
	*/
	private $orgNumber;

	public function setOrgNumber($orgNumber)
	{
		$this->orgNumber = $orgNumber;
	}

}
