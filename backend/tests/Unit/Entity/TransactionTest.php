<?php

use App\Entity\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    public function testEntity()
    {
        $customer = new \App\Entity\Customer();
        $transaction = new Transaction();

        $customer->setName('Jan Kowalski');
        $this->assertEquals('Jan Kowalski', $customer->getName());
        $transactionDate = new DateTime();

        $transaction->setCustomer($customer);
        $transaction->setTransactionDate($transactionDate);
        $transaction->setValue(120);

        $this->assertEquals($customer->getName(), $transaction->getCustomer()->getName());
        $this->assertEquals($transaction->getValue(), 120);
        $this->assertEquals($transaction->getRawValue(), 120 * 100);
        $this->assertEquals($transaction->getTransactionDate(), $transactionDate);
        $this->assertGreaterThanOrEqual($transaction->getCreatedAt(), new \DateTime('now'));
        $this->assertGreaterThanOrEqual($transaction->getUpdatedAt(), new \DateTime('now'));

    }
}