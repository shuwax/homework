<?php

namespace App\Repository\Interfaces;

use App\Entity\Customer;

interface ICustomerRepository
{
    public function save(Customer $customer): Customer;

    public function findAllCustomers(): array;

}