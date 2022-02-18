<?php

use App\DTO\CustomerDTO;
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
        $customerDTO = new CustomerDTO($customerData['name']);
        $customerUpdateDTO = new CustomerDTO($customerUpdateData['name']);

        $customer = $customerFactory->create($customerDTO);
        $customerId = 1;

        $updateCustomerEvent = new UpdateCustomerEvent($customerUpdateDTO, $customerId);


        $this->assertEquals(null, $updateCustomerEvent->getCustomer());
        $this->assertEquals($customerUpdateData['name'], $updateCustomerEvent->getCustomerDTO()->getName());

        $this->assertEquals('controller.action.customer.updateCustomer', UpdateCustomerEvent::NAME);

        $updateCustomerEvent->setCustomer($customer);
        $this->assertEquals($customer->getName(), $updateCustomerEvent->getCustomer()->getName());

    }
}