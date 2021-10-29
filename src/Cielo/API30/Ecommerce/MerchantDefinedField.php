<?php

namespace Cielo\API30\Ecommerce;

class MerchantDefinedField implements \JsonSerializable {
	
	const CUSTOMER_AUTHENTICATED = 1;
	const CARD_INSTALLMENTS = 3;
	const SALES_CHANNEL = 4;
	const COUPON = 5;
	const SELLER = 7;
	const CUSTOMER_NUMBER_OF_TRIES = 8;
	const CUSTOMER_PICK_UP_AT_STORE = 9;
	const CREDIT_CARD_FIRST_FOUR_DIGITS = 23;
	const CREDIT_CARD_BIN = 26;
	const CUSTOMER_RESIDENCE_TYPE = 27;
	const CUSTOMER_EMAIL_COPY_OR_PASTE = 32;
	const CUSTOMER_CREDIT_CARD_COPY_OR_PAST = 33;
	const CUSTOMER_EMAIL_VERIFIED = 34;
	const CUSTOMER_TYPE = 35;
	const SHIPPING_METHOD = 37;
	const CUSTOMER_IDENTIFY = 41;
	const CREDIT_CARD_HOLDER_NAME = 46;
	const CREDIT_CARD_PRIVATE_LABEL = 47;
	const CUSTOMER_SMS_VERIFIED = 53;
	const STORE_PROVIDER_NAME = 84;

	private $id;

	private $value;

	public function __construct( $data = null ) {
		$this->id		= $data['Id'] ?? null;
		$this->value 	= $data['Value'] ?? null;
	}

	public static function fromJson($json)
	{
		$object = \json_decode($json);
		$merchantDefinedField = new MerchantDefinedField();
		$merchantDefinedField->populate($object);

		return $merchantDefinedField;
	}

    public function populate(\stdClass $data)
	{
		$this->id 			= isset($data->Id) ? $data->Id : null;
		$this->value		= isset( $data->Value ) ? $data->Value : null;
	}

	public function jsonSerialize()
    {
        return get_object_vars($this);
    }

	public function getId()
	{
		return $this->id;
	}

	public function getValue()
	{
		return $this->value;
	}
	
	public function setId( $id )
	{
		$this->id = $id;

		return $this;
	}

	public function setValue( $value )
	{
		$this->value = $value;

		return $this;
	}
}