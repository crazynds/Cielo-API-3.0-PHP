<?php

namespace Cielo\API30\Ecommerce;

/**
 * Class Customer
 *
 * @package Cielo\API30\Ecommerce
 */
class Passenger implements \JsonSerializable
{
	const STANDARD = 'Standard';
	
	const GOLD = 'Gold';

	const PLATINUM = 'Platinum';

	const ADULT = 'Adult';
	
	const CHILD = 'Child';
	
	const INFANT = 'Infant';

	private $name;

	private $identity;

	private $status;

	private $rating;

	private $email;

	private $phone;

	private $travelLegs = [];

	public function __construct( $data = null) {
		$this->name			= $data['Name'] ?? null;
		$this->identity		= $data['Identity'] ?? null;
		$this->status		= $data['Status'] ?? self::STANDARD;
		$this->rating		= $data['Rating'] ?? self::ADULT;
		$this->email		= $data['Email'] ?? null;
		$this->phone		= $data['Phone'] ?? null;
	}

	public static function fromJson($json)
	{
		$object = \json_decode($json);
		$passenger = new Passenger();
		$passenger->populate($object);

		return $passenger;
	}

	public function populate(\stdClass $data)
	{
		$this->name				= isset($data->Name) ? $data->Name : null;
		$this->identity			= isset($data->Identity) ? $data->Identity : null;
		$this->status			= isset($data->Status) ? $data->Status : null;
		$this->rating			= isset($data->Rating) ? $data->Rating : null;
		$this->email			= isset($data->Email) ? $data->Email : null;
		$this->phone			= isset($data->Phone) ? $data->Phone : null;

		if(isset($data->TravelLegs)) {
			foreach( $data->TravelLegs as $traveler ) {
				$travelLeg = new TravelLegs();
				$travelLeg->populate( $traveler );
				array_push( $this->travelLegs, $travelLeg );
			}
		}
	}

	public function jsonSerialize()
    {
        return get_object_vars($this);
    }

	public function getName()
	{
		return $this->name;
	}
	
	public function getIdentity()
	{
		return $this->identity;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function getRating()
	{
		return $this->rating;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getPhone()
	{
		return $this->phone;
	}
	
	public function getTravelLegs()
	{
		return $this->travelLegs;
	}

	public function addTravelLegs( array $travelLegs )
	{
		foreach( $travelLegs as $travelLeg ) {
			$travel =  new TravelLegs( $travelLeg );
			array_push( $this->travelLegs, $travel );
		}

		return $this;
	}
	
	public function setName( $name )
	{
		$this->name = $name;

		return $this;
	}

	public function setIdentity( $identity )
	{
		$this->identity = $identity;

		return $this;
	}

	public function setStatus( $status )
	{
		$this->status = $status;

		return $this;
	}

	public function setRating( $rating )
	{
		$this->rating = $rating;

		return $this;
	}

	public function setEmail( $email )
	{
		$this->email = $email;

		return $this;
	}

	public function setPhone( $phone )
	{
		$this->phone = $phone;

		return $this;
	}

	public function setTravelLegs( $travelLegs )
	{
		$this->travelLegs = $travelLegs;

		return $this;
	}

}