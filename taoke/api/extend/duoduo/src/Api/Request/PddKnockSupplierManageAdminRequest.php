<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockSupplierManageAdminRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockSupplierManageAdminRequest_SupplierManageAdminReq, "supplier_manage_admin_req")
	*/
	private $supplierManageAdminReq;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "supplier_manage_admin_req", $this->supplierManageAdminReq);

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
		return "pdd.knock.supplier.manage.admin";
	}

	public function setSupplierManageAdminReq($supplierManageAdminReq)
	{
		$this->supplierManageAdminReq = $supplierManageAdminReq;
	}

}

class PddKnockSupplierManageAdminRequest_SupplierManageAdminReq extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(List<\Com\Pdd\Pop\Sdk\Api\Request\PddKnockSupplierManageAdminRequest_tring, List<String>>, "admin_manage_uid_org_map")
	*/
	private $adminManageUidOrgMap;

	/**
	* @JsonProperty(String, "admin_option")
	*/
	private $adminOption;

	public function setAdminManageUidOrgMap($adminManageUidOrgMap)
	{
		$this->adminManageUidOrgMap = $adminManageUidOrgMap;
	}

	public function setAdminOption($adminOption)
	{
		$this->adminOption = $adminOption;
	}

}
