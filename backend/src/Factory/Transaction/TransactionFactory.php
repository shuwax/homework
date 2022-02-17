<?php

namespace App\Factory\Transaction;

use App\Entity\Transaction;

class TransactionFactory implements ITransactionFactory
{
    /**
     * @param array $data
     * @return Transaction
     */
    public function create(array $data): Transaction {
        $transaction = new Transaction();
        $transaction->setValue($data['value']);
        $transaction->setCustomer($data['customer']);

        return $transaction;
    }

}