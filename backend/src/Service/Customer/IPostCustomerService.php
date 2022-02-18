<?php

namespace App\Service\Customer;


use App\DTO\CustomerDTO;
use App\Entity\Customer;

interface IPostCustomerService
{
    /**
     * @param CustomerDTO $customerDTO
     * @return Customer
     */
    public function create(CustomerDTO $customerDTO): Customer;
}