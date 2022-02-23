<?php

namespace App\Update\Transaction;

use App\DTO\TransactionDTO;
use App\Entity\Transaction;

class TransactionUpdate implements ITransactionUpdate
{
    /**
     * @param Transaction $transaction
     * @param TransactionDTO $transactionDTO
     * @return Transaction
     */
    public function update(Transaction $transaction, TransactionDTO $transactionDTO): Transaction
    {
        $transaction->setValue($transactionDTO->getValue());
        $transaction->setTransactionDate($transactionDTO->getTransactionDate());
        return $transaction;
    }

}