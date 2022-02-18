<?php

namespace App\Factory\Transaction;

use App\DTO\TransactionDTO;
use App\Entity\Transaction;

interface ITransactionFactory
{

    /**
     * @param TransactionDTO $transactionDTO
     * @return Transaction
     */
    public function create(TransactionDTO $transactionDTO): Transaction;

}