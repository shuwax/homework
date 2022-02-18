<?php

namespace App\Tools\Calculator\RewardPoints;

abstract class RewardPointChain implements IRewardPointHandler
{

    private IRewardPointHandler $nextHandler;

    public function setNext(IRewardPointHandler $handler): IRewardPointHandler
    {
        $this->nextHandler = $handler;

        return $handler;
    }

    public function handle(int $transactionValue, int $currentRewardPoints): ?int
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($transactionValue, $currentRewardPoints);
        }

        return null;
    }

    public function calculateFloorRawValue(int $transactionValue, int $factoryStart): int {
        return floor(($transactionValue - $factoryStart) / 100);
    }
}