<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockSupplierRbacRoleRelationBindRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockSupplierRbacRoleRelationBindRequest_Request, "request")
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
		return "pdd.knock.supplier.rbac.role.relation.bind";
	}

	public function setRequest($request)
	{
		$this->request = $request;
	}

}

class PddKnockSupplierRbacRoleRelationBindRequest_Request extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "from_role_key")
	*/
	private $fromRoleKey;

	/**
	* @JsonProperty(String, "to_role_key")
	*/
	private $toRoleKey;

	public function setFromRoleKey($fromRoleKey)
	{
		$this->fromRoleKey = $fromRoleKey;
	}

	public function setToRoleKey($toRoleKey)
	{
		$this->toRoleKey = $toRoleKey;
	}

}
