<?php

namespace App\Event\ControllerHandler\Transaction;


use App\DTO\TransactionDTO;
use App\Entity\Transaction;
use Symfony\Contracts\EventDispatcher\Event;


class UpdateTransactionEvent extends Event
{

    public const NAME = 'controller.action.transaction.updateTransaction';

    private int $transactionId;

    private TransactionDTO $transactionDTO;

    private ?Transaction $transaction = null;

    public function __construct(TransactionDTO $transactionDTO, int $transactionId)
    {
        $this->transactionId = $transactionId;
        $this->transactionDTO = $transactionDTO;
    }

    /**
     * @return int
     */
    public function getTransactionId(): int
    {
        return $this->transactionId;
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