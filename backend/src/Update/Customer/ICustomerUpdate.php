<?php

namespace App\Update\Customer;

use App\Entity\Customer;

interface ICustomerUpdate
{
    /**
     * @param Customer $customer
     * @param string $name
     * @return Customer
     */
    public function update(Customer $customer, string $name): Customer;

}