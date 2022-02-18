<?php

namespace App\Tools\Calculator\RewardPoints;

class RewardPointOverThan50 extends RewardPointChain
{

    public function handle(int $transactionValue, int $currentRewardPoints): ?int
    {
        if ($transactionValue > TransactionToRewardPoint::OVER_50_FACTOR_START) {
            $florRawValue = $this->calculateFloorRawValue($transactionValue, TransactionToRewardPoint::OVER_50_FACTOR_START);
            return parent::handle($transactionValue, $currentRewardPoints + $florRawValue * TransactionToRewardPoint::OVER_50_FACTOR);
        } else {
            return $currentRewardPoints;
        }
    }
}