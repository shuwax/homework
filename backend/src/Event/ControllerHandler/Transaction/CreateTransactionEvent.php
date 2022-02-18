<?php

namespace App\Event\ControllerHandler\Transaction;


use App\DTO\TransactionDTO;
use App\Entity\Transaction;
use Symfony\Contracts\EventDispatcher\Event;


class CreateTransactionEvent extends Event
{

    public const NAME = 'controller.action.transaction.createTransactions';

    private TransactionDTO $transactionDTO;


    private ?Transaction $transaction = null;

    public function __construct(TransactionDTO $transactionDTO)
    {
        $this->transactionDTO = $transactionDTO;
    }

    /**
     * @return TransactionDTO
     */
    public function getTransactionDTO(): TransactionDTO
    {
        return $this->transactionDTO;
    }


    /**
     * @return Transaction|null
     */
    public function getTransaction(): ?Transaction
    {
        return $this->transaction;
    }

    /**
     * @param Transaction|null $transaction
     */
    public function setTransaction(?Transaction $transaction): void
    {
        $this->transaction = $transaction;
    }


}