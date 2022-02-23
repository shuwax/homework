<?php

namespace App\Update\Transaction;

use App\DTO\TransactionDTO;
use App\Entity\Transaction;

interface ITransactionUpdate
{
    public function update(Transaction $transaction, TransactionDTO $transactionDTO): Transaction;

}