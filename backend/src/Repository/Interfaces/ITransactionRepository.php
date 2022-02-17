<?php

namespace App\Repository\Interfaces;

use App\Entity\Transaction;

interface ITransactionRepository
{
    public function save(Transaction $transaction): Transaction;

    public function delete(Transaction $transaction): void;

    public function findAllTransaction(): array;

    public function findOneByTransaction(array $criteria): ?Transaction;

}