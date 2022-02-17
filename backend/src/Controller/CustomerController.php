<?php

namespace App\Controller;

use App\Event\ControllerHandler\GetOneCustomerEvent;
use App\Service\Customer\IDeleteCustomerService;
use App\Service\Customer\IGetListCustomerService;
use App\Service\Customer\IPostCustomerService;
use App\Service\Customer\IPutCustomerService;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractApiController
{
    /**
     * @Route("/customers", name="customer_post", methods="POST" )
     */
    public function post(IPostCustomerService $postCustomerService, Request $request): Response
    {
        $content = $request->getContent();
        $contentArray = json_decode($content, true);
        return $this->responseCREATED($postCustomerService->create($contentArray));
    }

    /**
     * @Route("/customers", name="customers_get", methods="GET" )
     */
    public function getList(IGetListCustomerService $getListCustomerService): Response
    {
        return $this->responseOK($getListCustomerService->getList());
    }

    /**
     * @Route("/customers/{customerId}", name="customer_get", methods="GET" )
     */
    public function getOne(EventDispatcherInterface $dispatcher, $customerId): Response
    {
        $getOneCustomerEvent = new GetOneCustomerEvent($customerId);
        $dispatcher->dispatch($getOneCustomerEvent, GetOneCustomerEvent::NAME);
        return $this->responseOK($getOneCustomerEvent->getCustomer());
    }

    /**
     * @Route("/customers/{customerId}", name="customer_put", methods="PUT" )
     */
    public function put(IPutCustomerService $putCustomerService, int $customerId, Request $request): Response
    {
        $content = $request->getContent();
        $contentArray = json_decode($content, true);
        return $this->responseOK($putCustomerService->put($customerId, $contentArray));
    }

    /**
     * @Route("/customers/{customerId}", name="customer_delete", methods="DELETE" )
     */
    public function delete(IDeleteCustomerService $deleteCustomerService, int $customerId): Response
    {
        $deleteCustomerService->delete($customerId);

        return $this->responseNoContent();
    }
}
