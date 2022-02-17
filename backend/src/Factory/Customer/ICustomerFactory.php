<?php

namespace App\Factory\Customer;

use App\Entity\Customer;

interface ICustomerFactory
{

    /**
     * @param array $data
     * @return Customer
     */
    public function create(array $data): Customer;

}