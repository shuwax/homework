<?php

namespace App\Controller;

use App\DTO\TransactionDTO;
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
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class TransactionController extends AbstractApiController
{
    /**
     * @OA\Tag(name="Transactions")
     * @OA\Response(
     *     response=201,
     *     description="Create Transaction"
     * )
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
     * @OA\Tag(name="Transactions")
     * @OA\Response(
     *     response=200,
     *     description="List Transactions"
     * )
     * @Route("/transactions", name="transactions_get", methods="GET" )
     */
    public function getList(SerializerInterface $serializer, EventDispatcherInterface $dispatcher): Response
    {
        $getListTransactionEvent = new GetListTransactionEvent();
        $dispatcher->dispatch($getListTransactionEvent, GetListTransactionEvent::NAME);

        return $this->responseOk($this->serializer($serializer, $getListTransactionEvent->getTransactions(), ['transaction:list']));
    }

    /**
     * @OA\Tag(name="Transactions")
     * @OA\Response(
     *     response=200,
     *     description="List period 3 months Transactions"
     * )
     * @Route("/transactions/customer/{customerId}/period", name="transactions_customer_period_get", methods="GET" )
     */
    public function getOneByCustomerPeriod(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, $customerId): Response
    {
        $getOneCustomerTransactionsEvent = new GetTransactionByCustomerEvent($customerId);
        $dispatcher->dispatch($getOneCustomerTransactionsEvent, GetTransactionByCustomerEvent::NAME_PERIOD);
        return $this->responseOK($this->serializer($serializer, $getOneCustomerTransactionsEvent->getTransactions(), ['transaction:list:period']));
    }

    /**
     * @OA\Tag(name="Transactions")
     * @OA\Response(
     *     response=200,
     *     description="List Transactions selected Customer"
     * )
     * @Route("/transactions/customer/{customerId}", name="transactions_customer_get", methods="GET" )
     */
    public function getOneByCustomer(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, $customerId): Response
    {
        $getOneCustomerTransactionsEvent = new GetTransactionByCustomerEvent($customerId);
        $dispatcher->dispatch($getOneCustomerTransactionsEvent, GetTransactionByCustomerEvent::NAME);
        return $this->responseOK($this->serializer($serializer, $getOneCustomerTransactionsEvent->getTransactions(), ['transaction:list:period']));
    }


    /**
     * @OA\Tag(name="Transactions")
     * @OA\Response(
     *     response=200,
     *     description="Transaction"
     * )
     * @Route("/transactions/{transactionId}", name="transaction_get", methods="GET" )
     */
    public function getOne(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, int $transactionId): Response
    {
        $getOneTransactionEvent = new GetOneTransactionEvent($transactionId);
        $dispatcher->dispatch($getOneTransactionEvent, GetOneTransactionEvent::NAME);

        return $this->responseOk($this->serializer($serializer, $getOneTransactionEvent->getTransaction(), ['transaction:show']));
    }

    /**
     * @OA\Tag(name="Transactions")
     * @OA\Response(
     *     response=200,
     *     description="Update Transaction"
     * )
     * @ParamConverter("transactionDTO", converter="fos_rest.request_body")
     * @Route("/transactions/{transactionId}", name="transaction_put", methods="PUT" )
     */
    public function put(
        SerializerInterface              $serializer,
        EventDispatcherInterface         $dispatcher,
        int                              $transactionId,
        TransactionDTO             $transactionDTO,
        ConstraintViolationListInterface $validationErrors
    ): Response
    {
        if ($validationErrors->count() > 0) {
            return $this->responseBadRequest($validationErrors);
        }
        $updateTransactionEvent = new UpdateTransactionEvent($transactionDTO, $transactionId);
        $dispatcher->dispatch($updateTransactionEvent, UpdateTransactionEvent::NAME);

        return $this->responseOk($this->serializer($serializer, $updateTransactionEvent->getTransaction(), ['transaction:put']));
    }

    /**
     * @OA\Tag(name="Transactions")
     * @OA\Response(
     *     response=204,
     *     description="Delete Transaction"
     * )
     * @Route("/transactions/{transactionId}", name="transaction_delete", methods="DELETE" )
     */
    public function delete(EventDispatcherInterface $dispatcher, int $transactionId): Response
    {
        $deleteTransactionEvent = new DeleteTransactionEvent($transactionId);
        $dispatcher->dispatch($deleteTransactionEvent, DeleteTransactionEvent::NAME);

        return $this->responseNoContent();
    }

}
