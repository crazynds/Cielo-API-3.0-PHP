<?php

namespace Cielo\API30\Ecommerce;

/**
 * Class Browser
 * 
 * @package Cielo\API30\Ecommerce
 */

class Cart implements \JsonSerializable 
{
	private $isGift = false;

	private $returnsAccepted = true;

	private $items = [];

	public static function formJson($json)
	{
		$object = \json_decode($json);

		$browser = new Cart();
		$browser->populate($object);

		return $browser;
	}

	/**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
	{
		$this->isGift 				= isset($data->IsGift) ? $data->IsGift : null;
		$this->returnsAccepted 		= isset($data->ReturnsAccepted) ? !!$data->ReturnsAccepted : false;
		
		if(isset($data->Items)) {
			foreach( $data->Items as $item ) {
				$cartItem = new CartItem;
				$cartItem->populate( $item );
				array_push( $this->items, $cartItem );
			}
		}
	}

	public function jsonSerialize()
    {
        return get_object_vars($this);
    }

	public function getIsGift()
	{
		return $this->isGift;
	}

	public function getReturnsAccepted()
	{
		return $this->returnsAccepted;
	}

	public function getItems()
	{
		return $this->items;
	}

	public function addItems( array $items ) 
	{
		foreach( $items as $item ) {
			$item = new CartItem( $item );
			array_push( $this->items, $item );
		}

		return $this;
	}

	public function setIsGift( $isGift )
	{
		$this->isGift = $isGift;

		return $this;
	}

	public function setReturnsAccepted( $returnsAccepted )
	{
		$this->returnsAccepted = $returnsAccepted;

		return $this;
	}
}