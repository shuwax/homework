<?php

namespace App\Update\Transaction;

use App\Entity\Transaction;

interface ITransactionUpdate
{
    /**
     * @param Transaction $transaction
     * @param array $data
     * @return Transaction
     */
    public function update(Transaction $transaction, array $data): Transaction;

}