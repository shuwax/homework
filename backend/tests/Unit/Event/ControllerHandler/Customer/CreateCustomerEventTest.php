<?php

use App\DTO\CustomerDTO;
use App\Event\ControllerHandler\Customer\CreateCustomerEvent;
use App\Factory\Customer\CustomerFactory;
use PHPUnit\Framework\TestCase;

class CreateCustomerEventTest extends TestCase
{
    public function testEventSetup()
    {
        $customerData = ['name' => 'Jan Kowalski'];
        $customerFactory = new CustomerFactory();
        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerFactory->create($customerDTO);

        $createCustomerEvent = new CreateCustomerEvent($customerDTO);


        $this->assertEquals(null, $createCustomerEvent->getCustomer());
        $this->assertEquals($customerData['name'], $createCustomerEvent->getCustomerDTO()->getName());

        $this->assertEquals('controller.action.customer.createCustomer', CreateCustomerEvent::NAME);


        $createCustomerEvent->setCustomer($customer);

        $this->assertEquals($customerData['name'], $createCustomerEvent->getCustomer()->getName());

    }
}