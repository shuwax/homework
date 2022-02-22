<?php

namespace App\Controller;

use App\DTO\TransactionDTO;
use App\DTO\TransactionUpdateDTO;
use App\Event\ControllerHandler\Transaction\CreateTransactionEvent;
use App\Event\ControllerHandler\Transaction\DeleteTransactionEvent;
use App\Event\ControllerHandler\Transaction\GetListTransactionEvent;
use App\Event\ControllerHandler\Transaction\GetOneTransactionEvent;
use App\Event\ControllerHandler\Transaction\GetTransactionByCustomerEvent;
use App\Event\ControllerHandler\Transaction\UpdateTransactionEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractApiController
{
    /**
     * @ParamConverter("transactionDTO", converter="fos_rest.request_body")
     * @Route("/transactions", name="transaction_post", methods="POST" )
     */
    public function post(
        SerializerInterface              $serializer,
        EventDispatcherInterface         $dispatcher,
        TransactionDTO                   $transactionDTO,
        ConstraintViolationListInterface $validationErrors
    ): Response
    {
        if ($validationErrors->count() > 0) {
            return $this->responseBadRequest($validationErrors);
        }

        $createTransactionEvent = new CreateTransactionEvent($transactionDTO);
        $dispatcher->dispatch($createTransactionEvent, CreateTransactionEvent::NAME);

        return $this->responseCREATED($this->serializer($serializer, $createTransactionEvent->getTransaction(), ['transaction:post']));
    }

    /**
     * @Route("/transactions", name="transactions_get", methods="GET" )
     */
    public function getList(SerializerInterface $serializer, EventDispatcherInterface $dispatcher): Response
    {
        $getListTransactionEvent = new GetListTransactionEvent();
        $dispatcher->dispatch($getListTransactionEvent, GetListTransactionEvent::NAME);

        return $this->responseOk($this->serializer($serializer, $getListTransactionEvent->getTransactions(), ['transaction:list']));
    }

    /**
     * @Route("/transactions/customer/{customerId}/period", name="transactions_customer_get", methods="GET" )
     */
    public function getOneByCustomerPeriod(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, $customerId): Response
    {
        $getOneCustomerTransactionsEvent = new GetTransactionByCustomerEvent($customerId);
        $dispatcher->dispatch($getOneCustomerTransactionsEvent, GetTransactionByCustomerEvent::NAME);
        return $this->responseOK($this->serializer($serializer, $getOneCustomerTransactionsEvent->getTransactions(), ['transaction:list:period']));
    }


    /**
     * @Route("/transactions/{transactionId}", name="transaction_get", methods="GET" )
     */
    public function getOne(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, int $transactionId): Response
    {
        $getOneTransactionEvent = new GetOneTransactionEvent($transactionId);
        $dispatcher->dispatch($getOneTransactionEvent, GetOneTransactionEvent::NAME);

        return $this->responseOk($this->serializer($serializer, $getOneTransactionEvent->getTransaction(), ['transaction:show']));
    }

    /**
     * @ParamConverter("transactionUpdateDTO", converter="fos_rest.request_body")
     * @Route("/transactions/{transactionId}", name="transaction_put", methods="PUT" )
     */
    public function put(
        SerializerInterface              $serializer,
        EventDispatcherInterface         $dispatcher,
        int                              $transactionId,
        TransactionUpdateDTO             $transactionUpdateDTO,
        ConstraintViolationListInterface $validationErrors
    ): Response
    {
        if ($validationErrors->count() > 0) {
            return $this->responseBadRequest($validationErrors);
        }
        $updateTransactionEvent = new UpdateTransactionEvent($transactionUpdateDTO, $transactionId);
        $dispatcher->dispatch($updateTransactionEvent, UpdateTransactionEvent::NAME);

        return $this->responseOk($this->serializer($serializer, $updateTransactionEvent->getTransaction(), ['transaction:put']));
    }

    /**
     * @Route("/transactions/{transactionId}", name="transaction_delete", methods="DELETE" )
     */
    public function delete(EventDispatcherInterface $dispatcher, int $transactionId): Response
    {
        $deleteTransactionEvent = new DeleteTransactionEvent($transactionId);
        $dispatcher->dispatch($deleteTransactionEvent, DeleteTransactionEvent::NAME);

        return $this->responseNoContent();
    }

}
