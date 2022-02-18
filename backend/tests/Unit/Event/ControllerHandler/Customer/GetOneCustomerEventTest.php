<?php

use App\DTO\CustomerDTO;
use App\Event\ControllerHandler\Customer\GetOneCustomerEvent;
use App\Factory\Customer\CustomerFactory;
use PHPUnit\Framework\TestCase;

class GetOneCustomerEventTest extends TestCase
{
    public function testEventSetup() {
        $customerData = ['name' => 'Jan Kowalski'];
        $customerFactory = new CustomerFactory();
        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerFactory->create($customerDTO);
        $customerId = 1;

        $getOneCustomerEvent = new GetOneCustomerEvent($customerId);

        $this->assertEquals(null, $getOneCustomerEvent->getCustomer());
        $this->assertEquals($customerId, $getOneCustomerEvent->getCustomerId());
        $this->assertEquals('controller.action.customer.getOneCustomer', GetOneCustomerEvent::NAME);
        $getOneCustomerEvent->setCustomer($customer);
        $this->assertEquals($customer->getName(), $getOneCustomerEvent->getCustomer()->getName());

    }
}