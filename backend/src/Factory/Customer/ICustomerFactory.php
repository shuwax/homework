<?php

namespace App\Factory\Customer;

use App\Entity\Customer;

interface ICustomerFactory
{

    /**
     * @param string $name
     * @return Customer
     */
    public function create(string $name): Customer;

}