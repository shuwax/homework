<?php

use ApiTestCase\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class CustomerControllerTest extends JsonApiTestCase
{
    public function testPOSTResponse() {
        $requestBody = ["name"=> "Jan Kowalski"];
        $this->client->jsonRequest('POST','/api/customers', $requestBody);
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'customer', Response::HTTP_CREATED);
    }

    public function testGETEmptyListResponse() {
        $this->client->jsonRequest('GET','/api/customers');
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'empty_array', Response::HTTP_OK);
    }

    public function testGETListResponse() {
        //Create customer
        $this->testPOSTResponse();

        $this->client->jsonRequest('GET','/api/customers');
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'customers', Response::HTTP_OK);
    }
}