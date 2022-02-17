<?php

namespace App\Service\Customer;

interface ICalculateRewardPointsListCustomerService
{
    public function calculateRewardPointsListCustomers(array $customers): array;
}