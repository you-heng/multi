<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddDdkStatisticsDataQueryRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(Integer, "page")
	*/
	private $page;

	/**
	* @JsonProperty(Integer, "page_size")
	*/
	private $pageSize;

	/**
	* @JsonProperty(Integer, "period_type")
	*/
	private $periodType;

	/**
	* @JsonProperty(Integer, "statistics_type")
	*/
	private $statisticsType;

	/**
	* @JsonProperty(String, "time")
	*/
	private $time;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "page", $this->page);
		$this->setUserParam($params, "page_size", $this->pageSize);
		$this->setUserParam($params, "period_type", $this->periodType);
		$this->setUserParam($params, "statistics_type", $this->statisticsType);
		$this->setUserParam($params, "time", $this->time);

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
		return "pdd.ddk.statistics.data.query";
	}

	public function setPage($page)
	{
		$this->page = $page;
	}

	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
	}

	public function setPeriodType($periodType)
	{
		$this->periodType = $periodType;
	}

	public function setStatisticsType($statisticsType)
	{
		$this->statisticsType = $statisticsType;
	}

	public function setTime($time)
	{
		$this->time = $time;
	}

}
