<?php

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\Entity\NonDb\RewardPoint;
use App\Event\ControllerHandler\Customer\GetRewardPointsCustomerEvent;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class GetRewardPointsCustomerEventTest extends TestCase
{
    public function testEventSetup() {
        $customerData = ['name' => 'Jan Kowalski'];
        $transactionData = ["value" => 120, "customer" => ["id" => "1"], "transactionDate" => '2021-01-01'];

        $customerFactory = new CustomerFactory();
        $transactionFactory = new TransactionFactory();

        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerFactory->create($customerDTO);

        $transactionDTO = new TransactionDTO($transactionData['value'], $customer, $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);

        $transactionFactory->create($transactionDTO);

        $rewardPoint = new RewardPoint();
        $rewardPoint->setRewardPoints(120);
        $getRewardPointsCustomerEvent = new GetRewardPointsCustomerEvent($transactionData['customer']['id']);
        $this->assertEquals(null, $getRewardPointsCustomerEvent->getRewardPoint());
        $this->assertEquals('controller.action.customer.getRewardPointsCustomer', GetRewardPointsCustomerEvent::NAME);

        $getRewardPointsCustomerEvent->setRewardPoint($rewardPoint);
        $this->assertEquals(120, $getRewardPointsCustomerEvent->getRewardPoint()->getRewardPoints());

    }
}