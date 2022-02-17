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
    private function response($data, int $statusCode): JsonResponse
    {
        return $this->json($data, $statusCode);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    protected function responseOk($data): JsonResponse
    {
        return $this->json($data, Response::HTTP_OK);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    protected function responseCreated($data): JsonResponse
    {
        return $this->json($data, Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    protected function responseNoContent(): JsonResponse
    {
        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
