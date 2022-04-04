<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockOauthExchangeIdentityRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockOauthExchangeIdentityRequest_KnockOauthIdentityExchangeReq, "knock_oauth_identity_exchange_req")
	*/
	private $knockOauthIdentityExchangeReq;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "knock_oauth_identity_exchange_req", $this->knockOauthIdentityExchangeReq);

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
		return "pdd.knock.oauth.exchange.identity";
	}

	public function setKnockOauthIdentityExchangeReq($knockOauthIdentityExchangeReq)
	{
		$this->knockOauthIdentityExchangeReq = $knockOauthIdentityExchangeReq;
	}

}

class PddKnockOauthExchangeIdentityRequest_KnockOauthIdentityExchangeReq extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "access_token")
	*/
	private $accessToken;

	public function setAccessToken($accessToken)
	{
		$this->accessToken = $accessToken;
	}

}
