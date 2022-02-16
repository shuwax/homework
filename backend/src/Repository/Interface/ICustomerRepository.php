<?php

namespace App\Repository\Interface;

use App\Entity\Customer;

interface ICustomerRepository
{
    public function save(Customer $customer): Customer;

}