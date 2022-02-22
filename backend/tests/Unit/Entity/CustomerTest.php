<?php

use App\Entity\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testEntity() {
        $customer = new Customer();
        $customer->setName('Jan Kowalski');
        $this->assertEquals('Jan Kowalski', $customer->getName());
    }
}