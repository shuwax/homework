<?php

namespace App\Factory\Transaction;

use App\Entity\Transaction;

interface ITransactionFactory
{

    /**
     * @param array $data
     * @return Transaction
     */
    public function create(array $data): Transaction;

}