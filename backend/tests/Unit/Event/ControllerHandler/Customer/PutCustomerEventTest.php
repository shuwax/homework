<?php

use App\Event\ControllerHandler\Customer\UpdateCustomerEvent;
use App\Factory\Customer\CustomerFactory;
use PHPUnit\Framework\TestCase;

class PutCustomerEventTest extends TestCase
{
    public function testEventSetup()
    {
        $customerData = ['name' => 'Jan Kowalski'];
        $customerUpdateData = ['name' => 'Monika Kowalski'];
        $customerFactory = new CustomerFactory();
        $customer = $customerFactory->create($customerData);
        $customerId = 1;

        $updateCustomerEvent = new UpdateCustomerEvent($customerUpdateData, $customerId);


        $this->assertEquals(null, $updateCustomerEvent->getCustomer());
        $this->assertEquals($customerUpdateData, $updateCustomerEvent->getCustomerData());

        $this->assertEquals('controller.action.customer.updateCustomer', UpdateCustomerEvent::NAME);

        $updateCustomerEvent->setCustomer($customer);
        $this->assertEquals($customer->getName(), $updateCustomerEvent->getCustomer()->getName());

    }
}