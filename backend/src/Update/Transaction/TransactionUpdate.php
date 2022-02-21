<?php

namespace App\Update\Transaction;

use App\DTO\TransactionUpdateDTO;
use App\Entity\Transaction;

class TransactionUpdate implements ITransactionUpdate
{
    /**
     * @param Transaction $transaction
     * @param TransactionUpdateDTO $transactionUpdateDTO
     * @return Transaction
     */
    public function update(Transaction $transaction, TransactionUpdateDTO $transactionUpdateDTO): Transaction
    {
        $transaction->setValue($transactionUpdateDTO->getValue());
        $transaction->setTransactionDate($transactionUpdateDTO->getTransactionDate());
        return $transaction;
    }

}