<?php

namespace App\Tools\Calculator\RewardPoints;


class TransactionToRewardPoint
{
    const OVER_100_FACTOR = 2;
    const OVER_100_FACTOR_START = 10000;

    const OVER_50_FACTOR = 1;
    const OVER_50_FACTOR_START = 5000;

    private int $transactionValue;

    private int $rewardPoints = 0;

    public function __construct(int $transactionValue)
    {
        $this->transactionValue = $transactionValue;
    }

    /**
     * @return int
     */
    public function getTransactionValue(): int
    {
        return $this->transactionValue;
    }


    /**
     * @return int
     */
    public function getRewardPoints(): int
    {
        return $this->rewardPoints;
    }

    /**
     * @param int $rewardPoints
     */
    public function setRewardPoints(int $rewardPoints): void
    {
        $this->rewardPoints = $rewardPoints;
    }

    public function calculateRewardPoint()
    {
        $lessThan50 = new RewardPointLessThan50();
        $overThan50 = new RewardPointOverThan50();
        $overThen100 = new RewardPointOver100();
        $lessThan50->setNext($overThan50)->setNext($overThen100);
        $rewardPoints = $lessThan50->handle($this->getTransactionValue(), $this->getRewardPoints());
        $this->setRewardPoints($rewardPoints);

    }
}