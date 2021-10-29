<?php

namespace Cielo\API30\Ecommerce;

/**
 * Class Customer
 *
 * @package Cielo\API30\Ecommerce
 */
class TravelLegs implements \JsonSerializable
{
	private $origin;
	
	private $destination;

	public function __construct( $data = null) {
		$this->origin			= $data['Origin'] ?? null;
		$this->destination		= $data['Destination'] ?? null;
	}

	public static function fromJson($json)
	{
		$object = \json_decode($json);
		$TravelLeg = new TravelLegs();
		$TravelLeg->populate($object);

		return $TravelLeg;
	}

	public function populate(\stdClass $data)
	{
		$this->origin				= isset($data->Origin) ? $data->Origin : null;
		$this->destination			= isset($data->Destination) ? $data->Destination : null;
	}

	public function jsonSerialize()
    {
        return get_object_vars($this);
    }

	public function getOrigin()
	{
		return $this->origin;
	}
	
	public function getDestination()
	{
		return $this->destination;
	}
	
	public function setOrigin( $origin )
	{
		$this->origin = $origin;

		return $this;
	}
	
	public function setDestination( $destination )
	{
		$this->destination = $destination;

		return $this;
	}
}