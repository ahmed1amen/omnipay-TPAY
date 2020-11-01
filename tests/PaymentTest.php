<?php

namespace Omnipay\TPAY;

use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use Omnipay\TPAY\Message\GetMerchantInfoRequest;
use Omnipay\Omnipay;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function testPurchase()
    {


        $gateway = Omnipay::create('TPAY');
        $gateway->setPublicKey('y2h9jcmHy3aGNq2oOCwj');
        $gateway->setPrivateKey('WhBN04C6be2jGZoraIMc');
        $gateway->setTestMode(false);

        /**
         * @var  $response2 \Omnipay\TPAY\Message\FetchTransactionRequest
         */

        $response2 = $gateway->fetchTransaction()->setTransactionReference('1681993203358962')->send();


        dd($response2->getData());


    }


}
