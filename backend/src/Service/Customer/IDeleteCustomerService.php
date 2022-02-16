<?php

namespace App\Service\Customer;

interface IDeleteCustomerService
{
    /**
     * @param int $customerId
     * @return void
     */
    public function delete(int $customerId): void;
}