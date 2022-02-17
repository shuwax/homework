<?php

namespace App\Controller;

use App\Event\ControllerHandler\Customer\CreateCustomerEvent;
use App\Event\ControllerHandler\Customer\DeleteCustomerEvent;
use App\Event\ControllerHandler\Customer\GetListCustomerEvent;
use App\Event\ControllerHandler\Customer\GetOneCustomerEvent;
use App\Event\ControllerHandler\Customer\UpdateCustomerEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CustomerController extends AbstractApiController
{
    /**
     * @Route("/customers", name="customer_post", methods="POST" )
     */
    public function post(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, Request $request): Response
    {
        $createCustomerEvent = new CreateCustomerEvent($this->getRequestContent($request));
        $dispatcher->dispatch($createCustomerEvent, CreateCustomerEvent::NAME);

        return $this->responseCREATED($this->serializer($serializer, $createCustomerEvent->getCustomer(), ['customer:post']));
    }

    /**
     * @Route("/customers", name="customers_get", methods="GET" )
     */
    public function getList(SerializerInterface $serializer, EventDispatcherInterface $dispatcher): Response
    {
        $getListCustomerEvent = new GetListCustomerEvent();
        $dispatcher->dispatch($getListCustomerEvent, GetListCustomerEvent::NAME);
        return $this->responseOK($this->serializer($serializer, $getListCustomerEvent->getCustomers(), ['customer:list']));
    }

    /**
     * @Route("/customers/{customerId}", name="customer_get", methods="GET" )
     */
    public function getOne(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, $customerId): Response
    {
        $getOneCustomerEvent = new GetOneCustomerEvent($customerId);
        $dispatcher->dispatch($getOneCustomerEvent, GetOneCustomerEvent::NAME);
        return $this->responseOK($this->serializer($serializer, $getOneCustomerEvent->getCustomer(), ['customer:show']));
    }

    /**
     * @Route("/customers/{customerId}", name="customer_put", methods="PUT" )
     */
    public function put(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, int $customerId, Request $request): Response
    {
        $updateCustomerEvent = new UpdateCustomerEvent($this->getRequestContent($request), $customerId);
        $dispatcher->dispatch($updateCustomerEvent, UpdateCustomerEvent::NAME);
        return $this->responseOK($this->serializer($serializer, $updateCustomerEvent->getCustomer(), ['customer:put']));
    }

    /**
     * @Route("/customers/{customerId}", name="customer_delete", methods="DELETE" )
     */
    public function delete(EventDispatcherInterface $dispatcher, int $customerId): Response
    {
        $deleteCustomerEvent = new DeleteCustomerEvent($customerId);
        $dispatcher->dispatch($deleteCustomerEvent, DeleteCustomerEvent::NAME);
        return $this->responseNoContent();
    }
}
