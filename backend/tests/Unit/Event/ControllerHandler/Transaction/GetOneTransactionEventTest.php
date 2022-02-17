<?php

use App\Event\ControllerHandler\Transaction\GetOneTransactionEvent;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class GetOneTransactionEventTest extends TestCase
{
    public function testEventSetup()
    {
        $customerData = ['name' => 'Jan Kowalski'];
        $transactionData = ["value" => 12000, "customerId" => 1];

        $customerFactory = new CustomerFactory();
        $transactionFactory = new TransactionFactory();

        $customer = $customerFactory->create($customerData);

        $transactionData['customer'] = $customer;
        $transaction = $transactionFactory->create($transactionData);

        $transactionId = 1;
        $getOneTransactionEvent = new GetOneTransactionEvent($transactionId);
        $this->assertEquals(null, $getOneTransactionEvent->getTransaction());

        $this->assertEquals('controller.action.transaction.getOneTransaction', GetOneTransactionEvent::NAME);

        $getOneTransactionEvent->setTransaction($transaction);
        $this->assertEquals($transaction->getValue(), $getOneTransactionEvent->getTransaction()->getValue());
        $this->assertEquals($transactionId, $getOneTransactionEvent->getTransactionId());

    }
}