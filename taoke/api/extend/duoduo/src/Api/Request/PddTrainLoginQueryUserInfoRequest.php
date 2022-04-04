<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddTrainLoginQueryUserInfoRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(String, "crh_account")
	*/
	private $crhAccount;

	/**
	* @JsonProperty(String, "crh_password")
	*/
	private $crhPassword;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "crh_account", $this->crhAccount);
		$this->setUserParam($params, "crh_password", $this->crhPassword);

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
		return "pdd.train.login.query.user.info";
	}

	public function setCrhAccount($crhAccount)
	{
		$this->crhAccount = $crhAccount;
	}

	public function setCrhPassword($crhPassword)
	{
		$this->crhPassword = $crhPassword;
	}

}
