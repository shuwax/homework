<?php

namespace App\Factory\Customer;

use App\Entity\Customer;

class CustomerFactory implements ICustomerFactory
{
    /**
     * @param array $data
     * @return Customer
     */
    public function create(array $data): Customer {
        $customer = new Customer();
        $customer->setName($data['name']);
        return $customer;
    }

}