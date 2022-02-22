<?php

namespace App\Event\ControllerHandler\Transaction;


use App\Entity\Customer;
use App\Entity\Transaction;
use Symfony\Contracts\EventDispatcher\Event;


class GetTransactionByCustomerEvent extends Event
{

    public const NAME = 'controller.action.transaction.getTransactionByCustomerEvent';


    private int $customerId;

    private array $transactions = [];

    public function __construct(int $customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

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