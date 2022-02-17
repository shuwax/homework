<?php

namespace App\Update\Customer;

use App\Entity\Customer;

interface ICustomerUpdate
{
    /**
     * @param Customer $customer
     * @param  array $data
     * @return Customer
     */
    public function update(Customer $customer, array $data): Customer;

}