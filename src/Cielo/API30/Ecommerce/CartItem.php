<?php

namespace Cielo\API30\Ecommerce;

/**
 * Class Browser
 * 
 * @package Cielo\API30\Ecommerce
 */

class CartItem implements \JsonSerializable 
{
	const LOW = 'Low';

	const NORMAL = 'Normal';
	
	const HIGH = 'High';
	
	const OFF = 'Off';

	const YES = 'Yes';

	const NO = 'No';

	const ADULT_CONTENT = 'AdultContent';

	const COUPON = 'Coupon';

	const DEFAULT = 'Default';

	const ELETRONIC_GOOD = 'EletronicGood';

	const ELETRONIC_SOFTWARE = 'EletronicSoftware';

	const GIFTCERTIFICATE = 'GiftCertificate';

	const HANDLINGONLY = 'HandlingOnly';

	const SERVICE = 'Service';

	const SHIPPINGANDHANDLING = 'ShippingAndHandling';

	const SHIPPINGONLY = 'ShippingOnly';

	const SUBSCRIPTION = 'Subscription';

	const UNDEFINED = 'Undefined';

	private $giftCategory;

	private $hostHedge;

	private $nonSensicalHedge;

	private $obscenitiesHedge;

	private $phoneHedge;

	private $name;

	private $quantity;

	private $sku;

	private $unitPrice;

	private $risk;

	private $timeHedge;

	private $type;

	private $velocityHedge;

	public function __construct( $data = null) {
		$this->giftCategory			= $data['GiftCategory'] ?? self::OFF;
		$this->hostHedge			= $data['HostHedge'] ?? self::NORMAL;
		$this->nonSensicalHedge		= $data['NonSensicalHedge'] ?? self::NORMAL;
		$this->obscenitiesHedge		= $data['ObscenitiesHedge'] ?? self::NORMAL;
		$this->phoneHedge			= $data['PhoneHedge'] ?? self::NORMAL;
		$this->name					= $data['Name'] ?? null;
		$this->quantity				= $data['Quantity'] ?? 1;
		$this->sku					= $data['Sku'] ?? null;
		$this->unitPrice			= $data['UnitPrice'] ?? 0;
		$this->risk					= $data['Risk'] ?? self::NORMAL;
		$this->timeHedge			= $data['TimeHedge'] ?? self::NORMAL;
		$this->type					= $data['Type'] ?? self::DEFAULT;
		$this->velocityHedge		= $data['VelocityHedge'] ?? self::NORMAL;
	}

	public static function fromJson($json)
	{
		$object = \json_decode($json);
		$cartItem = new CartItem();
		$cartItem->populate($object);

		return $cartItem;
	}

    public function populate(\stdClass $data)
	{
		$this->giftCategory			= isset($data->GiftCategory) ? $data->GiftCategory : null;
		$this->hostHedge			= isset($data->HostHedge) ? $data->HostHedge : null;
		$this->nonSensicalHedge		= isset($data->NonSensicalHedge) ? $data->NonSensicalHedge : null;
		$this->obscenitiesHedge		= isset($data->ObscenitiesHedge) ? $data->ObscenitiesHedge : null;
		$this->phoneHedge			= isset($data->PhoneHedge) ? $data->PhoneHedge : null;
		$this->name					= isset($data->Name) ? $data->Name : null;
		$this->quantity				= isset($data->Quantity) ? $data->Quantity : null;
		$this->sku					= isset($data->Sku) ? $data->Sku : null;
		$this->unitPrice			= isset($data->UnitPrice) ? $data->UnitPrice : null;
		$this->risk					= isset($data->Risk) ? $data->Risk : null;
		$this->timeHedge			= isset($data->TimeHedge) ? $data->TimeHedge : null;
		$this->type					= isset($data->Type) ? $data->Type : null;
		$this->velocityHedge		= isset($data->VelocityHedge) ? $data->VelocityHedge : null;
	}

	public function jsonSerialize()
    {
        return get_object_vars($this);
    }

	public function getGiftCategory()
	{
		return $this->giftCategory;
	}
	
	public function getHostHedge()
	{
		return $this->hostHedge;
	}
	
	public function getNonSensicalHedge()
	{
		return $this->nonSensicalHedge;
	}
	
	public function getObscenitiesHedge()
	{
		return $this->obscenitiesHedge;
	}
	
	public function getPhoneHedge()
	{
		return $this->phoneHedge;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getQuantity()
	{
		return $this->quantity;
	}
	
	public function getSku()
	{
		return $this->sku;
	}
	
	public function getUnitPrice()
	{
		return $this->unitPrice;
	}
	
	public function getRisk()
	{
		return $this->risk;
	}
	
	public function getTimeHedge()
	{
		return $this->timeHedge;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function getVelocityHedge()
	{
		return $this->velocityHedge;
	}
	
	public function setGiftCategory( $giftCategory )
	{
		$this->giftCategory = $giftCategory;

		return $this;
	}

	public function setHostHedge( $hostHedge )
	{
		$this->hostHedge = $hostHedge;

		return $this;
	}

	public function setNonSensicalHedge( $nonSensicalHedge )
	{
		$this->nonSensicalHedge = $nonSensicalHedge;

		return $this;
	}

	public function setObscenitiesHedge( $obscenitiesHedge )
	{
		$this->obscenitiesHedge = $obscenitiesHedge;

		return $this;
	}

	public function setPhoneHedge( $phoneHedge )
	{
		$this->phoneHedge = $phoneHedge;

		return $this;
	}

	public function setName( $name )
	{
		$this->name = $name;

		return $this;
	}

	public function setQuantity( $quantity )
	{
		$this->quantity = $quantity;

		return $this;
	}

	public function setSku( $sku )
	{
		$this->sku = $sku;

		return $this;
	}

	public function setUnitPrice( $unitPrice )
	{
		$this->unitPrice = $unitPrice;

		return $this;
	}

	public function setRisk( $risk )
	{
		$this->risk = $risk;

		return $this;
	}

	public function setTimeHedge( $timeHedge )
	{
		$this->timeHedge = $timeHedge;

		return $this;
	}

	public function setType( $type )
	{
		$this->type = $type;

		return $this;
	}

	public function setVelocityHedge( $velocityHedge )
	{
		$this->velocityHedge = $velocityHedge;

		return $this;
	}

}