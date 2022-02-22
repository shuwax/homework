<?php

use ApiTestCase\JsonApiTestCase;
use App\Tools\Date\DateHandler;
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
            "customerId" => $contentNewCustomerContent['data']['id'],
            "transactionDate" => '2021-01-01'
        ];

        $this->client->jsonRequest('POST', '/api/transactions', $transactionRequestBody);

        $responseTransaction = $this->client->getResponse();
        $transactionContent = json_decode($responseTransaction->getContent(), true);

        $this->assertResponse($responseTransaction, 'transaction', Response::HTTP_CREATED);
        $this->assertEquals($transactionContent['data']['value'], $transactionRequestBody['value']);
        $this->assertEquals($transactionContent['data']['rawValue'], $transactionRequestBody['value'] * 100);
        $this->assertEquals(new DateTime($transactionContent['data']['transactionDate']), new DateTime($transactionRequestBody['transactionDate']));
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

        $requestBody = ["value" => 130, "transactionDate" => '2022-01-01'];
        $this->client->jsonRequest('PUT', '/api/transactions/' . $responseContent['data']['id'], $requestBody);

        $response = $this->client->getResponse();
        $updatedContent = json_decode($response->getContent(), true);

        $this->assertResponse($response, 'transaction', Response::HTTP_OK);

        $this->assertEquals(new DateTime($updatedContent['data']['transactionDate']), new DateTime($requestBody['transactionDate']));
        $this->assertEquals($updatedContent['data']['value'], $requestBody['value']);
        $this->assertNotEquals($updatedContent['data']['value'], $responseContent['data']['value']);
    }


    public function testGETOneWithEmptyTransactionsResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $responseNewCustomer = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($responseNewCustomer->getContent(), true);

        $this->client->jsonRequest('GET', '/api/transactions/customer/' . $contentNewCustomerContent['data']['customer']['id'] . '/period');
        $customerFromListResponse = $this->client->getResponse();
        $this->assertResponse($customerFromListResponse, 'empty_array', Response::HTTP_OK);

    }

    public function testGETOneWithTransactionsResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $responseNewCustomer = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($responseNewCustomer->getContent(), true);

        $dateHandler = new DateHandler();
        //Create transaction
        $transactionRequestBody = [
            "value" => 120,
            "customerId" => $contentNewCustomerContent['data']['customer']['id'],
            "transactionDate" => $dateHandler->formatDate($dateHandler->getCurrentDate(), 'Y-m-d')
        ];

        $this->client->jsonRequest('POST', '/api/transactions', $transactionRequestBody);

        $this->client->jsonRequest('GET', '/api/customers/' . $contentNewCustomerContent['data']['id']. '/transactions');

        $this->client->jsonRequest('GET', '/api/transactions/customer/' . $contentNewCustomerContent['data']['customer']['id'] . '/period');
        $customerFromListResponse = $this->client->getResponse();
        $customerFromListContent = json_decode($customerFromListResponse->getContent(), true);

        $this->assertResponse($customerFromListResponse, 'transactions_customer_period', Response::HTTP_OK);
        $this->assertCount(1, $customerFromListContent['data']);

    }
}