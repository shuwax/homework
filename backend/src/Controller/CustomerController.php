<?php

namespace App\Controller;

use App\Event\ControllerHandler\CreateCustomerEvent;
use App\Event\ControllerHandler\GetListCustomerEvent;
use App\Event\ControllerHandler\GetOneCustomerEvent;
use App\Service\Customer\IDeleteCustomerService;
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
    public function post(EventDispatcherInterface $dispatcher, Request $request): Response
    {
        $createCustomerEvent = new CreateCustomerEvent($this->getRequestContent($request));
        $dispatcher->dispatch($createCustomerEvent, CreateCustomerEvent::NAME);
        return $this->responseCREATED($createCustomerEvent->getCustomer());
    }

    /**
     * @Route("/customers", name="customers_get", methods="GET" )
     */
    public function getList(EventDispatcherInterface $dispatcher): Response
    {
        $getListCustomerEvent = new GetListCustomerEvent();
        $dispatcher->dispatch($getListCustomerEvent, GetListCustomerEvent::NAME);
        return $this->responseOK($getListCustomerEvent->getCustomers());
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
