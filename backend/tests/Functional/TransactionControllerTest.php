<?php

use ApiTestCase\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class TransactionControllerTest extends JsonApiTestCase
{
    public function testPOSTResponse()
    {
        //Create customer
        $customerRequestBody = ["name" => "Jan Kowalski"];
        $this->client->jsonRequest('POST', '/api/customers', $customerRequestBody);

        $response = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($response->getContent(), true);

        //Create transaction
        $transactionRequestBody = [
            "value" => 12000,
            "customerId" => $contentNewCustomerContent['id']
        ];

        $this->client->jsonRequest('POST', '/api/transactions', $transactionRequestBody);

        $responseTransaction = $this->client->getResponse();
        $transactionContent = json_decode($responseTransaction->getContent(), true);

        $this->assertResponse($responseTransaction, 'transaction', Response::HTTP_CREATED);
        $this->assertEquals($transactionContent['value'], $transactionRequestBody['value']);
        $this->assertEquals($transactionContent['customer']['id'], $contentNewCustomerContent['id']);

    }

}