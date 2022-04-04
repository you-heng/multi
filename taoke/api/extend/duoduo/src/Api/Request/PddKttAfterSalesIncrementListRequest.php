<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKttAfterSalesIncrementListRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(Long, "end_updated_at")
	*/
	private $endUpdatedAt;

	/**
	* @JsonProperty(Integer, "page_number")
	*/
	private $pageNumber;

	/**
	* @JsonProperty(Integer, "page_size")
	*/
	private $pageSize;

	/**
	* @JsonProperty(Long, "start_updated_at")
	*/
	private $startUpdatedAt;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "end_updated_at", $this->endUpdatedAt);
		$this->setUserParam($params, "page_number", $this->pageNumber);
		$this->setUserParam($params, "page_size", $this->pageSize);
		$this->setUserParam($params, "start_updated_at", $this->startUpdatedAt);

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
		return "pdd.ktt.after.sales.increment.list";
	}

	public function setEndUpdatedAt($endUpdatedAt)
	{
		$this->endUpdatedAt = $endUpdatedAt;
	}

	public function setPageNumber($pageNumber)
	{
		$this->pageNumber = $pageNumber;
	}

	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
	}

	public function setStartUpdatedAt($startUpdatedAt)
	{
		$this->startUpdatedAt = $startUpdatedAt;
	}

}
