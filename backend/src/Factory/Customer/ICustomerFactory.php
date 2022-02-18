<?php

namespace App\Factory\Customer;

use App\DTO\CustomerDTO;
use App\Entity\Customer;

interface ICustomerFactory
{

    /**
     * @param CustomerDTO $customerDTO
     * @return Customer
     */
    public function create(CustomerDTO $customerDTO): Customer;

}