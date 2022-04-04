<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddKnockSupplierSendGroupRobotNoticeRequest extends PopBaseHttpRequest
{
    public function __construct()
	{

	}
	/**
	* @JsonProperty(\Com\Pdd\Pop\Sdk\Api\Request\PddKnockSupplierSendGroupRobotNoticeRequest_GroupRobotSendNoticeReq, "group_robot_send_notice_req")
	*/
	private $groupRobotSendNoticeReq;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "group_robot_send_notice_req", $this->groupRobotSendNoticeReq);

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
		return "pdd.knock.supplier.send.group.robot.notice";
	}

	public function setGroupRobotSendNoticeReq($groupRobotSendNoticeReq)
	{
		$this->groupRobotSendNoticeReq = $groupRobotSendNoticeReq;
	}

}

class PddKnockSupplierSendGroupRobotNoticeRequest_GroupRobotSendNoticeReq extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(Boolean, "at_all")
	*/
	private $atAll;

	/**
	* @JsonProperty(String, "content")
	*/
	private $content;

	/**
	* @JsonProperty(String, "group_robot_token")
	*/
	private $groupRobotToken;

	public function setAtAll($atAll)
	{
		$this->atAll = $atAll;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function setGroupRobotToken($groupRobotToken)
	{
		$this->groupRobotToken = $groupRobotToken;
	}

}
