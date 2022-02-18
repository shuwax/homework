<?php

namespace App\Service\Transaction;

use App\DTO\TransactionUpdateDTO;
use App\Entity\Transaction;

interface IPutTransactionService
{
    /**
     * @param int $transactionId
     * @param TransactionUpdateDTO $transactionUpdateDTO
     * @return Transaction
     */
    public function put(int $transactionId, TransactionUpdateDTO $transactionUpdateDTO): Transaction;
}