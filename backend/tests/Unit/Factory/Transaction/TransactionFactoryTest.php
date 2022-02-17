<?php

namespace Factory\Transaction;

use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use PHPUnit\Framework\TestCase;

class TransactionFactoryTest extends TestCase
{
    public function testTransactionFactory()
    {
        $customerData = ["name" => 'Jan Kowalski'];
        $transactionData = ["value" => 12000, "customerId" => 1];

        $transactionFactory = new TransactionFactory();
        $customerFactory = new CustomerFactory();

        $customer = $customerFactory->create($customerData);
        $transactionData['customer'] = $customer;

        $transaction = $transactionFactory->create($transactionData);

        $this->assertEquals($transaction->getCustomer()->getName(), $customerData['name']);
        $this->assertEquals(12000, $transaction->getValue());

        $this->assertGreaterThanOrEqual($transaction->getCreatedAt(), new \DateTime('now'));
        $this->assertGreaterThanOrEqual($transaction->getUpdatedAt(), new \DateTime('now'));

    }

}