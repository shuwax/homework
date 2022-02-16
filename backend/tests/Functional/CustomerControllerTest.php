<?php

use ApiTestCase\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class CustomerControllerTest extends JsonApiTestCase
{
    public function testPostResponse() {
        $requestBody = ["name"=> "Jan Kowalski"];
        $this->client->jsonRequest('POST','/api/customer', $requestBody);
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'customer', Response::HTTP_CREATED);
    }
}