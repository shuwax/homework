<?php

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\Event\ControllerHandler\Transaction\GetOneTransactionEvent;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class GetOneTransactionEventTest extends TestCase
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

        $transactionId = 1;
        $getOneTransactionEvent = new GetOneTransactionEvent($transactionId);
        $this->assertEquals(null, $getOneTransactionEvent->getTransaction());

        $this->assertEquals('controller.action.transaction.getOneTransaction', GetOneTransactionEvent::NAME);

        $getOneTransactionEvent->setTransaction($transaction);
        $this->assertEquals($transaction->getValue(), $getOneTransactionEvent->getTransaction()->getValue());
        $this->assertEquals($transaction->getRawValue(), $getOneTransactionEvent->getTransaction()->getRawValue());
        $this->assertEquals($transactionId, $getOneTransactionEvent->getTransactionId());

    }
}