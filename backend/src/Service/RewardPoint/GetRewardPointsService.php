<?php

namespace App\Service\RewardPoint;

use App\Entity\Customer;
use App\Entity\NonDb\RewardPoint;
use App\Entity\Transaction;
use App\Service\Transaction\IGetListTransactionService;
use App\Tools\Calculator\RewardPoints\TransactionToRewardPoint;

class GetRewardPointsService implements IGetRewardPointsService
{

    private IGetListTransactionService $getListTransactionService;

    public function __construct(
        IGetListTransactionService $getListTransactionService
    )
    {
        $this->getListTransactionService = $getListTransactionService;
    }

    public function calculateRewardPointsCustomer(Customer $customer): RewardPoint
    {
        $rewardPoint = new RewardPoint();
        $customerRewardPointsOverall = $rewardPoint->getRewardPoints();
        $customerTransactions = $this->getListTransactionService->getListPeriodTimeByCustomer($customer);
        /** @var Transaction $transaction */
        foreach ($customerTransactions as $transaction) {
            $calculatorRewardPoints = new TransactionToRewardPoint($transaction->getRawValue());
            $calculatorRewardPoints->calculateRewardPoint();
            $customerRewardPointsOverall += $calculatorRewardPoints->getRewardPoints();
        }
        $rewardPoint->setRewardPoints($customerRewardPointsOverall);

        return $rewardPoint;
    }
}