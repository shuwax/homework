<?php

use App\Event\ControllerHandler\Customer\GetListCustomerEvent;
use App\Factory\Customer\CustomerFactory;
use PHPUnit\Framework\TestCase;

class GetListCustomerEventTest extends TestCase
{
    public function testEventSetup()
    {
        $customerData = ['name' => 'Jan Kowalski'];
        $customerFactory = new CustomerFactory();
        $customer = $customerFactory->create($customerData);

        $getListCustomerEvent = new GetListCustomerEvent();
        $this->assertCount(0, $getListCustomerEvent->getCustomers());

        $this->assertEquals('controller.action.customer.getListCustomers', $getListCustomerEvent::NAME);
        $getListCustomerEvent->setCustomers([$customer]);
        $this->assertCount(1, $getListCustomerEvent->getCustomers());

    }
}