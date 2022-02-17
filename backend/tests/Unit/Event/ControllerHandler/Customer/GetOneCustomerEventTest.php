<?php

use App\Event\ControllerHandler\Customer\GetOneCustomerEvent;
use App\Factory\Customer\CustomerFactory;
use PHPUnit\Framework\TestCase;

class GetOneCustomerEventTest extends TestCase
{
    public function testEventSetup() {
        $customerData = ['name' => 'Jan Kowalski'];
        $customerFactory = new CustomerFactory();
        $customer = $customerFactory->create($customerData);
        $customerId = 1;

        $getOneCustomerEvent = new GetOneCustomerEvent($customerId);

        $this->assertEquals(null, $getOneCustomerEvent->getCustomer());
        $this->assertEquals($customerId, $getOneCustomerEvent->getCustomerId());
        $this->assertEquals('controller.action.customer.getOneCustomer', $getOneCustomerEvent::NAME);
        $getOneCustomerEvent->setCustomer($customer);
        $this->assertEquals($customer->getName(), $getOneCustomerEvent->getCustomer()->getName());

    }
}