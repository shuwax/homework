<?php

namespace App\Service\Transaction;


use App\Entity\Transaction;

interface IPostTransactionService
{
    /**
     * @param array $data
     * @return Transaction
     */
    public function create(array $data): Transaction;
}