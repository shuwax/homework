<?php

use App\Event\ControllerHandler\Transaction\GetListTransactionEvent;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class GetListTransactionEventTest extends TestCase
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


        $getListTransactionEvent = new GetListTransactionEvent();
        $this->assertCount(0, $getListTransactionEvent->getTransactions());

        $this->assertEquals('controller.action.transaction.getListTransactions', GetListTransactionEvent::NAME);

        $getListTransactionEvent->setTransactions([$transaction]);
        $this->assertCount(1, $getListTransactionEvent->getTransactions());

    }
}