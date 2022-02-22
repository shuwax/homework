<?php

namespace App\Service\Transaction;

use App\Entity\Customer;

interface IGetListTransactionService
{
    /**
     * @return array
     */
    public function getList(): array;
    public function getListPeriodTime(Customer $customer): array;
}