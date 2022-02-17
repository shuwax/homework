<?php

use App\Event\ControllerHandler\Transaction\CreateTransactionEvent;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class CreateTransactionEventTest extends TestCase
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


        $createTransactionEvent = new CreateTransactionEvent($transactionData);
        $this->assertEquals(null, $createTransactionEvent->getTransaction());

        $this->assertEquals('controller.action.transaction.createTransactions', $createTransactionEvent::NAME);

        $createTransactionEvent->setTransaction($transaction);
        $this->assertEquals($transactionData['value'], $createTransactionEvent->getTransaction()->getValue());

    }
}