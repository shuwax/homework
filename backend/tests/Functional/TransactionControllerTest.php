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
            "value" => 120,
            "customerId" => $contentNewCustomerContent['data']['id']
        ];

        $this->client->jsonRequest('POST', '/api/transactions', $transactionRequestBody);

        $responseTransaction = $this->client->getResponse();
        $transactionContent = json_decode($responseTransaction->getContent(), true);

        $this->assertResponse($responseTransaction, 'transaction', Response::HTTP_CREATED);
        $this->assertEquals($transactionContent['data']['value'], $transactionRequestBody['value']);
        $this->assertEquals($transactionContent['data']['rawValue'], $transactionRequestBody['value'] * 100);
        $this->assertEquals($transactionContent['data']['customer']['id'], $contentNewCustomerContent['data']['id']);

    }

    public function testGETEmptyListResponse()
    {
        $this->client->jsonRequest('GET', '/api/transactions');
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'empty_array', Response::HTTP_OK);
    }

    public function testGETListResponse()
    {
        $this->testPOSTResponse();

        $this->client->jsonRequest('GET', '/api/transactions');
        $response = $this->client->getResponse();
        $contentArray = json_decode($response->getContent(), true);

        $this->assertResponse($response, 'transactions', Response::HTTP_OK);
        $this->assertCount(1, $contentArray);
    }

    public function testGETOneResponse()
    {
        $this->testPOSTResponse();
        $responseTransaction = $this->client->getResponse();
        $transactionContent = json_decode($responseTransaction->getContent(), true);


        $this->client->jsonRequest('GET', '/api/transactions/' . $transactionContent['data']['id']);
        $responseTransaction = $this->client->getResponse();
        $transactionFromListContent = json_decode($responseTransaction->getContent(), true);

        $this->assertResponse($responseTransaction, 'transaction', Response::HTTP_OK);
        $this->assertEquals($transactionFromListContent['data']['value'], $transactionContent['data']['value']);
    }

    public function testDeleteResponse()
    {
        $this->testPOSTResponse();
        $response = $this->client->getResponse();
        $transactionContent = json_decode($response->getContent(), true);

        $this->client->jsonRequest('DELETE', '/api/transactions/' . $transactionContent['data']['id']);

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }

    public function testPUTResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $response = $this->client->getResponse();
        $responseContent = json_decode($response->getContent(), true);

        $requestBody = ["value" => 130];
        $this->client->jsonRequest('PUT', '/api/transactions/' . $responseContent['data']['id'], $requestBody);

        $response = $this->client->getResponse();
        $updatedContent = json_decode($response->getContent(), true);

        $this->assertResponse($response, 'transaction', Response::HTTP_OK);
        $this->assertEquals($updatedContent['data']['value'], $requestBody['value']);
        $this->assertNotEquals($updatedContent['data']['value'], $responseContent['data']['value']);
    }


}