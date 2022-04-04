<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddLogisticsAvailableCompanyRecommendRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(List<Long>, "city_id")
	*/
	private $cityId;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "city_id", $this->cityId);

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
		return "pdd.logistics.available.company.recommend";
	}

	public function setCityId($cityId)
	{
		$this->cityId = $cityId;
	}

}
