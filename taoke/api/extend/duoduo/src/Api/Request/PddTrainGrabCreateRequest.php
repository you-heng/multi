<?php
namespace Com\Pdd\Pop\Sdk\Api\Request;

use Com\Pdd\Pop\Sdk\PopBaseHttpRequest;
use Com\Pdd\Pop\Sdk\PopBaseJsonEntity;

class PddTrainGrabCreateRequest extends PopBaseHttpRequest
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

	/**
	* @JsonProperty(List<String>, "depart_dates")
	*/
	private $departDates;

	/**
	* @JsonProperty(String, "end_time")
	*/
	private $endTime;

	/**
	* @JsonProperty(String, "have_account")
	*/
	private $haveAccount;

	/**
	* @JsonProperty(Integer, "is_reserve_first")
	*/
	private $isReserveFirst;

	/**
	* @JsonProperty(List<\Com\Pdd\Pop\Sdk\Api\Request\PddTrainGrabCreateRequest_PassengerInfosItem>, "passenger_infos")
	*/
	private $passengerInfos;

	/**
	* @JsonProperty(String, "pdd_order_id")
	*/
	private $pddOrderId;

	/**
	* @JsonProperty(List<Integer>, "seat_types")
	*/
	private $seatTypes;

	/**
	* @JsonProperty(String, "sum_ticket_price")
	*/
	private $sumTicketPrice;

	/**
	* @JsonProperty(List<\Com\Pdd\Pop\Sdk\Api\Request\PddTrainGrabCreateRequest_TravelInfosItem>, "travel_infos")
	*/
	private $travelInfos;

	/**
	* @JsonProperty(Integer, "is_otcbook_grab")
	*/
	private $isOtcbookGrab;

	protected function setUserParams(&$params)
	{
		$this->setUserParam($params, "crh_account", $this->crhAccount);
		$this->setUserParam($params, "crh_password", $this->crhPassword);
		$this->setUserParam($params, "depart_dates", $this->departDates);
		$this->setUserParam($params, "end_time", $this->endTime);
		$this->setUserParam($params, "have_account", $this->haveAccount);
		$this->setUserParam($params, "is_reserve_first", $this->isReserveFirst);
		$this->setUserParam($params, "passenger_infos", $this->passengerInfos);
		$this->setUserParam($params, "pdd_order_id", $this->pddOrderId);
		$this->setUserParam($params, "seat_types", $this->seatTypes);
		$this->setUserParam($params, "sum_ticket_price", $this->sumTicketPrice);
		$this->setUserParam($params, "travel_infos", $this->travelInfos);
		$this->setUserParam($params, "is_otcbook_grab", $this->isOtcbookGrab);

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
		return "pdd.train.grab.create";
	}

	public function setCrhAccount($crhAccount)
	{
		$this->crhAccount = $crhAccount;
	}

	public function setCrhPassword($crhPassword)
	{
		$this->crhPassword = $crhPassword;
	}

	public function setDepartDates($departDates)
	{
		$this->departDates = $departDates;
	}

	public function setEndTime($endTime)
	{
		$this->endTime = $endTime;
	}

	public function setHaveAccount($haveAccount)
	{
		$this->haveAccount = $haveAccount;
	}

	public function setIsReserveFirst($isReserveFirst)
	{
		$this->isReserveFirst = $isReserveFirst;
	}

	public function setPassengerInfos($passengerInfos)
	{
		$this->passengerInfos = $passengerInfos;
	}

	public function setPddOrderId($pddOrderId)
	{
		$this->pddOrderId = $pddOrderId;
	}

	public function setSeatTypes($seatTypes)
	{
		$this->seatTypes = $seatTypes;
	}

	public function setSumTicketPrice($sumTicketPrice)
	{
		$this->sumTicketPrice = $sumTicketPrice;
	}

	public function setTravelInfos($travelInfos)
	{
		$this->travelInfos = $travelInfos;
	}

	public function setIsOtcbookGrab($isOtcbookGrab)
	{
		$this->isOtcbookGrab = $isOtcbookGrab;
	}

}

class PddTrainGrabCreateRequest_PassengerInfosItem extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "birthday")
	*/
	private $birthday;

	/**
	* @JsonProperty(String, "card_no")
	*/
	private $cardNo;

	/**
	* @JsonProperty(String, "card_type")
	*/
	private $cardType;

	/**
	* @JsonProperty(String, "country")
	*/
	private $country;

	/**
	* @JsonProperty(String, "effective_date")
	*/
	private $effectiveDate;

	/**
	* @JsonProperty(String, "email")
	*/
	private $email;

	/**
	* @JsonProperty(String, "mobile")
	*/
	private $mobile;

	/**
	* @JsonProperty(String, "name")
	*/
	private $name;

	/**
	* @JsonProperty(String, "order_sn")
	*/
	private $orderSn;

	/**
	* @JsonProperty(String, "sex")
	*/
	private $sex;

	/**
	* @JsonProperty(String, "sub_pdd_order_id")
	*/
	private $subPddOrderId;

	/**
	* @JsonProperty(Integer, "ticket_type")
	*/
	private $ticketType;

	public function setBirthday($birthday)
	{
		$this->birthday = $birthday;
	}

	public function setCardNo($cardNo)
	{
		$this->cardNo = $cardNo;
	}

	public function setCardType($cardType)
	{
		$this->cardType = $cardType;
	}

	public function setCountry($country)
	{
		$this->country = $country;
	}

	public function setEffectiveDate($effectiveDate)
	{
		$this->effectiveDate = $effectiveDate;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setMobile($mobile)
	{
		$this->mobile = $mobile;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setOrderSn($orderSn)
	{
		$this->orderSn = $orderSn;
	}

	public function setSex($sex)
	{
		$this->sex = $sex;
	}

	public function setSubPddOrderId($subPddOrderId)
	{
		$this->subPddOrderId = $subPddOrderId;
	}

	public function setTicketType($ticketType)
	{
		$this->ticketType = $ticketType;
	}

}

class PddTrainGrabCreateRequest_TravelInfosItem extends PopBaseJsonEntity
{

	public function __construct()
	{

	}

	/**
	* @JsonProperty(String, "arrive_station")
	*/
	private $arriveStation;

	/**
	* @JsonProperty(String, "depart_station")
	*/
	private $departStation;

	/**
	* @JsonProperty(String, "train_no")
	*/
	private $trainNo;

	public function setArriveStation($arriveStation)
	{
		$this->arriveStation = $arriveStation;
	}

	public function setDepartStation($departStation)
	{
		$this->departStation = $departStation;
	}

	public function setTrainNo($trainNo)
	{
		$this->trainNo = $trainNo;
	}

}
