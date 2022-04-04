<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockOauthExchangeAccessTokenRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockOauthExchangeAccessTokenRequest_KnockAccessTokenExchangeReq, "knock_access_token_exchange_req")
	*/
	private $knockAccessTokenExchangeReq;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "knock_access_token_exchange_req", $this->knockAccessTokenExchangeReq);

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
		return "pdd.knock.oauth.exchange.access.token";
	}

	public function setKnockAccessTokenExchangeReq($knockAccessTokenExchangeReq)
	{
		$this->knockAccessTokenExchangeReq = $knockAccessTokenExchangeReq;
	}

}

class PddKnockOauthExchangeAccessTokenRequest_KnockAccessTokenExchangeReq extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "app_id")
	*/
	private $appId;

	/**
	* @JsonProperty(String, "code")
	*/
	private $code;

	/**
	* @JsonProperty(String, "grant_type")
	*/
	private $grantType;

	/**
	* @JsonProperty(String, "sign")
	*/
	private $sign;

	public function setAppId($appId)
	{
		$this->appId = $appId;
	}

	public function setCode($code)
	{
		$this->code = $code;
	}

	public function setGrantType($grantType)
	{
		$this->grantType = $grantType;
	}

	public function setSign($sign)
	{
		$this->sign = $sign;
	}

}
