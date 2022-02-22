<?php

namespace App\Service\RewardPoint;

use App\Entity\Customer;
use App\Entity\NonDb\RewardPoint;
use App\Entity\Transaction;
use App\Repository\Interfaces\ITransactionRepository;
use App\Tools\Calculator\RewardPoints\TransactionToRewardPoint;
use App\Tools\Date\IDateHandler;

class GetRewardPointsService implements IGetRewardPointsService
{

    private ITransactionRepository $transactionRepository;

    private IDateHandler $dateHandler;

    public function __construct(
        ITransactionRepository $transactionRepository,
        IDateHandler $dateHandler
    )
    {
        $this->transactionRepository = $transactionRepository;
        $this->dateHandler = $dateHandler;
    }

    public function calculateRewardPointsCustomer(Customer $customer): RewardPoint
    {
        $rewardPoint = new RewardPoint();
        $customerRewardPointsOverall = $rewardPoint->getRewardPoints();
        $periodDate = $this->dateHandler->formatDate($this->dateHandler->addToCurrentDateDays(Transaction::DAY_PERIOD_TRANSACTIONS), 'Y-m-d');
        $customerTransactions = $this->transactionRepository->findByCustomerAndDateTransaction($customer, $periodDate);

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