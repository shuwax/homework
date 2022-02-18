<?php

namespace App\Tools\Calculator\RewardPoints;

class RewardPointOver100 extends RewardPointChain
{
    public function handle(int $transactionValue, int $currentRewardPoints): ?int
    {
        if ($transactionValue > TransactionToRewardPoint::OVER_100_FACTOR_START) {
            $florRawValue = $this->calculateFloorRawValue($transactionValue, TransactionToRewardPoint::OVER_100_FACTOR_START);
            return ($currentRewardPoints + $florRawValue * TransactionToRewardPoint::OVER_100_FACTOR);
        }
        return $currentRewardPoints;
    }
}
