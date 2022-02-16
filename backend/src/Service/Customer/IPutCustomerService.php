<?php

namespace App\Service\Customer;


use App\Entity\Customer;

interface IPutCustomerService
{
    /**
     * @param int $customerId
     * @param array $data
     * @return Customer
     */
    public function put(int $customerId, array $data): Customer;
}