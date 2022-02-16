<?php

namespace App\Service\Customer;


use App\Entity\Customer;

interface IPostCustomerService
{
    /**
     * @param array $data
     * @return Customer
     */
    public function create(array $data): Customer;
}