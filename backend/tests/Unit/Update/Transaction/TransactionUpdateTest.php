<?php

namespace Update\Transaction;

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\DTO\TransactionUpdateDTO;
use App\Entity\Customer;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use App\Update\Transaction\TransactionUpdate;
use PHPUnit\Framework\TestCase;

class TransactionUpdateTest extends TestCase
{
    public function testCustomerFactory()
    {

        $customerFactory = new CustomerFactory();
        $transactionFactory = new TransactionFactory();
        $transactionUpdate = new TransactionUpdate();

        $customerData = ["name" => 'Jan Kowalski'];
        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerFactory->create($customerDTO);

        $transactionData = ["value" => 120, "customerId" => 1, "transactionDate" => '2021-01-01'];

        $transactionDTO = new TransactionDTO($transactionData['value'], $customer, $transactionData['transactionDate']);

        $transaction = $transactionFactory->create($transactionDTO);

        $transactionUpdateData = ["value" => 130, "transactionDate" => '2021-01-02'];
        $transactionDTO = new TransactionDTO($transactionUpdateData['value'], $customer, $transactionUpdateData['transactionDate']);

        /** @var Customer $customer */
        $transaction = $transactionUpdate->update($transaction, $transactionDTO);


        $this->assertEquals($transaction->getValue(), $transactionUpdateData['value']);
        $this->assertEquals($transaction->getTransactionDate(), new \DateTime($transactionUpdateData['transactionDate']));
        $this->assertEquals($transaction->getRawValue(), $transactionUpdateData['value'] * 100);
        $this->assertNotEquals($transaction->getValue(), $transactionData['value']);
        $this->assertNotEquals($transaction->getRawValue(), $transactionData['value'] * 100);
    }

}