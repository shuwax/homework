<?php

namespace App\Event\ControllerHandler\Transaction;


use App\DTO\TransactionDTO;
use App\DTO\TransactionUpdateDTO;
use App\Entity\Transaction;
use Symfony\Contracts\EventDispatcher\Event;


class UpdateTransactionEvent extends Event
{

    public const NAME = 'controller.action.transaction.updateTransaction';

    private int $transactionId;

    private TransactionUpdateDTO $transactionUpdateDTO;

    private ?Transaction $transaction = null;

    public function __construct(TransactionUpdateDTO $transactionUpdateDTO, int $transactionId)
    {
        $this->transactionId = $transactionId;
        $this->transactionUpdateDTO = $transactionUpdateDTO;
    }

    /**
     * @return int
     */
    public function getTransactionId(): int
    {
        return $this->transactionId;
    }

    /**
     * @return TransactionUpdateDTO
     */
    public function getTransactionUpdateDTO(): TransactionUpdateDTO
    {
        return $this->transactionUpdateDTO;
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