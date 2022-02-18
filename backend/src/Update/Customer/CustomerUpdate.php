<?php

namespace App\Update\Customer;

use App\DTO\CustomerDTO;
use App\Entity\Customer;

class CustomerUpdate implements ICustomerUpdate
{
    /**
     * @param Customer $customer
     * @param CustomerDTO $customerDTO
     * @return Customer
     */
    public function update(Customer $customer, CustomerDTO $customerDTO): Customer
    {
        $customer->setName($customerDTO->getName());
        return $customer;
    }

}