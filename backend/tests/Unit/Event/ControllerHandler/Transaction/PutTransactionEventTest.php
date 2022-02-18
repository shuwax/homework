<?php

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\DTO\TransactionUpdateDTO;
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
        $transactionData = ["value" => 120, "customerId" => 1];

        $customerFactory = new CustomerFactory();
        $transactionFactory = new TransactionFactory();

        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerFactory->create($customerDTO);

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customerId']);
        $transactionDTO->setCustomer($customer);
        $transaction = $transactionFactory->create($transactionDTO);

        $transactionId = 1;

        $transactionUpdateData = ["value" => 130];
        $transactionUpdateDTO = new TransactionUpdateDTO($transactionUpdateData['value']);

        $updateTransactionEvent = new UpdateTransactionEvent($transactionUpdateDTO, $transactionId);
        $this->assertEquals(null, $updateTransactionEvent->getTransaction());

        $this->assertEquals('controller.action.transaction.updateTransaction', UpdateTransactionEvent::NAME);

        $updateTransactionEvent->setTransaction($transaction);
        $this->assertEquals($transaction->getValue(), $updateTransactionEvent->getTransaction()->getValue());
        $this->assertEquals($transaction->getRawValue(), $updateTransactionEvent->getTransaction()->getRawValue());
        $this->assertEquals($transactionId, $updateTransactionEvent->getTransactionId());

    }
}