<?php

use App\Event\ControllerHandler\Customer\DeleteCustomerEvent;
use PHPUnit\Framework\TestCase;

class DeleteCustomerEventTest extends TestCase
{
    public function testEventSetup()
    {
        $customerId = 1;

        $deleteCustomerEvent = new DeleteCustomerEvent($customerId);

        $this->assertEquals($customerId, $deleteCustomerEvent->getCustomerId());

        $this->assertEquals('controller.action.customer.deleteCustomer', $deleteCustomerEvent::NAME);

    }
}