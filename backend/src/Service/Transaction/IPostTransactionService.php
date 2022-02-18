<?php

namespace App\Service\Transaction;


use App\DTO\TransactionDTO;
use App\Entity\Transaction;

interface IPostTransactionService
{
    /**
     * @param TransactionDTO $transactionDTO
     * @return Transaction
     */
    public function create(TransactionDTO $transactionDTO): Transaction;
}