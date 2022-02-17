<?php

namespace App\Event\ControllerHandler\Transaction;


use Symfony\Contracts\EventDispatcher\Event;


class GetListTransactionEvent extends Event
{

    public const NAME = 'controller.action.transaction.getListTransactions';


    private array $transactions = [];

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @param array $transactions
     */
    public function setTransactions(array $transactions): void
    {
        $this->transactions = $transactions;
    }

}