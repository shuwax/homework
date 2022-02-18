<?php

namespace App\Service\Customer;


use App\DTO\CustomerDTO;
use App\Entity\Customer;

interface IPutCustomerService
{

    /**
     * @param int $customerId
     * @param CustomerDTO $customerDTO
     * @return Customer
     */
    public function put(int $customerId, CustomerDTO $customerDTO): Customer;
}