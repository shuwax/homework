<?php

namespace App\Controller;

use App\Service\Config\IGetAliveService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfigController extends AbstractApiController
{
    /**
     * @Route("/configs/alive", name="config_alive", methods="GET")
     */
    public function alive(IGetAliveService $getAliveService): Response
    {
        return $this->response($getAliveService->getAlive());
    }
}
