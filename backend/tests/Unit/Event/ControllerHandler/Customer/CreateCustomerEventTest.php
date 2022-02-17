<?php

use App\Event\ControllerHandler\Customer\CreateCustomerEvent;
use App\Factory\Customer\CustomerFactory;
use PHPUnit\Framework\TestCase;

class CreateCustomerEventTest extends TestCase
{
    public function testEventSetup()
    {
        $customerData = ['name' => 'Jan Kowalski'];
        $customerFactory = new CustomerFactory();
        $customer = $customerFactory->create($customerData);

        $createCustomerEvent = new CreateCustomerEvent($customerData);


        $this->assertEquals(null, $createCustomerEvent->getCustomer());
        $this->assertEquals($customerData, $createCustomerEvent->getCustomerData());

        $this->assertEquals('controller.action.customer.createCustomer', $createCustomerEvent::NAME);


        $createCustomerEvent->setCustomer($customer);

        $this->assertEquals($customerData['name'], $createCustomerEvent->getCustomer()->getName());

    }
}