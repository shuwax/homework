<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfigController extends AbstractApiController
{
    /**
     * @Route("/config/alive", name="config", methods="GET")
     */
    public function alive(): Response
    {
        return $this->response([
            'message' => 'alive'
        ]);
    }
}
