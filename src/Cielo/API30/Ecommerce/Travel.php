<?php

namespace Cielo\API30\Ecommerce;

/**
 * Class Customer
 *
 * @package Cielo\API30\Ecommerce
 */
class Travel implements \JsonSerializable
{
	const ONE_WAY = 'OneWayTrip';
	
	const TRIP = 'RoundTrip';

	private $journeyType;

	private $departureTime;
	
	private $passengers = [];

	public static function fromJson($json)
	{
		$object = \json_decode($json);
		$travel = new Travel();
		$travel->populate($object);

		return $travel;
	}

	public function populate(\stdClass $data)
	{
		$this->journeyType 		= isset($data->JourneyType) ? $data->JourneyType : null;
		$this->departureTime	= isset($data->DepartureTime) ? $data->DepartureTime : null;

		if(isset($data->Passengers)) {
			foreach( $data->Passengers as $traveler ) {
				$passenger = new Passenger;
				$passenger->populate( $traveler );
				array_push( $this->passengers, $passenger );
			}
		}
	}

	public function jsonSerialize()
    {
        return get_object_vars($this);
    }

	public function getJourneyType()
	{
		return $this->journeyType;
	}
	
	public function getDepartureTime()
	{
		return $this->departureTime;
	}
	
	public function getPassengers()
	{
		return $this->passengers;
	}

	public function addPassengers( array $passengers ) 
	{
		foreach( $passengers as $traveler ) {
			$travelerLeg = $traveler['TravelLegs'];

			$passenger =  new Passenger( $traveler );
			$passenger->addTravelLegs( $travelerLeg );

			array_push( $this->passengers, $passenger );
		}

		return $this;
	}
	
	public function setJourneyType( $journeyType )
	{
		$this->journeyType = $journeyType;

		return $this;
	}
	
	public function setDepartureTime( $departureTime )
	{
		$this->departureTime = $departureTime;

		return $this;
	}
	
	public function setPassengers( $passengers )
	{
		$this->passengers = $passengers;

		return $this;
	}
}