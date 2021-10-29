<?php

namespace Cielo\API30\Ecommerce;

/**
 * Class AntFraudAnalysis
 * 
 * @package Cielo\API30\Ecommerce
 */
class FraudAnalysis implements \JsonSerializable
{
	const CYBER_SOURCE = 'Cybersource';
	
	const SEQUENCE_AUTHORIZE = 'AuthorizeFirst';
	
	const SEQUENCE_ANALYSE = 'AnalyseFirst';

	const CRITERIA_SUCCESS = 'OnSuccess';

	const CRITERIA_ALWAYS = 'Always';

	private $browser;

	private $cart;
	
	private $shipping;

	private $travel;

	private $merchantDefinedFields = [];

	private $provider;
	
	private $sequence;
	
	private $sequenceCriteria;

	private $captureOnLowRisk;
	
	private $voidOnHighRisk;

	private $totalOrderAmount;
	
	private $transactionAmount;
	
	private $isRetryTransaction;
	
	private $statusDescription;
	
	private $status;

	public static function fromJson($json)
	{
		$object = \json_decode($json);
		$fraudAnalysis = new FraudAnalysis();
		$fraudAnalysis->populate($object);

		return $fraudAnalysis;
	}

	/**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
	{
		$this->provider				= isset($data->Provider) ? $data->Provider : null;
		$this->sequence				= isset($data->Sequence) ? $data->Sequence : null;
		$this->sequenceCriteria		= isset($data->SequenceCriteria) ? $data->SequenceCriteria : null;
		$this->captureOnLowRisk		= isset($data->CaptureOnLowRisk) ? !!$data->CaptureOnLowRisk : false;
		$this->voidOnHighRisk		= isset($data->VoidOnHighRisk) ? !!$data->VoidOnHighRisk : false;
		$this->totalOrderAmount		= isset($data->TotalOrderAmount) ? $data->TotalOrderAmount : null;
		$this->transactionAmount	= isset($data->TransactionAmount) ? $data->TransactionAmount : null;
		$this->isRetryTransaction	= isset($data->IsRetryTransaction) ? $data->IsRetryTransaction : null;
		$this->statusDescription	= isset($data->StatusDescription) ? $data->StatusDescription : null;
		$this->status				= isset($data->Status) ? $data->Status : null;
		
		if(isset($data->Browser)) {
			$this->browser = new Browser();
			$this->browser->populate($data->Browser);
		}

		if(isset($data->Cart)) {
			$this->cart = new Cart();
			$this->cart->populate($data->Cart);
		}

		if(isset($data->Shipping)) {
			$this->shipping = new Shipping();
			$this->shipping->populate( $data->Shipping );
		}
		
		if(isset($data->Travel)) {
			$this->travel = new Travel();
			$this->travel->populate( $data->Travel );
		}
		
		if(isset($data->MerchantDefinedFields)) {
            foreach ($data->MerchantDefinedFields as $item ) {
				$merchantDefinedField = new MerchantDefinedField();
				$merchantDefinedField->populate( $item );
				array_push($this->merchantDefinedFields, $merchantDefinedField);
			}
		}
	}

	/**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

	public function getProvider()
	{
		return $this->provider;
	}

	public function getSequence()
	{
		return $this->sequence;
	}
	
	public function getSequenceCriteria()
	{
		return $this->sequenceCriteria;
	}

	public function getCaptureOnLowRisk()
	{
		return $this->captureOnLowRisk;
	}

	public function getVoidOnHighRisk()
	{
		return $this->voidOnHighRisk;
	}

	public function getTotalOrderAmount()
	{
		return $this->totalOrderAmount;
	}

	public function getTransactionAmount()
	{
		return $this->transactionAmount;
	}

	public function getIsRetryTransaction()
	{
		return $this->isRetryTransaction;
	}

	public function getStatusDescription()
	{
		return $this->statusDescription;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setProvider( $provider )
	{
		$this->provider = $provider;

		return $this;
	}

	public function setSequence( $sequence )
	{
		$this->sequence = $sequence;

		return $this;
	}
	
	public function setSequenceCriteria( $sequence )
	{
		$this->sequenceCriteria = $sequence;

		return $this;
	}

	public function setCaptureOnLowRisk( $captureOnLowRisk )
	{
		$this->captureOnLowRisk = $captureOnLowRisk;

		return $this;
	}

	public function setVoidOnHighRisk( $voidOnHighRisk )
	{
		$this->voidOnHighRisk = $voidOnHighRisk;

		return $this;
	}

	public function setTotalOrderAmount( $totalOrderAmount )
	{
		$this->totalOrderAmount = $totalOrderAmount;

		return $this;
	}

	public function setTransactionAmount( $transactionAmount )
	{
		$this->transactionAmount = $transactionAmount;

		return $this;
	}

	public function setIsRetryTransaction( $isRetryTransaction )
	{
		$this->isRetryTransaction = $isRetryTransaction;

		return $this;
	}

	public function setStatusDescription( $statusDescription )
	{
		$this->statusDescription = $statusDescription;

		return $this;
	}

	public function setStatus( $status )
	{
		$this->status = $status;

		return $this;
	}

	public function browser()
	{
		$browser = new Browser();

		$this->browser = $browser;

		return $browser;
	}

	public function getBrowser()
	{
		return $this->browser;
	}

	public function cart()
	{
		$cart = new Cart();

		$this->cart = $cart;

		return $cart;
	}

	public function getCart()
	{
		return $this->cart;
	}

	public function shipping()
	{
		$shipping = new Shipping();

		$this->shipping = $shipping;

		return $shipping;
	}

	public function getShipping()
	{
		return $this->shipping;
	}

	public function travel()
	{
		$travel = new Travel();

		$this->travel = $travel;

		return $travel;
	}

	public function getTravel()
	{
		return $this->travel;
	}
	
	public function addMerchantDefinedFields( array $items )
	{
		foreach( $items as $item ) {
			$item = new MerchantDefinedField( $item );
			array_push( $this->merchantDefinedFields, $item );
		}

		return $this;
	}

	public function getMerchantDefinedFields()
	{
		return $this->merchantDefinedFields;
	}
}