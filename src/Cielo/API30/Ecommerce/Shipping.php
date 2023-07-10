<?php

namespace Cielo\API30\Ecommerce;

class Shipping implements \JsonSerializable {

	const SAME_DAY 	= 'SameDay';
	const ONE_DAY 	= 'OneDay';
	const TWO_DAY 	= 'TwoDay';
	const THREE_DAY = 'ThreeDay';
	const LOW_COST 	= 'LowCost';
	const PICKUP 	= 'Pickup';
	const OTHER 	= 'Other';
	const NONE 		= 'None';

	private $addressee;

	private $method;

	private $phone;

	public static function fromJson($json)
	{
		$object = \json_decode($json);
		$shipping = new Shipping();
		$shipping->populate($object);

		return $shipping;
	}

	public function populate(\stdClass $data)
	{
		$this->addressee	= isset($data->Addressee) ? $data->Addressee : null;
		$this->method		= isset($data->Method) ? $data->Method : null;
		$this->phone		= isset($data->Phone) ? $data->Phone : null;
	}

	public function jsonSerialize()
    {
        return get_object_vars($this);
    }

	public function getAddressee()
	{
		return $this->addressee;
	}
	
	public function getMethod()
	{
		return $this->method;
	}
	
	public function getPhone()
	{
		return $this->phone;
	}
	
	public function setAddressee( $addressee )
	{
		$this->addressee = $addressee;

		return $this;
	}

	public function setMethod( $method )
	{
		$this->method = $method;

		return $this;
	}

	public function setPhone( $phone )
	{
		$this->phone = $phone;

		return $this;
	}

}