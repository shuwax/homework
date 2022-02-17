<?php

namespace App\Event\ControllerHandler\Transaction;

use Symfony\Contracts\EventDispatcher\Event;


class DeleteTransactionEvent extends Event
{

    public const NAME = 'controller.action.transaction.deleteTransaction';

    private int $transactionId;

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
}