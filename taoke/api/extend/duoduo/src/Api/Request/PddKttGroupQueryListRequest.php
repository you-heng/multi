<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKttGroupQueryListRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(Long, "end_update_time")
	*/
	private $endUpdateTime;

	/**
	* @JsonProperty(Integer, "page")
	*/
	private $page;

	/**
	* @JsonProperty(Integer, "size")
	*/
	private $size;

	/**
	* @JsonProperty(Long, "start_update_time")
	*/
	private $startUpdateTime;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "end_update_time", $this->endUpdateTime);
		$this->setUserParam($params, "page", $this->page);
		$this->setUserParam($params, "size", $this->size);
		$this->setUserParam($params, "start_update_time", $this->startUpdateTime);

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
		return "pdd.ktt.group.query.list";
	}

	public function setEndUpdateTime($endUpdateTime)
	{
		$this->endUpdateTime = $endUpdateTime;
	}

	public function setPage($page)
	{
		$this->page = $page;
	}

	public function setSize($size)
	{
		$this->size = $size;
	}

	public function setStartUpdateTime($startUpdateTime)
	{
		$this->startUpdateTime = $startUpdateTime;
	}

}
