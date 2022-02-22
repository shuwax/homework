<?php

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\Event\ControllerHandler\Transaction\GetListTransactionEvent;
use App\Event\ControllerHandler\Transaction\GetTransactionByCustomerEvent;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class GetListTransactionByCustomerEventTest extends TestCase
{
    public function testEventSetup()
    {
        $customerData = ['name' => 'Jan Kowalski'];
        $transactionData = ["value" => 120, "customerId" => 1, "transactionDate" => '2021-01-01'];

        $customerFactory = new CustomerFactory();
        $transactionFactory = new TransactionFactory();

        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerFactory->create($customerDTO);

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customerId'], $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);

        $transaction = $transactionFactory->create($transactionDTO);


        $getTransactionByCustomerEvent = new GetTransactionByCustomerEvent($transactionData['customerId']);
        $this->assertCount(0, $getTransactionByCustomerEvent->getTransactions());

        $this->assertEquals('controller.action.transaction.getTransactionByCustomerEvent', GetTransactionByCustomerEvent::NAME);

        ;
        $getTransactionByCustomerEvent->setTransactions([$transaction]);
        $this->assertCount(1, $getTransactionByCustomerEvent->getTransactions());
        $this->assertEquals($transactionData['customerId'], $getTransactionByCustomerEvent->getCustomerId());

    }
}