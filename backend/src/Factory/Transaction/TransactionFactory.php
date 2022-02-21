<?php

namespace App\Factory\Transaction;

use App\DTO\TransactionDTO;
use App\Entity\Transaction;

class TransactionFactory implements ITransactionFactory
{
    /**
     * @param TransactionDTO $transactionDTO
     * @return Transaction
     */
    public function create(TransactionDTO $transactionDTO): Transaction
    {
        $transaction = new Transaction();
        $transaction->setValue($transactionDTO->getValue());
        $transaction->setCustomer($transactionDTO->getCustomer());
        $transaction->setTransactionDate($transactionDTO->getTransactionDate());

        return $transaction;
    }

}