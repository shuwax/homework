<?php

namespace App\Tools\Calculator\RewardPoints;

class RewardPointOver100 extends RewardPointChain
{
    public function handle(int $transactionValue, int $currentRewardPoints): ?int
    {
        return ($currentRewardPoints + ($transactionValue - TransactionToRewardPoint::OVER_100_FACTOR_START) * TransactionToRewardPoint::OVER_100_FACTOR);
    }
}