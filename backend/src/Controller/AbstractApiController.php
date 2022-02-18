<?php

namespace App\Controller;

use Cassandra\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class AbstractApiController extends AbstractController
{
    /**
     * @param $data
     * @param int $statusCode
     * @return Response
     */
    private function response($data, int $statusCode): Response
    {
        return new Response($data, $statusCode);
    }

    /**
     * @param $data
     * @param int $statusCode
     * @return JsonResponse
     */
    private function jsonResponse($data, int $statusCode): JsonResponse
    {
        return $this->json($data, $statusCode);
    }

    /**
     * @param SerializerInterface $serializer
     * @param $data
     * @param array $serializeGroup
     * @param string $type
     * @return string
     */
    protected function serializer(SerializerInterface $serializer, $data, array $serializeGroup = [], string $type = 'json'): string
    {
        return $serializer->serialize($data, $type, ["groups" => $serializeGroup]);
    }

    /**
     * @param $data
     * @return Response
     */
    protected function responseOk($data): Response
    {
        return $this->response($data, Response::HTTP_OK);
    }

    /**
     * @param $data
     * @return Response
     */
    protected function responseCreated($data): Response
    {
        return $this->response($data, Response::HTTP_CREATED);
    }

    /**
     * @return Response
     */
    protected function responseNoContent(): Response
    {
        return $this->jsonResponse([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param ConstraintViolationListInterface $validationError
     * @return JsonResponse
     */
    protected function responseBadRequest(ConstraintViolationListInterface $validationError): JsonResponse
    {
        return $this->jsonResponse($this->createErrorMessage($validationError), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param ConstraintViolationListInterface $violations
     * @return array[]
     */
    private function createErrorMessage(ConstraintViolationListInterface $violations): array
    {
        $errors = [];

        /** @var ConstraintViolation $violation */
        foreach ($violations as $violation) {
            $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return ['errors' => $errors];
    }


    /**
     * @param Request $request
     * @return array
     */
    protected function getRequestContent(Request $request): array
    {
        $content = $request->getContent();
        return json_decode($content, true);
    }
}
