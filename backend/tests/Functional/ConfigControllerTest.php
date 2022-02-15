<?php

use ApiTestCase\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class ConfigControllerTest extends JsonApiTestCase
{
    public function testAliveResponse() {
        $this->client->request('GET','/api/config/alive');
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'alive', Response::HTTP_OK);
    }
}