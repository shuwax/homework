<?php

namespace App\Service\Transaction;

use App\DTO\TransactionDTO;
use App\Entity\Transaction;

interface IPutTransactionService
{
    public function put(int $transactionId, TransactionDTO $transactionDTO): Transaction;
}