<?php

namespace App\Service\Customer;


interface IPostCustomerService
{
    /**
     * @param array $data
     * @return array
     */
    public function create(array $data):array;
}