<?php

namespace App\Service\Transaction;

use App\Entity\Transaction;

interface IGetOneTransactionService
{
    /**
     * @param int $transactionId
     * @return Transaction
     */
    public function getOne(int $transactionId): Transaction;
}