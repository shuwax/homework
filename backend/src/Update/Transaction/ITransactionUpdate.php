<?php

namespace App\Update\Transaction;

use App\DTO\TransactionUpdateDTO;
use App\Entity\Transaction;

interface ITransactionUpdate
{
    /**
     * @param Transaction $transaction
     * @param TransactionUpdateDTO $transactionUpdateDTO
     * @return Transaction
     */
    public function update(Transaction $transaction, TransactionUpdateDTO $transactionUpdateDTO): Transaction;

}