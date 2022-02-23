<?php

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\Event\ControllerHandler\Transaction\UpdateTransactionEvent;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class PutTransactionEventTest extends TestCase
{
    public function testEventSetup()
    {
        $customerData = ['name' => 'Jan Kowalski'];
        $transactionData = ["value" => 120, "customer" => ["id" => "1"], "transactionDate" => '2021-01-01'];

        $customerFactory = new CustomerFactory();
        $transactionFactory = new TransactionFactory();

        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerFactory->create($customerDTO);

        $transactionId = 1;

        $transactionUpdateData = ["value" => 130];
        $transactionUpdateDTO = new TransactionDTO($transactionUpdateData['value'], $customer, $transactionData['transactionDate']);

        $updateTransactionEvent = new UpdateTransactionEvent($transactionUpdateDTO, $transactionId);
        $this->assertEquals(null, $updateTransactionEvent->getTransaction());

        $this->assertEquals('controller.action.transaction.updateTransaction', UpdateTransactionEvent::NAME);

        $transaction = $transactionFactory->create($transactionUpdateDTO);
        $updateTransactionEvent->setTransaction($transaction);

        $this->assertEquals($transaction->getValue(), $updateTransactionEvent->getTransaction()->getValue());
        $this->assertEquals($transaction->getRawValue(), $updateTransactionEvent->getTransaction()->getRawValue());
        $this->assertEquals($transactionId, $updateTransactionEvent->getTransactionId());

    }
}