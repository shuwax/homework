<?php

use App\Event\ControllerHandler\Transaction\GetOneTransactionEvent;
use App\Event\ControllerHandler\Transaction\UpdateTransactionEvent;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class PutTransactionEventTest extends TestCase
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

        $transactionUpdateData = ["value" => 13000];
        $updateTransactionEvent = new UpdateTransactionEvent($transactionUpdateData, $transactionId);
        $this->assertEquals(null, $updateTransactionEvent->getTransaction());

        $this->assertEquals('controller.action.transaction.updateTransaction', UpdateTransactionEvent::NAME);

        $updateTransactionEvent->setTransaction($transaction);
        $this->assertEquals($transaction->getValue(), $updateTransactionEvent->getTransaction()->getValue());
        $this->assertEquals($transactionId, $updateTransactionEvent->getTransactionId());

    }
}