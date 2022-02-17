<?php

use PHPUnit\Framework\TestCase;

class Customer extends TestCase
{
    public function testEntity() {
        $customer = new \App\Entity\Customer();
        $customer->setName('Jan Kowalski');
        $this->assertEquals('Jan Kowalski', $customer->getName());
    }
}