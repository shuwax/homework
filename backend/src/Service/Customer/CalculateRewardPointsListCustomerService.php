<?php

namespace App\Service\Customer;

use App\Entity\Customer;
use App\Entity\Transaction;
use App\Tools\Calculator\RewardPoints\TransactionToRewardPoint;

class CalculateRewardPointsListCustomerService implements ICalculateRewardPointsListCustomerService
{

    public function calculateRewardPointsListCustomers(array $customers): array
    {
        /** @var Customer $customer */
        foreach ($customers as $customer) {
            $this->calculateRewardPointsCustomer($customer);
        }

        return $customers;
    }

    public function calculateRewardPointsCustomer(Customer $customer): Customer
    {
        $transactions = $customer->getTransactions();
        $customerRewardPointsOverall = $customer->getRewardPointsOverall();
        /** @var Transaction $transaction */
        foreach ($transactions as $transaction) {
            $calculatorRewardPoints = new TransactionToRewardPoint($transaction->getRawValue());
            $calculatorRewardPoints->calculateRewardPoint();
            $customerRewardPointsOverall += $calculatorRewardPoints->getRewardPoints();
        }
        $customer->setRewardPointsOverall($customerRewardPointsOverall);

        return $customer;
    }
}