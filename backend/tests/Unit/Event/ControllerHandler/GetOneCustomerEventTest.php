<?php

use App\Event\ControllerHandler\GetOneCustomerEvent;
use PHPUnit\Framework\TestCase;

class GetOneCustomerEventTest extends TestCase
{
    public function testEventSetup() {
        $customerId = 1;
        $getOneCustomerEvent = new GetOneCustomerEvent($customerId);
        $customer = new \App\Entity\Customer();
        $customer->setName('Jan Kowalski');
        $this->assertEquals(null, $getOneCustomerEvent->getCustomer());
        $this->assertEquals($customerId, $getOneCustomerEvent->getCustomerId());
        $this->assertEquals('controller.action.customer.getOneCustomer', $getOneCustomerEvent::NAME);
        $getOneCustomerEvent->setCustomer($customer);
        $this->assertEquals($customer->getName(), $getOneCustomerEvent->getCustomer()->getName());

    }
}