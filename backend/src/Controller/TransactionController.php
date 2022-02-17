<?php

namespace App\Controller;

use App\Event\ControllerHandler\Transaction\CreateTransactionEvent;
use App\Event\ControllerHandler\Transaction\GetListTransactionEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TransactionController extends AbstractApiController
{
    /**
     * @Route("/transactions", name="transaction_post", methods="POST" )
     */
    public function post(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, Request $request): Response
    {
        $createTransactionEvent = new CreateTransactionEvent($this->getRequestContent($request));
        $dispatcher->dispatch($createTransactionEvent, CreateTransactionEvent::NAME);

        return $this->responseCREATED($this->serializer($serializer, $createTransactionEvent->getTransaction(), ['transaction:post']));
    }

    /**
     * @Route("/transactions", name="transactions_get_list", methods="GET" )
     */
    public function getList(SerializerInterface $serializer, EventDispatcherInterface $dispatcher): Response
    {
        $getListTransactionEvent = new GetListTransactionEvent();
        $dispatcher->dispatch($getListTransactionEvent, GetListTransactionEvent::NAME);

        return $this->responseOk($this->serializer($serializer, $getListTransactionEvent->getTransactions(), ['transaction:list']));
    }

}