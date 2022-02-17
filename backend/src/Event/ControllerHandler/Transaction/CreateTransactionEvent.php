<?php

namespace App\Event\ControllerHandler\Transaction;


use App\Entity\Transaction;
use Symfony\Contracts\EventDispatcher\Event;


class CreateTransactionEvent extends Event
{

    public const NAME = 'controller.action.transaction.createTransactions';

    private array $transactionData = [];


    private ?Transaction $transaction = null;

    public function __construct(array $transactionData)
    {
        $this->transactionData = $transactionData;
    }

    /**
     * @return array
     */
    public function getTransactionData(): array
    {
        return $this->transactionData;
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