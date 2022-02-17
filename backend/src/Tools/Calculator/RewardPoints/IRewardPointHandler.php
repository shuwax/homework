<?php

namespace App\Tools\Calculator\RewardPoints;

interface IRewardPointHandler
{
    public function setNext(IRewardPointHandler $handler): IRewardPointHandler;

    public function handle(int $transactionValue, int $currentRewardPoints): ?int;
}