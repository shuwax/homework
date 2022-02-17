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

        $transaction->setCustomer($customer);
        $transaction->setValue(12000);

        $this->assertEquals($customer->getName(), $transaction->getCustomer()->getName());
        $this->assertGreaterThanOrEqual($transaction->getCreatedAt(), new \DateTime('now'));
        $this->assertGreaterThanOrEqual($transaction->getUpdatedAt(), new \DateTime('now'));

    }
}