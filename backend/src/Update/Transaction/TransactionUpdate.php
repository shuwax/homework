<?php

namespace App\Update\Transaction;

use App\Entity\Transaction;

class TransactionUpdate implements ITransactionUpdate
{
    /**
     * @param Transaction $transaction
     * @param array $data
     * @return Transaction
     */
    public function update(Transaction $transaction, array $data): Transaction
    {
        $transaction->setValue($data['value']);
        return $transaction;
    }

}