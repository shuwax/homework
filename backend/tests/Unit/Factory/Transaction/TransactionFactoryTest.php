<?php

namespace Factory\Transaction;

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\Entity\Customer;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class TransactionFactoryTest extends TestCase
{
    public function testTransactionFactory()
    {
        $customerData = ["name" => 'Jan Kowalski'];
        $transactionData = ["value" => 120, "customer" => ["id" => "1"], "transactionDate" => '2021-01-01'];

        $transactionFactory = new TransactionFactory();
        $customerFactory = new CustomerFactory();
        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerFactory->create($customerDTO);

        $customerForDTO = new Customer();
        $customerForDTO->setId($transactionData['customer']['id']);
        $transactionDTO = new TransactionDTO($transactionData['value'], $customerForDTO, $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);

        $transaction = $transactionFactory->create($transactionDTO);


        $this->assertEquals($transaction->getCustomer()->getName(), $customerData['name']);
        $this->assertEquals(120, $transaction->getValue());
        $this->assertEquals(120 * 100, $transaction->getRawValue());

        $this->assertGreaterThanOrEqual($transaction->getTransactionDate(), new \DateTime($transactionData['transactionDate']));
        $this->assertGreaterThanOrEqual($transaction->getCreatedAt(), new \DateTime('now'));
        $this->assertGreaterThanOrEqual($transaction->getUpdatedAt(), new \DateTime('now'));

    }

}