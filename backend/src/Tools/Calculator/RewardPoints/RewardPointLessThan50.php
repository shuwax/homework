<?php

namespace App\Tools\Calculator\RewardPoints;

class RewardPointLessThan50 extends RewardPointChain
{

    public function handle(int $transactionValue, int $currentRewardPoints): ?int
    {
        if ($transactionValue < TransactionToRewardPoint::OVER_50_FACTOR_START) {
            return $currentRewardPoints;
        } else {
            return parent::handle($transactionValue, $currentRewardPoints);
        }
    }
}