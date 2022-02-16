<?php

use ApiTestCase\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class ConfigControllerTest extends JsonApiTestCase
{
    public function testAliveResponse() {
        $this->client->jsonRequest('GET','/api/configs/alive');
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'alive', Response::HTTP_OK);
    }
}