<?php

namespace App\Service\Transaction;

use App\Entity\Transaction;

interface IPutTransactionService
{
    /**
     * @param int $transactionId
     * @param array $data
     * @return Transaction
     */
    public function put(int $transactionId, array $data): Transaction;
}