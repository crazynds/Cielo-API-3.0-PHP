<?php

require 'vendor/autoload.php';

use Cielo\API30\Ecommerce\Browser;
use Cielo\API30\Ecommerce\CartItem;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Cielo\API30\Ecommerce\FraudAnalysis;
use Cielo\API30\Merchant;

use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\CreditCard;
use Cielo\API30\Ecommerce\MerchantDefinedField;
use Cielo\API30\Ecommerce\Passenger;
use Cielo\API30\Ecommerce\Request\CieloRequestException;
use Cielo\API30\Ecommerce\Shipping;
use Cielo\API30\Ecommerce\Travel;

$environment = Environment::sandbox();

// Configure seu merchant
$merchant = new Merchant('fd481034-6641-4c95-964d-4e24ba21718d', 'MPSHVSAALYPGRWYUGMVDAYCLXYQPMWFUGTUNWSTC');

// Crie uma instância de Sale informando o ID do pedido na loja
$sale = new Sale(rand(11111,99999));

// Crie uma instância de Customer informando o nome do cliente
$customer = $sale->customer('Nomezinho');

// Crie uma instância de Payment informando o valor do pagamento
$payment = $sale->payment(15700);

// Crie uma instância de Credit Card utilizando os dados de teste
// esses dados estão disponíveis no manual de integração
$payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
        ->creditCard("123", CreditCard::VISA)
        ->setExpirationDate("11/2025")
        ->setCardNumber("4111111111111111")
        ->setHolder("Nomezinho");

// Cria instância de FraudAnalysis 
$fraude = $payment->fraudAnalysis()
		->setProvider(FraudAnalysis::CYBER_SOURCE)
		->setSequence(FraudAnalysis::SEQUENCE_ANALYSE)
		->setSequenceCriteria(FraudAnalysis::CRITERIA_SUCCESS)
		->setCaptureOnLowRisk(true)
		->setVoidOnHighRisk(true);

// Tabela 20
$merchantDefinedFields = $fraude->addMerchantDefinedFields([
	[
		'Id' => MerchantDefinedField::CUSTOMER_AUTHENTICATED,
		'Value' => 'hebert.dev@hotmail.com'
	],[
		'Id' => MerchantDefinedField::CUSTOMER_EMAIL_VERIFIED,
		'Value' => 'SIM'
	]
]);

// Dados do navegador
$browser = $fraude->browser()
		->setBrowserFingerprint('074c1ee676ed4998ab66491013c565e2')
		->setCookiesAccepted(true)
		->setEmail('hebert.dev@hotmail.com')
		->setHostName($_SERVER['USERDOMAIN'])
		->setIpAddress('127.0.0.1')
		->setType(Browser::CHROME);

// dados do carrinho
$cart = $fraude->cart()
			->addItems([
				[
					"GiftCategory"=> CartItem::NO,
					"HostHedge"=> CartItem::OFF,
					"NonSensicalHedge"=> CartItem::OFF,
					"ObscenitiesHedge"=> CartItem::OFF,
					"PhoneHedge"=> CartItem::OFF,
					"Name"=>"ItemTeste1",
					"Quantity"=>1,
					"Sku"=>"20170511",
					"UnitPrice"=>2000,
					"Risk"=>CartItem::HIGH,
					"TimeHedge"=>CartItem::NORMAL,
					"Type"=>CartItem::DEFAULT,
					"VelocityHedge"=>CartItem::HIGH
				]
			])
			->setIsGift(false)
			->setReturnsAccepted(false);

// Dados de entrega
$shipping = $fraude->shipping()
				->setAddressee('João das Couves')
				->setMethod(Shipping::LOW_COST)
				->setPhone('1155855585');

// dados do passageiro
$passengers = [
	[
		"Name"=>"Passenger Test",
		"Identity"=>"212424808",
		"Status"=>Passenger::PLATINUM,
		"Rating"=>Passenger::ADULT,
		"Email"=>"email@mail.com",
		"Phone"=>"5564991681074",
		'TravelLegs' => [
			[
				"Origin"=>"AMS",
				"Destination"=>"GIG"
			]
		]
	]
];

// antefraude viagem  
$travel = $fraude->travel()
				->setJourneyType(Travel::ONE_WAY)
				->setDepartureTime('2023-01-09 18:00')
				->addPassengers($passengers);

// Crie o pagamento na Cielo
try {

	$log = new Logger('debug');
	$log->pushHandler(new StreamHandler(__dir__.'/logging.log', Logger::DEBUG));

    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
    $sale = (new CieloEcommerce($merchant, $environment , $log))->createSale($sale);

    // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
    // dados retornados pela Cielo
    $paymentId = $sale->getPayment()->getPaymentId();

	$fraudStatus = $sale->getPayment()->getFraudAnalysis();

	$browser = $sale->getPayment()->getFraudAnalysis()->getBrowser();
} catch (CieloRequestException $e) {
    // Em caso de erros de integração, podemos tratar o erro aqui.
    // os códigos de erro estão todos disponíveis no manual de integração.
    $error = $e->getCieloError();
}

