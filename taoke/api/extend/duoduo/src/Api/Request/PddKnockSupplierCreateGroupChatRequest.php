<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockSupplierCreateGroupChatRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockSupplierCreateGroupChatRequest_GroupCreateReq, "group_create_req")
	*/
	private $groupCreateReq;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "group_create_req", $this->groupCreateReq);

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
		return "pdd.knock.supplier.create.group.chat";
	}

	public function setGroupCreateReq($groupCreateReq)
	{
		$this->groupCreateReq = $groupCreateReq;
	}

}

class PddKnockSupplierCreateGroupChatRequest_GroupCreateReq extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "group_notice")
	*/
	private $groupNotice;

	/**
	* @JsonProperty(String, "group_title")
	*/
	private $groupTitle;

	/**
	* @JsonProperty(List<String>, "member_user_number_list")
	*/
	private $memberUserNumberList;

	/**
	* @JsonProperty(String, "org_number")
	*/
	private $orgNumber;

	/**
	* @JsonProperty(String, "owner_user_number")
	*/
	private $ownerUserNumber;

	/**
	* @JsonProperty(String, "unique_id")
	*/
	private $uniqueId;

	public function setGroupNotice($groupNotice)
	{
		$this->groupNotice = $groupNotice;
	}

	public function setGroupTitle($groupTitle)
	{
		$this->groupTitle = $groupTitle;
	}

	public function setMemberUserNumberList($memberUserNumberList)
	{
		$this->memberUserNumberList = $memberUserNumberList;
	}

	public function setOrgNumber($orgNumber)
	{
		$this->orgNumber = $orgNumber;
	}

	public function setOwnerUserNumber($ownerUserNumber)
	{
		$this->ownerUserNumber = $ownerUserNumber;
	}

	public function setUniqueId($uniqueId)
	{
		$this->uniqueId = $uniqueId;
	}

}
