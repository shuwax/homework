<?php

namespace App\Factory\Customer;

use App\DTO\CustomerDTO;
use App\Entity\Customer;

class CustomerFactory implements ICustomerFactory
{

    public function create(CustomerDTO $customerDTO): Customer
    {
        $customer = new Customer();
        $customer->setName($customerDTO->getName());
        return $customer;
    }

}