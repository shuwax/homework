<?php

namespace App\Service\Customer;

use App\Entity\Customer;

interface IGetCustomerService
{
    public function get(int $customerId): ?Customer;
}