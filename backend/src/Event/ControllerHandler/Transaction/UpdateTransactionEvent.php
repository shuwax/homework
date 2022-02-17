<?php

namespace App\Event\ControllerHandler\Transaction;


use App\Entity\Transaction;
use Symfony\Contracts\EventDispatcher\Event;


class UpdateTransactionEvent extends Event
{

    public const NAME = 'controller.action.transaction.updateTransaction';

    private int $transactionId;

    private array $transactionData;

    private ?Transaction $transaction = null;

    public function __construct(array $transactionData, int $transactionId)
    {
        $this->transactionId = $transactionId;
        $this->transactionData = $transactionData;
    }

    /**
     * @return int
     */
    public function getTransactionId(): int
    {
        return $this->transactionId;
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