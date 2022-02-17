<?php

namespace App\Controller;

use App\Service\Config\IGetAliveService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ConfigController extends AbstractApiController
{
    /**
     * @Route("/configs/alive", name="config_alive", methods="GET")
     */
    public function alive(SerializerInterface $serializer, IGetAliveService $getAliveService): Response
    {
        return $this->responseOk($this->serializer($serializer, $getAliveService->getAlive()));
    }
}
