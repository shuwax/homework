<?php

namespace App\Controller;

use App\Service\Config\IPostCustomerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractApiController
{
    /**
     * @Route("/customer", name="customer", methods="POST" )
     */
    public function post(IPostCustomerService $customerService, Request $request): Response
    {
        $content = $request->getContent();
        $contentArray = json_decode($content, true);

        return $this->response($customerService->create($contentArray), Response::HTTP_CREATED);
    }
}
