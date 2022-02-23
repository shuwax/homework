<?php

namespace App\Service\Transaction;

use App\Entity\Customer;

interface IGetListTransactionService
{
    /**
     * @return array
     */
    public function getList(): array;
    public function getListPeriodTimeByCustomer(Customer $customer): array;
    public function getListByCustomer(Customer $customer): array;
}