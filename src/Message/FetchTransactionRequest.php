<?php

namespace Omnipay\TPAY\Message;


use GuzzleHttp\Client;

class FetchTransactionRequest extends AbstractRequest
{

    public function getData()
    {

        $merchantCode = $this->configuration['merchantCode'];  // required	The merchant code provided by TPAY team during the account setup.
        $merchantRefNum = $this->getTransactionReference();   // required Unique Order ID
        $merchant_sec_key = $this->configuration['merchant_sec_key'];
        $data = [
            "merchantCode" => $merchantCode,
            "merchantRefNumber" => $merchantRefNum,
            "signature" => "",
        ];
        $data['signature'] = hash('sha256', $merchantCode . $merchantRefNum . $merchant_sec_key);


        return $data;
    }


    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {


        $headers = array_merge(
            $this->getHeaders()

        );

        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $headers,
            ''
        );


        return $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getHeaders());
    }


    /**
     * @return string
     */
    public function getEndpoint()
    {

        return $this->getBaseEndpoint() . '/ECommerceWeb/Fawry/payments/status?' . urldecode(http_build_query($this->getData()));
    }


    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}