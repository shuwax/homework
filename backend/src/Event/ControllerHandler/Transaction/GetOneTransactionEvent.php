<?php

namespace App\Event\ControllerHandler\Transaction;


use App\Entity\Transaction;
use Symfony\Contracts\EventDispatcher\Event;


class GetOneTransactionEvent extends Event
{

    public const NAME = 'controller.action.transaction.getOneTransaction';

    private int $transactionId;

    private ?Transaction $transaction = null;

    public function __construct(int $transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return int
     */
    public function getTransactionId(): int
    {
        return $this->transactionId;
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