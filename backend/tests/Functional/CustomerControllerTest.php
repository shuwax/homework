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
        $this->assertEquals(true, $contentNewCustomerContent['id'] > 0);
        $this->assertEquals($contentNewCustomerContent['name'], $requestBody['name']);
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

        $this->client->jsonRequest('GET', '/api/customers/' . $contentNewCustomerContent['id']);
        $customerFromListResponse = $this->client->getResponse();
        $customerFromListContent = json_decode($customerFromListResponse->getContent(), true);

        $this->assertResponse($customerFromListResponse, 'customer', Response::HTTP_OK);
        $this->assertEquals($customerFromListContent['name'], $contentNewCustomerContent['name']);

    }

    public function testUpdateResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $responseNewCustomer = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($responseNewCustomer->getContent(), true);

        $requestBody = ["name" => "Monika Kowalska"];
        $this->client->jsonRequest('PUT', '/api/customers/' . $contentNewCustomerContent['id'], $requestBody);

        $responseUpdateCustomer = $this->client->getResponse();
        $customerAfterUpdateContent = json_decode($responseUpdateCustomer->getContent(), true);

        $this->assertResponse($responseUpdateCustomer, 'customer', Response::HTTP_OK);
        $this->assertEquals($customerAfterUpdateContent['name'], $requestBody['name']);
        $this->assertNotEquals($customerAfterUpdateContent['name'], $contentNewCustomerContent['name']);

    }

    public function testDELETEResponse()
    {
        //Create customer
        $this->testPOSTResponse();
        $responseNewCustomer = $this->client->getResponse();
        $contentNewCustomerContent = json_decode($responseNewCustomer->getContent(), true);

        $this->client->jsonRequest('DELETE', '/api/customers/' . $contentNewCustomerContent['id']);

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);

    }
}