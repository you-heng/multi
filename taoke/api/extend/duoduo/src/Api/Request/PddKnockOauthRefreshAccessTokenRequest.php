<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockOauthRefreshAccessTokenRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockOauthRefreshAccessTokenRequest_KnockOauthTokenRefreshReq, "knock_oauth_token_refresh_req")
	*/
	private $knockOauthTokenRefreshReq;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "knock_oauth_token_refresh_req", $this->knockOauthTokenRefreshReq);

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
		return "pdd.knock.oauth.refresh.access.token";
	}

	public function setKnockOauthTokenRefreshReq($knockOauthTokenRefreshReq)
	{
		$this->knockOauthTokenRefreshReq = $knockOauthTokenRefreshReq;
	}

}

class PddKnockOauthRefreshAccessTokenRequest_KnockOauthTokenRefreshReq extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "app_id")
	*/
	private $appId;

	/**
	* @JsonProperty(String, "grant_type")
	*/
	private $grantType;

	/**
	* @JsonProperty(String, "refresh_token")
	*/
	private $refreshToken;

	public function setAppId($appId)
	{
		$this->appId = $appId;
	}

	public function setGrantType($grantType)
	{
		$this->grantType = $grantType;
	}

	public function setRefreshToken($refreshToken)
	{
		$this->refreshToken = $refreshToken;
	}

}
