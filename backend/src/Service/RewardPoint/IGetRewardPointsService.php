<?php

namespace App\Service\RewardPoint;

use App\Entity\Customer;
use App\Entity\NonDb\RewardPoint;

interface IGetRewardPointsService
{
    public function calculateRewardPointsCustomer(Customer $customer): RewardPoint;
}