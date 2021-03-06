<?php

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\Event\ControllerHandler\Transaction\GetListTransactionEvent;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class GetListTransactionEventTest extends TestCase
{
    public function testEventSetup()
    {
        $customerData = ['name' => 'Jan Kowalski'];
        $transactionData = ["value" => 120, "customer" => ["id" => "1"], "transactionDate" => '2021-01-01'];

        $customerFactory = new CustomerFactory();
        $transactionFactory = new TransactionFactory();

        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerFactory->create($customerDTO);

        $transactionDTO = new TransactionDTO($transactionData['value'], $customer, $transactionData['transactionDate']);

        $transaction = $transactionFactory->create($transactionDTO);


        $getListTransactionEvent = new GetListTransactionEvent();
        $this->assertCount(0, $getListTransactionEvent->getTransactions());

        $this->assertEquals('controller.action.transaction.getListTransactions', GetListTransactionEvent::NAME);

        $getListTransactionEvent->setTransactions([$transaction]);
        $this->assertCount(1, $getListTransactionEvent->getTransactions());

    }
}