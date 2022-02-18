<?php

namespace App\Update\Customer;

use App\DTO\CustomerDTO;
use App\Entity\Customer;

interface ICustomerUpdate
{
    /**
     * @param Customer $customer
     * @param CustomerDTO $customerDTO
     * @return Customer
     */
    public function update(Customer $customer, CustomerDTO $customerDTO): Customer;

}