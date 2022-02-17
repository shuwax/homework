<?php

namespace App\Service\Transaction;

interface IGetListTransactionService
{
    /**
     * @return array
     */
    public function getList(): array;
}