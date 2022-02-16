<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AbstractApiController extends AbstractController
{
    /**
     * @param $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function response($data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return $this->json($data, $statusCode);
    }
}
