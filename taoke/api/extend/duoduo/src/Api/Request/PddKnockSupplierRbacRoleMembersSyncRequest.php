<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockSupplierRbacRoleMembersSyncRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockSupplierRbacRoleMembersSyncRequest_Request, "request")
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
		return "pdd.knock.supplier.rbac.role.members.sync";
	}

	public function setRequest($request)
	{
		$this->request = $request;
	}

}

class PddKnockSupplierRbacRoleMembersSyncRequest_Request extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "modify_action_enum")
	*/
	private $modifyActionEnum;

	/**
	* @JsonProperty(String, "role_key")
	*/
	private $roleKey;

	/**
	* @JsonProperty(List<String>, "user_numbers")
	*/
	private $userNumbers;

	public function setModifyActionEnum($modifyActionEnum)
	{
		$this->modifyActionEnum = $modifyActionEnum;
	}

	public function setRoleKey($roleKey)
	{
		$this->roleKey = $roleKey;
	}

	public function setUserNumbers($userNumbers)
	{
		$this->userNumbers = $userNumbers;
	}

}
