<?php

namespace App\Update\Customer;

use App\Entity\Customer;

class CustomerUpdate implements ICustomerUpdate
{
    /**
     * @param Customer $customer
     * @param array $data
     * @return Customer
     */
    public function update(Customer $customer, array $data): Customer {
        $customer->setName($data['name']);
        return $customer;
    }

}