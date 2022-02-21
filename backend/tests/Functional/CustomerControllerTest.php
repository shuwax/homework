<?php

use ApiTestCase\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class CustomerControllerTest extends JsonApiTestCase
{
    public function testPOSTResponse()
    {
        $requestBody = ["name" => "Jan Kowalski"];
        $this->client->jsonRequest('POST', '/api/customers', $requestBody);

        $response = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($response->getContent(), true);


        $this->assertResponse($response, 'customer', Response::HTTP_CREATED);
        $this->assertEquals(true, $contentNewCustomerContent['data']['id'] > 0);
        $this->assertEquals($contentNewCustomerContent['data']['name'], $requestBody['name']);
    }

    public function testGETEmptyListResponse()
    {
        $this->client->jsonRequest('GET', '/api/customers');
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'empty_array', Response::HTTP_OK);
    }

    public function testGETListResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $this->client->jsonRequest('GET', '/api/customers');
        $response = $this->client->getResponse();
        $contentArray = json_decode($response->getContent(), true);


        $this->assertResponse($response, 'customers', Response::HTTP_OK);
        $this->assertCount(1, $contentArray);
    }

    public function testGETOneNotFoundResponse()
    {
        $this->client->jsonRequest('GET', '/api/customers/-1');
        $this->client->getResponse();
        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

    public function testGETOneResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $responseNewCustomer = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($responseNewCustomer->getContent(), true);

        $this->client->jsonRequest('GET', '/api/customers/' . $contentNewCustomerContent['data']['id']);
        $customerFromListResponse = $this->client->getResponse();
        $customerFromListContent = json_decode($customerFromListResponse->getContent(), true);

        $this->assertResponse($customerFromListResponse, 'customer', Response::HTTP_OK);
        $this->assertEquals($customerFromListContent['data']['name'], $contentNewCustomerContent['data']['name']);

    }

    public function testUpdateResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $responseNewCustomer = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($responseNewCustomer->getContent(), true);

        $requestBody = ["name" => "Monika Kowalska"];
        $this->client->jsonRequest('PUT', '/api/customers/' . $contentNewCustomerContent['data']['id'], $requestBody);

        $responseUpdateCustomer = $this->client->getResponse();
        $customerAfterUpdateContent = json_decode($responseUpdateCustomer->getContent(), true);

        $this->assertResponse($responseUpdateCustomer, 'customer', Response::HTTP_OK);
        $this->assertEquals($customerAfterUpdateContent['data']['name'], $requestBody['name']);
        $this->assertNotEquals($customerAfterUpdateContent['data']['name'], $contentNewCustomerContent['data']['name']);

    }

    public function testDELETEResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $responseNewCustomer = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($responseNewCustomer->getContent(), true);

        $this->client->jsonRequest('DELETE', '/api/customers/' . $contentNewCustomerContent['data']['id']);

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);

    }

    public function testGETOneWithEmptyTransactionsResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $responseNewCustomer = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($responseNewCustomer->getContent(), true);

        $this->client->jsonRequest('GET', '/api/customers/' . $contentNewCustomerContent['data']['id']. '/transactions');
        $customerFromListResponse = $this->client->getResponse();
        $customerFromListContent = json_decode($customerFromListResponse->getContent(), true);

        $this->assertResponse($customerFromListResponse, 'customer_with_empty_transactions', Response::HTTP_OK);
        $this->assertEquals($customerFromListContent['data']['name'], $contentNewCustomerContent['data']['name']);
        $this->assertCount(0, $customerFromListContent['data']['transactions']);

    }

    public function testGETOneWithTransactionsResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $responseNewCustomer = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($responseNewCustomer->getContent(), true);



        //Create transaction
        $transactionRequestBody = [
            "value" => 120,
            "customerId" => $contentNewCustomerContent['data']['id']
        ];

        $this->client->jsonRequest('POST', '/api/transactions', $transactionRequestBody);

        $this->client->jsonRequest('GET', '/api/customers/' . $contentNewCustomerContent['data']['id']. '/transactions');
        $customerFromListResponse = $this->client->getResponse();
        $customerFromListContent = json_decode($customerFromListResponse->getContent(), true);


        $this->assertResponse($customerFromListResponse, 'customer_with_transactions', Response::HTTP_OK);
        $this->assertEquals($customerFromListContent['data']['name'], $contentNewCustomerContent['data']['name']);
        $this->assertCount(1, $customerFromListContent['data']['transactions']);

    }

}