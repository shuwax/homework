<?php

namespace App\Service\Transaction;

interface IDeleteTransactionService
{
    /**
     * @param int $transactionId
     * @return void
     */
    public function delete(int $transactionId): void;
}