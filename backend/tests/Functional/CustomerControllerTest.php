<?php

use ApiTestCase\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class CustomerControllerTest extends JsonApiTestCase
{
    public function testPostResponse() {
        $this->client->request('POST','/api/customer');
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'customer', Response::HTTP_CREATED);
    }
}